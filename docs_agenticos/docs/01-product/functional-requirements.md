# Requisitos Funcionais — Skilla

**Status:** Draft
**Owner:** TODO(USER)
**Last updated:** 2026-09-26

---

## Convenções

- **RF** = Requisito Funcional
- **UC** = Use Case (ver [use-cases.md](use-cases.md))
- **Rastreabilidade:** Cada RF mapeia para um ou mais Use Cases

---

## RF01 — Gestão de Utilizadores (Auth & Perfis)

| ID | Requisito | UC Relacionado | Status |
|----|-----------|----------------|--------|
| RF01.1 | Registro com: primeiro_nome, sobrenome, email, senha, província, papel (cliente/freelancer) | UC01 | ✅ |
| RF01.2 | Login com email + senha → JWT em cookie HttpOnly | UC01 | ✅ |
| RF01.3 | Logout invalida token (blocklist JWT) | UC01 | ✅ |
| RF01.4 | Refresh token (rota `/refresh-token`) | UC01 | ✅ |
| RF01.5 | Edição de perfil: foto, bio, telefone, localização, skills (freelancer) | UC02 | ✅ |
| RF01.6 | Perfis distintos: cliente vs freelancer (campos, permissões, UI) | UC02 | ✅ |
| RF01.7 | Proteção de rotas por papel (middleware `role:cliente|freelancer`) | UC01, UC02 | ✅ |
| RF01.8 | Username único auto-gerado (slug nome + sufixo) | UC01 | ✅ |
| RF01.9 | 20 créditos grátis ao criar conta (freelancer) | UC03 | ✅ |
| RF01.10 | Carteira criada automaticamente no registro (saldo 0, moeda AOA) | UC04 | ✅ |

---

## RF02 — Gestão de Jobs (Trabalhos)

| ID | Requisito | UC Relacionado | Status |
|----|-----------|----------------|--------|
| RF02.1 | Cliente publica job via wizard (rascunho → público) | UC03 | ✅ |
| RF02.2 | Job campos: título, descrição, categoria, tipo (preço_fixo/por_hora), orçamento (fixo ou faixa hora), tamanho, duração, nível, possibilidade efetivação, prazo, anexos, skills | UC03 | ✅ |
| RF02.3 | Validação rigorosa ao publicar (campos obrigatórios) | UC03 | ✅ |
| RF02.4 | Cliente edita job próprio (apenas se status `rascunho` ou `aberto` sem propostas aceitas) | UC03 | ✅ |
| RF02.5 | Cliente encerra/cancela job próprio | UC03 | ✅ |
| RF02.6 | Listagem pública de jobs `aberto` com paginação | UC04 | ✅ |
| RF02.7 | Filtros: categoria, orçamento máx, tipo trabalho, nível experiência, localização, busca textual (título/descrição), urgente, remoto, destaque | UC04 | ✅ |
| RF02.8 | Ordenação: mais recentes, maior orçamento, menos propostas, destaque primeiro | UC04 | ✅ |
| RF02.9 | Detalhe do job: dados completos, cliente, skills, anexos, propostas (se cliente), jobs similares, save/unsave | UC04, UC05 | ✅ |
| RF02.10 | Contador de visualizações (incremento único por sessão) | UC04 | ✅ |
| RF02.11 | Expiração automática: cron diário → jobs `aberto` com `expira_em < now()` → `cancelado` | UC03 | ✅ |
| RF02.12 | Estados do job: `rascunho`, `aberto`, `em_andamento`, `concluido`, `cancelado`, `arquivado` | UC03, UC06 | ✅ |

---

## RF03 — Sistema de Propostas

