# Technical Requirements Document (TRD) — Skilla

**Status:** Draft
**Owner:** TODO(USER)
**Last updated:** 2026-09-26

---

## Visão Geral

Este documento especifica os requisitos técnicos não-funcionais e de infraestrutura para sustentar o produto definido no [PRD](../01-product/PRD.md) e [Requisitos Não-Funcionais](../01-product/non-functional-requirements.md).

---

## 1. Performance

| Requisito | Especificação | Validação |
|-----------|---------------|-----------|
| **Throughput API** | ≥ 200 req/s (endpoints leitura) / ≥ 50 req/s (escrita) | k6 load test |
| **Latência P95** | < 300ms (leitura) / < 500ms (escrita) | APM / logs |
| **WebSocket** | < 200ms latência mensagem (mesma AZ) | Reverb metrics |
| **Concorrência** | 500 usuários simultâneos (100 WS ativos) | Stress test |
| **Tamanho resposta** | < 50KB JSON típico; paginação 15 itens | Network tab |

### Otimizações Implementadas
- Eager loading (`with()`) para evitar N+1
- Índices compostos: `(status, created_at)`, `(cliente_id, status)`, `(freelancer_id, status)`
- Cache Redis para listagens pesadas (jobs feed, freelancers) — TTL 60s
- Queue para side-effects: notificações, emails, webhooks
- `cursorPaginate` para feeds infinitos

---

## 2. Escalabilidade

| Dimensão | Estratégia | Limite Atual | Próximo Passo |
|----------|------------|--------------|---------------|
| **HTTP (PHP-FPM)** | Horizontal: múltiplos workers behind Nginx | `pm.max_children=50` (single VM) | Load balancer + fleet VMs / Kubernetes |
| **WebSocket (Reverb)** | Horizontal: Redis pub/sub + múltiplos servidores Reverb | 1 servidor (10k conexões) | Fleet Reverb + sticky sessions / consistent hashing |
| **Queue Workers** | Horizontal: `php artisan queue:work --timeout=60 --tries=3` múltiplos | 4 workers (database driver) | Redis driver + Horizon para monitoramento |
| **Database (MySQL)** | Vertical (MVP) → Read replicas (v1.0) | Single primary | Primary + 2 replicas; ProxySQL |
| **Storage** | Local (MVP) → S3-compatível (MinIO / AWS S3) | `storage/app/private` | `league/flysystem-aws-s3-v3` |
| **Cache** | Redis single (MVP) → Cluster | 1 instância | Redis Cluster / Valkey |

---

## 3. Observabilidade

| Componente | Ferramenta | Métricas/Logs Chave |
|------------|------------|---------------------|
| **Logs** | Laravel Pail (dev) / JSON file + Loki (prod) | `request_id`, `user_id`, `duration_ms`, `memory_mb`, `sql_queries` |
| **Métricas** | Prometheus (exporter `prometheus/client_php`) | `http_requests_total`, `http_request_duration_seconds`, `queue_jobs_processed`, `ws_connections_active` |
| **Tracing** | OpenTelemetry (futuro) | Distributed traces HTTP + WS + Queue |
| **Alertas** | Prometheus Alertmanager → Slack/Email | `http_5xx_rate > 1%`, `queue_lag > 300s`, `ws_connections > 8000`, `disk_usage > 80%` |
| **Health Check** | `GET /up` (Laravel Octane) + custom `/health` | DB connectivity, Redis, Reverb, Disk, Queue lag |

### Log Structure (JSON)
```json
{
  "timestamp": "2026-09-26T14:30:00.123Z",
  "level": "info",
  "message": "Job published",
  "context": {
    "request_id": "abc-123",
    "user_id": "uuid-cliente",
    "job_id": "uuid-job",
    "duration_ms": 45,
    "memory_mb": 12,
    "sql_count": 3
  }
}
```

---

## 4. Jobs / Filas (Queue)

| Job | Queue | Prioridade | Timeout | Tries | Backoff |
|-----|-------|------------|---------|-------|---------|
| `SendNotification` | `notifications` | High | 30s | 3 | 10s, 30s, 60s |
| `SendEmail` | `emails` | Normal | 60s | 3 | 30s, 60s, 120s |
| `ProcessWebhook` | `webhooks` | High | 30s | 5 | 5s, 10s, 30s, 60s, 120s |
| `GenerateReport` | `reports` | Low | 300s | 1 | - |
| `ReconcileWallets` | `maintenance` | Low | 120s | 1 | - |

**Driver:** `database` (MVP) → `redis` (v1.0)
**Monitoramento:** Laravel Horizon (quando Redis)

---

## 5. WebSockets (Tempo Real)

| Aspecto | Especificação |
|---------|---------------|
| **Servidor** | Laravel Reverb (Pusher protocol v7) |
| **Canais** | Privados: `conversation.{conversa_id}` (auth via JWT) |
| **Eventos** | `MessageSent`, `MessageRead`, `TypingIndicator` |
| **Autenticação** | `Broadcast::channel('conversation.{id}', fn($user, $id) => $user->can('access', Conversation::find($id)))` |
| **SSL** | WSS obrigatório em produção (Nginx proxy + certificado) |
| **Escala** | Redis pub/sub entre múltiplos Reverb; `REVERB_HOST=0.0.0.0`, `REVERB_PORT=8080` |
| **Limites** | Max 10k conexões/servidor; mensagem max 64KB |

