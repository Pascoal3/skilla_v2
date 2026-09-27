# 📌 1. Nome da Tela

**Dashboard do Cliente — Visão Geral e Centro de Comando**  
`/cliente/dashboard`

---

# 🎯 2. Objetivo da Tela

Fornecer ao cliente uma visão centralizada e accionável do estado de todos os seus projectos, propostas recebidas, saldo da carteira e alertas urgentes, permitindo que tome decisões rápidas sem precisar de navegar por múltiplas secções da plataforma.

---

# 🧱 3. Estrutura Geral (Layout)

text

```
┌─────────────────────────────────────────────────────────────────┐
│                         TOPBAR (fixo)                           │
├────────────────┬────────────────────────────────────────────────┤
│                │                                                │
│   SIDEBAR      │   ÁREA DE CONTEÚDO PRINCIPAL                   │
│   Fixa         │   Scroll vertical                              │
│   240px        │   Flex column, gap-6                           │
│                │                                                │
└────────────────┴────────────────────────────────────────────────┘
```

**Tipo de layout:** Split — sidebar fixa à esquerda + área de conteúdo com scroll à direita

**Grid interno do conteúdo:**

text

```
ROW 1: Saudação + CTA                          → coluna única (full width)
ROW 2: KPI Cards                               → grid 4 colunas
ROW 3: Carteira | Alertas Urgentes             → grid 2 colunas (60% | 40%)
ROW 4: Jobs Ativos | Propostas Recebidas       → grid 2 colunas (55% | 45%)
ROW 5: Histórico de Transações                 → coluna única (full width)
```

**Espaçamentos:**

- Padding interno do conteúdo: `32px` (horizontal e vertical)
- Gap entre blocos: `24px`
- Gap interno dos cards: `16px`
- Border-radius dos cards: `12px`

---

# 🧩 4. Componentes da Interface (Hierárquico)

---

## 4.1 TOPBAR `(height: 64px, position: fixed, z-index: 50)`

text

```
┌──────────────────────────────────────────────────────────────────┐
│  [🔷 Skilla]          ←————————————————→   [🔔] [Avatar ▾]      │
└──────────────────────────────────────────────────────────────────┘
```

### Elementos:

**Logo Skilla** `(left)`

- Logótipo em SVG
- Cor: `#2563EB` (azul principal)
- Tipografia: `Inter Bold, 20px`
- Clicável → redireciona para `/cliente/dashboard`

**Ícone de Notificações** `(right, mr-4)`

- Ícone: sino `Bell`
- Tamanho: `24px`, cor `#6B7280`
- **Badge numérico** (aparece apenas se `count > 0`)
    - Círculo vermelho `#EF4444`, `16px x 16px`
    - Número branco `Inter Bold, 10px`
    - Posição: `top-right` do ícone
- **Ao clicar:** Abre dropdown de notificações
    - Largura: `380px`
    - Lista de notificações com: ícone de tipo + mensagem + tempo relativo ("há 5 min")
    - Cada item clicável → redireciona via `url_redirecionamento`
    - Botão no fundo: `"Marcar todas como lidas"`

**Avatar + Nome** `(right, dropdown trigger)`

- Foto circular `40px x 40px`, `border-radius: 50%`
- Fallback: iniciais do nome em fundo `#DBEAFE`
- Nome completo ao lado: `Inter Medium, 14px, #374151`
- Chevron `▾` em `#9CA3AF`
- **Ao clicar:** Dropdown com 3 itens:
    - `👤 Ver o Meu Perfil` → `/cliente/perfil`
    - `⚙️ Definições` → `/cliente/definicoes`
    - `🚪 Terminar Sessão` → POST `/logout`

**Fonte dos dados:**

SQL

```
-- Nome e avatar
SELECT nome_completo, url_avatar FROM perfis WHERE id = [auth_id];

-- Contador de notificações
SELECT COUNT(*) FROM notificacoes 
WHERE usuario_id = [auth_id] AND lida = false;
```

---

## 4.2 SIDEBAR `(width: 240px, position: fixed, height: 100vh)`

text

```
┌─────────────────┐
│  [🔷 Skilla]    │  ← Apenas em mobile (no desktop está na topbar)
├─────────────────┤
│ 📊 Dashboard    │  ← Estado: Activo (fundo #EFF6FF, texto #2563EB)
│ 💼 Os Meus Jobs │
│ 📩 Propostas    │  ← Badge: [4]
│ 💬 Mensagens    │  ← Badge: [2]
│ 💰 Carteira     │
│ ⭐ Avaliações   │
│ 👤 O Meu Perfil │
├─────────────────┤
│ ⚙️ Definições   │
│ 🚪 Sair         │
└─────────────────┘
```

