# Mapeamento de Dados — Skilla

**Status:** Draft
**Owner:** TODO(USER)
**Last updated:** 2026-09-26

---

## Visão Geral

Este documento mapeia como os dados fluem entre **módulos**, **eventos de domínio**, **formulários (inputs)**, **endpoints API** e **tabelas de persistência**. Serve como referência para desenvolvedores entenderem a rastreabilidade completa: *de onde vem → para onde vai → o que dispara*.

---

## 1. Mapeamento por Evento de Domínio (Event Sourcing Logical)

| Evento | Origem (Input) | Serviço/Handler | Tabelas Afetadas (Escrita) | Tabelas Lidas (Validação) | Side Effects (Listeners/Jobs) |
|--------|----------------|-----------------|----------------------------|---------------------------|-------------------------------|
| **UserRegistered** | `POST /registar` (FormRequest) | `AuthController::registar` | `perfis` (insert), `carteiras` (insert) | `provincias` (exists) | `WalletService::createWalletForProfile` (20 créditos se freelancer) |
| **JobSavedAsDraft** | `POST /api/jobs/save` (wizard step) | `JobController::store` → `JobService::saveDraft` | `trabalhos` (insert/update, status=rascunho) | `perfis` (cliente), `categorias` | — |
| **JobPublished** | `PATCH /api/jobs/{id}/publish` | `JobController::publish` → `JobService::publishJob` | `trabalhos` (update status=aberto, expira_em=+30d) | `trabalhos` (dono), `categorias` | `JobPublished` event → `NotifyMatchingFreelancers` (queue) |
| **ProposalSubmitted** | `POST /api/proposals` | `ProposalController::store` → `ProposalService::store` | `propostas` (insert), `transacoes_credito` (insert gasto_proposta), `perfis` (update saldo_creditos--) | `trabalhos` (status=aberto, proposals_open), `perfis` (freelancer créditos≥1) | `ProposalSubmitted` event → `SendProposalNotification` (queue) |
| **ProposalAccepted** | `POST /api/proposals/{id}/accept` | `ProposalController::accept` → `ProposalService::accept` + `ContractService::createFromProposal` | `propostas` (update aceita + outras rejeitadas), `contratos` (insert), `transacoes_escrow` (insert retido), `transacoes_carteiras` (insert debito_escrow), `carteiras` (update saldo cliente--), `conversas` (insert), `trabalhos` (update status=em_andamento, proposals_open=false, proposta_aceita_id) | `carteiras` (cliente saldo≥valor), `propostas` (pendente), `trabalhos` (aberto) | `ProposalAccepted` event → `SendProposalAcceptedNotification`, `BroadcastContractCreated` (Reverb) |
| **ProposalRejected** | `POST /api/proposals/{id}/reject` | `ProposalController::reject` → `ProposalService::reject` | `propostas` (update status=rejeitada) | `propostas` (pendente) | `ProposalRejected` event → `SendProposalRejectedNotification` |
| **WorkSubmitted** | `PATCH /api/contracts/{id}/submit` | `ContractController::submit` → `ContractService::submitWork` | `contratos` (update trabalho_entregue_em=now) | `contratos` (ativo, retido, freelancer_id) | `WorkSubmitted` event → `SendWorkSubmittedNotification` |
| **WorkApproved** | `PATCH /api/contracts/{id}/approve` | `ContractController::approve` → `ContractService::approveWork` + `EscrowService::liberar` | `transacoes_escrow` (update liberado), `transacoes_carteiras` (insert credito_escrow freelancer + comissao plataforma), `carteiras` (update saldo freelancer++, plataforma++), `contratos` (update status=concluido, liberado, aprovado_em), `trabalhos` (update status=concluido), `perfis` (update total_trabalhos_concluidos++) | `contratos` (retido, trabalho_entregue_em), `transacoes_escrow` (retido) | `WorkApproved` event → `SendWorkApprovedNotification`, `TriggerReviewRequest` (queue) |
| **DisputeOpened** | `POST /api/contracts/{id}/dispute` | `ContractController::dispute` → `ContractService::openDispute` | `contratos` (update status=em_disputa), `disputas` (insert) | `contratos` (ativo, retido) | `DisputeOpened` event → `NotifyBothParties`, `NotifyAdmin` |
| **DisputeResolved** | `POST /admin/disputas/{id}/resolve` | `AdminDisputeController::resolve` → `DisputeService::resolve` + `EscrowService::liberar|reembolsarTotal` | `disputas` (update resolvida), `transacoes_escrow` (update liberado|devolvido), `transacoes_carteiras` (insert credito_escrow|reembolso_escrow), `carteiras` (update saldo vencedor++), `contratos` (update status=concluido|cancelado) | `disputas` (aberta), `contratos` (em_disputa), `transacoes_escrow` (retido) | `DisputeResolved` event → `NotifyResolution` |
| **ReviewSubmitted** | `POST /api/reviews` | `ReviewController::store` → `ReviewService::store` | `avaliacoes` (insert), `perfis` (update avaliacao_media, total_avaliacoes) | `contratos` (concluido, liberado), `avaliacoes` (unique check) | `ReviewSubmitted` event → `NotifyReviewReceived` |
| **CreditPurchased** | `POST /creditos/comprar` | `CreditosController::store` → `CreditService::purchase` | `transacoes_carteiras` (insert compra_creditos débito Kz), `transacoes_credito` (insert compra +quantidade), `carteiras` (update saldo--), `perfis` (update saldo_creditos++) | `carteiras` (saldo≥preço), `config('skilla.pacotes_creditos')` | — |
| **BoostActivated** | `POST /highlight` | `HighlightController::store` → `HighlightService::activate` | `destaques` (insert), `transacoes_credito` (insert boost -quantidade), `perfis` (update esta_destacado=true, destaque_expira_em, saldo_creditos--) | `perfis` (saldo_creditos≥custo) | `BoostActivated` event → `NotifyBoostActive` |
| **JobExpired** (Cron) | Scheduler `jobs:expire` | `ExpireJobsCommand` → `JobService::expire` | `trabalhos` (update status=cancelado onde aberto + expira_em<now) | `trabalhos` (aberto, expira_em) | `JobExpired` event → `NotifyClientJobExpired`, `NotifyFreelancersProposalsCancelled` |
| **HighlightExpired** (Cron) | Scheduler `highlights:expire` | `ExpireHighlightsCommand` | `destaques` (update status=expirado), `perfis` (update esta_destacado=false) | `destaques` (ativo, expira_em<now) | — |
| **WalletReconciled** (Cron) | Scheduler `wallet:reconcile` | `ReconcileWalletsCommand` | — (read-only) | `carteiras`, `transacoes_carteiras` | Alerta se divergência > 0.01 Kz |