---

## 6. Armazenamento de Anexos

| Tipo | Local (MVP) | Produção (v1.0) | Políticas |
|------|-------------|-----------------|-----------|
| **Avatar / Perfil** | `storage/app/public/avatars/` | S3 `skilla-avatars/` | Público (CDN), max 2MB, webp |
| **Anexos Job** | `storage/app/private/jobs/{job_id}/` | S3 `skilla-jobs/` | Privado, signed URL (1h), max 5MB |
| **Chat Files** | `storage/app/private/chat/{conversa_id}/` | S3 `skilla-chat/` | Privado, signed URL (1h), max 5MB |
| **Portfólio** | `storage/app/public/portfolio/` | S3 `skilla-portfolio/` | Público (CDN), max 3MB |

**Validação:** MIME real (`finfo`), extensão allowlist, rename UUID, scan antivírus (futuro).

---

## 7. Estratégia de Testes

| Nível | Ferramenta | Cobertura Alvo | Onde Roda |
|-------|------------|----------------|-----------|
| **Unit** | Pest PHP | ≥ 70% Services (`app/Services/*`) | CI (cada PR) |
| **Feature** | Pest + Laravel Testing | Fluxos críticos (UC01–UC15) | CI (cada PR) |
| **Browser** | Pest + Dusk (opcional) | Journeys E2E (login → job → proposta → chat → pagamento) | Nightly / Pre-deploy |
| **Contract** | Pact (futuro) | API consumers (mobile, webhooks) | CI |
| **Load** | k6 | Cenários: 100 VUs, 500 VUs | Staging (semanal) |
| **Segurança** | OWASP ZAP / SAST (Psalm/PHPStan) | High/Critical 0 | CI |

### Cenários Críticos de Teste (Feature)
1. `test_client_can_publish_job_and_freelancer_proposes`
2. `test_accept_proposal_creates_contract_escrow_chat_atomically`
3. `test_approve_work_releases_escrow_90_10_split`
4. `test_dispute_freezes_escrow_admin_resolves`
5. `test_wallet_balance_never_negative_under_concurrency`
6. `test_proposal_requires_credit_debit_atomic`
7. `test_job_expires_after_30_days_cron`

---

## 8. Migrações e Seeders

### Convenções de Migração
- Nomes: `create_{table}_table` / `add_{col}_to_{table}_table` / `modify_{col}_on_{table}_table`
- Sempre `down()` reversível
- FKs com `onDelete('cascade'|'set null'|'restrict')` explícito
- Índices declarados no `up()`

### Seeders Obrigatórios (Produção)
| Seeder | Dados | Essencial |
|--------|-------|-----------|
| `ProvinciaSeeder` | 18 províncias Angola | ✅ |
| `CategoriaSeeder` | Categorias base (Design, Dev, Marketing, etc.) | ✅ |
| `HabilidadesSeeder` | Skills normalizadas (~50) | ✅ |
| `CarteiraPlataformaSeeder` | 1 carteira `tipo=plataforma` | ✅ |
| `ConfigSeeder` | Pacotes créditos, comissão, limites | ✅ |

**Comando full reset:** `php artisan migrate:fresh --seed`

---

## 9. Segurança (Resumo — Detalhes em `security-guidelines.md`)

| Camada | Medidas |
|--------|---------|
| **Auth** | JWT HttpOnly cookie, TTL 24h, refresh rota, blocklist logout |
| **Autorização** | Policies em todos Controllers; Gates para ações admin |
| **Rate Limit** | Por IP + user_id; tiers: auth(5/min), api(60/min), ws(30/min) |
| **Upload** | MIME real, 5MB max, UUID rename, storage privado, headers download |
| **DB** | Transações ACID + `lockForUpdate` em carteiras; `decimal(15,2)` dinheiro |
| **Headers** | CSP, HSTS, X-Frame-Options, X-Content-Type-Options, Referrer-Policy |
| **Auditoria** | `transacoes_carteiras`, `transacoes_escrow`, `transacoes_credito` imutáveis (apenas INSERT) |

---

## 10. CI/CD Pipeline (GitHub Actions / GitLab CI)

```yaml
stages:
  - lint:        pint --test, phpstan --level=5, npm run lint
  - test:        php artisan test --parallel --coverage --min=70
  - build:       npm run build (Vite production)
  - docker:      build image (multi-stage: composer + node + php-fpm + nginx)
  - deploy:      staging (auto), production (manual approval)
```

**Artefatos:** Docker image tag `skilla:{sha}`; source maps para Sentry.

---

## Related docs
- [architeture-document.md](architeture-document.md)
- [tech-stack.md](tech-stack.md)
- [dev-plan.md](dev-plan.md)
- [coding-standards.md](coding-standards.md)
- [security-guidelines.md](security-guidelines.md)
- [../01-product/non-functional-requirements.md](../01-product/non-functional-requirements.md)
- [../03-data/database-schema.md](../03-data/database-schema.md)