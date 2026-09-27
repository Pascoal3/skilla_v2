# Stack Tecnológica — Skilla

**Status:** Draft
**Owner:** TODO(USER)
**Last updated:** 2026-09-26

---

## Backend

| Componente | Tecnologia | Versão | Justificativa |
|------------|------------|--------|---------------|
| **Framework** | Laravel | 11.x (LTS) | Ecossistema maduro, MVC, Eloquent, Queue, Scheduler, Broadcasting, Policies, Testing |
| **Linguagem** | PHP | 8.3 | Performance (JIT), typed properties, enums, readonly, attributes |
| **Auth** | tymon/jwt-auth | 2.3 | Stateless JWT, cookies HttpOnly, refresh tokens, blocklist |
| **Database** | MySQL | 8.0 | ACID, JSON, CTE, Window functions, spatial (futuro), amplamente suportado |
| **Cache/Queue/PubSub** | Redis / Valkey | 7.x | Sub-ms latency, pub/sub para Reverb, sorted sets para rate limit |
| **WebSocket** | Laravel Reverb | 1.x | Pusher protocol v7, horizontal scaling via Redis, open source, zero custo |
| **Storage** | League Flysystem | 3.x | Abstração: local (dev) → S3/MinIO (prod) |
| **Validação** | Laravel Validation | Built-in | Fluente, mensagens custom, Rule objects |
| **Testes** | Pest PHP | 2.x / 3.x | Sintaxe expressiva, parallel, coverage, Dusk integration |
| **Static Analysis** | PHPStan / Psalm | Level 5+ | Detecção bugs tipo, dead code, security |
| **Code Style** | Laravel Pint | 1.x | PSR-12 + Laravel conventions, auto-fix |
| **Process Manager** | Supervisor | 4.x | Gerencia queue workers, Reverb, scheduler em produção |
| **Web Server** | Nginx | 1.24+ | Reverse proxy, SSL termination, static assets, rate limit |
| **Containerização** | Docker | 24+ | Paridade dev/staging/prod, multi-stage builds |

---

## Frontend

| Componente | Tecnologia | Versão | Justificativa |
|------------|------------|--------|---------------|
| **Template Engine** | Blade | Built-in | Server-side rendering, components, layouts, directives, integração nativa Laravel |
| **CSS Framework** | Tailwind CSS | 4.x (JIT) | Utility-first, tree-shaking nativo, design system consistente, performance |
| **JavaScript** | Alpine.js | 3.x | Reactivity leve (15kb), integração Blade, sem build step obrigatório |
| **Build Tool** | Vite | 5.x | HMR instantâneo, bundling otimizado, code splitting, TS support |
| **Ícones** | Heroicons / Lucide | Latest | SVG inline, tree-shakable, consistente |
| **Charts (futuro)** | Chart.js / ApexCharts | Latest | Dashboards admin, métricas |

---

## Infraestrutura & DevOps

| Componente | Tecnologia | Versão | Justificativa |
|------------|------------|--------|---------------|
| **OS Produção** | Ubuntu | 22.04 LTS / 24.04 LTS | Suporte longo, pacotes atualizados |
| **CI/CD** | GitHub Actions | - | Nativo no repo, matrix jobs, secrets, environments |
| **Monitoramento** | Prometheus + Grafana | Latest | Métricas custom, alertas, dashboards |
| **Logs** | Loki + Promtail | Latest | Agregação logs JSON, query LogQL |
| **Tracing** | OpenTelemetry + Jaeger | Latest | Distributed tracing (futuro) |
| **Uptime** | UptimeRobot / Better Uptime | - | Health checks externos, alertas SMS/Email |
| **Backup** | mysqldump + rclone → S3/Wasabi | - | Diário, retenção 30d, restore testado |
| **DNS/SSL** | Cloudflare | - | DNS, WAF, DDoS, CDN, SSL gratuito, proxy Reverb |
| **Secrets** | GitHub Secrets / 1Password / Vault | - | Não comitar `.env`; rotação periódica |

---

## Dependências Composer (Principais)

```json
{
  "require": {
    "php": "^8.3",
    "laravel/framework": "^11.8",
    "tymon/jwt-auth": "^2.3",
    "doctrine/dbal": "^4.4"
  },
  "require-dev": {
    "pestphp/pest": "^2.34",
    "pestphp/pest-plugin-laravel": "^2.3",
    "laravel/pint": "^1.27",
    "phpstan/phpstan": "^1.11",
    "laravel/pail": "^1.2",
    "mockery/mockery": "^1.6",
    "nunomaduro/collision": "^8.6"
  }
}
```

