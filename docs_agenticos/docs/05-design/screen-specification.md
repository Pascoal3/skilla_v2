# Especificação Detalhada de Telas — Skilla

**Status:** Draft
**Owner:** TODO(USER)
**Last updated:** 2026-09-26

---

## Convenções

Cada tela especifica:
- **Objetivo**: O que o usuário consegue fazer
- **Permissões**: Quem acessa (Público, Cliente, Freelancer, Admin)
- **Campos / Elementos**: Inputs, botões, listas, dados exibidos
- **Validações**: Regras client-side + server-side
- **Estados**: Vazio, Carregando, Erro, Sucesso, Variações
- **Ações / Navegação**: Para onde vai cada botão/link
- **API Endpoints**: Endpoints consumidos (GET/POST/PATCH)
- **Componentes Reutilizados**: Refs para `component-library.md`
- **Acessibilidade**: Pontos críticos WCAG

---

## 1. Landing Page (`/`)

### Objetivo
Apresentar proposta de valor e converter visitantes em registro (Cliente ou Freelancer).

### Permissões
Público (não autenticado)

### Layout & Seções

| Seção | Elementos | Ações |
|-------|-----------|-------|
| **Header** | Logo, "Entrar" (link `/login`), "Começar" (link `/escolher-funcao` - primary) | Navegação |
| **Hero** | H1 "Trabalho seguro, pagamento garantido", Subtitle "A primeira plataforma freelance de Angola com escrow nativo", CTA Primary "Começar como Cliente" → `/registar/cliente`, CTA Secondary "Começar como Freelancer" → `/registar/freelancer` | Conversão |
| **Value Props** | 3 Cards (Escrow Seguro, Perfis Verificados, Pagamento em Kz) | Informação |
| **Como Funciona** | Stepper 4 passos (Cliente publica → Freelancer propõe → Escrow retém → Entrega & Pagamento) | Educação |
| **Stats** | Números: "500+ Freelancers", "200+ Jobs/mês", "95% Satisfação" | Prova social |
| **CTA Final** | "Pronto para começar?" + dois botões grandes | Conversão |
| **Footer** | Links (Termos, Privacidade, Ajuda), Redes sociais, Copyright | Navegação legal |

### Validações
- Nenhuma (página estática)

### Estados
- **Loading**: Skeleton cards nos stats/value props
- **Erro**: Fallback gracioso se APIs falharem (estático)

### API Endpoints
- `GET /api/stats` (opcional, para números dinâmicos)

### Componentes
`Header`, `Button`, `Card`, `Stepper`, `Footer`

### Acessibilidade
- H1 único, landmark `<main>`, `alt` em ilustrações, foco visível nos CTAs

---

## 2. Escolha de Função (`/escolher-funcao`)

### Objetivo
Direcionar usuário para fluxo de registro correto.

### Permissões
Público

### Layout
- Container centralizado max-w-3xl
- **Header**: Logo + "Voltar" (link `/`)
- **Dois Cards Lado a Lado** (mobile: stack vertical):
  - **Card Cliente**: Ícone 🏢, Título "Quero Contratar", Lista benefícios (Publicar jobs grátis, Receber propostas, Escrow seguro, Avaliar freelancers), Botão Primary "Registrar como Cliente" → `/registar/cliente`
  - **Card Freelancer**: Ícone 💻, Título "Quero Trabalhar", Lista benefícios (20 créditos grátis, Jobs variados, Pagamento garantido, Portfólio público), Botão Primary "Registrar como Freelancer" → `/registar/freelancer`
- **Footer**: "Já tem conta? Entrar" → `/login`

### Validações
- Nenhuma

### Estados
- **Hover Card**: Elevação + shadow-lg

### Componentes
`Card`, `Button`, `Icon`, `Header`

---

## 3. Registro Cliente (`/registar/cliente`)

### Objetivo
Criar conta de cliente com dados pessoais e perfil básico.

### Permissões
Público (middleware `guest`)

### Layout (Wizard 3 Passos)