| ID | Requisito | UC Relacionado | Status |
|----|-----------|----------------|--------|
| RF03.1 | Freelancer envia proposta: job_id, carta_apresentacao (50–2000 chars), valor_proposto, dias_entrega | UC05 | ✅ |
| RF03.2 | Validação: job `aberto` e `proposals_open=true`; freelancer não enviou antes; tem ≥ 1 crédito | UC05 | ✅ |
| RF03.3 | Débito de 1 crédito do freelancer ao enviar (transação `gasto_proposta`) | UC05 | ✅ |
| RF03.4 | Cliente visualiza propostas recebidas no seu job (valor, prazo, carta, perfil freelancer, avaliação) | UC06 | ✅ |
| RF03.5 | Cliente aceita proposta → cria Contrato + Escrow (retido) + Conversa + Notificações | UC06 | ✅ |
| RF03.6 | Cliente rejeita proposta → status `rejeitada`, notifica freelancer | UC06 | ✅ |
| RF03.7 | Após aceitação: job `proposals_open=false`, status `em_andamento`, `proposta_aceita_id` setado | UC06 | ✅ |
| RF03.8 | Freelancer visualiza próprio histórico de propostas com status | UC05 | ✅ |
| RF03.9 | Limite de propostas por job: máx 15 (configurável) | UC05 | 🟡 |

---

## RF04 — Contratos & Escrow

| ID | Requisito | UC Relacionado | Status |
|----|-----------|----------------|--------|
| RF04.1 | Contrato criado atomicamente ao aceitar proposta: trabalho_id, proposta_id, cliente_id, freelancer_id, valor_acordado, dias_entrega, data_limite, comissão 10%, valor_freelancer (90%) | UC06 | ✅ |
| RF04.2 | Escrow: débito carteira cliente (valor total) → `transacoes_escrow` status `retido` | UC07 | ✅ |
| RF04.3 | Carteira plataforma recebe comissão apenas na liberação (não na retenção) | UC07 | ✅ |
| RF04.4 | Freelancer submete entrega → `trabalho_entregue_em` timestamp | UC08 | ✅ |
| RF04.5 | Cliente aprova entrega → libera escrow: 90% carteira freelancer, 10% carteira plataforma | UC08 | ✅ |
| RF04.6 | Cliente pode abrir disputa → congela escrow (`em_disputa`), cria registro `disputas` | UC09 | ✅ |
| RF04.7 | Admin resolve disputa: `resolvida_cliente` (reembolso 100% cliente) OU `resolvida_freelancer` (libera 90% freelancer + 10% plataforma) | UC09 | ✅ |
| RF04.8 | Estados contrato: `ativo`, `em_disputa`, `concluido`, `cancelado` | UC06–UC09 | ✅ |
| RF04.9 | Estados pagamento escrow: `pendente`, `retido`, `liberado`, `devolvido_cliente` | UC07, UC09 | ✅ |

---

## RF05 — Chat em Tempo Real

| ID | Requisito | UC Relacionado | Status |
|----|-----------|----------------|--------|
| RF05.1 | Conversa criada automaticamente ao aceitar proposta (1:1 cliente↔freelancer) | UC07 | ✅ |
| RF05.2 | Mensagens de texto em tempo real via WebSocket (Laravel Reverb) | UC07 | ✅ |
| RF05.3 | Upload de arquivos no chat: PDF, imagens (jpg, png, webp), máx 5MB | UC07 | ✅ |
| RF05.4 | Histórico completo paginado (mais recentes primeiro) | UC07 | ✅ |
| RF05.5 | Diferenciação visual: enviadas (direita, azul) vs recebidas (esquerda, cinza) | UC07 | ✅ |
| RF05.6 | Marcação de lida (lida/não lida) + contador não lidas no badge | UC07 | ✅ |
| RF05.7 | Notificação push/in-app ao receber mensagem (se fora da tela) | UC07, UC10 | ✅ |

---

## RF06 — Avaliações

| ID | Requisito | UC Relacionado | Status |
|----|-----------|----------------|--------|
| RF06.1 | Após contrato `concluido`, ambas partes podem avaliar (1–5 estrelas + comentário opcional) | UC10 | ✅ |
| RF06.2 | Impedir avaliação duplicada: unique (contrato_id, avaliador_id) | UC10 | ✅ |
| RF06.3 | Média ponderada atualizada no perfil (`avaliacao_media`, `total_avaliacoes`) | UC10 | ✅ |
| RF06.4 | Exibição da média e total no perfil público e no card do freelancer | UC10 | ✅ |

---

## RF07 — Portfólio (Freelancer)

| ID | Requisito | UC Relacionado | Status |
|----|-----------|----------------|--------|
| RF07.1 | Freelancer adiciona item: título, descrição, imagem, URL projeto, categoria | UC11 | ✅ |
| RF07.2 | Freelancer edita/remove próprios itens | UC11 | ✅ |
| RF07.3 | Portfólio público no perfil do freelancer | UC11 | ✅ |

