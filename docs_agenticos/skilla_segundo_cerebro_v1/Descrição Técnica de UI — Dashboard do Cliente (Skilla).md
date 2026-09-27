
## Visão Geral

A Dashboard do Cliente é o **centro de comando** da sua experiência na plataforma. É a primeira tela que ele vê após o login e deve responder imediatamente a três perguntas:

> _"O que está a acontecer com os meus projetos?"_  
> _"Tenho dinheiro suficiente para contratar?"_  
> _"Alguém respondeu ao meu trabalho?"_

---

## Estrutura de Layout

text

```
┌─────────────────────────────────────────────────────────────┐
│                        TOPBAR                               │
├──────────────┬──────────────────────────────────────────────┤
│              │                                              │
│   SIDEBAR    │           ÁREA DE CONTEÚDO PRINCIPAL         │
│   (Navegação)│                                              │
│              │                                              │
└──────────────┴──────────────────────────────────────────────┘
```

---

## Zona 1 — TOPBAR (Barra Superior)

### O que contém:

text

```
[Logo Skilla]  ←————————————————→  [🔔 Notificações] [Avatar + Nome ▼]
```

### Componente: Sino de Notificações `🔔`

**O que mostra:**

- Badge vermelho com contador de notificações não lidas

**De onde vêm os dados:**

SQL

```
SELECT COUNT(*) 
FROM notificacoes 
WHERE usuario_id = [meu_id] 
AND lida = false
```

- **Tabela:** `notificacoes`
- **Campos lidos:** `titulo`, `mensagem`, `lida`, `criado_em`, `url_redirecionamento`

**Exemplos de notificações que o cliente recebe:**

|Evento|Mensagem gerada|
|---|---|
|Freelancer envia proposta|_"João Silva enviou uma proposta para o teu job"_|
|Freelancer entrega trabalho|_"O teu projeto foi submetido para revisão"_|
|Disputa resolvida pelo Admin|_"A disputa foi resolvida a teu favor"_|

---

### Componente: Avatar + Menu de Conta `▼`

**O que mostra:**

- Foto de perfil circular
- Nome completo
- Dropdown com: `Ver Perfil` / `Definições` / `Terminar Sessão`

**De onde vêm os dados:**

SQL

```
SELECT nome_completo, url_avatar 
FROM perfis 
WHERE id = [meu_id]
```

---

## Zona 2 — SIDEBAR (Navegação Lateral)

### Estrutura dos itens:

text

```
📊  Dashboard          ← Ativo (página atual)
💼  Os Meus Jobs
📩  Propostas Recebidas
💬  Mensagens
💰  A Minha Carteira
⭐  Avaliações
👤  O Meu Perfil
```

### Lógica de badges por item:

|Item da Sidebar|Badge|Fonte no BD|
|---|---|---|
|Propostas Recebidas|Nº de propostas `pendente` não vistas|`propostas` WHERE `visto = false`|
|Mensagens|Nº de mensagens não lidas|`mensagens` WHERE `lida = false`|
|Dashboard|—|—|

---

## Zona 3 — ÁREA DE CONTEÚDO PRINCIPAL

### Bloco A — Saudação + Ação Primária

text

```
┌──────────────────────────────────────────────────────────────┐
│  Olá, [Nome do Cliente] 👋                                   │
│  Tens [N] proposta(s) nova(s) à espera de revisão.          │
│                                                              │
│                        [+ Publicar Novo Job]  ← CTA Azul    │
└──────────────────────────────────────────────────────────────┘
```

**Lógica da mensagem dinâmica:**

text

```
SE propostas pendentes > 0
  → "Tens [N] proposta(s) nova(s) à espera de revisão."

SE jobs ativos > 0 E propostas = 0
  → "Os teus jobs estão ativos. Aguarda propostas dos freelancers."

SE nenhum job publicado
  → "Bem-vindo! Publica o teu primeiro trabalho para começar."
```

**De onde vêm os dados:**

SQL

```
-- Contar propostas pendentes não vistas
SELECT COUNT(*) 
FROM propostas p
JOIN trabalhos t ON p.trabalho_id = t.id
WHERE t.cliente_id = [meu_id]
AND p.status = 'pendente'
AND p.visto = false
```

---