#### Passo 1: Dados Pessoais
| Campo | Tipo | Validação | Obrigatório |
|-------|------|-----------|-------------|
| Primeiro Nome | Text | min 2, max 50, apenas letras | Sim |
| Sobrenome | Text | min 2, max 50, apenas letras | Sim |
| Província | Select | Deve existir em `provincias` | Sim |
| Localização | Textarea | Max 200 chars | Não |
| Telefone | Tel | Regex `^\+244\s?9\d{2}\s?\d{3}\s?\d{3}$` | Não |

#### Passo 2: Conta
| Campo | Tipo | Validação | Obrigatório |
|-------|------|-----------|-------------|
| Email | Email | Único em `perfis`, formato válido | Sim |
| Senha | Password | Min 8, 1 maiúscula, 1 minúscula, 1 número, 1 especial | Sim |
| Confirmar Senha | Password | Igual a Senha | Sim |

#### Passo 3: Perfil (Opcional - pode pular)
| Campo | Tipo | Validação |
|-------|------|-----------|
| Avatar | File Upload | Imagem, max 2MB, jpg/png/webp |
| Bio | Textarea | Max 500 chars |

### Validações Server-Side (FormRequest)
- Email único (`unique:perfis,email`)
- Província existe (`exists:provincias,id`)
- Senha bcrypt + força

### Ações
- **Próximo**: Valida passo atual → salva em sessão → próximo
- **Anterior**: Volta sem validar
- **Pular Passo 3**: Cria conta com defaults
- **Finalizar**: `AuthController::registar` → JWT cookie → Redirect `/painel/cliente`

### Estados
- **Loading**: Botão disabled + spinner
- **Erro Validação**: Inline abaixo do campo (vermelho)
- **Erro Servidor**: Toast error + mantém no passo
- **Sucesso**: Overlay `/overlay-conta-criada` → Redirect

### API Endpoints
- `POST /api/auth/register` (ou web `POST /registar`)

### Componentes
`Stepper`, `Input`, `Select`, `Textarea`, `FileUpload`, `Button`, `Toast`, `Overlay`

### Acessibilidade
- `autocomplete` attributes, `aria-describedby` para erros/helpers, `autofocus` no primeiro campo

---

## 4. Registro Freelancer (`/registar/freelancer`)

### Objetivo
Criar conta de freelancer + skills iniciais.

### Permissões
Público (`guest`)

### Layout
Igual ao Cliente + **Passo 3: Skills**

#### Passo 3: Skills (Obrigatório - min 1, max 10)
- **Multi-select com busca**: Digita → filtra skills → adiciona chips removíveis
- Skills vindas de `habilidades` (categorizadas)
- Contador: "3 de 10 skills selecionadas"
- Validação: min 1 skill

### Validações Extras
- `saldo_creditos` default = 20 (setado no controller)

---

## 5. Login (`/login`)

### Objetivo
Autenticar usuário existente.

### Layout
- Card centralizado max-w-md
- **Header**: Logo + "Voltar" (`/escolher-funcao`)
- **Form**:
  - Email (email, required, autofocus)
  - Senha (password, required, show/hide toggle)
  - "Lembrar-me" (checkbox → `remember_token`)
  - "Esqueci a senha" → `/recuperar-senha` (futuro)
  - Botão Primary "Entrar" (full width)
- **Footer**: "Não tem conta? Escolha sua função" → `/escolher-funcao`

### Validações
- `throttle:login` (5/min)
- Credenciais válidas → JWT cookie

### Estados
- **Erro 401**: "Email ou senha inválidos" (genérico)
- **Loading**: Spinner no botão

---

## 6. Dashboard Cliente (`/painel/cliente`)

### Objetivo
Visão consolidada da atividade do cliente.

### Permissões
`role:cliente` + `jwt.cookie`

### Layout
- **Header**: "Olá, {primeiro_nome}" + Saldo Carteira (Kz) + Notificações Bell
- **Sidebar** (lg: fixa, md: drawer):
  - Meus Jobs (ativo)
  - Propostas Recebidas
  - Pagamentos
  - Carteira
  - Configurações
