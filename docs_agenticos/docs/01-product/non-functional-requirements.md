# Requisitos Não-Funcionais — Skilla

**Status:** Draft
**Owner:** TODO(USER)
**Last updated:** 2026-09-26

---

## Convenções

- **RNF** = Requisito Não-Funcional
- Classificação: **Crítico** (bloqueia lançamento) | **Importante** (degradação aceitável temporária) | **Desejável** (nice-to-have)

---

## RNF01 — Segurança

| ID | Requisito | Classificação | Detalhes / Implementação |
|----|-----------|---------------|--------------------------|
| RNF01.1 | Autenticação JWT stateless em cookie HttpOnly + Secure + SameSite=Lax | Crítico | `tymon/jwt-auth` v2.3; TTL 24h; refresh token rota dedicada; blocklist no logout |
| RNF01.2 | Senhas com hash bcrypt (cost 12) | Crítico | Laravel `Hash::make()` default; cast `password` → `hashed` no Model |
| RNF01.3 | Validação de entrada em todas as camadas (Request classes + Model mutators) | Crítico | FormRequests no Controller; `$fillable` + `$casts` no Model |
| RNF01.4 | Proteção CSRF em rotas web (Blade forms) | Crítico | `@csrf` directive; `VerifyCsrfToken` middleware |
| RNF01.5 | Proteção SQL Injection (Eloquent ORM + parameter binding) | Crítico | Nunca raw SQL com interpolação; usar `whereRaw` com bindings se necessário |
| RNF01.6 | Proteção XSS (Blade `{{ }}` escaping + CSP headers) | Crítico | CSP: `default-src 'self'; script-src 'self' 'unsafe-inline' https://cdn.tailwindcss.com; style-src 'self' 'unsafe-inline'; img-src 'self' data: https:; connect-src 'self' wss://` |
| RNF01.7 | Rate limiting: login (5/min), registro (3/min), propostas (10/min), chat (30/min), API geral (60/min) | Crítico | `throttle` middleware + Redis store; chaves por IP + user_id |
| RNF01.8 | Controle de acesso por papel (Policies/Gates): cliente só acessa seus jobs/contratos; freelancer só suas propostas/contratos | Crítico | `JobPolicy`, `ProposalPolicy`, `ContractPolicy`, `ConversationPolicy` |
| RNF01.9 | Upload seguro: validação MIME (pdf, jpeg, png, webp), máx 5MB, rename UUID, storage fora de public, scan antivírus (futuro) | Crítico | `Storage::disk('private')`; `File::mimeType()`; `validateFile()` em Service |
| RNF01.10 | Logs de auditoria em operações financeiras (escrow, carteira, créditos) | Importante | `transacoes_carteiras`, `transacoes_escrow`, `transacoes_credito` com `id_referencia`, `tipo_referencia`, `criado_em` |
| RNF01.11 | Criptografia em trânsito (TLS 1.2+) e em repouso (MySQL SSL, backups criptografados) | Importante | Nginx + Let's Encrypt; MySQL `require_secure_transport=ON` |
| RNF01.12 | Headers de segurança: HSTS, X-Frame-Options=DENY, X-Content-Type-Options=nosniff, Referrer-Policy=strict-origin-when-cross-origin | Importante | Middleware `SecurityHeaders` ou Nginx `add_header` |

---

## RNF02 — Desempenho

| ID | Requisito | Classificação | Detalhes / Implementação |
|----|-----------|---------------|--------------------------|
| RNF02.1 | Tempo de resposta P95 < 300ms para endpoints de leitura (jobs, propostas, perfil) | Crítico | Índices DB otimizados; eager loading (`with()`); cache Redis para listagens pesadas |
| RNF02.2 | Tempo de resposta P95 < 500ms para endpoints de escrita (criar job, proposta, contrato) | Crítico | Transações DB curtas; queue para side-effects (notificações, emails) |
| RNF02.3 | Chat WebSocket: latência < 200ms (mesma região), entrega garantida (ack) | Crítico | Laravel Reverb (Pusher protocol); canais privados `conversation.{id}`; presence para online/offline |
| RNF02.4 | Consultas DB otimizadas: índices compostos em `(status, created_at)`, `(cliente_id, status)`, `(freelancer_id, status)`, FKs indexadas | Crítico | Ver `database-schema.md` e migrations |
| RNF02.5 | Suporte a 500 usuários simultâneos (100 WebSocket ativos) sem degradação | Importante | PHP-FPM `pm.max_children=50`; Reverb horizontal scaling (Redis pub/sub); queue workers `>= 4` |
| RNF02.6 | Paginação padrão 15 itens; cursor pagination para feeds infinitos | Importante | `paginate(15)` / `cursorPaginate(20)` |
| RNF02.7 | Assets front: Vite build produção (minify, hash, gzip/broli); Tailwind JIT purged | Importante | `npm run build` → `public/build`; Nginx `gzip_static on; brotli on;` |

---

## RNF03 — Usabilidade & Acessibilidade

| ID | Requisito | Classificação | Detalhes |
|----|-----------|---------------|----------|
| RNF03.1 | Mobile-first: breakpoints <640px (mobile), 640–1024px (tablet), >1024px (desktop) | Crítico | Tailwind CSS v4; container max-w-7xl; grid 12 cols; gap-6 |
| RNF03.2 | Feedback visual em todas as ações: toast (sucesso/erro/aviso), loading (skeleton/spinner), empty states ilustrados | Crítico | Componente `Toast`, `ButtonLoading`, `EmptyState` |
| RNF03.3 | Validação client-side (Alpine.js) + server-side com mensagens em pt-AO | Crítico | `wire:model` / `x-model` + `x-show` errors; FormRequest messages |
| RNF03.4 | Contraste WCAG AA (4.5:1 texto normal, 3:1 large text); foco visível (`focus-visible:ring-2`) | Importante | Paleta `documentation_guide.md` / `ui-plan.md` validada |
| RNF03.5 | Navegação por teclado funcional (tab order lógico, skip links) | Importante | Semantic HTML (`<main>`, `<nav>`, `<button>`, `<a>`) |
| RNF03.6 | Suporte a pt-AO (formatação moeda Kz, datas DD/MM/AAAA, número telefone +244) | Importante | Helpers `formatKz()`, `formatDateBR()`, `formatPhoneAO()` |

