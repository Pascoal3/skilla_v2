# Diretrizes de Segurança — Skilla

**Status:** Draft
**Owner:** TODO(USER)
**Last updated:** 2026-09-26

---

## Visão Geral

Aplicação das práticas **OWASP Top 10** e **OWASP API Security Top 10** ao contexto Laravel + marketplace financeiro (escrow, carteira, créditos). Foco em **defesa em profundidade**.

---

## 1. Autenticação e Sessão (AuthN)

| Controle | Implementação | Status |
|----------|---------------|--------|
| **JWT Stateless** | `tymon/jwt-auth` v2.3; token em cookie `HttpOnly; Secure; SameSite=Lax` | ✅ |
| **TTL Access Token** | 24h (`config('jwt.ttl', 1440)`) | ✅ |
| **Refresh Token** | Rota `/refresh-token` (rotação + blacklist anterior) | ✅ |
| **Logout** | Invalida token (blocklist) + limpa cookie + invalida sessão | ✅ |
| **Rate Limit Auth** | `throttle:login` (5/min/IP+email); `throttle:register` (3/min/IP) | ✅ |
| **Password Policy** | Mín 8 chars; bcrypt cost 12 (`Hash::make()`); breached check (futuro) | ✅ |
| **2FA (TOTP)** | Não no MVP; planejado v1.0 (`laravel/fortify` + `pragmarx/google2fa`) | 🟡 |
| **Device Fingerprint** | Não no MVP; planejado v1.0 (detecção login suspeito) | 🟡 |

### Configuração JWT Crítica
```php
// config/jwt.php
'ttl' => env('JWT_TTL', 1440),           // 24h
'refresh_ttl' => env('JWT_REFRESH_TTL', 20160), // 14 dias
'blacklist_enabled' => true,
'blacklist_grace_period' => 0,
'cookie' => env('JWT_COOKIE', 'jwt_token'),
'cookie_secure' => env('JWT_COOKIE_SECURE', true),  // true em prod
'cookie_same_site' => 'Lax',             // CSRF protection
'cookie_http_only' => true,
```

---

## 2. Autorização (AuthZ)

| Princípio | Implementação |
|-----------|---------------|
| **Menor Privilégio** | Policies em **todos** Controllers (`$this->authorize()`) |
| **Role-Based** | Middleware `role:cliente|freelancer|admin` nas rotas |
| **Resource Ownership** | Policies verificam `user_id === resource.user_id` |
| **State-Based** | Policies verificam status do recurso (ex.: contrato `ativo`, escrow `retido`) |
| **Admin Isolation** | Rotas admin sob `middleware(['jwt.cookie', 'role:admin', 'ip:allowlist'])` |

### Exemplo Policy Completa
```php
// ContractPolicy.php
public function view(Perfil $user, Contract $contract): bool
{
    return $user->id === $contract->cliente_id 
        || $user->id === $contract->freelancer_id;
}

public function approveWork(Perfil $user, Contract $contract): bool
{
    return $user->id === $contract->cliente_id
        && $contract->status_contrato === 'ativo'
        && $contract->status_pagamento === 'retido'
        && $contract->trabalho_entregue_em !== null;
}
```

---

## 3. Proteção de Entrada (Input Validation)

| Vetor | Controle |
|-------|----------|
| **SQL Injection** | Eloquent ORM + Parameter Binding (nunca raw SQL com interpolação) |
| **XSS (Reflected/Stored)** | Blade `{{ }}` auto-escape; CSP headers; `strip_tags` em campos ricos |
| **CSRF** | `@csrf` em forms web; `VerifyCsrfToken` middleware; SameSite=Lax cookie |
| **File Upload** | Validação MIME real (`finfo`), extensão allowlist, max 5MB, rename UUID, storage privado, headers `Content-Disposition: attachment` |
| **Mass Assignment** | `$fillable` em **todos** Models; FormRequest `validated()` only |
| **Parameter Pollution** | FormRequest define campos esperados; ignora extras |

### Upload Seguro (Padrão)
```php
// ChatService::storeFile()
public function storeFile(UploadedFile $file, string $conversaId): array
{
    $allowedMimes = ['application/pdf', 'image/jpeg', 'image/png', 'image/webp'];
    $maxSize = 5 * 1024 * 1024; // 5MB
    
    if (!in_array($file->getMimeType(), $allowedMimes)) {
        throw new InvalidFileTypeException('Tipo de arquivo não permitido.');
    }
    if ($file->getSize() > $maxSize) {
        throw new FileTooLargeException('Arquivo excede 5MB.');
    }
    
    $filename = (string) Str::uuid() . '.' . $file->getClientOriginalExtension();
    $path = $file->storeAs("private/chat/{$conversaId}", $filename, 'private');
    
    return [
        'path' => $path,
        'filename' => $file->getClientOriginalName(),
        'size' => $file->getSize(),
        'mime' => $file->getMimeType(),
    ];
}
```

---