- **Content Area** (Tabs):

#### Tab: Meus Jobs (Default)
- **Toolbar**: "Novo Job" (Primary) + Filtros (Status: Todos/Abertos/Em andamento/Concluídos/Cancelados)
- **Table** (ou Cards mobile):
  | Coluna | Desktop | Mobile |
  |--------|---------|--------|
  | Título | ✓ | ✓ |
  | Status | Badge | Badge |
  | Orçamento | Kz | Kz |
  | Propostas | Count + badge | Count |
  | Atualizado em | Data | Data |
  | Ações | Ver / Editar / Cancelar | Menu dropdown |
- **Empty State**: "Nenhum job criado" + CTA "Criar Primeiro Job"

#### Tab: Propostas Recebidas
- Agrupado por Job → Cards de proposta
- Cada card: Freelancer (avatar, nome, avaliação), Valor, Prazo, Carta (truncada + "Ver mais"), Botões "Aceitar" (primary) / "Rejeitar" (ghost)
- **Aceitar**: Modal confirmação → `POST /api/proposals/{id}/accept` → Success toast → Redirect Sala de Trabalho
- **Rejeitar**: Confirm dialog → `POST /api/proposals/{id}/reject` → Toast

#### Tab: Pagamentos
- Resumo: Total gasto, Em escrow, Disponível
- Tabela: Contrato, Freelancer, Valor, Status Pagamento, Data, Ações

#### Tab: Carteira (Link para `/carteira`)

### Estados
- **Loading**: Skeleton table/cards
- **Empty**: Ilustração + CTA contextual
- **Erro**: Toast + retry button

### API Endpoints
- `GET /api/cliente/dashboard` (widgets)
- `GET /api/jobs?cliente_id=me` (meus jobs)
- `GET /api/proposals?cliente_id=me` (propostas recebidas)
- `GET /api/wallet/balance`

---

## 7. Wizard Criar Job (`/jobs/create`)

### Objetivo
Guiar cliente na criação completa de um job (rascunho → publicado).

### Permissões
`role:cliente`

### Layout
- **Stepper Topo**: 5 passos (Básico → Orçamento → Detalhes → Skills → Revisão)
- **Sidebar Fixa** (lg): Resumo do que já preencheu
- **Content**: Form do passo atual
- **Footer Fixo**: "Anterior" (ghost) | "Salvar Rascunho" (secondary) | "Próximo" / "Publicar" (primary)

### Passos Detalhados

#### 1. Básico
| Campo | Tipo | Validação |
|-------|------|-----------|
| Título | Text | Required公開時, min 5, max 255 |
| Categoria | Select | Required公開時, `exists:categorias,id` |
| Tipo Trabalho | Radio (Preço Fixo / Por Hora) | Required公開時 |

#### 2. Orçamento
| Campo | Tipo | Validação | Condicional |
|-------|------|-----------|-------------|
| Preço Fixo | Number | > 0, step 100 | Se tipo=preco_fixo |
| Taxa Hora Mín | Number | > 0, step 100 | Se tipo=por_hora |
| Taxa Hora Max | Number | ≥ Mín, step 100 | Se tipo=por_hora |

#### 3. Detalhes
| Campo | Tipo | Validação |
|-------|------|-----------|
| Descrição | Textarea (rich text simples) | Required公開時, min 20, max 10000 |
| Tamanho Projeto | Select | Pequeno/Médio/Grande |
| Duração Estimada | Select | 1 semana, 2-4 semanas, 1-3 meses, 3-6 meses, 6+ meses |
| Nível Experiência | Select | Iniciante/Intermediário/Especialista |
| Possibilidade Efetivação | Checkbox | Boolean |
| Prazo | Date Picker | ≥ Hoje + 1 dia |
| Anexos | Dropzone (múltiplo) | Max 5 arquivos, 5MB cada, pdf/jpg/png/webp |