**Pacotes de domínio (custom):**
- `app/Services/*` — Domain Services
- `app/Policies/*` — Authorization
- `app/Events/*` + `app/Listeners/*` — Domain Events
- `app/Console/Commands/*` — Scheduler commands

---

## Dependências NPM (Principais)

```json
{
  "devDependencies": {
    "@tailwindcss/vite": "^4.0.0",
    "tailwindcss": "^4.3.3",
    "vite": "^8.0.0",
    "laravel-vite-plugin": "^3.1",
    "concurrently": "^9.0.1"
  },
  "dependencies": {
    "@tailwindcss/cli": "^4.3.3",
    "alpinejs": "^3.14"
  }
}
```

---

## Versões Detectadas no Projeto (composer.json / package.json)

| Pacote | Versão | Fonte |
|--------|--------|-------|
| PHP | ^8.3 | `composer.json` |
| Laravel Framework | ^13.8 | `composer.json` *(Nota: versão 13.x = Laravel 11.x)* |
| tymon/jwt-auth | ^2.3 | `composer.json` |
| doctrine/dbal | ^4.4 | `composer.json` |
| Tailwind CSS | ^4.3.3 | `package.json` |
| Vite | ^8.0.0 | `package.json` |
| Alpine.js | ^3.14 | `package.json` (implícito) |
| Pest | ^2.34 | `composer.json` (dev) |
| Laravel Pint | ^1.27 | `composer.json` (dev) |

> **Nota:** Laravel 11.x usa versão Composer `^13.8` (Illuminate packages v113). Laravel 12.x seria `^14.x`.

---

## Justificativas Arquiteturais (Resumo)

| Decisão | Alternativas Consideradas | Razão |
|---------|---------------------------|-------|
| **Laravel (MVC) vs Symfony / Node / Go** | Symfony (complexo), Node (ecossistema JS), Go (curva aprendizado) | Time-to-market, ecossistema PHP em Angola, Eloquent, Reverb nativo, Jobs/Queue/Scheduler built-in |
| **MySQL vs PostgreSQL** | PostgreSQL (JSONB melhor, extensões) | MySQL 8 tem JSON, CTE, Window; hospedagem mais barata/comum em Angola; equipe familiar |
| **Reverb vs Pusher / Soketi / Centrifugo** | Pusher (custo alto), Soketi (menos maduro), Centrifugo (Go, complexo) | Reverb: open source, Pusher protocol, escala horizontal via Redis, zero custo, mantido pela Laravel |
| **Blade + Alpine vs React/Vue/Svelte (SPA)** | SPA (SEO complexo, 2 codebases, auth state sync) | SSR nativo, SEO-friendly, 1 codebase, produtividade alta, Alpine para interatividade pontual |
| **Tailwind v4 vs Bootstrap / CSS Modules** | Bootstrap (opinionated, pesado), CSS Modules (verbose) | Design system custom, JIT, tree-shaking, dark mode nativo, container queries |
| **JWT (stateless) vs Session (stateful)** | Session (simples, CSRF), Sanctum (SPA + token) | JWT: stateless, escala horizontal fácil, mobile-ready, cookie HttpOnly seguro |
| **Redis vs Database Queue** | Database (simples, sem dependência extra) | Redis: performance, pub/sub para Reverb, rate limit distribuído, sorted sets |
| **Local Storage vs S3** | S3 desde início | MVP: local simples; v1.0: S3/MinIO para escalabilidade, CDN, durabilidade |

---

## Matriz de Compatibilidade

| Componente | PHP | Laravel | MySQL | Redis | Node |
|------------|-----|---------|-------|-------|------|
| **Mínimo** | 8.2 | 11.x | 8.0 | 6.2 | 18.x |
| **Atual** | 8.3 | 11.x (v113) | 8.0 | 7.2 | 20.x |
| **Suportado até** | 8.3 (active até 2026-11) | 11.x (LTS até 2026-08) | 8.0 (EOL 2026-04) | 7.2 (active) | 20.x (LTS até 2026-10) |

**Plano de Upgrade:** PHP 8.4 (nov 2025) → Laravel 12 (fev 2026) → MySQL 8.4 / 9.0

---

## Related docs
- [TRD.md](TRD.md)
- [architeture-document.md](architeture-document.md)
- [dev-plan.md](dev-plan.md)
- [coding-standards.md](coding-standards.md)
- [security-guidelines.md](security-guidelines.md)
- [../01-product/non-functional-requirements.md](../01-product/non-functional-requirements.md)
- [../06-environment/environment-specification.md](../06-environment/environment-specification.md)