### Especificações dos itens:

|Propriedade|Valor|
|---|---|
|Altura de cada item|`48px`|
|Padding horizontal|`16px`|
|Ícone|`20px`, cor `#6B7280`|
|Texto|`Inter Medium, 14px, #374151`|
|Estado activo (fundo)|`#EFF6FF`|
|Estado activo (texto + ícone)|`#2563EB`|
|Estado activo (barra lateral)|`3px solid #2563EB` à esquerda|
|Hover|`background: #F9FAFB`|

### Badges nos itens:

- Fundo `#2563EB`, texto branco
- `Inter Bold, 11px`
- `border-radius: 10px`, `padding: 2px 6px`
- Apenas visível se valor `> 0`

**Fonte dos dados dos badges:**

SQL

```
-- Badge Propostas
SELECT COUNT(*) FROM propostas p
JOIN trabalhos t ON p.trabalho_id = t.id
WHERE t.cliente_id = [auth_id] 
AND p.status = 'pendente' AND p.visto = false;

-- Badge Mensagens
SELECT COUNT(*) FROM mensagens m
JOIN conversas c ON m.conversa_id = c.id
JOIN contratos ct ON c.contrato_id = ct.id
WHERE ct.cliente_id = [auth_id] 
AND m.lida = false AND m.remetente_id != [auth_id];
```

---

## 4.3 BLOCO A — Saudação + CTA Principal

text

```
┌──────────────────────────────────────────────────────────────────┐
│  Olá, Rafael 👋                                                  │
│  Tens 4 propostas novas à espera de revisão.                    │
│                                              [+ Publicar Job]   │
└──────────────────────────────────────────────────────────────────┘
```

### Elementos:

**Título de saudação**

- `"Olá, [primeiro_nome] 👋"`
- Tipografia: `Inter Bold, 24px, #111827`
- O primeiro nome é extraído do campo `nome_completo` (split por espaço)

**Mensagem dinâmica contextual**

- Tipografia: `Inter Regular, 15px, #6B7280`
- Lógica de estados:

text

```
IF propostas_pendentes > 0:
  "Tens [N] proposta(s) nova(s) à espera de revisão."

ELSE IF contratos_aguarda_revisao > 0:
  "Um freelancer submeteu o trabalho final. Revê agora."

ELSE IF jobs_ativos > 0:
  "Os teus jobs estão ativos. Aguarda propostas dos freelancers."

ELSE IF total_jobs = 0:
  "Bem-vindo à Skilla! Publica o teu primeiro trabalho para começar."
```

**Botão CTA — "Publicar Novo Job"** `(right-aligned)`

- Fundo: `#2563EB`
- Texto: `"+ Publicar Novo Job"`, `Inter SemiBold, 14px, #FFFFFF`
- `border-radius: 8px`, `padding: 10px 20px`
- Ícone `+` à esquerda do texto
- Hover: `background: #1D4ED8`
- Acção: Navega para `/cliente/jobs/criar` (Passo 1 do Wizard)

---

## 4.4 BLOCO B — KPI Cards (4 cartões de métricas)

text

```
┌──────────────┐ ┌──────────────┐ ┌──────────────┐ ┌──────────────┐
│  💼          │ │  📩          │ │  🔄          │ │  ✅          │
│  Jobs        │ │  Propostas   │ │  Em          │ │  Concluídos  │
│  Publicados  │ │  Recebidas   │ │  Andamento   │ │              │
│              │ │              │ │              │ │              │
│     3        │ │     12       │ │     1        │ │     8        │
│              │ │  ▲ 4 novos   │ │              │ │              │
└──────────────┘ └──────────────┘ └──────────────┘ └──────────────┘
```

### Especificações de cada card:

|Propriedade|Valor|
|---|---|
|Fundo|`#FFFFFF`|
|Border|`1px solid #E5E7EB`|
|Border-radius|`12px`|
|Padding|`20px`|
|Sombra|`box-shadow: 0 1px 3px rgba(0,0,0,0.08)`|
|Ícone|`32px`, cor temática|
|Label|`Inter Regular, 13px, #6B7280`|
|Número|`Inter Bold, 32px, #111827`|
|Sub-label|`Inter Regular, 12px` (cor varia por contexto)|

