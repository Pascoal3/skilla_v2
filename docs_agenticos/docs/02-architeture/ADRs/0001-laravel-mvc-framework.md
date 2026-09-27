# ADR 0001: Framework e Padrão Arquitetural — Laravel MVC

**Status:** Accepted
**Owner:** TODO(USER)
**Last updated:** 2026-09-26

---

## Context

O projeto Skilla precisa de uma base sólida para um marketplace freelance com:
- Autenticação e autorização complexa (roles, ownership, state-based)
- Transações financeiras ACID (escrow, carteira, créditos)
- Tempo real (chat WebSocket)
- Jobs assíncronos (notificações, emails, webhooks, crons)
- Deploy em VPS Linux (Ubuntu) com stack tradicional
- Equipe familiarizada com PHP/Laravel
- Time-to-market crítico (MVP em ~3 meses)

Alternativas consideradas:
1. **Node.js (NestJS/Express) + TypeScript** — Ecossistema JS, mas falta ferramentas built-in para queue/scheduler/broadcasting; auth financeira mais manual
2. **Go (Gin/Fiber) + gRPC** — Performance superior, mas curva de aprendizado alta; ecossistema financeiro menos maduro
3. **Python (Django/FastAPI)** — Produtividade alta, mas WebSocket nativo fraco; deploy mais complexo em VPS simples
4. **Laravel (MVC) + Blade + Alpine.js** — **Escolhido**

---

## Decision

Adotar **Laravel 11 (LTS)** com padrão **MVC modular** como framework principal, utilizando:

- **Backend API + Web**: Laravel Controllers + FormRequests + Policies + Services
- **Frontend**: Blade (SSR) + Tailwind CSS v4 + Alpine.js (interatividade pontual)
- **Auth**: JWT stateless (`tymon/jwt-auth`) em cookie HttpOnly
- **Database**: MySQL 8 (Eloquent ORM)
- **Cache/Queue/PubSub**: Redis 7 / Valkey
- **WebSocket**: Laravel Reverb (Pusher protocol v7, open source, escala horizontal via Redis)
- **Scheduler**: Laravel Scheduler (crons: expiração jobs, highlights, reconciliação)
- **Storage**: Flysystem (local MVP → S3/MinIO prod)
- **Testes**: Pest PHP (Unit + Feature + Browser opcional)
- **Code Quality**: PHPStan (Level 5), Laravel Pint (PSR-12)

---

## Consequences

### Positivas
- **Velocidade**: Features completas em dias (auth, queue, scheduler, broadcasting, policies, validation)
- **Ecossistema Financeiro**: Packages maduros para pagamentos, decimal handling, audit trails
- **Manutenibilidade**: Convenções claras, separação de responsabilidades (Services, Policies, Events)
- **Escalabilidade Horizontal**: PHP-FPM + Nginx + Reverb (Redis pub/sub) + Queue Workers independentes
- **Deploy Simples**: VPS Ubuntu + Nginx + Supervisor + Docker opcional
- **Comunidade PT/BR**: Documentação, pacotes, talentos disponíveis em Angola/Brasil

### Negativas
- **Performance Bruta**: PHP < Go/Node para CPU-intensive (mitigado: queue para trabalho pesado, cache Redis)
- **Memory Footprint**: PHP-FPM workers consomem mais RAM (mitigado: `pm.max_children` tuning, Octane futuro)
- **Type Safety**: PHP tipado mas não tão rigoroso quanto TypeScript/Go (mitigado: PHPStan Level 5, strict_types)

### Riscos
- **Vendor Lock-in**: Laravel-specific patterns (mitigado: Services isolados, interfaces para gateways pagamento)
- **Reverb Maturity**: Relativamente novo (v1.x, 2024); fallback Pusher/Soketi se crítico

---

## Alternatives Considered

| Alternativa | Prós | Contras | Decisão |
|-------------|------|---------|---------|
| **Symfony** | Mais flexível, enterprise | Curva aprendizado, verbose, menos "batteries included" para MVP | Rejeitado |
| **Laravel + Inertia.js (React/Vue)** | SPA moderna, type-safe frontend | Duas codebases, SEO complexo, build step, auth state sync | Rejeitado (MVP) — Reavaliar v1.5 |
| **Laravel + Livewire** | Full-stack reativo, sem JS | Payload maior, latência servidor, menos controle UI | Rejeitado — Alpine.js suficiente para interatividade |
| **API-only (Sanctum) + Mobile App** | Separação clara, mobile-first | Duplo esforço UI, auth state complexo, time-to-market 2x | Rejeitado MVP — PWA v1.0 |

---

## Related docs
- [tech-stack.md](tech-stack.md)
- [architeture-document.md](architeture-document.md)
- [TRD.md](TRD.md)
- [coding-standards.md](coding-standards.md)
- [../06-environment/environment-specification.md](../06-environment/environment-specification.md)