### Bloco B — KPI Cards (Resumo Rápido)

Quatro cards horizontais com métricas chave:

text

```
┌──────────────┐ ┌──────────────┐ ┌──────────────┐ ┌──────────────┐
│  💼 Jobs     │ │ 📩 Propostas │ │ 🔄 Em        │ │ ✅ Projetos  │
│  Publicados  │ │  Recebidas   │ │  Andamento   │ │  Concluídos  │
│              │ │              │ │              │ │              │
│     [N]      │ │     [N]      │ │     [N]      │ │     [N]      │
└──────────────┘ └──────────────┘ └──────────────┘ └──────────────┘
```

**De onde vêm os dados:**

SQL

```
-- Card 1: Jobs Publicados (status aberto)
SELECT COUNT(*) FROM trabalhos 
WHERE cliente_id = [meu_id] AND status = 'aberto';

-- Card 2: Total de Propostas Recebidas
SELECT COUNT(*) FROM propostas p
JOIN trabalhos t ON p.trabalho_id = t.id
WHERE t.cliente_id = [meu_id] AND p.status = 'pendente';

-- Card 3: Contratos em Andamento
SELECT COUNT(*) FROM contratos 
WHERE cliente_id = [meu_id] AND status_contrato = 'ativo';

-- Card 4: Projetos Concluídos
SELECT COUNT(*) FROM contratos 
WHERE cliente_id = [meu_id] AND status_contrato = 'concluido';
```

---

### Bloco C — Card da Carteira (Wallet)

text

```
┌─────────────────────────────────────────────────────────────┐
│  💰 A Minha Carteira Skilla                                 │
│                                                             │
│   Saldo Disponível                                          │
│   ┌─────────────────────────┐                               │
│   │   50.000,00 Kz          │   [+ Recarregar Saldo]        │
│   └─────────────────────────┘                               │
│                                                             │
│   💎 Em Escrow (Retido): 25.000,00 Kz                       │
│   ℹ️  Este valor está reservado para projetos em curso.     │
└─────────────────────────────────────────────────────────────┘
```

**Por que mostrar o Escrow aqui?**

> O cliente precisa de entender porque o seu saldo disponível pode parecer baixo. Mostrar o valor retido em Escrow evita confusão e builds trust na plataforma.

**De onde vêm os dados:**

SQL

```
-- Saldo disponível
SELECT saldo_disponivel FROM carteiras 
WHERE usuario_id = [meu_id];

-- Valor total em Escrow (projetos ativos)
SELECT SUM(te.valor) 
FROM transacoes_escrow te
JOIN contratos c ON te.contrato_id = c.id
WHERE c.cliente_id = [meu_id] 
AND te.status_pagamento = 'retido';
```

**Campos lidos:**

- Tabela `carteiras`: `saldo_disponivel`
- Tabela `transacoes_escrow`: `valor`, `status_pagamento`
- Tabela `contratos`: `cliente_id`

---

### Bloco D — Os Meus Jobs Ativos

text

```
┌─────────────────────────────────────────────────────────────┐
│  💼 Os Meus Jobs Ativos                          [Ver Todos] │
├─────────────────────────────────────────────────────────────┤
│                                                             │
│  ┌───────────────────────────────────────────────────────┐  │
│  │ 🟢 Aberto                                             │  │
│  │ Desenvolvimento de Website Corporativo                │  │
│  │ Orçamento: 150.000 Kz  •  Publicado há 2 dias        │  │
│  │ 📩 4 propostas recebidas          [Ver Propostas →]  │  │
│  └───────────────────────────────────────────────────────┘  │
│                                                             │
│  ┌───────────────────────────────────────────────────────┐  │
│  │ 🔄 Em Andamento                                       │  │
│  │ Criação de Logótipo para Startup                      │  │
│  │ Freelancer: Ana Rodrigues  •  Entrega em 3 dias       │  │
│  │ 💰 Escrow: 45.000 Kz              [Ir para Chat →]   │  │
│  └───────────────────────────────────────────────────────┘  │
│                                                             │
│  ┌───────────────────────────────────────────────────────┐  │
│  │ ⚠️  Aguarda Revisão                                   │  │
│  │ Design de Flyer Promocional                           │  │
│  │ Freelancer submeteu o trabalho final                  │  │
│  │                    [Aprovar] [Abrir Disputa]          │  │
│  └───────────────────────────────────────────────────────┘  │
└─────────────────────────────────────────────────────────────┘
```

