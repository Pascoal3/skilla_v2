# Mapa de Telas — Skilla

**Status:** Draft
**Owner:** TODO(USER)
**Last updated:** 2026-09-26

---

## Convenções

- **Rota** = Caminho URL (web.php / api.php)
- **Perfil** = Quem acessa (Público, Cliente, Freelancer, Admin)
- **Tipo** = Página (Blade), Componente (Partial), Modal, API Endpoint
- **Auth** = Requer autenticação (Sim/Não)
- **Ref. UC** = Use Case relacionado (ver `../01-product/use-cases.md`)

---

## 1. Público (Não Autenticado)

| # | Tela / Componente | Rota | Tipo | Auth | Ref. UC | Descrição |
|---|-------------------|------|------|------|---------|-----------|
| P01 | Landing Page | `/` | Página | Não | — | Hero, value props, como funciona, CTA |
| P02 | Escolha de Função | `/escolher-funcao` | Página | Não | UC01 | Dois cards: Cliente / Freelancer |
| P03 | Login | `/login` | Página | Não | UC01 | Form email/senha + link registro |
| P04 | Registro Cliente | `/registar/cliente` | Página | Não | UC01 | Wizard 3 passos (dados, conta, perfil) |
| P05 | Registro Freelancer | `/registar/freelancer` | Página | Não | UC01 | Wizard 3 passos + skills opcional |
| P06 | Perfil Público Freelancer | `/perfil/{id}` | Página | Não | UC12 | Avatar, bio, skills, portfólio, avaliações |
| P07 | Job Detail (Público) | `/jobs/{id}` | Página | Não | UC04 | Detalhe job + botão "Propor" (se logado freelancer) |
| P08 | Freelancers Directory | `/freelancers` | Página | Não | UC12 | Lista + filtros (busca, skills, local, avaliação) |
| P09 | Termos de Uso | `/termos` | Página | Não | — | Legal |
| P10 | Política de Privacidade | `/privacidade` | Página | Não | — | Legal |
| P11 | Sobre / Ajuda | `/ajuda` | Página | Não | — | FAQ, contato |
| P12 | Overlay Conta Criada | `/overlay-conta-criada` | Modal | Não | UC01 | Sucesso registro + redirecionamento |
| P13 | Footer | `/footer` | Partial | Não | — | Links, redes, copyright |

---

## 2. Cliente (Autenticado, `role:cliente`)

| # | Tela / Componente | Rota | Tipo | Auth | Ref. UC | Descrição |
|---|-------------------|------|------|------|---------|-----------|
| C01 | Dashboard Cliente | `/painel/cliente` | Página | Sim | UC13 | Visão geral: jobs, propostas, carteira, stats |
| C02 | API Dashboard Data | `/api/cliente/dashboard` | API | Sim | UC13 | JSON para widgets (AJAX) |
| C03 | Criar Job (Wizard) | `/jobs/create` | Página | Sim | UC03 | 5 steps: Básico → Orçamento → Detalhes → Skills → Revisão |
| C04 | Meus Jobs | `/painel/cliente/jobs` | Página | Sim | UC03 | Tabela: rascunhos, abertos, em andamento, concluídos, cancelados |
| C05 | Job Detail (Owner) | `/jobs/{id}` | Página | Sim | UC03, UC06 | Mesma view pública + ações: editar, cancelar, ver propostas |
| C06 | Propostas Recebidas | `/jobs/{id}/propostas` | Partial/Modal | Sim | UC06 | Cards por proposta: freelancer, valor, prazo, carta, avaliação → Aceitar/Rejeitar |
| C07 | Sala de Trabalho (Chat) | `/chat/{conversaId}` | Página | Sim | UC07, UC08 | Chat tempo real + botões "Aprovar" / "Disputa" |
| C08 | Carteira | `/carteira` | Página | Sim | UC14 | Saldo Kz, extrato, recarga, saque (futuro) |
| C09 | Extrato Carteira | `/carteira/extrato` | Página | Sim | UC14 | Tabela paginada transacoes_carteiras |
| C10 | Recarga Carteira | `/carteira/recarga` | Página | Sim | UC14 | Form valor + comprovante (MVP simulado) |
| C11 | Perfil Cliente | `/perfil` | Página | Sim | UC02 | Editar: avatar, bio, telefone, localização |
| C12 | Configurações | `/definicoes` | Página | Sim | UC02 | Senha, notificações, privacidade, deletar conta |
| C13 | Notificações | `/notificacoes` | Partial/Drawer | Sim | UC10 | Lista + marcar lidas |
| C14 | Avaliar Freelancer | `/avaliar/{contratoId}` | Modal | Sim | UC10 | Estrelas + comentário (após contrato concluido) |
| C15 | Disputa (Cliente) | `/contratos/{id}/disputa` | Modal | Sim | UC09 | Form motivo + evidências |

