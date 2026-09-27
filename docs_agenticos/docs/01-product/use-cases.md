# Casos de Uso — Skilla

**Status:** Draft
**Owner:** TODO(USER)
**Last updated:** 2026-09-26

---

## Convenções

- **UC** = Use Case
- **Ator:** Cliente (C), Freelancer (F), Sistema (S), Admin (A)
- **Pré:** Pré-condições
- **Gatilho:** Evento que inicia
- **Fluxo Principal:** Caminho feliz
- **Alternativos:** Exceções / variações
- **Pós:** Pós-condições / resultado
- **RFs:** Requisitos Funcionais relacionados (ver `functional-requirements.md`)

---

## UC01 — Autenticação e Registro

| Campo | Detalhe |
|-------|---------|
| **ID** | UC01 |
| **Nome** | Registrar e Autenticar Usuário |
| **Atores** | Visitante → Cliente / Freelancer |
| **Pré** | Acesso à internet; email válido; província angolana |
| **Gatilho** | Usuário acessa `/registar/cliente` ou `/registar/freelancer` |
| **Fluxo Principal** | 1. Preenche: primeiro_nome, sobrenome, email, senha (8+), província, papel<br>2. Sistema valida unicidade email, senha forte, província existe<br>3. Gera username único (slug + sufixo)<br>4. Hash senha (bcrypt)<br>5. Cria `Perfil` + `Carteira` (saldo 0, AOA)<br>6. Se freelancer: `saldo_creditos = 20`<br>7. Gera JWT → cookie HttpOnly<br>8. Redireciona para dashboard correspondente |
| **Alternativos** | A1: Email já cadastrado → erro "Email já em uso"<br>A2: Província inválida → erro "Província não encontrada"<br>A3: Senha fraca → erro "Mínimo 8 caracteres" |
| **Pós** | Usuário autenticado com perfil ativo; JWT válido por 24h |
| **RFs** | RF01.1–RF01.10 |

---

## UC02 — Gerenciar Perfil

| Campo | Detalhe |
|-------|---------|
| **ID** | UC02 |
| **Nome** | Visualizar e Editar Perfil Próprio |
| **Atores** | Cliente (C), Freelancer (F) |
| **Pré** | Autenticado (JWT válido) |
| **Gatilho** | Acessa `/perfil` ou `/definicoes` |
| **Fluxo Principal** | 1. Carrega dados do perfil (com relations: província, skills, carteira)<br>2. Usuário edita: foto (upload), bio, telefone, localização<br>3. Se freelancer: adiciona/remove skills (multi-select)<br>4. Salva → validação → atualiza `perfis` + `perfil_habilidades` |
| **Alternativos** | A1: Upload falha (tipo/tamanho) → erro inline<br>A2: Username alterado → verifica unicidade |
| **Pós** | Perfil atualizado; skills sincronizadas (freelancer) |
| **RFs** | RF01.4–RF01.6 |

---

## UC03 — Publicar Job (Cliente)

| Campo | Detalhe |
|-------|---------|
| **ID** | UC03 |
| **Nome** | Criar e Publicar Trabalho |
| **Atores** | Cliente (C) |
| **Pré** | Autenticado como cliente; tem carteira (para futuro escrow) |
| **Gatilho** | Clica "Novo Job" no dashboard |
| **Fluxo Principal** | 1. Wizard 5 passos (básico, orçamento, detalhes, skills, revisão)<br>2. Cada passo salva rascunho (`status=rascunho`) via AJAX<br>3. No passo final: validação completa (RF02.3)<br>4. Se válido: `status=aberto`, `expira_em=now()+30d`, `proposals_open=true`<br>5. Notifica freelancers com skills match (opcional) |
| **Alternativos** | A1: Sai no meio → rascunho salvo (retomável)<br>A2: Validação falha → erros no passo correspondente<br>A3: Cliente edita job `aberto` sem propostas aceitas → permitido |
| **Pós** | Job visível no feed público; cliente vê em "Meus Jobs" |
| **RFs** | RF02.1–RF02.12 |