#### 4. Skills
- Multi-select com busca (typeahead)
- Chips selecionados removíveis
- Max 10 skills
- Mostra skills da categoria selecionada primeiro

#### 5. Revisão
- Resumo só-leitura de todos campos
- Botão "Salvar Rascunho" (secondary) → `POST /api/jobs/save` (status=rascunho)
- Botão "Publicar" (primary) → `PATCH /api/jobs/{id}/publish` → Validação rigorosa → Sucesso → Redirect `/jobs/{id}`

### Validações Server-Side (Publish)
- Todos campos obrigatórios preenchidos
- Pelo menos 1 skill
- Orçamento > 0
- Descrição ≥ 20 chars

### Estados
- **Draft Saved**: Toast "Rascunho salvo" + permanece no passo
- **Publish Success**: Toast "Job publicado!" + Redirect
- **Validation Error**: Scroll para campo + erro inline
- **Auto-save**: A cada 30s (localStorage) + sync servidor a cada step

### API Endpoints
- `POST /api/jobs/save` (rascunho)
- `PATCH /api/jobs/{id}/publish` (publicar)
- `POST /api/jobs/{id}/skills` (skills)

---

## 8. Feed de Jobs Freelancer (`/jobs`)

### Objetivo
Descobrir e filtrar oportunidades de trabalho.

### Permissões
`role:freelancer`

### Layout
- **Header**: "Descobrir Jobs" + Badge "X oportunidades" + "Salvos" (link)
- **Sidebar Filtros** (lg: fixa 280px, md: drawer `md:hidden`):
  - **Busca**: Input + botão limpar
  - **Categoria**: Checkboxes (Design, Dev, Marketing, etc.) + "Urgente" + "Remoto"
  - **Orçamento Máx**: Range slider (0–5M Kz) + input número
  - **Prazo**: Checkboxes (1 semana, 2-4 sem, 1-3 meses, 3+ meses)
  - **Nível**: Checkboxes (Iniciante, Intermediário, Especialista)
  - **Localização**: Multi-select províncias
  - **Ordenação**: Select (Mais recentes, Maior orçamento, Menos propostas, Destaque)
  - **Botão**: "Limpar filtros"
- **Content**: Grid Cards (1 col mobile, 2 tab, 3 desk) + Paginação
- **Job Card** (ver `component-library.md`):
  - Badge Destaque (roxo) / Urgente (laranja)
  - Título + Categoria + Cliente (avatar + nome)
  - Orçamento (Kz) + Tipo (Fixo/Hora)
  - Prazo (relativo: "em 5 dias")
  - Skills tags (max 3 + "+N")
  - Badge Propostas: "3 propostas"
  - Botão "Ver Detalhes" → `/jobs/{id}`

### Estados
- **Loading**: Grid Skeletons (8 cards)
- **Empty**: "Nenhum job encontrado" + "Amplie seus filtros"
- **Erro**: Toast + botão "Tentar novamente"

### Interações
- Filtros aplicam instantaneamente (debounce 300ms) → `GET /api/jobs?...`
- URL sincronizada com query params (shareable)
- Scroll infinito opcional (cursor pagination)

### API Endpoints
- `GET /api/jobs` (com query params)

---

## 9. Detalhe Job Freelancer (`/jobs/{id}`)

### Objetivo
Visualizar job completo e enviar proposta.

### Permissões
`role:freelancer` (público também vê, mas sem botão propor)

### Layout
- **Header Fixo** (sticky top): Título + Badges (Urgente, Remoto, Destaque) + "Salvar" (bookmark toggle)
- **Sidebar** (lg: sticky right 320px):
  - **Cliente**: Avatar, Nome, Avaliação, "X jobs concluídos", "Membro desde"
  - **Resumo Job**: Orçamento (grande), Tipo, Prazo (contagem regressiva), Nível, Tamanho
  - **Ações**: "Compartilhar", "Denunciar"
  - **CTA Fixo Bottom** (mobile): "Enviar Proposta" (Primary) — desabilitado se inelegível