---

## 3. Freelancer (Autenticado, `role:freelancer`)

| # | Tela / Componente | Rota | Tipo | Auth | Ref. UC | Descrição |
|---|-------------------|------|------|------|---------|-----------|
| F01 | Dashboard Freelancer | `/painel/freelancer` | Página | Sim | UC13 | Visão: propostas, trabalhos, avaliações, carteira, créditos |
| F02 | API Dashboard Data | `/api/freelancer/dashboard` | API | Sim | UC13 | JSON para widgets |
| F03 | Feed de Jobs | `/jobs` | Página | Sim | UC04 | Grid cards + filtros sidebar (categoria, orçamento, nível, local, busca) |
| F04 | Job Detail (Freelancer) | `/jobs/{id}` | Página | Sim | UC04, UC05 | Detalhe + botão "Enviar Proposta" (se elegível) |
| F05 | Enviar Proposta | `/jobs/{id}/propor` | Modal/Página | Sim | UC05 | Form: carta, valor, prazo + validação créditos |
| F06 | Minhas Propostas | `/proposals` | Página | Sim | UC05 | Tabela: job, valor, prazo, status (pendente/aceita/rejeitada) |
| F07 | Trabalhos em Andamento | `/painel/freelancer/trabalhos` | Página | Sim | UC08 | Cards: contrato, prazo, botão "Entregar" |
| F08 | Sala de Trabalho (Chat) | `/chat/{conversaId}` | Página | Sim | UC07, UC08 | Chat + botão "Entregar Trabalho Final" |
| F09 | Carteira Freelancer | `/carteira` | Página | Sim | UC14 | Saldo Kz + Créditos, extrato, recarga, saque |
| F10 | Extrato Créditos | `/carteira/creditos/extrato` | Página | Sim | UC14 | Tabela transacoes_credito (compra, gasto, boost) |
| F11 | Comprar Créditos | `/creditos/comprar` | Página | Sim | UC14 | Cards pacotes + pagamento com saldo carteira |
| F12 | Boost Perfil | `/perfil/boost` | Modal | Sim | UC14 | Confirma gasto créditos → destaca por 30d |
| F13 | Perfil Freelancer (Edição) | `/perfil` | Página | Sim | UC02 | Avatar, bio, skills (multi-select), telefone, localização |
| F14 | Portfólio | `/perfil/portfolio` | Página | Sim | UC11 | Grid + CRUD (criar, editar, excluir itens) |
| F15 | Configurações | `/definicoes` | Página | Sim | UC02 | Senha, notificações, privacidade, deletar conta |
| F16 | Notificações | `/notificacoes` | Partial/Drawer | Sim | UC10 | Lista + marcar lidas |
| F17 | Avaliar Cliente | `/avaliar/{contratoId}` | Modal | Sim | UC10 | Estrelas + comentário (após contrato concluido) |
| F18 | Disputa (Freelancer) | `/contratos/{id}/disputa` | Modal | Sim | UC09 | Form motivo + evidências |

---

## 4. Admin (Autenticado, `role:admin` / IP Allowlist) — Futuro v1.0

| # | Tela / Componente | Rota | Tipo | Auth | Ref. UC | Descrição |
|---|-------------------|------|------|------|---------|-----------|
| A01 | Admin Dashboard | `/admin` | Página | Sim | UC15 | Métricas: usuários, jobs, volume, disputas abertas |
| A02 | Gestão Usuários | `/admin/users` | Página | Sim | UC15 | Tabela + filtros + ações (banir, ajustar créditos/saldo) |
| A03 | Gestão Jobs | `/admin/jobs` | Página | Sim | UC15 | Listar, forçar cancelar, ver detalhes |
| A04 | Gestão Contratos | `/admin/contracts` | Página | Sim | UC15 | Listar, ver detalhes, forçar resolução |
| A05 | Gestão Disputas | `/admin/disputes` | Página | Sim | UC15 | Lista abertas → Decidir (cliente/freelancer/mutuo) |
| A06 | Transações / Auditoria | `/admin/transactions` | Página | Sim | UC15 | Extrato completo carteiras + escrow + créditos |
| A07 | Reconciliação | `/admin/reconcile` | Página | Sim | UC15 | Forçar `wallet:reconcile` + log divergências |
| A08 | Configuração Plataforma | `/admin/settings` | Página | Sim | UC15 | Comissão %, pacotes créditos, limites, boost |

---

## 5. Componentes Compartilhados (Partials / Modais)