---

## 2. Mapeamento Formulário → Tabela (Input Mapping)

### Auth & Perfil
| Formulário | Campos | Tabela Alvo | Transformações |
|------------|--------|-------------|----------------|
| Registro Cliente | `primeiro_nome`, `sobrenome`, `email`, `password`, `provincia_id`, `funcao=cliente` | `perfis` | `nome_usuario` = slug(nome) + sufixo único; `password` = bcrypt; `saldo_creditos=0` |
| Registro Freelancer | `primeiro_nome`, `sobrenome`, `email`, `password`, `provincia_id`, `funcao=freelancer` | `perfis` | `nome_usuario` = slug(nome) + sufixo único; `password` = bcrypt; `saldo_creditos=20` |
| Edição Perfil (Cliente) | `url_avatar`, `bio`, `telefone`, `localizacao` | `perfis` | Upload avatar → storage + URL |
| Edição Perfil (Freelancer) | `url_avatar`, `bio`, `telefone`, `localizacao`, `skills[]` | `perfis`, `perfil_habilidades` | Sync skills (delete + insert) |

### Jobs
| Wizard Step | Campos | Tabela Alvo | Validação |
|-------------|--------|-------------|-----------|
| 1. Básico | `titulo`, `categoria_id`, `tipo_trabalho` | `trabalhos` (rascunho) | `categoria_id` exists |
| 2. Orçamento | `tipo_trabalho` (preco_fixo/por_hora), `orcamento_fixo` OU `taxa_hora_min`/`taxa_hora_max` | `trabalhos` | Se fixo: orcamento_fixo>0; Se hora: min>0, max≥min |
| 3. Detalhes | `descricao`, `tamanho_projeto`, `duracao_estimada`, `nivel_experiencia`, `possibilidade_efetivacao`, `prazo`, `anexos[]` | `trabalhos`, `trabalho_anexos` | Descricao≥20 chars; anexos: mime/pdf/jpg/png/webp, ≤5MB, max 5 |
| 4. Skills | `skills[]` (habilidade_ids) | `trabalho_habilidades` | Skills existem |
| 5. Publicar | — | `trabalhos` (status=aberto, expira_em=+30d) | Todos campos obrigatórios preenchidos |