- **Tabs Content**:
  - **Descrição**: Texto completo + Anexos (cards com preview/download)
  - **Requisitos**: Skills tags + Detalhes (Tamanho, Duração, Nível, Efetivação)
  - **Propostas** (se já propôs): "Você já enviou proposta" + status
  - **Jobs Similares**: 3 cards (mesma categoria/cliente)

### Botão "Enviar Proposta" - Lógica Habilitação
- ✅ Job `status=aberto` E `proposals_open=true`
- ✅ Freelancer `saldo_creditos >= 1`
- ✅ Não propôs antes (`propostas` unique)
- ❌ Caso contrário: Desabilitado + Tooltip explicativo

### Modal Enviar Proposta (ao clicar CTA)
- **Campos**: Carta (textarea, contador 50-2000), Valor (number, >0), Prazo (number, ≥1)
- **Validação**: Client-side + Server-side
- **Submit**: `POST /api/proposals/send` → Toast success → Redirect `/proposals` (minhas propostas)

### Estados
- **Job Fechado**: Banner "Este job não aceita mais propostas"
- **Já Propôs**: Badge "Proposta enviada" + link para Minhas Propostas
- **Sem Créditos**: CTA "Comprar Créditos" → `/creditos/comprar`

### API Endpoints
- `GET /api/jobs/{id}` (detalhe)
- `POST /api/proposals/send` (enviar proposta)
- `POST /api/jobs/{id}/save` (toggle save)

---

## 10. Sala de Trabalho / Chat (`/chat/{conversaId}`)

### Objetivo
Comunicação tempo real entre cliente e freelancer durante execução do contrato.

### Permissões
Partes do contrato (`ConversationPolicy::view`)

### Layout
- **Header Fixo** (sticky top, z-30):
  - **Left**: Avatar + Nome outro participante + Badge Status Contrato + Indicador Online (verde/offline cinza)
  - **Center**: "Contrato #{short_id}" + Status Pagamento Badge
  - **Right**: Botões contextuais:
    - Cliente + `status_pagamento=retido` + `trabalho_entregue_em` → "Aprovar Entrega" (Primary)
    - Freelancer + `status_contrato=ativo` + sem `trabalho_entregue_em` → "Entregar Trabalho" (Primary)
    - Qualquer + `status_contrato=ativo` + `status_pagamento=retido` → "Disputa" (Ghost/Destructive)
- **Message List** (flex-1, overflow-y-auto, auto-scroll bottom):
  - **Date Separator**: "Hoje", "Ontem", "DD/MM/AAAA"
  - **Message Bubble**:
    - **Enviada (Direita)**: bg-primary-500, text-white, rounded-tr-none, hora pequena cinza
    - **Recebida (Esquerda)**: bg-gray-100, text-gray-900, rounded-tl-none, avatar miniatura (apenas primeira da sequência), nome + hora
    - **Arquivo**: Preview imagem (max-h-64) / Ícone PDF + nome + tamanho + botão download
    - **Status**: Check simples (enviado), Check duplo (recebido), Check duplo azul (lida)
- **Input Área Fixa** (sticky bottom, z-20):
  - **Left**: Botão Anexar (ícone clipe) → Input file hidden (accept: pdf, jpg, png, webp, max 5MB)
  - **Center**: Textarea auto-resize (min-h-12, max-h-48, placeholder "Digite uma mensagem...")
  - **Right**: Botão Enviar (Primary, disabled se vazio e sem arquivo)
  - **Shortcuts**: Enter = Enviar, Shift+Enter = Nova linha

### WebSocket (Reverb)
- Canal: `private-conversation.{conversaId}`
- Eventos: `MessageSent`, `MessageRead`, `TypingIndicator`
- Reconexão automática + toast "Reconectando..." se disconnect