**Cores dos ícones por card:**

|Card|Cor do ícone|Fundo do ícone|
|---|---|---|
|Jobs Publicados|`#2563EB`|`#EFF6FF`|
|Propostas Recebidas|`#7C3AED`|`#F5F3FF`|
|Em Andamento|`#D97706`|`#FFFBEB`|
|Concluídos|`#059669`|`#ECFDF5`|

**Sub-label de contexto:**

- "Propostas Recebidas" → mostra `"▲ [N] novas"` em verde se houver novas
- Cards clicáveis → navegam para a secção correspondente

**Fonte dos dados:**

SQL

```
SELECT 
    (SELECT COUNT(*) FROM trabalhos 
     WHERE cliente_id = [auth_id] AND status = 'aberto') as jobs_publicados,

    (SELECT COUNT(*) FROM propostas p
     JOIN trabalhos t ON p.trabalho_id = t.id
     WHERE t.cliente_id = [auth_id] AND p.status = 'pendente') as propostas_recebidas,

    (SELECT COUNT(*) FROM contratos 
     WHERE cliente_id = [auth_id] 
     AND status_contrato IN ('ativo','aguarda_revisao')) as em_andamento,

    (SELECT COUNT(*) FROM contratos 
     WHERE cliente_id = [auth_id] 
     AND status_contrato = 'concluido') as concluidos;
```

---

## 4.5 BLOCO C — Card da Carteira Skilla `(coluna esquerda, 60%)`

text

```
┌──────────────────────────────────────────────────────┐
│  💰 A Minha Carteira Skilla                          │
│                                                      │
│  Saldo Disponível                                    │
│  ┌────────────────────────────────┐                  │
│  │    50.000,00 KZS               │  [+ Recarregar]  │
│  └────────────────────────────────┘                  │
│                                                      │
│  ┌──────────────────────────────────────────────┐    │
│  │  🔒 Retido em Escrow          25.000,00 KZS  │    │
│  │  ℹ️ Reservado para projectos em curso        │    │
│  └──────────────────────────────────────────────┘    │
└──────────────────────────────────────────────────────┘
```

### Elementos:

**Título do bloco**

- `"💰 A Minha Carteira Skilla"`
- `Inter SemiBold, 16px, #111827`

**Área de saldo disponível**

- Label: `"Saldo Disponível"`, `Inter Regular, 13px, #6B7280`
- Valor: `Inter Bold, 36px, #111827`
- Formato: `50.000,00 KZS`
- Fundo do campo: `#F9FAFB`, `border: 1px solid #E5E7EB`, `border-radius: 8px`, `padding: 16px`

**Botão "Recarregar Saldo"**

- Estilo: `outlined` (borda `#2563EB`, texto `#2563EB`, fundo transparente)
- `border-radius: 8px`, `padding: 8px 16px`
- `Inter SemiBold, 13px`
- Hover: fundo `#EFF6FF`
- Acção: Abre modal de recarga simulada

**Área de Escrow**

- Fundo: `#FFFBEB` (amarelo suave)
- Border: `1px solid #FDE68A`
- `border-radius: 8px`, `padding: 12px 16px`
- Ícone: cadeado `🔒` em `#D97706`
- Texto principal: `"Retido em Escrow"`, `Inter Medium, 13px, #92400E`
- Valor: `Inter Bold, 16px, #92400E`
- Texto explicativo: `Inter Regular, 12px, #B45309`
- Tooltip `ℹ️` ao hover: `"Este valor está bloqueado como garantia para os teus projectos activos. Será libertado após aprovação do trabalho."`

**Fonte dos dados:**

SQL

```
-- Saldo disponível
SELECT saldo_disponivel FROM carteiras 
WHERE usuario_id = [auth_id];

-- Total em Escrow
SELECT COALESCE(SUM(te.valor), 0) as total_escrow
FROM transacoes_escrow te
JOIN contratos c ON te.contrato_id = c.id
WHERE c.cliente_id = [auth_id] 
AND te.status_pagamento = 'retido';
```

---

## 4.6 BLOCO D — Alertas Urgentes `(coluna direita, 40%)`

> Bloco condicional — apenas renderizado se houver alertas activos

text