### Propostas
| Formulário | Campos | Tabela Alvo | Validação |
|------------|--------|-------------|-----------|
| Enviar Proposta | `job_id`, `carta_apresentacao` (50-2000), `valor_proposto` (>0), `dias_entrega` (≥1) | `propostas`, `transacoes_credito`, `perfis` (saldo_creditos--) | Job aberto, proposals_open, freelancer não propôs, créditos≥1 |

### Contrato/Execução
| Ação | Input | Tabela Alvo |
|------|-------|-------------|
| Entregar Trabalho | `contract_id` (botão) | `contratos.trabalho_entregue_em` |
| Aprovar Trabalho | `contract_id` (botão + confirmação) | `contratos`, `transacoes_escrow`, `transacoes_carteiras`, `carteiras`, `trabalhos`, `perfis` |
| Abrir Disputa | `contract_id`, `motivo` | `contratos.status_contrato=em_disputa`, `disputas` |
| Resolver Disputa (Admin) | `dispute_id`, `decisao` (cliente/freelancer/mutuo), `valor_custom?` | `disputas`, `transacoes_escrow`, `transacoes_carteiras`, `carteiras`, `contratos` |

### Chat
| Ação | Input | Tabela Alvo |
|------|-------|-------------|
| Enviar Mensagem | `conversa_id`, `conteudo` (texto) | `mensagens` |
| Enviar Arquivo | `conversa_id`, `arquivo` (file) | `mensagens` (tipo=arquivo, url_arquivo, nome_arquivo, tamanho_arquivo) |
| Marcar Lida | `conversa_id` (visualização) | `mensagens.lida=true` |

### Avaliação
| Formulário | Campos | Tabela Alvo | Validação |
|------------|--------|-------------|-----------|
| Avaliar | `contrato_id`, `nota` (1-5), `comentario` (opcional) | `avaliacoes`, `perfis` (avaliacao_media, total_avaliacoes) | Contrato concluido+liberado; unique(contrato, avaliador) |

### Créditos/Boost
| Formulário | Campos | Tabela Alvo |
|------------|--------|-------------|
| Comprar Créditos | `pacote_id` (config) | `transacoes_carteiras` (compra_creditos), `transacoes_credito` (compra), `carteiras`, `perfis` |
| Boost Perfil | — (botão, custo config) | `destaques`, `transacoes_credito` (boost), `perfis` |

---

## 3. Mapeamento Endpoint API → Entidades (API → Domain)

| Endpoint | Método | Entidade Primária (Response) | Entidades Secundárias (Side Effects) |
|----------|--------|------------------------------|--------------------------------------|
| `/api/auth/register` | POST | `Perfil` + `Token` | `Carteira` |
| `/api/auth/login` | POST | `Token` + `Perfil` | — |
| `/api/jobs` | GET | `Job[]` (paginado) | — |
| `/api/jobs/save` | POST | `Job` (rascunho) | — |
| `/api/jobs/{id}/publish` | PATCH | `Job` (aberto) | — |
| `/api/jobs/{id}/skills` | POST | `Job` + `JobSkill[]` | — |
| `/api/proposals/send` | POST | `Proposal` | `CreditTransaction`, `Perfil.creditos` |
| `/api/proposals/{id}/accept` | POST | `Contract` + `Conversation` | `EscrowTransaction`, `WalletTransaction`, `Wallet`, `Job` |
| `/api/contracts/{id}/submit` | PATCH | `Contract` | — |
| `/api/contracts/{id}/approve` | PATCH | `Contract` | `EscrowTransaction`, `WalletTransaction`, `Wallet`, `Job`, `Perfil` |
| `/api/contracts/{id}/dispute` | POST | `Dispute` | `Contract.status_contrato` |
| `/api/chat/send` | POST | `Message` | `Conversation.ultima_mensagem_em` |
| `/api/chat/{conversaId}/messages` | GET | `Message[]` | — |
| `/api/reviews` | POST | `Review` | `Perfil.avaliacao_media`, `Perfil.total_avaliacoes` |
| `/api/wallet/deposit` | POST | `WalletTransaction` | `Wallet.saldo` |
| `/api/credits/add` | POST | `CreditTransaction` | `Perfil.saldo_creditos` |
| `/api/highlight` | POST | `Highlight` | `CreditTransaction`, `Perfil.esta_destacado` |