**Lógica dos status dos cards:**

|Status|Cor|Ação disponível|
|---|---|---|
|`aberto`|🟢 Verde|Ver Propostas|
|`em_andamento`|🔵 Azul|Ir para Chat|
|`aguarda_revisao`|🟡 Amarelo|Aprovar / Abrir Disputa|
|`em_disputa`|🔴 Vermelho|Ver Disputa|
|`concluido`|⚫ Cinza|Ver Detalhes|

**De onde vêm os dados:**

SQL

```
SELECT 
    t.id,
    t.titulo,
    t.orcamento_fixo,
    t.status,
    t.criado_em,
    t.expira_em,
    COUNT(p.id) as total_propostas,
    c.id as contrato_id,
    c.status_contrato,
    c.data_limite,
    pf.nome_completo as nome_freelancer
FROM trabalhos t
LEFT JOIN propostas p ON p.trabalho_id = t.id AND p.status = 'pendente'
LEFT JOIN contratos c ON c.trabalho_id = t.id
LEFT JOIN perfis pf ON pf.id = c.freelancer_id
WHERE t.cliente_id = [meu_id]
AND t.status IN ('aberto', 'em_andamento', 'aguarda_revisao', 'em_disputa')
GROUP BY t.id
ORDER BY t.criado_em DESC
LIMIT 5;
```

**Tabelas lidas:**

- `trabalhos`: `titulo`, `orcamento_fixo`, `status`, `criado_em`, `expira_em`
- `propostas`: contagem de propostas por job
- `contratos`: `status_contrato`, `data_limite`
- `perfis`: nome do freelancer contratado

---

### Bloco E — Últimas Propostas Recebidas

text

```
┌─────────────────────────────────────────────────────────────┐
│  📩 Últimas Propostas Recebidas              [Ver Todas →]  │
├─────────────────────────────────────────────────────────────┤
│  ┌─────────────────────────────────────────────────────┐    │
│  │ [Avatar] Miguel Fernandes          ⭐ 4.8           │    │
│  │          Para: "Website Corporativo"                │    │
│  │          Valor: 130.000 Kz  •  Prazo: 14 dias       │    │
│  │          "Tenho 5 anos de experiência em..."        │    │
│  │                              [Ver Proposta Completa]│    │
│  └─────────────────────────────────────────────────────┘    │
│                                                             │
│  ┌─────────────────────────────────────────────────────┐    │
│  │ [Avatar] Carla Mendes              ⭐ 4.5           │    │
│  │          Para: "Website Corporativo"                │    │
│  │          Valor: 120.000 Kz  •  Prazo: 10 dias       │    │
│  │          "Posso entregar antes do prazo porque..."  │    │
│  └─────────────────────────────────────────────────────┘    │
└─────────────────────────────────────────────────────────────┘
```

**De onde vêm os dados:**

SQL

```
SELECT 
    p.id,
    p.valor_proposto,
    p.dias_entrega,
    p.carta_apresentacao,
    p.criado_em,
    pf.nome_completo,
    pf.url_avatar,
    pf.avaliacao_media,
    t.titulo as titulo_trabalho
FROM propostas p
JOIN perfis pf ON pf.id = p.freelancer_id
JOIN trabalhos t ON t.id = p.trabalho_id
WHERE t.cliente_id = [meu_id]
AND p.status = 'pendente'
ORDER BY p.criado_em DESC
LIMIT 3;
```

**Tabelas lidas:**

- `propostas`: `valor_proposto`, `dias_entrega`, `carta_apresentacao`
- `perfis`: `nome_completo`, `url_avatar`, `avaliacao_media`
- `trabalhos`: `titulo`

---

### Bloco F — Alertas e Ações Urgentes

> Este bloco só aparece se existirem situações que requerem ação imediata do cliente.

text

