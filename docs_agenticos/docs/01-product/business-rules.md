# Regras de Negócio — Skilla

**Status:** Draft
**Owner:** TODO(USER)
**Last updated:** 2026-09-26

---

## Convenções

- **BR** = Business Rule (Regra de Negócio)
- Regras são **invariáveis** do domínio; violá-las = bug crítico
- Implementadas preferencialmente em **Services** (não Controllers) + **Policies** + **DB Constraints**

---

## BR01 — Usuários & Perfis

| ID | Regra | Onde Validar |
|----|-------|--------------|
| BR01.1 | Email único em `perfis` (UNIQUE constraint) | DB + FormRequest |
| BR01.2 | Username único auto-gerado; colisão → sufixo numérico | `Perfil::generateUniqueUsername()` |
| BR01.3 | Papel (`funcao`) imutável após criação (cliente ↔ freelancer) | Policy `update` → `false` para `funcao` |
| BR01.4 | Apenas freelancers têm `saldo_creditos`, `esta_destacado`, `destaque_expira_em` | Model accessor + UI condicional |
| BR01.5 | Cliente não pode ter skills, portfólio, boost | Policy + UI |
| BR01.6 | Perfil inativo (`esta_ativo=false`) → não aparece em buscas, não recebe propostas, não pode criar jobs | Scope `ativo()` em queries; middleware opcional |
| BR01.7 | Província obrigatória no registro (FK `provincias`) | FormRequest `required|exists:provincias,id` |

---

## BR02 — Jobs (Trabalhos)

| ID | Regra | Onde Validar |
|----|-------|--------------|
| BR02.1 | Apenas clientes (`funcao=cliente`) podem criar jobs | `JobPolicy::create` |
| BR02.2 | Job começa como `rascunho`; só vira `aberto` após validação completa (título, categoria, descrição, tipo, orçamento) | `JobService::publishJob()` |
| BR02.3 | Job `rascunho` editável pelo dono; job `aberto` editável apenas se **sem propostas aceitas** | `JobPolicy::update` |
| BR02.4 | Job `aberto` expira automaticamente aos 30 dias (`expira_em = created_at + 30d`) → status `cancelado` | Scheduler `jobs:expire` daily |
| BR02.5 | Job com proposta aceita → `proposals_open=false`, status `em_andamento`, `proposta_aceita_id` setado | `ProposalService::accept()` / `ContractService::createFromProposal()` |
| BR02.6 | Cliente pode cancelar job `aberto` (sem proposta aceita) → status `cancelado` | `JobPolicy::cancel` |
| BR02.7 | Job `em_andamento` só muda via contrato (entrega/aprovação/disputa) | `ContractService` |
| BR02.8 | Limite de 15 propostas por job (configurável) | `ProposalService::store()` → count check |
| BR02.9 | Anexo de job: máx 5 arquivos, 5MB cada, tipos permitidos | `JobService::attachFiles()` |

---

## BR03 — Propostas

| ID | Regra | Onde Validar |
|----|-------|--------------|
| BR03.1 | Apenas freelancers (`funcao=freelancer`) podem enviar propostas | `ProposalPolicy::create` |
| BR03.2 | Freelancer não pode propor no próprio job (cliente_id ≠ freelancer_id) | `ProposalService::store()` |
| BR03.3 | Freelancer não pode enviar mais de 1 proposta por job (UNIQUE `trabalho_id, freelancer_id`) | DB UNIQUE + Service check |
| BR03.4 | Envio de proposta gasta **1 crédito** (`saldo_creditos >= 1`); débito atômico na transação | `ProposalService::store()` + `DB::transaction` |
| BR03.5 | Proposta só pode ser enviada se job `status=aberto` E `proposals_open=true` | `ProposalService::store()` |
| BR03.6 | Valores: `valor_proposto > 0`; `dias_entrega >= 1` | FormRequest |
| BR03.7 | Cliente vê todas as propostas do seu job; freelancer vê apenas as suas | `ProposalPolicy::view` + scopes |
| BR03.8 | Status proposta: `pendente` → `aceita` | `rejeitada` (terminal) | `ProposalService::accept/reject()` |
| BR03.9 | Ao aceitar: **todas as outras propostas do job ficam `rejeitada` automaticamente** | `ProposalService::accept()` |
| BR03.10 | Crédito gasto **não é reembolsado** se proposta rejeitada ou job cancelado | Regra de negócio (não-reativo) |

