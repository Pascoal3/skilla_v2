# Escopo do MVP — Skilla

**Status:** Draft
**Owner:** TODO(USER)
**Last updated:** 2026-09-26

---

## Visão Geral

O MVP (Minimum Viable Product) do Skilla entrega o **core loop** completo: cliente publica job → freelancer propõe → cliente aceita → escrow retém → chat → entrega → aprovação → liberação → avaliação. Tudo com pagamentos **simulados** (carteira interna) e créditos para propostas.

---

## Features no MVP (Priorizadas)

| Módulo | Feature | Detalhes | Status Implementação |
|--------|---------|----------|---------------------|
| **Auth** | Registro + Login JWT | Email, senha, papel (cliente/freelancer), província, 20 créditos grátis | ✅ Implementado |
| **Auth** | Perfil (CRUD) | Foto, bio, skills, localização, telefone | ✅ Implementado |
| **Jobs** | Wizard publicação (5 passos) | Rascunho → Público; título, categoria, orçamento, tipo, prazo, skills, anexos | ✅ Implementado |
| **Jobs** | Listagem + Filtros | Categoria, orçamento, tipo, nível, localização, busca textual | ✅ Implementado |
| **Jobs** | Detalhe do job | Views tracking, propostas, jobs similares, save/unsave | ✅ Implementado |
| **Jobs** | Expiração automática | Cron diário: jobs `aberto` com `expira_em < now()` → `cancelado` | ✅ Implementado |
| **Propostas** | Envio com créditos | 1 crédito/proposta; validação saldo; carta + valor + prazo | ✅ Implementado |
| **Propostas** | Gestão pelo cliente | Listar, aceitar, rejeitar; bloqueio novas propostas após aceitação | ✅ Implementado |
| **Propostas** | Histórico do freelancer | Status: pendente/aceita/rejeitada | ✅ Implementado |
| **Contratos** | Criação automática | Ao aceitar proposta: contrato + escrow + conversa | ✅ Implementado |
| **Escrow** | Retenção (simulada) | Débito carteira cliente → `transacoes_escrow` status `retido` | ✅ Implementado |
| **Escrow** | Liberação | Cliente aprova → 90% freelancer, 10% plataforma → `liberado` | ✅ Implementado |
| **Escrow** | Reembolso total | Disputa favorável ao cliente → devolve 100% ao cliente | ✅ Implementado |
| **Chat** | Tempo real (Reverb) | Canais privados por conversa; texto + arquivos (PDF, img) | ✅ Implementado |
| **Chat** | Histórico | Paginação, marcação lida/não lida | ✅ Implementado |
| **Entrega** | Submissão pelo freelancer | Botão "Entregar trabalho" → `trabalho_entregue_em` | ✅ Implementado |
| **Aprovação** | Aprovação pelo cliente | Botão "Aprovar" → libera escrow + finaliza contrato | ✅ Implementado |
| **Avaliações** | Bilateral (1–5 estrelas + comentário) | Uma por contrato por parte; atualiza média no perfil | ✅ Implementado |
| **Carteira** | Saldo + Extrato | `carteiras` + `transacoes_carteiras` (recarga, débito, crédito, comissão) | ✅ Implementado |
| **Carteira** | Recarga simulada | Admin aprova comprovante → credita saldo (MVP: manual) | ✅ Implementado |
| **Créditos** | Compra + Gasto + Boost | Pacotes (config), 1 crédito/proposta, boost perfil (créditos) | ✅ Implementado |
| **Notificações** | In-app | Proposta recebida, aceita/rejeitada, mensagem, job updates | ✅ Implementado |
| **Disputas** | Abertura + Congelamento | Qualquer parte abre → `status_contrato=em_disputa` + `disputas` | ✅ Implementado |
| **Disputas** | Decisão Admin | Admin resolve → libera para cliente OU freelancer | ✅ Implementado |
| **Admin** | Painel básico | Usuários, jobs, contratos, disputas, transações | 🟡 Parcial |

**Legenda:** ✅ Implementado | 🟡 Parcial | ❌ Não iniciado

---

## Features FORA do MVP (Post-MVP)