---

## UC04 — Buscar e Visualizar Jobs (Freelancer)

| Campo | Detalhe |
|-------|---------|
| **ID** | UC04 |
| **Nome** | Descobrir Oportunidades |
| **Atores** | Freelancer (F), Visitante (parcial) |
| **Pré** | Autenticado (para propor) |
| **Gatilho** | Acessa `/jobs` (feed) |
| **Fluxo Principal** | 1. Lista jobs `aberto` paginada (15/página)<br>2. Aplica filtros: categoria, orçamento máx, tipo, nível, local, busca textual, urgente, remoto<br>3. Ordenação: destaque, recentes, orçamento, propostas<br>4. Clica job → detalhe completo (RF02.9)<br>5. Opcional: Salva job (favoritos) |
| **Alternativos** | A1: Sem jobs → empty state ilustrado<br>A2: Job expirou → não aparece (scheduler) |
| **Pós** | Freelancer tem visão de mercado; pode iniciar UC05 |
| **RFs** | RF02.6–RF02.10, RF08.1 |

---

## UC05 — Enviar Proposta (Freelancer)

| Campo | Detalhe |
|-------|---------|
| **ID** | UC05 |
| **Nome** | Candidatar-se a um Job |
| **Atores** | Freelancer (F) |
| **Pré** | Autenticado freelancer; job `aberto` + `proposals_open=true`; `saldo_creditos >= 1`; não propôs antes |
| **Gatilho** | No detalhe do job, clica "Enviar Proposta" |
| **Fluxo Principal** | 1. Formulário: carta_apresentacao (50–2000), valor_proposto (>0), dias_entrega (>=1)<br>2. Submit → `DB::transaction`:<br>&nbsp;&nbsp;a. Cria `Proposta` (pendente)<br>&nbsp;&nbsp;b. `saldo_creditos--` + `transacoes_credito` (gasto_proposta)<br>3. Notifica cliente (nova proposta)<br>4. Redirect: "Minhas Propostas" |
| **Alternativos** | A1: Sem créditos → modal compra pacotes (UC14)<br>A2: Job fechado / max propostas → erro "Não aceita propostas"<br>A3: Já propôs → erro "Já enviou proposta" |
| **Pós** | Proposta registrada; crédito debitado; cliente notificado |
| **RFs** | RF03.1–RF03.9 |

---

## UC06 — Gerenciar Propostas Recebidas (Cliente)

| Campo | Detalhe |
|-------|---------|
| **ID** | UC06 |
| **Nome** | Avaliar e Aceitar/Rejeitar Propostas |
| **Atores** | Cliente (C) |
| **Pré** | Autenticado cliente; job próprio com propostas `pendente` |
| **Gatilho** | Acessa "Meus Jobs" → clica job → aba "Propostas" |
| **Fluxo Principal** | 1. Lista propostas com: freelancer, valor, prazo, carta, avaliação média, portfólio<br>2. Para cada: botões "Aceitar" / "Rejeitar"<br>3. **Aceitar**:<br>&nbsp;&nbsp;a. Verifica saldo carteira ≥ valor<br>&nbsp;&nbsp;b. `DB::transaction`: cria Contrato + Escrow (retido) + Conversa<br>&nbsp;&nbsp;c. Job: `proposals_open=false`, `status=em_andamento`, `proposta_aceita_id`<br>&nbsp;&nbsp;d. Outras propostas → `rejeitada`<br>&nbsp;&nbsp;e. Notifica freelancer aceito + rejeitados<br>4. **Rejeitar**: proposta → `rejeitada`; notifica freelancer |
| **Alternativos** | A1: Saldo insuficiente → modal recarga carteira<br>A2: Job já tem proposta aceita → botões desabilitados |
| **Pós** | Contrato ativo; escrow retido; chat aberto; freelancer notificado |
| **RFs** | RF03.4–RF03.7, RF04.1–RF04.3 |

---

## UC07 — Comunicação e Execução (Chat)