## 4. Segurança Financeira (Escrow, Carteira, Créditos)

| Risco | Controle |
|-------|----------|
| **Race Condition (saldo negativo)** | `lockForUpdate()` em `WalletService::debitar/depositar`; transação serializável |
| **Precisão Monetária** | `decimal(15,2)` em **todas** colunas de valor; `casts => 'decimal:2'` |
| **Comissão Imutável** | Snapshot no escrow (`valor_comissao`, `valor_liquido_freelancer`) na retenção |
| **Auditoria Imutável** | Tabelas `transacoes_carteiras`, `transacoes_escrow`, `transacoes_credito` — apenas `INSERT` (nunca UPDATE/DELETE) |
| **Reconciliação Diária** | Command `wallet:reconcile` compara `SUM(valor)` vs `carteiras.saldo`; alerta se divergência > 0.01 Kz |
| **Idempotência (Webhooks Futuro)** | Header `X-Idempotency-Key` + tabela `idempotency_keys` (planejado Multicaixa) |
| **Limites de Valor** | Hardcoded no Service (ex.: max 10M Kz/job, max 1M Kz saque/dia) — configurável v1.0 |

### Exemplo: WalletService com Locking
```php
public function debitar(Wallet $wallet, float $amount, string $type, array $meta = []): WalletTransaction
{
    return DB::transaction(function () use ($wallet, $amount, $type, $meta) {
        $lockedWallet = Wallet::where('id', $wallet->id)
            ->lockForUpdate()
            ->firstOrFail();
        
        if ($lockedWallet->saldo < $amount) {
            throw new InsufficientBalanceException('Saldo insuficiente.');
        }
        
        $lockedWallet->saldo -= $amount;
        $lockedWallet->save();
        
        return WalletTransaction::create([
            'id' => Str::uuid(),
            'carteira_origem_id' => $lockedWallet->id,
            'valor' => $amount,
            'tipo' => $type,
            'status' => 'concluido',
            'descricao' => $meta['descricao'] ?? 'Débito',
            'metodo_pagamento' => $meta['metodo'] ?? 'interno',
            'id_referencia' => $meta['id_referencia'] ?? null,
            'tipo_referencia' => $meta['tipo_referencia'] ?? null,
        ]);
    });
}
```

---

## 5. Headers de Segurança (HTTP)

### Nginx Config (Produção)
```nginx
# Security Headers
add_header X-Frame-Options "DENY" always;
add_header X-Content-Type-Options "nosniff" always;
add_header Referrer-Policy "strict-origin-when-cross-origin" always;
add_header Permissions-Policy "geolocation=(), microphone=(), camera=()" always;

# HSTS (apenas após validar HTTPS)
add_header Strict-Transport-Security "max-age=31536000; includeSubDomains; preload" always;

# CSP (ajustar para permitir Reverb WS + Tailwind JIT se necessário)
add_header Content-Security-Policy "
    default-src 'self';
    script-src 'self' 'unsafe-inline' https://cdn.tailwindcss.com;
    style-src 'self' 'unsafe-inline';
    img-src 'self' data: https:;
    font-src 'self' data:;
    connect-src 'self' wss://${REVERB_HOST};
    frame-ancestors 'none';
    base-uri 'self';
    form-action 'self';
" always;

# Remove headers que vazam info
proxy_hide_header X-Powered-By;
proxy_hide_header Server;
```

### Laravel Middleware (Backup)
```php
// app/Http/Middleware/SecurityHeaders.php
public function handle(Request $request, Closure $next): Response
{
    $response = $next($request);
    $response->headers->set('X-Frame-Options', 'DENY');
    $response->headers->set('X-Content-Type-Options', 'nosniff');
    $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');
    return $response;
}
```

---

## 6. WebSocket (Reverb) Segurança

| Controle | Implementação |
|----------|---------------|
| **Autenticação Canal** | `Broadcast::channel('conversation.{id}', fn($user, $id) => $user->can('access', Conversation::find($id)))` |
| **Canal Privado** | Prefixo `private-` (ex.: `private-conversation.123`) — exige auth |
| **WSS Obrigatório** | Nginx proxy SSL → Reverb; `REVERB_SCHEME=https` |
| **Rate Limit WS** | `throttle:ws` (30 mensagens/min/user) via middleware custom |
| **Validação Payload** | Listener valida `message` size < 64KB; tipo permitido |

---

## 7. Criptografia e Segredos