---

## RF08 — Busca & Descoberta

| ID | Requisito | UC Relacionado | Status |
|----|-----------|----------------|--------|
| RF08.1 | Busca jobs por palavra-chave + filtros (RF02.7) | UC04 | ✅ |
| RF08.2 | Busca freelancers por nome, skill, categoria, localização | UC12 | 🟡 |
| RF08.3 | Filtro freelancers por avaliação média, área de atuação | UC12 | 🟡 |
| RF08.4 | Sugestão de freelancers no detalhe do job (skills match) | UC05 | 🟡 |

---

## RF09 — Notificações

| ID | Requisito | UC Relacionado | Status |
|----|-----------|----------------|--------|
| RF09.1 | Nova proposta recebida (cliente) | UC05, UC06 | ✅ |
| RF09.2 | Proposta aceita/rejeitada (freelancer) | UC06 | ✅ |
| RF09.3 | Nova mensagem no chat (ambos) | UC07 | ✅ |
| RF09.4 | Atualizações de job/contrato (entrega, aprovação, disputa) | UC08, UC09 | ✅ |
| RF09.5 | Lista paginada no painel + marcação lida individual/todas | UC10 | ✅ |

---

## RF10 — Dashboards

| ID | Requisito | UC Relacionado | Status |
|----|-----------|----------------|--------|
| RF10.1 | Dashboard Cliente: meus jobs (ativos, concluídos, cancelados), propostas recebidas, pagamentos, saldo carteira | UC13 | ✅ |
| RF10.2 | Dashboard Freelancer: minhas propostas, trabalhos em andamento, avaliações, portfólio, saldo créditos/carteira | UC13 | ✅ |
| RF10.3 | Estatísticas: jobs concluídos, média avaliação, total ganho (freelancer) / total gasto (cliente) | UC13 | ✅ |

---

## RF11 — Monetização (Créditos, Boost, Comissão)

| ID | Requisito | UC Relacionado | Status |
|----|-----------|----------------|--------|
| RF11.1 | Saldo de créditos por freelancer (`saldo_creditos` em `perfis`) | UC03, UC05 | ✅ |
| RF11.2 | Compra de créditos: pacotes configuráveis (config/skilla.php) → recarga carteira → créditos | UC14 | ✅ |
| RF11.3 | Boost de perfil: gasta créditos → `destaques` (inicio_em, expira_em, `esta_destacado=true`) | UC14 | ✅ |
| RF11.4 | Comissão 10% automática na liberação do escrow (config `skilla.comissao_percentual`) | UC07 | ✅ |
| RF11.5 | Extrato de créditos (`transacoes_credito`: compra, gasto_proposta, boost, ajuste_admin) | UC14 | ✅ |

---

## RF12 — Administração

| ID | Requisito | UC Relacionado | Status |
|----|-----------|----------------|--------|
| RF12.1 | Listar/filtrar usuários, jobs, contratos, disputas, transações | UC15 | 🟡 |
| RF12.2 | Ações: banir/ativar usuário, forçar resolução disputa, ajustar créditos/saldo | UC15 | 🟡 |
| RF12.3 | Métricas básicas: usuários ativos, jobs publicados, volume transacionado | UC15 | 🟡 |

---

## Rastreabilidade RF → UC

| RF | UC Principal |
|----|--------------|
| RF01 | UC01, UC02 |
| RF02 | UC03, UC04 |
| RF03 | UC05, UC06 |
| RF04 | UC06, UC07, UC08, UC09 |
| RF05 | UC07 |
| RF06 | UC10 |
| RF07 | UC11 |
| RF08 | UC04, UC12 |
| RF09 | UC05–UC10 |
| RF10 | UC13 |
| RF11 | UC03, UC05, UC07, UC14 |
| RF12 | UC15 |

---

## Related docs
- [non-functional-requirements.md](non-functional-requirements.md)
- [business-rules.md](business-rules.md)
- [use-cases.md](use-cases.md)
- [../02-architeture/TRD.md](../02-architeture/TRD.md)
- [../04-api/api-specification.md](../04-api/api-specification.md)