```
┌──────────────────────────────────────────┐
│  ⚠️ Requer a Tua Atenção                │
├──────────────────────────────────────────┤
│  🔴  "Design de Flyer Promocional"       │
│       Trabalho submetido. Aguarda        │
│       aprovação até 20 Jun 2025.         │
│                   [Ir para Revisão →]    │
├──────────────────────────────────────────┤
│  🟡  "Website Corporativo"               │
│       Expira em 2 dias sem contrato.     │
│       Aceita uma proposta rapidamente.   │
│                   [Ver Propostas →]      │
└──────────────────────────────────────────┘
```

### Especificações:

**Título do bloco**

- `"⚠️ Requer a Tua Atenção"`
- `Inter SemiBold, 16px, #111827`

**Alerta Tipo 1 — Vermelho (Trabalho submetido)**

- Borda esquerda: `4px solid #EF4444`
- Fundo: `#FEF2F2`
- Ícone: `🔴`
- Título do job: `Inter SemiBold, 14px, #111827`
- Descrição: `Inter Regular, 13px, #6B7280`
- Data limite formatada: `"até [DD MMM YYYY]"`
- Botão: `"Ir para Revisão →"` — link sublinhado `#2563EB`

**Alerta Tipo 2 — Amarelo (Job a expirar)**

- Borda esquerda: `4px solid #F59E0B`
- Fundo: `#FFFBEB`
- Ícone: `🟡`
- Botão: `"Ver Propostas →"` — link sublinhado `#2563EB`

**Estado vazio do bloco:**

text

```
✅ Tudo em ordem!
   Não tens nenhuma acção urgente pendente.
```

- Ícone check verde, texto `#6B7280`

**Fonte dos dados:**

SQL

```
-- Alertas tipo 1: trabalhos aguardando aprovação
SELECT c.id, t.titulo, c.data_limite
FROM contratos c JOIN trabalhos t ON t.id = c.trabalho_id
WHERE c.cliente_id = [auth_id] 
AND c.status_contrato = 'aguarda_revisao';

-- Alertas tipo 2: jobs a expirar em 48h
SELECT id, titulo, expira_em FROM trabalhos
WHERE cliente_id = [auth_id] 
AND status = 'aberto'
AND expira_em BETWEEN NOW() AND NOW() + INTERVAL 2 DAY;
```

---

## 4.7 BLOCO E — Os Meus Jobs Ativos

text

```
┌──────────────────────────────────────────────────────────────────┐
│  💼 Os Meus Jobs Ativos                           [Ver Todos →]  │
├──────────────────────────────────────────────────────────────────┤
│                                                                  │
│  ┌────────────────────────────────────────────────────────────┐  │
│  │  🟢 Aberto          Publicado há 2 dias                    │  │
│  │  Desenvolvimento de Website Corporativo                    │  │
│  │  Orçamento: 150.000 KZS  •  📩 4 propostas recebidas      │  │
│  │                                      [Ver Propostas →]    │  │
│  └────────────────────────────────────────────────────────────┘  │
│                                                                  │
│  ┌────────────────────────────────────────────────────────────┐  │
│  │  🔄 Em Andamento    Entrega em 3 dias                      │  │
│  │  Criação de Logótipo para Startup                          │  │
│  │  Freelancer: Ana Rodrigues  •  💰 Escrow: 45.000 KZS      │  │
│  │                                         [Ir para Chat →]  │  │
│  └────────────────────────────────────────────────────────────┘  │
│                                                                  │
│  ┌────────────────────────────────────────────────────────────┐  │
│  │  ⚠️ Aguarda Revisão                                        │  │
│  │  Design de Flyer Promocional                               │  │
│  │  O freelancer submeteu o trabalho final                    │  │
│  │                          [Aprovar ✅]  [Abrir Disputa ⚖️] │  │
│  └────────────────────────────────────────────────────────────┘  │
│                                                                  │
└──────────────────────────────────────────────────────────────────┘
```

### Especificações dos cards de job:

**Estrutura interna de cada card:**

text

```
[Badge de status]          [Tempo relativo / Countdown]
[Título do Job - H3]
[Orçamento] • [Contagem de propostas OU nome do freelancer]
                                        [Botão de acção →]
```

**Estilos dos badges de status:**

|Status|Badge|Cor fundo|Cor texto|
|---|---|---|---|
|`aberto`|`🟢 Aberto`|`#DCFCE7`|`#166534`|
|`em_andamento`|`🔄 Em Andamento`|`#DBEAFE`|`#1E40AF`|
|`aguarda_revisao`|`⚠️ Aguarda Revisão`|`#FEF3C7`|`#92400E`|
|`em_disputa`|`⚖️ Em Disputa`|`#FEE2E2`|`#991B1B`|