---

## BR04 — Contratos

| ID | Regra | Onde Validar |
|----|-------|--------------|
| BR04.1 | Contrato criado **apenas** via aceitação de proposta (nunca direto) | `ContractService::createFromProposal()` |
| BR04.2 | Contrato herda: `valor_acordado = proposta.valor_proposto`, `dias_entrega = proposta.dias_entrega`, `data_limite = now() + dias_entrega` | Service |
| BR04.3 | Comissão da plataforma = 10% (`config('skilla.comissao_percentual', 0.10)`) → `valor_freelancer = 90%` | `EscrowService::reter()` |
| BR04.4 | Estados contrato: `ativo` → (`em_disputa` | `concluido` | `cancelado`) | `ContractService` |
| BR04.5 | Estados pagamento: `pendente` → `retido` (após escrow) → (`liberado` | `devolvido_cliente`) | `EscrowService` |
| BR04.6 | Apenas freelancer do contrato pode "entregar trabalho" (`trabalho_entregue_em`) | `ContractPolicy::submitWork` |
| BR04.7 | Apenas cliente do contrato pode "aprovar entrega" (libera escrow) | `ContractPolicy::approveWork` |
| BR04.8 | Aprovação só permitida se `status_pagamento = retido` E `trabalho_entregue_em` não nulo | `ContractService::approveWork()` |
| BR04.9 | Ao aprovar: job → `concluido`; contrato → `concluido` + `liberado`; freelancer `total_trabalhos_concluidos++` | `ContractService::approveWork()` |
| BR04.10 | Contrato `cancelado` apenas via disputa resolvida a favor do cliente OU admin force | `ContractService::cancel()` / Admin |

---

## BR05 — Escrow & Carteira

| ID | Regra | Onde Validar |
|----|-------|--------------|
| BR05.1 | Escrow **sempre** retém valor total do contrato (`valor_acordado`) da carteira do cliente | `EscrowService::reter()` |
| BR05.2 | Carteira do cliente deve ter saldo ≥ valor_acordado para aceitar proposta | `ProposalService::accept()` → `WalletService::debitar()` |
| BR05.3 | Comissão (10%) **só** creditada na carteira da plataforma na **liberação** (não na retenção) | `EscrowService::liberar()` |
| BR05.4 | Freelancer recebe `valor_liquido_freelancer` (90%) na carteira na liberação | `EscrowService::liberar()` |
| BR05.5 | Reembolso total (disputa favorável ao cliente): 100% volta para carteira do cliente; comissão **não** gerada | `EscrowService::reembolsarTotal()` |
| BR05.6 | Carteira plataforma (`tipo=plataforma`) é singleton (uma única linha) | Seeder + unique constraint |
| BR05.7 | Saldo carteira **nunca negativo** (constraint `saldo >= 0` + lockForUpdate) | DB CHECK + Service |
| BR05.8 | Moeda fixa: **AOA (Kz)** — sem conversão no MVP | Config + Model cast |
| BR05.9 | IBAN virtual único por carteira (gerado via `IbanService`) | `WalletService::getOrCreateWallet()` |

---

## BR06 — Créditos & Boost

| ID | Regra | Onde Validar |
|----|-------|--------------|
| BR06.1 | Freelancer novo recebe **20 créditos grátis** (`saldo_creditos=20` no registro) | `AuthController::registar()` |
| BR06.2 | 1 crédito = 1 proposta enviada | `ProposalService::store()` |
| BR06.3 | Créditos comprados via pacotes (config `skilla.pacotes_creditos`) → recarga carteira + crédito | `CreditosController::store()` |
| BR06.4 | Boost de perfil: gasta créditos (config) → `esta_destacado=true`, `destaque_expira_em=now()+30d` (config) | `HighlightController::store()` |
| BR06.5 | Boost expira → job `esta_destacado=false` (scheduler daily) | `highlights:expire` command |
| BR06.6 | Freelancer destacado aparece primeiro na listagem (ordenação) | `JobController::index2()` sort |
| BR06.7 | Transações de crédito: `compra`, `gasto_proposta`, `boost`, `ajuste_admin` (auditoria) | `CreditService` + `transacoes_credito` |

---

## BR07 — Chat & Comunicação