| Campo | Detalhe |
|-------|---------|
| **ID** | UC07 |
| **Nome** | Trocar Mensagens e Arquivos no Contrato |
| **Atores** | Cliente (C), Freelancer (F) |
| **Pré** | Contrato `ativo`; conversa criada |
| **Gatilho** | Acessa `/chat/{conversaId}` ou "Sala de Trabalho" no dashboard |
| **Fluxo Principal** | 1. Carrega histórico paginado (mais recentes primeiro)<br>2. WebSocket conecta ao canal `conversation.{id}`<br>3. Envia texto: `POST /api/chat/send` → broadcast → salva `mensagens`<br>4. Envia arquivo: valida MIME/tamanho → storage privado → salva `url_arquivo` + `tipo_mensagem=arquivo`<br>5. Marca `lida` ao visualizar; contador badge atualiza |
| **Alternativos** | A1: Offline → mensagens ficam na fila; notificação push (futuro)<br>A2: Arquivo inválido → erro "Tipo/tamanho não permitido" |
| **Pós** | Comunicação registrada; arquivos acessíveis apenas aos participantes |
| **RFs** | RF05.1–RF05.7 |

---

## UC08 — Entregar e Aprovar Trabalho

| Campo | Detalhe |
|-------|---------|
| **ID** | UC08 |
| **Nome** | Finalizar Contrato com Pagamento |
| **Atores** | Freelancer (F), Cliente (C) |
| **Pré** | Contrato `ativo` + `status_pagamento=retido` |
| **Gatilho** | Freelancer clica "Entregar Trabalho Final" |
| **Fluxo Principal** | 1. Freelancer: confirma modal → `trabalho_entregue_em=now()`<br>2. Notifica cliente<br>3. Cliente revisa no chat → clica "Aprovar" (confirmação modal)<br>4. `DB::transaction` (`ContractService::approveWork`):<br>&nbsp;&nbsp;a. `EscrowService::liberar()`: escrow `liberado`; carteira freelancer +90%; carteira plataforma +10%<br>&nbsp;&nbsp;b. Contrato: `status=concluido`, `status_pagamento=liberado`, `aprovado_em=now()`<br>&nbsp;&nbsp;c. Job: `status=concluido`<br>&nbsp;&nbsp;d. Freelancer: `total_trabalhos_concluidos++`<br>5. Notifica ambos<br>6. Dispara UC10 (Avaliação) |
| **Alternativos** | A1: Cliente não aprova → abre disputa (UC09)<br>A2: Prazo expira sem entrega → cliente abre disputa<br>A3: Freelancer reentrega antes da aprovação → atualiza `trabalho_entregue_em` |
| **Pós** | Pagamento liquidado; contrato concluído; reputação atualizada |
| **RFs** | RF04.4–RF04.9 |

---

## UC09 — Abrir e Resolver Disputa

| Campo | Detalhe |
|-------|---------|
| **ID** | UC09 |
| **Nome** | Conflito no Contrato |
| **Atores** | Cliente (C), Freelancer (F), Admin (A) |
| **Pré** | Contrato `ativo` + `status_pagamento=retido` |
| **Gatilho** | Qualquer parte clica "Reportar Problema" |
| **Fluxo Principal** | 1. Modal: motivo obrigatório (texto)<br>2. `DB::transaction`:<br>&nbsp;&nbsp;a. Contrato → `em_disputa`<br>&nbsp;&nbsp;b. Cria `Disputa` (aberta_por, motivo, status=aberta)<br>&nbsp;&nbsp;c. Escrow congelado<br>3. Notifica outra parte + Admin<br>4. **Admin** acessa painel → analisa chat, arquivos, contrato<br>5. Admin decide:<br>&nbsp;&nbsp;- **Favor Cliente**: `EscrowService::reembolsarTotal()` → 100% cliente; contrato `cancelado`<br>&nbsp;&nbsp;- **Favor Freelancer**: `EscrowService::liberar()` → 90% freelancer + 10% plataforma; contrato `concluido`<br>&nbsp;&nbsp;- **Acordo Mútuo**: split custom<br>6. Disputa → `resolvida_cliente|freelancer|acordo_mutuo`; `resolvida_em=now()`<br>7. Notifica ambos |
| **Alternativos** | A1: Disputa frívola → admin pode advertir/banir autor |
| **Pós** | Fundo liberado para parte vencedora; contrato finalizado |
| **RFs** | RF04.6–RF04.7, BR09.1–BR09.7 |