**Tempo relativo:**

- Jobs `aberto` → `"Publicado há [X] dias"` (calculado a partir de `criado_em`)
- Jobs `em_andamento` → `"Entrega em [N] dias"` (calculado a partir de `data_limite`)
- Jobs `aguarda_revisao` → `"Submetido há [X] horas"`

**Botões de acção por status:**

|Status|Botão(ões)|
|---|---|
|`aberto`|`[Ver Propostas →]`|
|`em_andamento`|`[Ir para Chat →]`|
|`aguarda_revisao`|`[Aprovar ✅]` + `[Abrir Disputa ⚖️]`|
|`em_disputa`|`[Ver Disputa →]`|

**Botão "Ver Todos →"** `(header do bloco)`

- `Inter Medium, 13px, #2563EB`
- Navega para `/cliente/jobs`

**Estado vazio:**

text

```
💼 Ainda não publicaste nenhum trabalho.
   Os teus jobs aparecerão aqui.
   [Publicar Primeiro Job →]
```

**Fonte dos dados:**

SQL

```
SELECT 
    t.id, t.titulo, t.orcamento_fixo, t.status,
    t.criado_em, t.expira_em,
    COUNT(p.id) FILTER (WHERE p.status = 'pendente') as total_propostas,
    c.id as contrato_id,
    c.status_contrato,
    c.data_limite,
    pf.nome_completo as freelancer_nome,
    te.valor as valor_escrow
FROM trabalhos t
LEFT JOIN propostas p ON p.trabalho_id = t.id
LEFT JOIN contratos c ON c.trabalho_id = t.id
LEFT JOIN perfis pf ON pf.id = c.freelancer_id
LEFT JOIN transacoes_escrow te ON te.contrato_id = c.id 
    AND te.status_pagamento = 'retido'
WHERE t.cliente_id = [auth_id]
AND t.status NOT IN ('cancelado', 'concluido')
GROUP BY t.id, c.id, pf.nome_completo, te.valor
ORDER BY t.criado_em DESC
LIMIT 5;
```

---

## 4.8 BLOCO F — Últimas Propostas Recebidas

text

```
┌──────────────────────────────────────────────────────────────────┐
│  📩 Últimas Propostas Recebidas                   [Ver Todas →]  │
├──────────────────────────────────────────────────────────────────┤
│  ┌──────────────────────────────────────────────────────────┐    │
│  │  [👤]  Miguel Fernandes           ⭐ 4.8  (23 avaliações)│    │
│  │        Para: "Website Corporativo"                       │    │
│  │        💰 130.000 KZS  •  📅 14 dias de entrega         │    │
│  │        "Tenho 5 anos de experiência em Laravel e..."    │    │
│  │                              [Ver Proposta Completa →]  │    │
│  └──────────────────────────────────────────────────────────┘    │
│                                                                  │
│  ┌──────────────────────────────────────────────────────────┐    │
│  │  [👤]  Carla Mendes               ⭐ 4.5  (11 avaliações)│    │
│  │        Para: "Website Corporativo"                       │    │
│  │        💰 120.000 KZS  •  📅 10 dias de entrega         │    │
│  │        "Posso entregar antes do prazo porque tenho..."  │    │
│  └──────────────────────────────────────────────────────────┘    │
└──────────────────────────────────────────────────────────────────┘
```

### Especificações dos cards de proposta:

**Avatar do freelancer**

- Circular, `48px x 48px`
- Fallback: iniciais em fundo `#DBEAFE`
- Hover: mostra botão overlay `"Ver Perfil"`

**Nome + Avaliação**

- Nome: `Inter SemiBold, 15px, #111827`
- Estrela: `⭐ #F59E0B`
- Nota: `Inter Bold, 14px, #111827`
- Total de avaliações: `Inter Regular, 12px, #9CA3AF`

**Para (job alvo)**

- `"Para: [Título do Job]"`, `Inter Regular, 13px, #6B7280`
- Título clicável → vai para o job

**Métricas da proposta**

- `💰 [valor] KZS` — `Inter SemiBold, 14px, #111827`
- `📅 [N] dias de entrega` — `Inter Regular, 13px, #6B7280`

**Trecho da carta**