### Anexos
- Upload via `POST /api/chat/send` (multipart) → retorna message object
- Preview imediato otimista (local) → confirmação server
- Tipos permitidos: PDF, JPG, PNG, WebP ≤ 5MB
- Storage: `private/chat/{conversaId}/{uuid}.ext`

### Ações Contratuais (Botões Header)
| Botão | Quem | Condição | Endpoint | Pós-Ação |
|-------|------|----------|----------|----------|
| Entregar Trabalho | Freelancer | `ativo` + sem `trabalho_entregue_em` | `PATCH /api/contracts/{id}/submit` | Toast "Entregue!" → Botão some → Header mostra "Aguardando aprovação" |
| Aprovar Entrega | Cliente | `retido` + `trabalho_entregue_em` existe | `PATCH /api/contracts/{id}/approve` | Modal confirmação → `approve` → Toast "Pagamento liberado!" → Redirect Dashboard |
| Disputa | Qualquer | `ativo` + `retido` | `POST /api/contracts/{id}/dispute` | Modal motivo → Toast "Disputa aberta" → Botões somem → Status "Em Disputa" |

### Estados
- **Conectando**: Spinner header + "Conectando..."
- **Offline**: Banner "Você está offline. Mensagens serão enviadas ao reconectar."
- **Carregando Histórico**: Skeleton bubbles
- **Erro Envio**: Toast error + botão "Reenviar" na bubble

### API Endpoints
- `GET /api/chat/{conversaId}/messages` (histórico paginado)
- `POST /api/chat/send` (enviar texto/arquivo)
- `PATCH /api/messages/{id}/read` (marcar lida)
- `PATCH /api/contracts/{id}/submit` | `approve` | `dispute`

### Acessibilidade
- `aria-live="polite"` na lista mensagens
- `role="log"` para novas mensagens
- `aria-label` no input "Mensagem para {nome}"
- Foco management: input mantém foco após envio; scroll bottom apenas se usuário no bottom

---

## 11. Carteira (`/carteira`)

### Objetivo
Gerenciar saldo Kz, extrato, recarga, saque e créditos.

### Permissões
Autenticado (Cliente + Freelancer)

### Layout (Tabs)
- **Header**: Saldo Principal (Grande, Kz) + "Recarregar" (Primary) + "Sacar" (Ghost, futuro)
- **Tabs**:
  1. **Extrato Kz** (`/carteira/extrato`)
  2. **Créditos** (`/carteira/creditos/extrato`) — só Freelancer
  3. **Comprar Créditos** (`/creditos/comprar`) — só Freelancer

### Tab Extrato Kz
- **Resumo**: Saldo Atual | Total Entradas (mês) | Total Saídas (mês)
- **Tabela** (Server-side pagination, sort Data desc):
  | Data | Tipo | Descrição | Entrada (Kz) | Saída (Kz) | Saldo |
  |------|------|-----------|--------------|------------|-------|
  | 26/09/2024 | Recarga | Recarga via Multicaixa | 50.000,00 | — | 50.000,00 |
  | 26/09/2024 | Escrow | Pagamento Contrato #abc | — | 15.000,00 | 35.000,00 |
- **Filtros**: Tipo (select), Data Início/Fim, Busca Descrição
- **Exportar CSV** (futuro)

### Tab Créditos (Freelancer)
- **Header**: Saldo Créditos (grande, número) + "Comprar Créditos" (Primary) + "Boost Perfil" (Secondary, se saldo≥custo)
- **Tabela Extrato Créditos**:
  | Data | Tipo | Descrição | Quantidade | Saldo |
  |------|------|-----------|------------|-------|
  | 26/09 | Compra | Pacote Pro | +30 | 30 |
  | 26/09 | Gasto | Proposta Job #xyz | -1 | 29 |

### Recarga (Modal/Página)
- **Form**: Valor (number, min 500 Kz) + Método (Select: Multicaixa Express, Transferência) + Comprovante (File, opcional MVP)
- **Submit**: Cria `transacoes_carteiras` status `pendente` → Admin aprova → `concluido` + creditado

