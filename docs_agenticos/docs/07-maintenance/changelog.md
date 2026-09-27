# Changelog — Skilla

**Status:** Draft
**Owner:** TODO(USER)
**Last updated:** 2026-09-26

---

## Formato

Baseado em [Keep a Changelog](https://keepachangelog.com/pt-BR/1.0.0/) e [Semantic Versioning](https://semver.org/lang/pt-BR/).

### Tipos de Mudança
- **Added** — Novas funcionalidades
- **Changed** — Mudanças em funcionalidades existentes
- **Deprecated** — Funcionalidades que serão removidas
- **Removed** — Funcionalidades removidas
- **Fixed** — Correções de bugs
- **Security** — Correções de vulnerabilidades

---

## [Unreleased] — Em Desenvolvimento (Main Branch)

### Added
- Documentação técnica completa (wiki) em `docs_agenticos/docs/`
- ADRs para decisões arquiteturais (Laravel MVC, Reverb WebSocket, Escrow Audit Trail)
- Especificação completa de API REST + WebSocket
- Guias de UI/UX, Design System, Component Library
- Especificação de ambientes (Dev, Staging, Prod) + CI/CD
- Dicionário de dados, DBML, Mapeamento de dados

### Changed
- Atualização da estrutura de documentação para seguir `documentation_guide.md`

### Fixed
- Correção de referências cruzadas entre documentos

---

## [0.1.0] — 2026-09-26 (Baseline MVP)

### Added
#### Core Platform
- **Autenticação JWT** stateless com cookies HttpOnly (registro, login, logout, refresh)
- **Perfis duais**: Cliente e Freelancer com campos específicos
- **Sistema de Províncias** (18 províncias Angola) + localização livre

#### Jobs (Trabalhos)
- **Wizard 5 passos** para criação: Básico → Orçamento → Detalhes → Skills → Revisão
- **Rascunho → Publicado** com validação rigorosa no publish
- **Filtros avançados**: Categoria, orçamento, tipo, nível, localização, busca textual
- **Ordenação**: Recente, orçamento, propostas, destaque
- **Expiração automática** (30 dias) via Scheduler (`jobs:expire`)
- **Anexos** (PDF, imagens ≤ 5MB) + visualização

#### Propostas
- **Envio com créditos** (1 crédito/proposta, 20 grátis no registro)
- **Validações**: Job aberto, não propôs antes, tem créditos
- **Gestão pelo cliente**: Aceitar/Rejeitar com notificações
- **Bloqueio automático** de novas propostas após aceitação
- **Limite**: Máx 15 propostas por job

#### Contratos & Escrow
- **Criação atômica** ao aceitar proposta: Contrato + Escrow (retido) + Conversa (chat)
- **Escrow**: Retenção 100% valor (débito cliente) → Liberação 90% freelancer + 10% plataforma
- **Reembolso total** em disputa favorável ao cliente
- **Estados**: `ativo` → `em_disputa` | `concluido` | `cancelado`
- **Pagamento**: `pendente` → `retido` → `liberado` | `devolvido_cliente`

#### Carteira & Créditos
- **Carteira digital** por usuário + 1 carteira plataforma (singleton)
- **Transações imutáveis** (apenas INSERT): `transacoes_carteiras`, `transacoes_escrow`, `transacoes_credito`
- **Locking pessimista** (`lockForUpdate`) em débitos/créditos
- **Reconciliação diária** via Scheduler (`wallet:reconcile`)
- **Créditos**: Compra pacotes (config), gasto proposta (1), boost perfil
- **IBAN virtual** gerado automaticamente via `IbanService`

#### Chat Tempo Real
- **Laravel Reverb** (Pusher protocol v7) + Redis Pub/Sub
- **Canais privados** `private-conversation.{id}` com auth via Policies
- **Mensagens**: Texto + Arquivos (PDF, JPG, PNG, WebP ≤ 5MB)
- **Histórico paginado** + marcação lida/não lida + contador badge
- **Indicador de digitação** (typing indicator) via whisper

#### Avaliações & Disputas
- **Avaliação bilateral** (1-5 estrelas + comentário) pós-contrato concluído
- **Unique constraint** (contrato, avaliador) — 1 avaliação por parte
- **Disputas**: Abertura por qualquer parte → congela escrow → Admin decide
- **Resolução Admin**: Favor cliente (reembolso 100%) / Favor freelancer (liberação 90/10) / Acordo mútuo

#### Notificações
- **In-app** (tabela `notificacoes`) com tipos: proposta, chat, contrato, disputa, expiração, créditos
- **Lista paginada** + marcação lida individual/todas

#### Portfólio & Extras
- **Portfólio freelancer**: CRUD itens (título, descrição, imagem, link, categoria)
- **Boost de perfil**: Gasta créditos → `esta_destacado=true` por 30 dias → aparece primeiro no feed
- **Jobs salvos** (favoritos freelancer)

#### Admin (Básico)
- Painel com métricas, gestão usuários/jobs/contratos/disputas/transações
- Ações: banir/ativar, ajustar créditos/saldo, forçar resolução disputa

#### Técnico
- **Stack**: Laravel 11 (PHP 8.3), MySQL 8, Redis 7, Reverb, Nginx, Supervisor
- **Frontend**: Blade + Tailwind CSS v4 + Alpine.js + Vite
- **Testes**: Pest PHP (Unit + Feature), PHPStan Level 5, Laravel Pint (PSR-12)
- **Queue/Schedule**: Database driver (MVP) → Redis (futuro)
- **Storage**: Local (MVP) → S3/MinIO (futuro)
- **CI/CD**: GitHub Actions (lint, test, build, deploy staging)

### Changed
- Migração nomes tabelas EN → PT-BR (`jobs` → `trabalhos`, `proposals` → `propostas`, `contracts` → `contratos`, `wallets` → `carteiras`, etc.)
- Tabelas legadas EN mantidas no banco mas **não usadas** (limpeza futura)

### Fixed
- Race condition em carteira resolvida com `lockForUpdate()`
- Snapshot comissão no escrow (não recalcula na liberação)
- Validação MIME real em uploads (`finfo`) + storage privado
- Rate limiting por contexto (login, propostas, chat, API)

### Security
- JWT em cookie HttpOnly + Secure + SameSite=Lax
- CSP, HSTS, X-Frame-Options, X-Content-Type-Options headers
- Policies/Gates em todos Controllers (ownership + state-based)
- Upload validation: MIME real, 5MB max, UUID rename, storage privado
- Auditoria imutável financeira (apenas INSERT em transações)

---

## [0.0.1] — 2026-07-01 (Início do Projeto)

### Added
- Inicialização repositório Laravel 11
- Configuração base: MySQL, Redis, JWT, Reverb
- Estrutura pastas modular (Services, Policies, Events, Commands)
- Seeders base: Províncias, Categorias, Habilidades, Carteira Plataforma, Config

---

## Notas de Migração (Para Versões Futuras)

### v0.2.0 (Planejado — Pós-MVP)
- **Multicaixa Express Integration** (Recarga/Saque real)
- **KYC Básico** (BI + Selfie + Liveness) — v1.0
- **PWA** (Service Worker, Manifest, Push Notifications)
- **App Mobile** (React Native/Flutter wrapper)
- **Assinaturas Premium/Enterprise** (Billing recorrente)
- **Matching Inteligente** (Recomendação baseada em skills/histórico)
- **Contratos por Marcos** (Milestones + Escrow multi-release)
- **API Pública + Webhooks** (OpenAPI 3.0, Rate limit, Idempotency)

### v1.0 (Planejado — Launch Oficial)
- **KYC Completo** (BI + Validação Gov API)
- **Seguro de Projeto Opcional** (Parceria seguradora)
- **Marketplace Gigs** (Serviços padronizados tipo Fiverr)
- **Skilla Academy** (Cursos, Certificações, Badges)
- **White-label para Agências** (Multi-tenancy)
- **Expansão PALOP** (Moçambique, Cabo Verde, etc.)

---

## Checklist de Release

### Pré-Release
- [ ] Todos testes passando (`php artisan test --parallel --coverage --min=70`)
- [ ] Static analysis limpo (`phpstan analyse --level=5`, `pint --test`)
- [ ] Migrações rodam limpo em DB vazio (`migrate:fresh --seed`)
- [ ] Build frontend OK (`npm run build`)
- [ ] Docker image builda sem erros
- [ ] Deploy staging OK + smoke tests
- [ ] Documentação atualizada (changelog, API docs, README)

### Release
- [ ] Tag `v{X.Y.Z}` no Git
- [ ] GitHub Release com changelog
- [ ] Deploy produção (Blue-Green)
- [ ] Health checks passando
- [ ] Monitoramento ativo (alertas)
- [ ] Comunicação stakeholders

### Pós-Release
- [ ] Monitoramento 24h intensivo
- [ ] Rollback plan testado (se necessário)
- [ ] Métricas de adoção (analytics)
- [ ] Feedback usuários (suporte)

---

## Related docs
- [dev-plan.md](../02-architeture/dev-plan.md)
- [TRD.md](../02-architeture/TRD.md)
- [environment-specification.md](../06-environment/environment-specification.md)
- [README.md](README.md)