---

## 4. Mapeamento Tabela → Múltiplos Contextos (Polyglot Persistence Logical)

| Tabela | Contexto Primário | Contextos Secundários (Read Models) |
|--------|-------------------|-------------------------------------|
| `perfis` | Auth, Profile, Dashboard | Job (client), Proposal (freelancer), Contract (both), Review (both), Search (freelancer directory) |
| `trabalhos` | Job Management (Client), Job Feed (Freelancer) | Proposal (list), Contract (origin), Search (filters), Dashboard (stats) |
| `propostas` | Proposal Management (Freelancer), Proposal Review (Client) | Contract (origin), Notification (trigger), CreditTransaction (cost) |
| `contratos` | Contract Lifecycle (Both), Escrow (source), Chat (source), Review (gate) | Dashboard (stats), Notification (trigger), Dispute (source) |
| `carteiras` | Wallet (balance, statement), Escrow (source/dest), Credit Purchase (source) | Dashboard (balance), Admin (audit) |
| `transacoes_carteiras` | Wallet Statement, Escrow Audit, Reconciliation | Admin (audit), Finance (reports) |
| `transacoes_escrow` | Escrow State Machine, Dispute Resolution | Contract (payment_status), Admin (audit) |
| `transacoes_credito` | Credit Statement, Boost Audit | Perfil (saldo_creditos), Admin (audit) |
| `conversas` | Chat Access Control | Message (parent), Contract (1:1) |
| `mensagens` | Chat History, File Storage | Notification (unread count), Search (content) |
| `avaliacoes` | Reputation System | Perfil (avg_rating), Contract (gate), Search (ranking) |
| `disputas` | Dispute Resolution (Admin) | Contract (status_contrato), Escrow (freeze), Notification |
| `destaques` | Boost Visibility (Job Feed Sort) | Perfil (esta_destacado), CreditTransaction (cost) |
| `notificacoes` | In-App Notification Center | All modules (trigger) |

---

## 5. Rastreabilidade de Campos Críticos (Data Lineage)

| Campo Crítico | Origem (Source of Truth) | Propagação (Derivado) | Validação Cruzada |
|---------------|--------------------------|----------------------|-------------------|
| `perfis.saldo_creditos` | `transacoes_credito` (SUM quantidade) | `ProposalService::store` (decrement), `CreditService::purchase` (increment), `HighlightService::activate` (decrement) | Reconciliação: `SUM(transacoes_credito.quantidade) = perfis.saldo_creditos` |
| `carteiras.saldo` | `transacoes_carteiras` (SUM valor IN - OUT) | `WalletService::debitar/depositar`, `EscrowService::reter/liberar/reembolsarTotal` | Reconciliação diária: `wallet:reconcile` |
| `contratos.comissao_plataforma` + `valor_freelancer` | `EscrowService::reter` (snapshot) | `EscrowService::liberar` (usa snapshot, não recalcula) | `valor_acordado = comissao_plataforma + valor_freelancer` |
| `trabalhos.status` | `JobService::publishJob` (aberto), `ProposalService::accept` (em_andamento), `ContractService::approveWork` (concluido), `ExpireJobs` (cancelado), `JobService::cancel` (cancelado) | `PropostaService::accept` bloqueia novas propostas | Estados válidos: rascunho→aberto→em_andamento→concluido/cancelado |
| `perfis.avaliacao_media` | `avaliacoes` (AVG nota) | `ReviewService::store` (event listener recalcula) | `AVG(avaliacoes.nota) WHERE avaliado_id = X` |
| `destaques.expira_em` | `HighlightController::store` (now()+30d config) | `ExpireHighlights` cron (daily) | `expira_em > now()` = ativo |

---

## Related docs
- [database-schema.md](database-schema.md)
- [database-dbml.md](database-dbml.md)
- [data-dictionary.md](data-dictionary.md)
- [../01-product/functional-requirements.md](../01-product/functional-requirements.md)
- [../01-product/business-rules.md](../01-product/business-rules.md)
- [../02-architeture/architeture-document.md](../02-architeture/architeture-document.md) (Sequências)
- [../04-api/api-specification.md](../04-api/api-specification.md)