---

## UC10 — Avaliar Parceiro

| Campo | Detalhe |
|-------|---------|
| **ID** | UC10 |
| **Nome** | Avaliação Pós-Contrato |
| **Atores** | Cliente (C), Freelancer (F) |
| **Pré** | Contrato `concluido` + `status_pagamento=liberado`; não avaliou ainda |
| **Gatilho** | Botão "Avaliar" no dashboard ou página do contrato |
| **Fluxo Principal** | 1. Form: nota (1–5 estrelas) + comentário (opcional, máx 1000)<br>2. Submit → valida unique(contrato_id, avaliador_id)<br>3. Cria `Avaliacao`<br>4. Recalcula `perfis.avaliacao_media` (AVG) + `total_avaliacoes`<br>5. Notifica avaliado |
| **Alternativos** | A1: Já avaliou → botão desabilitado<br>A2: Contrato não concluído → não aparece |
| **Pós** | Reputação atualizada; visível no perfil e cards |
| **RFs** | RF06.1–RF06.4 |

---

## UC11 — Gerenciar Portfólio (Freelancer)

| Campo | Detalhe |
|-------|---------|
| **ID** | UC11 |
| **Nome** | Exibir Trabalhos Anteriores |
| **Atores** | Freelancer (F), Visitante (visualização) |
| **Pré** | Autenticado freelancer (para CRUD) |
| **Gatilho** | Acessa `/perfil/portfolio` |
| **Fluxo Principal** | 1. Lista itens próprios (criar/editar/excluir)<br>2. Criar: título, descrição, imagem, URL projeto, categoria<br>3. Público: perfil do freelancer exibe grid de portfólio |
| **Alternativos** | A1: Imagem inválida → erro<br>A2: Freelancer sem itens → empty state "Nenhum projeto ainda" |
| **Pós** | Portfólio público atualizado |
| **RFs** | RF07.1–RF07.3 |

---

## UC12 — Buscar Freelancers (Cliente)

| Campo | Detalhe |
|-------|---------|
| **ID** | UC12 |
| **Nome** | Encontrar Talentos |
| **Atores** | Cliente (C), Visitante |
| **Pré** | - |
| **Gatilho** | Acessa `/freelancers` ou busca no header |
| **Fluxo Principal** | 1. Lista freelancers (`funcao=freelancer`, `esta_ativo=true`)<br>2. Filtros: nome, skill, categoria, localização, avaliação mínima<br>3. Cards: foto, nome, título, skills, avaliação média, preço/hora estimado<br>4. Clica → perfil público completo |
| **Alternativos** | A1: Sem resultados → empty state + sugestão ampliar filtros |
| **Pós** | Cliente pode convidar para job (futuro) ou usar info para criar job direcionado |
| **RFs** | RF08.2–RF08.4 |

---

## UC13 — Dashboards Personalizados

| Campo | Detalhe |
|-------|---------|
| **ID** | UC13 |
| **Nome** | Visualizar Resumo de Atividade |
| **Atores** | Cliente (C), Freelancer (F) |
| **Pré** | Autenticado |
| **Gatilho** | Acessa `/painel/cliente` ou `/painel/freelancer` |
| **Fluxo Principal (Cliente)** | 1. Cards: Jobs ativos, Propostas recebidas, Saldo carteira, Total gasto<br>2. Lista: Meus jobs (status badges), Propostas pendentes<br>3. Gráficos: Gasto por mês, Jobs por categoria |
| **Fluxo Principal (Freelancer)** | 1. Cards: Propostas enviadas, Trabalhos em andamento, Avaliação média, Saldo créditos/Kz<br>2. Lista: Minhas propostas (status), Contratos ativos<br>3. Gráficos: Ganhos por mês, Taxa aceitação |
| **Alternativos** | A1: Dados vazios → empty states com CTAs (criar job, explorar jobs) |
| **Pós** | Visão consolidada para tomada de decisão |
| **RFs** | RF10.1–RF10.3 |