---

## RNF04 — Disponibilidade & Confiabilidade

| ID | Requisito | Classificação | Detalhes |
|----|-----------|---------------|----------|
| RNF04.1 | Uptime alvo 99.5% (excluindo manutenção programada) | Importante | Health check endpoint `/up`; monitoramento uptime (UptimeRobot / Prometheus) |
| RNF04.2 | Deploy zero-downtime (blue-green ou rolling) | Importante | `php artisan down --render="errors.503"` durante migrações; Reverb graceful reload |
| RNF04.3 | Backup DB diário (mysqldump + compress + upload S3/compatível) + restore testado mensal | Crítico | Cron `0 3 * * *`; retenção 30 dias; script restore documentado |
| RNF04.4 | Transações ACID em operações financeiras (escrow, carteira, créditos) | Crítico | `DB::transaction()` com `lockForUpdate()` em carteiras; `SELECT FOR UPDATE` |
| RNF04.5 | Idempotência em endpoints críticos (webhook pagamento, aceitar proposta) | Importante | Chave de idempotência `X-Idempotency-Key` + tabela `idempotency_keys` (futuro) |
| RNF04.6 | Páginas de erro amigáveis (404, 503, 500) sem stack trace em produção | Importante | `render()` em `App\Exceptions\Handler`; views `errors/404.blade.php`, `errors/500.blade.php` |

---

## RNF05 — Escalabilidade & Manutenibilidade

| ID | Requisito | Classificação | Detalhes |
|----|-----------|---------------|----------|
| RNF05.1 | Arquitetura modular (Services, Actions, Policies, FormRequests) — baixo acoplamento | Importante | `app/Services/*`, `app/Actions/*` (futuro), `app/Policies/*` |
| RNF05.2 | Migrations versionadas + seeders reprodutíveis para qualquer ambiente | Importante | `php artisan migrate:fresh --seed` passa em CI |
| RNF05.3 | Código segue PSR-12 + Laravel Pint (config `pint.json`) | Importante | `./vendor/bin/pint --test` em CI |
| RNF05.4 | Testes: Unit (≥70% Services), Feature (fluxos críticos), Browser (Pest + Dusk opcional) | Importante | `php artisan test` em CI; coverage `--min=70` |
| RNF05.5 | Observabilidade: logs JSON (Laravel Octane / Pail), métricas Prometheus (futuro), tracing (futuro) | Desejável | `laravel/pail` para logs; `prometheus/client_php` para métricas |

---

## RNF06 — Compatibilidade & Legais

| ID | Requisito | Classificação | Detalhes |
|----|-----------|---------------|----------|
| RNF06.1 | PHP 8.3+, MySQL 8.0+, Node 20+, Nginx 1.24+ | Crítico | Versões em `composer.json`, `package.json`, `Dockerfile` (futuro) |
| RNF06.2 | Funcionamento em Linux (produção) e Windows/macOS (dev local) | Importante | Docker Compose para paridade (futuro); `.env.example` documentado |
| RNF06.3 | Conformidade LGPD Angola (Lei 22/11): consentimento, direito ao esquecimento, portabilidade, DPO | Importante | `PrivacyPolicy`, `TermsOfService`, `DataExport` job, `AccountDeletion` action |
| RNF06.4 | Termos de Uso e Política de Privacidade acessíveis no footer | Importante | Views `legal/terms.blade.php`, `legal/privacy.blade.php` |

---

## RNF07 — Específicos de Domínio (Financeiro)

| ID | Requisito | Classificação | Detalhes |
|----|-----------|---------------|----------|
| RNF07.1 | Precisão monetária: `decimal(15,2)` em todas as colunas de valor (Kz) | Crítico | Migrations: `saldo`, `valor`, `valor_acordado`, `comissao`, `orcamento_fixo` |
| RNF07.2 | Locking pessimista (`lockForUpdate`) em carteiras durante débito/crédito | Crítico | `WalletService::debitar/depositar` usa `Wallet::where('id', $id)->lockForUpdate()->firstOrFail()` |
| RNF07.3 | Comissão calculada no momento da retenção (snapshot) e não mutável depois | Crítico | `EscrowService::reter()` calcula e persiste `valor_comissao`, `valor_liquido_freelancer` |
| RNF07.4 | Reconciliação diária: soma saldos carteiras = soma transações (job scheduler) | Importante | Command `wallet:reconcile` roda daily; alerta se divergência > 0.01 Kz |
| RNF07.5 | Auditoria imutável: `transacoes_carteiras` e `transacoes_escrow` nunca UPDATE/DELETE (apenas INSERT) | Crítico | Models sem `$fillable` para `id`, `criado_em`; policies `delete` → `false` |

---

## Related docs
- [functional-requirements.md](functional-requirements.md)
- [business-rules.md](business-rules.md)
- [business-logic-security.md](business-logic-security.md)
- [../02-architeture/security-guidelines.md](../02-architeture/security-guidelines.md)
- [../02-architeture/tech-stack.md](../02-architeture/tech-stack.md)
- [../03-data/database-schema.md](../03-data/database-schema.md)