| Feature | Módulo | Prioridade | Esforço | Dependência |
|---------|--------|------------|---------|-------------|
| Multicaixa Express real (recarga/saque) | Pagamentos | P0 | Alto | Parceria bancária |
| KYC automatizado (BI + selfie + liveness) | Auth/Segurança | P1 | Alto | Provedor biométrico / API gov |
| PWA / App mobile nativo | Frontend | P1 | Médio | Service Worker, Push API |
| Assinatura Premium (freelancer) | Monetização | P1 | Médio | Stripe/Multicaixa recorrente |
| Assinatura Enterprise (cliente) | Monetização | P2 | Médio | Billing system |
| Matching inteligente (recomendação) | Busca/Discovery | P2 | Alto | Data pipeline + ML |
| Contratos por marcos (milestones) | Contratos | P2 | Médio | Escrow multi-release |
| Videochamada no chat | Comunicação | P3 | Alto | WebRTC / provedor |
| API pública + Webhooks | Integração | P3 | Alto | Rate limit, auth, docs |
| Skilla Academy (cursos/certificações) | Ecossistema | P3 | Muito Alto | LMS / conteúdo |
| White-label para agências | B2B | P3 | Alto | Multi-tenancy |
| Expansão PALOP (Moçambique, CV, etc.) | Internacionalização | P3 | Muito Alto | Moedas, KYC, pagamentos locais |
| Seguro de projeto opcional | Risk | P3 | Alto | Parceria seguradora |
| Gamificação (badges, streaks) | Engajamento | P2 | Médio | Event tracking |

---

## Critérios de Pronto do MVP (Definition of Done)

### Técnicos
- [ ] Todos os endpoints API funcionando e testados (Postman/collection)
- [ ] Testes unitários ≥ 70% coverage em Services (Escrow, Wallet, Contract, Proposal)
- [ ] Testes de integração para fluxos críticos (aceitar proposta → escrow; aprovar → liberar)
- [ ] Migrações rodam limpo em DB vazio (fresh + seed)
- [ ] Seeders populam: províncias, categorias, skills, carteira plataforma, pacotes créditos
- [ ] Queue workers processam jobs (notificações, emails futuros)
- [ ] Scheduler roda: expiração jobs, limpeza tokens expirados
- [ ] Reverb (WebSocket) funcional em produção (SSL, auth channel)
- [ ] Logs estruturados (JSON) + rotação
- [ ] Backup automático DB (diário) + restore testado

### Produto
- [ ] Cliente completa jornada: cadastro → job → proposta → aceita → chat → aprova → avalia
- [ ] Freelancer completa jornada: cadastro → busca → proposta → entrega → recebe → avalia
- [ ] Carteira: recarga (simulada) → saldo visível → extrato correto
- [ ] Créditos: 20 grátis no registro → gasto 1/proposta → compra pacote → boost
- [ ] Disputa: abre → congela → admin decide → reembolso OU liberação
- [ ] Expiração: job aberto > 30 dias → cancelado automaticamente
- [ ] Notificações: aparecem no bell icon + contador
- [ ] Admin: vê usuários, pode banir/ativar; vê jobs/contratos/disputas; pode forçar resolução

### UX / Qualidade
- [ ] Responsivo mobile-first (breakpoints: <640, 640–1024, >1024)
- [ ] Estados vazios ilustrados (sem jobs, sem propostas, sem mensagens)
- [ ] Loading states (skeleton/spinner) em todas as listas
- [ ] Toast notifications (sucesso, erro, aviso) consistentes
- [ ] Validação client-side + server-side com mensagens claras pt-AO
- [ ] Acessibilidade básica: labels, contrastes, foco visível, alt text
- [ ] Páginas de erro 404/500 amigáveis

### Segurança
- [ ] JWT em cookie HttpOnly + Secure + SameSite=Lax
- [ ] Rate limit: login (5/min), registro (3/min), propostas (10/min), chat (30/min)
- [ ] CSRF protection em forms web
- [ ] Upload: validação tipo (pdf, jpg, png, webp), tamanho máx 5MB, rename aleatório
- [ ] Policies/Gates em todos os controllers (cliente só vê seus jobs, freelancer só suas propostas)
- [ ] SQL Injection prevenido (Eloquent ORM + parameter binding)
- [ ] XSS prevenido (Blade `{{ }}` escaping, CSP headers)

---

## Estimativa de Esforço (Já Investido / Restante)

| Fase | Semanas | Status |
|------|---------|--------|
| Fase 1: Fundação (DB, Auth, Perfis) | 1 | ✅ Concluído |
| Fase 2: Mercado (Jobs, Propostas, Busca) | 2 | ✅ Concluído |
| Fase 3: Contratação (Contratos, Escrow, Carteira) | 2 | ✅ Concluído |
| Fase 4: Comunicação (Chat Reverb, Entrega, Aprovação) | 2 | 🟡 Em andamento |
| Fase 5: Qualidade (Testes, Admin, Polish, Deploy) | 2 | ❌ Pendente |
| **Total** | **~9 semanas** | |

---

## Related docs
- [PRD.md](PRD.md)
- [functional-requirements.md](functional-requirements.md)
- [../02-architeture/dev-plan.md](../02-architeture/dev-plan.md)
- [../07-maintenance/changelog.md](../07-maintenance/changelog.md)