---

## UC14 — Gerenciar Créditos e Boost (Freelancer)

| Campo | Detalhe |
|-------|---------|
| **ID** | UC14 |
| **Nome** | Comprar Créditos e Destacar Perfil |
| **Atores** | Freelancer (F) |
| **Pré** | Autenticado freelancer; saldo carteira Kz suficiente |
| **Gatilho** | Acessa `/creditos/comprar` ou `/perfil/boost` |
| **Fluxo Principal (Comprar Créditos)** | 1. Exibe pacotes (config `skilla.pacotes_creditos`)<br>2. Seleciona → paga com saldo carteira<br>3. `DB::transaction`: débita carteira Kz + credita créditos + `transacoes_credito` (compra) |
| **Fluxo Principal (Boost)** | 1. Verifica créditos ≥ custo boost (config)<br>2. Gasta créditos → `destaques` (inicio_em=now, expira_em=+30d)<br>3. `esta_destacado=true` → aparece primeiro no feed |
| **Alternativos** | A1: Saldo Kz insuficiente → recarregar carteira (UC09 fluxo carteira)<br>A2: Créditos insuficientes para boost → comprar créditos primeiro |
| **Pós** | Créditos disponíveis para propostas; boost ativo se comprado |
| **RFs** | RF11.1–RF11.5 |

---

## UC15 — Administração (Admin)

| Campo | Detalhe |
|-------|---------|
| **ID** | UC15 |
| **Nome** | Gestão da Plataforma |
| **Atores** | Admin (A) |
| **Pré** | Autenticado admin (role admin / flag `is_admin`) |
| **Gatilho** | Acessa `/admin` |
| **Fluxo Principal** | 1. Dashboard: métricas (usuários, jobs, volume, disputas abertas)<br>2. Usuários: listar, filtrar, banir/ativar, ajustar créditos/saldo<br>3. Jobs: listar, forçar cancelar, ver detalhes<br>4. Contratos: listar, forçar resolução disputa<br>5. Disputas: listar abertas, decidir (favor cliente/freelancer/acordo)<br>6. Transações: extrato completo, reconciliação manual |
| **Alternativos** | A1: Ações irreversíveis → confirmação modal + log auditoria |
| **Pós** | Plataforma moderada; métricas visíveis |
| **RFs** | RF12.1–RF12.3 |

---

## Rastreabilidade UC ↔ RF

| UC | RFs Principais |
|----|----------------|
| UC01 | RF01.1–RF01.10 |
| UC02 | RF01.4–RF01.6 |
| UC03 | RF02.1–RF02.12 |
| UC04 | RF02.6–RF02.10, RF08.1 |
| UC05 | RF03.1–RF03.9 |
| UC06 | RF03.4–RF03.7, RF04.1–RF04.3 |
| UC07 | RF05.1–RF05.7 |
| UC08 | RF04.4–RF04.9 |
| UC09 | RF04.6–RF04.7 |
| UC10 | RF06.1–RF06.4 |
| UC11 | RF07.1–RF07.3 |
| UC12 | RF08.2–RF08.4 |
| UC13 | RF10.1–RF10.3 |
| UC14 | RF11.1–RF11.5 |
| UC15 | RF12.1–RF12.3 |

---

## Related docs
- [user-flow.md](user-flow.md)
- [functional-requirements.md](functional-requirements.md)
- [business-rules.md](business-rules.md)
- [../05-design/screen-mapping.md](../05-design/screen-mapping.md)
- [../05-design/screen-specification.md](../05-design/screen-specification.md)