### Comprar Créditos (Freelancer)
- **Cards Pacotes** (do config):
  - Basic: 10 créditos / 1.500 Kz
  - Pro: 30 créditos / 4.000 Kz (badge "Recomendado")
  - Premium: 100 créditos / 12.000 Kz (badge "Mais Popular")
- **Cálculo**: Mostra "Você terá X créditos → Y propostas potenciais"
- **Pagamento**: Usa saldo carteira Kz (verifica saldo ≥ preço)
- **Submit**: `POST /api/credits/buy` → Atomic: débita Kz + credita créditos

### Boost Perfil (Freelancer)
- **Card**: "Destaque seu perfil por 30 dias" + Custo (ex.: 50 créditos)
- **Estado**: Se ativo → "Até DD/MM/AAAA" + "Cancelar" (ghost)
- **Submit**: Confirma gasto créditos → `POST /api/credits/boost`

### API Endpoints
- `GET /api/wallet/balance`
- `GET /api/wallet/statement`
- `GET /api/credits`
- `POST /api/wallet/deposit`
- `POST /api/credits/buy`
- `POST /api/credits/boost`

---

## 12. Perfil Público Freelancer (`/perfil/{id}`)

### Objetivo
Exibir portfólio, skills, avaliações para clientes decidirem contratar.

### Permissões
Público

### Layout
- **Header**: Avatar XL (128px), Nome Completo, `@username`, Badges (Verificado ✓, Destaque ★), Avaliação Média (Estrelas + número) + "X avaliações"
- **Badges**: "Freelancer Verificado" (se KYC futuro), "Top Rated" (se avg ≥ 4.8 + 10+ reviews)
- **Tabs**:
  1. **Sobre**: Bio, Localização, Skills (tags clicáveis → busca), Estatísticas (Jobs concluídos, Taxa resposta, Tempo médio resposta)
  2. **Portfólio**: Grid 3 cols (Card: Imagem cover, Título, Categoria, Link projeto) → Click → Modal/Detalhe
  3. **Avaliações**: Lista (Mais recentes) — Card: Estrelas, Comentário, Autor (avatar + nome), Data, Contrato (link se público)
- **CTA Fixo Bottom** (mobile): "Contratar" → `/jobs/create?freelancer_id={id}` (pre-fill)

### Estados
- **Sem Portfólio**: Empty state "Nenhum projeto publicado"
- **Sem Avaliações**: "Ainda não avaliado"

---

## 13. Admin Dashboard (`/admin`) — Futuro v1.0

### Objetivo
Visão gerencial e moderação da plataforma.

### Permissões
`role:admin` + IP Allowlist + 2FA

### Layout
- **Sidebar**: Dashboard, Usuários, Jobs, Contratos, Disputas, Transações, Configurações
- **Dashboard Widgets**:
  - Usuários: Total, Novos hoje, Ativos 7d, Banidos
  - Jobs: Publicados hoje, Em andamento, Concluídos mês
  - Financeiro: Volume Kz (mês), Comissão (mês), Saldo Plataforma
  - Disputas: Abertas, Resolvidas (mês), Tempo médio resolução
  - Gráficos: Usuários/dia (7d), Volume Kz (30d), Funil Jobs
- **Ações Rápidas**: "Ver disputas abertas", "Reconciliar carteiras", "Exportar relatório"

### Tabelas Admin (Server-side, search, sort, export CSV)
- **Usuários**: Filtros (Role, Status, Província, Data registro) + Ações (Ver, Banir/Desbanir, Ajustar Créditos, Ajustar Saldo)
- **Disputas**: Status, Partes, Contrato, Valor, Tempo aberto → "Decidir" (Modal: Cliente/Freelancer/Mútuo + Valores custom)

---

## Related docs
- [ui-plan.md](ui-plan.md)
- [screen-mapping.md](screen-mapping.md)
- [component-library.md](component-library.md)
- [../01-product/user-flow.md](../01-product/user-flow.md)
- [../04-api/api-specification.md](../04-api/api-specification.md)