```
┌─────────────────────────────────────────────────────────────┐
│  ⚠️  Requer a tua Atenção                                   │
├─────────────────────────────────────────────────────────────┤
│  🔴 "Design de Flyer" — O freelancer submeteu o trabalho.   │
│      Tens até [data] para aprovar ou abrir disputa.         │
│                              [Ir para Revisão →]            │
├─────────────────────────────────────────────────────────────┤
│  🟡 "Website Corporativo" — Expira em 2 dias sem contrato.  │
│      Aceita uma proposta ou o job será cancelado.           │
│                              [Ver Propostas →]              │
└─────────────────────────────────────────────────────────────┘
```

**Lógica de geração dos alertas:**

text

```
ALERTA TIPO 1 (Vermelho - Urgente):
  SELECT contratos WHERE cliente_id = [meu_id] 
  AND status_contrato = 'aguarda_revisao'

ALERTA TIPO 2 (Amarelo - Atenção):
  SELECT trabalhos WHERE cliente_id = [meu_id] 
  AND status = 'aberto'
  AND expira_em <= NOW() + INTERVAL 2 DAY
```

---

### Bloco G — Histórico de Transações (Resumo)

text

```
┌─────────────────────────────────────────────────────────────┐
│  💳 Últimas Movimentações                  [Ver Carteira →] │
├─────────────────────────────────────────────────────────────┤
│  ✅ Recarga via Multicaixa     + 100.000 Kz    12 Jun 2025  │
│  🔒 Escrow — Website Corp.     - 130.000 Kz    10 Jun 2025  │
│  💸 Reembolso Disputa Flyer   + 45.000 Kz      8 Jun 2025  │
└─────────────────────────────────────────────────────────────┘
```

**De onde vêm os dados:**

SQL

```
SELECT 
    tc.tipo,
    tc.valor,
    tc.descricao,
    tc.criado_em
FROM transacoes_carteiras tc
JOIN carteiras c ON c.id = tc.carteira_id
WHERE c.usuario_id = [meu_id]
ORDER BY tc.criado_em DESC
LIMIT 3;
```

**Tabelas lidas:**

- `transacoes_carteiras`: `tipo`, `valor`, `descricao`, `criado_em`
- `carteiras`: ligação ao `usuario_id`

---

## Mapa Completo de Dados da Dashboard

text

```
DASHBOARD DO CLIENTE
│
├── TOPBAR
│   ├── notificacoes (lida, titulo, mensagem)
│   └── perfis (nome_completo, url_avatar)
│
├── BLOCO A — Saudação
│   └── propostas + trabalhos (contagem pendentes)
│
├── BLOCO B — KPI Cards
│   ├── trabalhos (COUNT por status)
│   ├── propostas (COUNT pendentes)
│   └── contratos (COUNT por status_contrato)
│
├── BLOCO C — Carteira
│   ├── carteiras (saldo_disponivel)
│   └── transacoes_escrow (SUM retido)
│
├── BLOCO D — Jobs Ativos
│   ├── trabalhos (titulo, status, orcamento_fixo)
│   ├── propostas (COUNT por trabalho)
│   ├── contratos (status_contrato, data_limite)
│   └── perfis (nome freelancer contratado)
│
├── BLOCO E — Propostas Recebidas
│   ├── propostas (valor, prazo, carta)
│   ├── perfis (nome, avatar, avaliacao_media)
│   └── trabalhos (titulo do job)
│
├── BLOCO F — Alertas Urgentes
│   ├── contratos (aguarda_revisao)
│   └── trabalhos (expira_em próximo)
│
└── BLOCO G — Transações Recentes
    ├── transacoes_carteiras (tipo, valor, data)
    └── carteiras (ligação ao usuario)
```

---

## Notas de Implementação

**Performance:**

> Todos os dados da dashboard devem ser carregados numa única chamada ao backend através de um `DashboardController@index` que executa as queries em paralelo e retorna um único objeto JSON. Evita múltiplos requests separados.

**Estados Vazios:**

> Cada bloco deve ter um estado vazio desenhado. Se o cliente não tem jobs, o Bloco D mostra _"Ainda não publicaste nenhum trabalho. Começa agora!"_ com o botão CTA.

**Atualização em Tempo Real:**

> O bloco de notificações e o bloco de alertas devem usar o canal WebSocket (Laravel Reverb) para atualizar sem refresh quando chegarem novas propostas ou o freelancer submeter o trabalho.