- Máximo 2 linhas com `overflow: ellipsis`
- `Inter Regular, 13px, #6B7280`
- `line-clamp: 2`

**Botão "Ver Proposta Completa →"**

- Link `#2563EB`, sem fundo
- Navega para `/cliente/propostas/[id]`

**Fonte dos dados:**

SQL

```
SELECT 
    p.id, p.valor_proposto, p.dias_entrega,
    p.carta_apresentacao, p.criado_em,
    pf.nome_completo, pf.url_avatar,
    pf.avaliacao_media, pf.total_avaliacoes,
    t.titulo as titulo_trabalho, t.id as trabalho_id
FROM propostas p
JOIN perfis pf ON pf.id = p.freelancer_id
JOIN trabalhos t ON t.id = p.trabalho_id
WHERE t.cliente_id = [auth_id]
AND p.status = 'pendente'
ORDER BY p.criado_em DESC
LIMIT 3;
```

---

## 4.9 BLOCO G — Histórico de Transações (Resumo)

text

```
┌──────────────────────────────────────────────────────────────────┐
│  💳 Últimas Movimentações da Carteira         [Ver Carteira →]   │
├──────────────────────────────────────────────────────────────────┤
│  ✅  Recarga via Multicaixa Express    +100.000 KZS  12 Jun 2025 │
│  🔒  Escrow — Website Corporativo     - 130.000 KZS  10 Jun 2025 │
│  💸  Reembolso — Disputa Flyer         +45.000 KZS   08 Jun 2025 │
└──────────────────────────────────────────────────────────────────┘
```

### Especificações:

**Cada linha de transação:**

text

```
[Ícone tipo]  [Descrição]  ...............  [Valor]  [Data]
```

**Ícones por tipo de transação:**

|`tipo`|Ícone|Cor do valor|
|---|---|---|
|`recarga`|✅|`#059669` (verde)|
|`debito_escrow`|🔒|`#EF4444` (vermelho)|
|`reembolso_escrow`|💸|`#059669` (verde)|

**Formato dos valores:**

- Positivo: `+ 100.000,00 KZS` em `#059669`
- Negativo: `- 130.000,00 KZS` em `#EF4444`
- Tipografia: `Inter SemiBold, 14px`

**Data:**

- Formato: `DD MMM YYYY`
- `Inter Regular, 13px, #9CA3AF`

**Fonte dos dados:**

SQL

```
SELECT 
    tc.tipo, tc.valor, tc.descricao, tc.criado_em
FROM transacoes_carteiras tc
JOIN carteiras c ON c.id = tc.carteira_id
WHERE c.usuario_id = [auth_id]
ORDER BY tc.criado_em DESC
LIMIT 3;
```

---

# 🧠 5. Hierarquia Visual

text

```
NÍVEL 1 — Atenção imediata (O que o olho vê primeiro):
  → Saudação personalizada + Botão CTA azul "Publicar Novo Job"
  → Alertas urgentes (vermelho/amarelo) — se existirem

NÍVEL 2 — Scanning rápido (Leitura em F):
  → KPI Cards (4 números grandes em linha)
  → Card da Carteira (valor monetário em destaque)

NÍVEL 3 — Leitura de detalhe (Conteúdo de trabalho):
  → Lista de Jobs Ativos (estado actual dos projectos)
  → Últimas Propostas Recebidas

NÍVEL 4 — Referência (Consulta pontual):
  → Histórico de transações (rodapé do scroll)
```

**Fluxo de leitura do utilizador:**

text

```
Saudação → CTA → KPI Cards → Alertas → Carteira → Jobs → Propostas → Transações
     ↑                                                                        ↑
  Entrada                                                               Fim do scroll
```

**Elementos âncora de destaque:**

- Botão `"+ Publicar Novo Job"` — único elemento em `#2563EB` sólido no topo
- Badges de alerta vermelho/amarelo — capturam atenção por contraste de cor
- Números grandes dos KPI cards — comunicam estado em menos de 1 segundo

---

# ⚙️ 6. Interações e Comportamentos

### Interações Globais:

|Elemento|Acção|Resultado|
|---|---|---|
|Logo Skilla|Click|Reload da dashboard|
|Sino 🔔|Click|Abre dropdown de notificações|
|Notificação individual|Click|Redireciona via `url_redirecionamento` + marca como lida|
|Avatar ▾|Click|Abre menu de conta|
|Item da Sidebar|Click|Navega para a secção|
|Badge da sidebar|—|Atualiza via WebSocket em tempo real|