| Item | Especificação |
|------|---------------|
| **TLS** | TLS 1.2+ (Nginx + Let's Encrypt / Cloudflare); `ssl_protocols TLSv1.2 TLSv1.3` |
| **MySQL SSL** | `require_secure_transport=ON`; conexão PDO com `MYSQL_ATTR_SSL_CA` |
| **Redis TLS** | `REDIS_CLIENT=tls` (produção) |
| **APP_KEY** | 32 chars base64; rotacionar anualmente; nunca commitar |
| **JWT Secret** | Separado de `APP_KEY`; `JWT_SECRET` no `.env`; rotacionar semestralmente |
| **Secrets Management** | GitHub Secrets (CI); 1Password / Vault (produção); `.env` nunca no repo |
| **Backup Encryption** | `mysqldump | gpg --encrypt --recipient ops@skilla` antes de upload S3 |

---

## 8. Logging e Auditoria

### Log Structure (JSON)
```json
{
  "timestamp": "2026-09-26T14:30:00.123Z",
  "level": "info",
  "message": "Escrow released",
  "context": {
    "request_id": "abc-123",
    "user_id": "uuid-cliente",
    "contract_id": "uuid-contrato",
    "escrow_id": "uuid-escrow",
    "amount_freelancer": 45000.00,
    "amount_platform": 5000.00,
    "duration_ms": 120
  }
}
```

### Eventos Auditados (Obrigatório Log)
- Login/Logout/Refresh (sucesso + falha)
- Registro usuário
- Criação Job/Proposta/Contrato
- **Todas operações financeiras** (escrow reter/liberar/reembolsar, carteira débito/crédito, crédito compra/gasto/boost)
- Abertura/Resolução Disputa
- Ações Admin (banir, ajustar saldo, forçar resolução)
- Upload arquivos
- Falhas de autorização (403)

### Retenção
- Logs aplicação: 90 dias (hot) + 1 ano (cold/S3)
- Logs auditoria financeira: 5 anos (compliance)
- Logs acesso (Nginx): 30 dias

---

## 9. Proteção contra Abuso de Lógica de Negócio

| Abuso | Controle |
|-------|----------|
| **Spam Propostas** | 1 crédito/proposta + Rate limit 10/min + Max 15 propostas/job |
| **Auto-contratação** | Verificação telefone único; device fingerprint (v1.0); admin review |
| **Manipulação Avaliação** | Só após contrato `concluido`+`liberado`; unique(contrato, avaliador); detecção padrão |
| **Disputa Frívola** | Motivo obrigatório; admin decide com evidências; penalidade reincidente |
| **Enumeração Usuário** | Mensagens genéricas ("se email existe..."); rate limit |
| **Bypass Escrow** | Policies + Service privado; só `ContractService::approveWork` chama `EscrowService::liberar` |

---

## 10. Conformidade Legal (Angola)

| Requisito | Status |
|-----------|--------|
| **LGPD Angola (Lei 22/11)** | Privacy Policy, Terms of Service, Consentimento cookies, Direito ao esquecimento (job `AccountDeletion`), Portabilidade dados (export JSON) |
| **Lei de Transações Eletrônicas** | Contratos digitais válidos; logs imutáveis como evidência |
| **Regulamento BNA (Pagamentos)** | MVP: simulado (sem licença); v1.0: parceria instituição de pagamento licenciada |
| **Lei do Trabalho (Freelancers)** | Termos claros: não vínculo empregatício; plataforma = intermediadora |

---

## 11. Testes de Segurança Automatizados

| Ferramenta | Frequência | Critério Pass |
|------------|------------|---------------|
| **PHPStan** (level 5+) | CI (todo PR) | 0 erros |
| **Psalm** (security plugins) | CI (todo PR) | 0 issues High |
| **Laravel Pint** | CI (todo PR) | 0 style violations |
| **OWASP ZAP** (baseline) | Nightly / Pre-deploy | 0 Alertas High/Critical |
| **k6 Load + Security** | Semanal (staging) | P95 < 300ms; 0 erros 5xx |
| **Dependabot / Renovate** | Diário | Auto-PR para vulns (composer/npm) |

---

## 12. Incident Response (Runbook Resumido)

| Cenário | Ação Imediata | Escalação |
|---------|---------------|-----------|
| **Vazamento `.env` / `APP_KEY`** | Rotacionar `APP_KEY` + `JWT_SECRET`; revogar todos tokens; forçar logout global | CTO + Legal (se dados sensíveis) |
| **Saldo Carteira Negativo (Bug)** | `php artisan down`; auditoria `wallet:reconcile`; correção manual transações; deploy fix | Eng Lead + Finance |
| **DDoS / Abuso API** | Ativar Cloudflare "Under Attack Mode"; rate limit agressivo Nginx; block IPs | DevOps |
| **Disputa Fraude (Lavagem)** | Congelar contas envolvidas; preservar logs; reportar BNA (se > limite) | Compliance + Legal |
| **Reverb Down** | Restart `supervisorctl restart reverb`; health check `/up`; fallback polling se prolongado | DevOps |

---

## Related docs
- [business-logic-security.md](../01-product/business-logic-security.md)
- [coding-standards.md](coding-standards.md)
- [TRD.md](TRD.md)
- [architeture-document.md](architeture-document.md)
- [../03-data/database-schema.md](../03-data/database-schema.md) (tabelas auditoria)
- [../06-environment/environment-specification.md](../06-environment/environment-specification.md)