| # | Componente | Usado Em | Descrição |
|---|------------|----------|-----------|
| SH01 | Header (Navbar) | Todas páginas autenticadas | Logo, navegação, user menu, notificações bell |
| SH02 | Sidebar Navigation | Dashboards (Cliente/Freelancer) | Links principais + badges contadores |
| SH03 | User Menu (Dropdown) | Header | Perfil, Carteira, Configurações, Logout |
| SH04 | Notification Bell | Header | Badge count + dropdown lista recentes + "Ver todas" |
| SH05 | Job Card | Feed, Dashboard, Search | Título, orçamento, prazo, cliente, skills, badges, ações |
| SH06 | Proposal Card | Propostas recebidas, Minhas propostas | Freelancer/Cliente, valor, prazo, status, ações |
| SH07 | Contract Card | Dashboard, Trabalhos | Status, valor, prazo, outra parte, ações (entregar/aprovar/disputa) |
| SH08 | Message Bubble | Chat | Bolha enviada (direita, azul) / recebida (esquerda, cinza) + anexo |
| SH09 | File Attachment | Chat, Job Detail, Proposta | Ícone por tipo + nome + tamanho + download/preview |
| SH10 | Avatar + Status | Header, Cards, Chat | Imagem + fallback iniciais + anel status (online/offline) |
| SH11 | Status Badge | Jobs, Propostas, Contratos, Pagamentos | Cores semânticas + texto legível |
| SH12 | Empty State | Feeds, Listas, Search | Ilustração + título + descrição + CTA |
| SH13 | Loading Skeleton | Todas listas/cards | Placeholders animados |
| SH14 | Toast Container | Global (Portal) | Top-right, stack, auto-close, tipos |
| SH15 | Modal Base | Propostas, Disputas, Avaliações, Boost, Confirmações | Overlay, trap focus, ESC/backdrop close |
| SH15 | Confirm Dialog | Ações destrutivas (cancelar, rejeitar, disputa) | Título, descrição, "Cancelar" / "Confirmar (destrutivo)" |
| SH16 | Bottom Sheet (Mobile) | Filtros, Menu usuário, Ações rápidas | Slide-up, handle, backdrop |
| SH17 | Stepper / Progress | Wizard Job, Wizard Registro | 1–5 steps, clickable (completed), current highlight |
| SH18 | Data Table | Admin, Extratos, Dashboards | Sort, paginação, ações por linha, seleção múltipla |
| SH19 | Filter Panel | Jobs Feed, Admin lists | Colapsável, accordion por seção, "Limpar filtros" |
| SH20 | Pagination | Todas listas paginadas | Prev/Next, page numbers, per-page select |

---

## 6. Estados de Tela por Componente

| Componente | Estados |
|------------|---------|
| **Job Card** | Default | Hover (shadow) | Loading (skeleton) | Saved (bookmark filled) | Urgent badge | Featured badge |
| **Proposal Card** | Pending | Accepted (green) | Rejected (red) | Loading action |
| **Contract Card** | Ativo | Em Disputa (warning) | Concluido (success) | Cancelado (error) | Ações contextuais |
| **Message Bubble** | Sent (right, blue) | Received (left, gray) | File preview | Read (check) | Unread (badge) |
| **Status Badge** | Rascunho (gray) | Aberto (blue) | Em Andamento (orange) | Concluido (green) | Cancelado (red) | Em Disputa (yellow) | Retido (yellow) | Liberado (green) | Devolvido (red) |
| **Button** | Default | Hover | Active | Disabled | Loading (spinner) | Destructive |
| **Input** | Default | Focus | Error (red border + msg) | Disabled | Filled |
| **Modal** | Closed | Opening (animate) | Open | Closing (animate) |
| **Toast** | Enter (slide) | Visible | Exit (fade) | Action button (undo) |
| **Skeleton** | Pulse (animation) | Loaded (swap) |
| **Empty State** | Illustrated | Title | Description | CTA Button |

---

## 7. Navegação e Fluxos Principais

### Cliente
```
Landing → Escolha Função → Registro Cliente → Dashboard Cliente
    → Criar Job (Wizard 5 steps) → Meus Jobs → Job Detail → Propostas Recebidas
    → Aceitar Proposta → Sala de Trabalho → Aprovar Entrega → Avaliar
    → Carteira → Recarga → Extrato
```

### Freelancer
```
Landing → Escolha Função → Registro Freelancer → Dashboard Freelancer
    → Feed Jobs (Filtros) → Job Detail → Enviar Proposta (Créditos)
    → Minhas Propostas → Sala de Trabalho → Entregar Trabalho
    → Carteira → Créditos (Comprar/Boost) → Extrato
    → Perfil → Portfólio → Skills
```

---

## Related docs
- [ui-plan.md](ui-plan.md)
- [screen-specification.md](screen-specification.md)
- [component-library.md](component-library.md)
- [../01-product/user-flow.md](../01-product/user-flow.md)
- [../01-product/use-cases.md](../01-product/use-cases.md)
- [../04-api/api-specification.md](../04-api/api-specification.md)