### Interações dos Blocos:

|Elemento|Acção|Resultado|
|---|---|---|
|Botão "Publicar Novo Job"|Click|`/cliente/jobs/criar` (Wizard Passo 1)|
|KPI Card|Click|Navega para lista filtrada correspondente|
|Botão "Recarregar Saldo"|Click|Abre Modal de Recarga Simulada|
|Ícone ℹ️ do Escrow|Hover|Mostra tooltip explicativo|
|Botão "Ver Propostas"|Click|`/cliente/jobs/[id]/propostas`|
|Botão "Ir para Chat"|Click|`/cliente/contratos/[id]/chat`|
|Botão "Aprovar ✅"|Click|Abre Modal de confirmação de aprovação|
|Botão "Abrir Disputa ⚖️"|Click|Abre Modal de abertura de disputa|
|Botão "Ver Proposta Completa"|Click|`/cliente/propostas/[id]`|
|Avatar do freelancer|Hover|Overlay com botão "Ver Perfil"|
|Link "Ver Todos"|Click|Navega para lista completa|
|Link "Ver Carteira"|Click|`/cliente/carteira`|

### Estados dos botões:

text

```
"Aprovar ✅"  →  Normal: verde  |  Hover: verde escuro  |  Loading: spinner branco
"Abrir Disputa"  →  Normal: outlined vermelho  |  Hover: fundo vermelho suave
```

### Comportamentos em tempo real (WebSocket):

text

```
Canal: cliente.[auth_id]

Eventos escutados:
  → nova_proposta_recebida     : Atualiza badge sidebar + KPI card + Bloco F
  → trabalho_submetido         : Adiciona alerta urgente no Bloco D
  → disputa_resolvida          : Atualiza status do job no Bloco E
  → nova_mensagem              : Atualiza badge "Mensagens" na sidebar
```

---

# 🧪 7. Observações de UX/UI

### ✅ Decisões de Design Acertadas:

**1. Saudação contextual dinâmica**  
A mensagem abaixo do nome muda conforme o estado real do cliente. Isto elimina a sensação de "dashboard vazia" e guia o utilizador para a próxima acção sem ele ter de pensar.

**2. Escrow explicado no ponto de confusão**  
Mostrar o valor retido em Escrow directamente na carteira, com tooltip explicativo, evita que o cliente abra um ticket de suporte a perguntar "onde está o meu dinheiro".

**3. Alertas de urgência integrados no dashboard**  
Em vez de apenas enviar email/notificação, os alertas aparecem visualmente na dashboard. Isto respeita o comportamento real do utilizador angolano que pode não verificar o email com frequência.

**4. Acções directas nos cards**  
Os botões de acção aparecem no próprio card do job (Aprovar, Chat, Ver Propostas) sem forçar o utilizador a navegar para outra página para executar a acção mais comum.

### ⚠️ Pontos de Atenção:

**1. Estado vazio no primeiro acesso**  
No primeiro login após o registo, 5 dos 7 blocos estarão vazios. É crítico que cada bloco tenha um estado vazio desenhado com uma call-to-action clara, caso contrário a dashboard parecerá quebrada.

text

```
Solução: Implementar um "Checklist de Onboarding" no topo
  □ Recarrega a tua carteira
  □ Publica o teu primeiro job
  □ Aguarda propostas
Mostra progresso e guia o utilizador novos.
```

**2. Mobile responsiveness da sidebar**  
Em ecrãs `< 768px` a sidebar deve colapsar para um bottom navigation bar com 5 itens principais, ou um hamburger menu lateral. O layout split não funciona em mobile sem esta adaptação.

**3. Ordenação das propostas**  
Mostrar apenas as 3 propostas mais recentes pode esconder as melhores. Considerar ordenar por `avaliacao_media DESC` em vez de `criado_em DESC` para mostrar os freelancers mais qualificados primeiro.

**4. Countdown visual nos jobs a expirar**  
Para jobs que expiram em menos de 24 horas, substituir o texto estático por um contador animado (`23h 14m`) para criar urgência e levar o cliente a agir.

**5. Acessibilidade**  
Garantir que os badges de status de cor não dependem apenas da cor para comunicar o estado. O texto dentro do badge (`Aberto`, `Em Andamento`) já resolve isto, mas confirmar contraste mínimo `4.5:1` em todos os pares de cores.