| ID | Regra | Onde Validar |
|----|-------|--------------|
| BR07.1 | Conversa **só existe** após aceitação de proposta (1:1 cliente↔freelancer por contrato) | `ContractService::createFromProposal()` → `Conversation::create()` |
| BR07.2 | Apenas participantes do contrato (cliente/freelancer) podem acessar a conversa | `ConversationPolicy::view` |
| BR07.3 | Mensagens: texto OU arquivo (PDF, jpg, png, webp ≤ 5MB) | `ChatController::send()` + validation |
| BR07.4 | Arquivos salvos em `storage/app/private/chat/{conversa_id}/` com nome UUID | `ChatService::storeFile()` |
| BR07.5 | Marcação `lida` por mensagem; contador não lidas por usuário | `ChatController::messages()` + `Message::where('lida', false)` |
| BR07.6 | WebSocket canal privado: `conversation.{conversa_id}` (auth via JWT) | `routes/channels.php` + Reverb |

---

## BR08 — Avaliações

| ID | Regra | Onde Validar |
|----|-------|--------------|
| BR08.1 | Avaliação **somente** após contrato `status=concluido` | `ReviewPolicy::create` |
| BR08.2 | Uma avaliação por parte por contrato (UNIQUE `contrato_id, avaliador_id`) | DB + Service |
| BR08.3 | Notas: inteiro 1–5; comentário opcional (máx 1000 chars) | FormRequest |
| BR08.4 | Média do avaliado recalculada: `AVG(nota)` → `perfis.avaliacao_media` (2 casas) | `ReviewService::store()` + event |
| BR08.5 | Avaliação não editável após envio (imutável) | Policy `update` → `false` |

---

## BR09 — Disputas

| ID | Regra | Onde Validar |
|----|-------|--------------|
| BR09.1 | Disputa aberta por **qualquer parte** do contrato (`cliente_id` ou `freelancer_id`) | `DisputePolicy::create` |
| BR09.2 | Ao abrir: contrato → `em_disputa`; escrow → congelado (não pode liberar/reembolsar) | `ContractService::openDispute()` |
| BR09.3 | Apenas **admin** resolve disputa (`resolvida_cliente` | `resolvida_freelancer` | `acordo_mutuo`) | `DisputePolicy::resolve` |
| BR09.4 | Resolução `resolvida_cliente` → `EscrowService::reembolsarTotal()` (100% cliente) | `DisputeService::resolve()` |
| BR09.5 | Resolução `resolvida_freelancer` → `EscrowService::liberar()` (90% freelancer + 10% plataforma) | `DisputeService::resolve()` |
| BR09.6 | Resolução `acordo_mutuo` → split custom (admin define valores) | `DisputeService::resolve()` |
| BR09.7 | Contrato em disputa **não** permite entrega/aprovação até resolução | `ContractPolicy::submitWork/approveWork` → `false` se `em_disputa` |

---

## BR10 — Notificações

| ID | Regra | Onde Validar |
|----|-------|--------------|
| BR10.1 | Eventos que disparam notificação: proposta_recebida, proposta_aceita, proposta_rejeitada, mensagem_chat, trabalho_entregue, trabalho_aprovado, disputa_aberta, disputa_resolvida, job_expirado, creditos_baixos | `NotificationService` + Events/Listeners |
| BR10.2 | Notificação in-app + badge contador não lidas | `NotificationController::index()` |
| BR10.3 | Notificação lida individualmente ou "marcar todas como lidas" | `NotificationController::markAsRead()` |

---

## BR11 — Expiração & Limpeza (Cron Jobs)

| ID | Regra | Frequência | Comando |
|----|-------|------------|---------|
| BR11.1 | Jobs `aberto` com `expira_em < now()` → `cancelado` | Daily (00:00) | `jobs:expire` |
| BR11.2 | Boosts expirados (`destaque_expira_em < now()`) → `esta_destacado=false` | Daily (01:00) | `highlights:expire` |
| BR11.3 | Tokens JWT expirados na blocklist → limpeza | Daily (02:00) | `jwt:clean` |
| BR11.4 | Reconciliação carteiras (soma saldos = soma transações) | Daily (03:00) | `wallet:reconcile` |
| BR11.5 | Notificações > 90 dias lidas → archive (soft delete) | Weekly | `notifications:prune` |

---

## Related docs
- [functional-requirements.md](functional-requirements.md)
- [business-logic-security.md](business-logic-security.md)
- [use-cases.md](use-cases.md)
- [../02-architeture/architeture-document.md](../02-architeture/architeture-document.md)
- [../03-data/data-mapping.md](../03-data/data-mapping.md)