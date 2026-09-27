### 🧠 O que a Dashboard do Freelancer precisa comunicar imediatamente?

Ao entrar, o freelancer tem **3 perguntas mentais instantâneas:**

> _"Tenho dinheiro?"_ → **Saldo de Créditos**  
> _"Tenho trabalho?"_ → **Contratos Ativos**  
> _"Há oportunidades?"_ → **Jobs Recomendados**

A Dashboard deve responder a estas 3 perguntas **em menos de 3 segundos de leitura**, sem o utilizador clicar em nada. Isto chama-se **Zero-Click Information Architecture**.

### 📊 Mapeamento de Dados → Componentes Visuais

|Componente Visual|Tabela de Origem|Campo(s)|
|---|---|---|
|Saldo de Créditos|`carteiras`|`saldo_creditos`|
|Jobs em Andamento|`contratos`|`status_contrato = 'ativo'`|
|Propostas Enviadas|`propostas`|`status = 'pendente'`|
|Avaliação Média|`perfis`|`avaliacao_media`|
|Jobs Recomendados|`trabalhos` + `trabalho_habilidades` + `perfil_habilidades`|Match por `habilidade_id`|
|Notificações|`mensagens`|`lida = false`|
|Histórico Financeiro|`transacoes_carteiras`|`tipo`, `valor`, `criado_em`|

---

## 2. Prompt Final para Google Stitch

text

```

PROMPT DE GERAÇÃO DE UI: DASHBOARD DO FREELANCER — PLATAFORMA SKILLA

━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
[IDENTIDADE VISUAL E DESIGN SYSTEM]
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━

Crie uma interface de alta fidelidade para 
a Dashboard do Freelancer da plataforma 
SKILLA. O design deve seguir rigorosamente 
este Design System:

CORES:
- Fundo geral: Branco Puro (#FFFFFF)
- Superfície dos Cards: Branco (#FFFFFF) 
  com borda sutil (#F0F0F0, 1px)
- Cor de Acento Principal: Verde (#14a800)
  usado apenas em CTAs, badges de status 
  positivo e indicadores ativos
- Cor de Alerta/Pendente: Âmbar (#F59E0B)
  para propostas aguardando resposta
- Texto Principal: Preto (#111111)
- Texto Secundário: Cinza médio (#6B7280)
- Separadores: Cinza ultra-claro (#F3F4F6)

TIPOGRAFIA:
- Família: Sans-serif geométrica 
  (estilo Inter ou DM Sans)
- H1 Dashboard: 22px, peso 700
- Títulos de Cards: 14px, peso 600, 
  cor #6B7280 (uppercase com letter-spacing)
- Valores numéricos grandes (KPIs): 
  28px, peso 700, cor #111111
- Corpo de texto: 14px, peso 400
- Labels e metadados: 12px, peso 500

COMPONENTES BASE:
- Cards: border-radius 12px, 
  box-shadow: 0 1px 3px rgba(0,0,0,0.08)
- Botões primários: fundo verde (#14a800), 
  texto branco, border-radius 8px, 
  padding 10px 20px
- Botões secundários: fundo transparente, 
  borda 1px #E5E7EB, texto #374151
- Avatares: circular, border 2px #FFFFFF 
  com sombra leve
- Tags/Badges de habilidades: fundo 
  #F3F4F6, texto #374151, border-radius 
  20px, padding 4px 12px, fonte 12px
- Badge "Impulsionado": fundo #EDE9FE, 
  texto #7C3AED, border-radius 20px

━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
[LAYOUT E ARQUITETURA GERAL]
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━

Layout de página única (SPA) com 3 zonas:

ZONA 1 — NAVBAR SUPERIOR FIXA:
- Altura: 64px, fundo branco, 
  border-bottom 1px #F0F0F0
- Esquerda: Logo "SKILLA" em negrito, 
  fonte grande, cor preta
- Centro: Links de navegação principais 
  em texto — "Contratar talento", 
  "Gerir trabalho", "Relatórios", 
  "Mensagens" (com badge de contador 
  de mensagens não lidas em verde)
- Direita: Barra de pesquisa com ícone 
  de lupa + placeholder "Pesquisar...", 
  ícone de sino (notificações) com badge 
  numérico vermelho, ícone de chat e 
  avatar circular do utilizador

ZONA 2 — SIDEBAR LATERAL ESQUERDA:
- Largura: 240px, fundo branco, 
  border-right 1px #F0F0F0
- Topo: Avatar grande do freelancer 
  (64px) + Nome Completo (peso 600) + 
  avaliação com ícone de estrela amarela 
  + número (ex: ★ 4.9)
- Badge de nível abaixo do nome: 
  "Freelancer Pro" ou "Básico" em 
  verde claro
- Separador fino
- Menu de Navegação (lista vertical 
  com ícone + label):
  → "Início" (estado ATIVO: texto verde, 
    barra vertical verde 3px na esquerda, 
    fundo #F0FDF4)
  → "Os meus Jobs"
  → "Propostas"
  → "Mensagens"
  → "A minha Carteira"
  → "O meu Perfil"
  → "Definições"
- Rodapé da Sidebar: 
  Bloco de Créditos — fundo #F0FDF4, 
  border-radius 10px, padding 16px. 
  Ícone de moeda verde + texto 
  "Os seus Créditos" + número grande 
  em verde (ex: 20 créditos) + botão 
  pequeno "Comprar mais"

ZONA 3 — ÁREA DE CONTEÚDO PRINCIPAL:
- Padding: 32px
- Largura máxima do conteúdo: 960px
- Organizada em linhas (rows) com 
  grid de 12 colunas

━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
[ÁREA DE CONTEÚDO — ESTRUTURA DETALHADA]
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━

ROW 1 — CABEÇALHO DA PÁGINA:
- Texto à esquerda: 
  "Bom dia, [Nome] 👋" (H1, 22px, 
  peso 700)
- Subtítulo: "Aqui está o resumo 
  da sua atividade" (cinza médio)
- À direita: Botão primário verde 
  "Explorar Trabalhos"

━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━

ROW 2 — KPI CARDS (4 cards em grid 
         4 colunas, gap 16px):

CARD KPI 1 — "Trabalhos Ativos":
- Ícone: pasta/briefcase em verde claro
- Número grande: "2"
- Label: "TRABALHOS ATIVOS"
- Texto de apoio: "Em andamento"

CARD KPI 2 — "Propostas Enviadas":
- Ícone: envelope/papel em âmbar
- Número grande: "5"
- Label: "PROPOSTAS ENVIADAS"
- Badge de status: "3 Pendentes" 
  em âmbar

CARD KPI 3 — "Total Ganho":
- Ícone: gráfico de subida em verde
- Número grande: "KZS 120.000,00"
- Label: "TOTAL GANHO"
- Texto de apoio: "Este mês"

CARD KPI 4 — "Avaliação Média":
- Ícone: estrela amarela
- Número grande: "4.9"
- Label: "AVALIAÇÃO MÉDIA"
- Texto de apoio: "24 avaliações"

━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━

ROW 3 — GRID DE 2 COLUNAS (60% / 40%):

COLUNA ESQUERDA (60%) — 
"Trabalhos em Andamento":

Card de Secção:
- Cabeçalho do card: Label "TRABALHOS 
  ATIVOS" + link "Ver todos →" à direita

Item de Trabalho 1:
- Avatar do Cliente (32px) + Nome do 
  Cliente + badge "Em Andamento" verde
- Título do Job (peso 600, 15px)
- Barra de progresso horizontal 
  (fundo #F3F4F6, preenchimento verde, 
  border-radius 4px) — ex: 60%
- Linha de metadados: ícone calendário + 
  "Entrega em 5 dias" | ícone moeda + 
  "KZS 65.000,00"
- Botão: "Ver Sala de Trabalho" 
  (secundário, largura total)

Separador fino entre items

Item de Trabalho 2:
- Estrutura idêntica ao Item 1
- Badge "Aguarda Revisão" em âmbar

━━━━━━━━━

COLUNA DIREITA (40%) — 
"As minhas Propostas":

Card de Secção:
- Cabeçalho: Label "PROPOSTAS RECENTES" 
  + link "Ver todas →"

Lista de 3 propostas (sem separadores 
pesados, apenas padding vertical 12px):

Proposta 1:
- Título do Job (peso 600, truncado 
  se longo)
- Valor proposto: "KZS 45.000,00" 
  alinhado à direita
- Badge de status: "Pendente" (âmbar)
- Data de envio: "há 2 horas" (12px, 
  cinza)

Proposta 2:
- Estrutura idêntica
- Badge: "Aceite" (verde)

Proposta 3:
- Estrutura idêntica
- Badge: "Recusada" (vermelho claro 
  #FEE2E2, texto #DC2626)

━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━

ROW 4 — SECÇÃO COMPLETA:
"Jobs Recomendados para Si"

Cabeçalho da secção:
- Label "RECOMENDADOS COM BASE NAS 
  SUAS HABILIDADES" (uppercase, cinza)
- Subtítulo: "Trabalhos que combinam 
  com o seu perfil"

Grid de 2 cards de job 
(estrutura igual ao feed de busca):

CARD DE JOB RECOMENDADO:
- Topo do card: Avatar do Cliente (40px) 
  + Nome do Cliente + Avaliação do 
  Cliente (estrelinhas) + badge 
  "Impulsionado" se aplicável
- Espaçamento: margin-top 16px
- Título do Job (H3, peso 600)
- Descrição truncada (2 linhas, 
  cor cinza)
- Tags de habilidades (badges cinzas)
- Separador fino
- Rodapé do card — linha com:
  Ícone moeda + "KZS 65.000,00 /h" 
  (peso 700) | espaçamento mínimo 
  de 24px entre o valor e o botão | 
  Botão "Enviar Proposta" (verde, 
  padding 10px 20px)

━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
[FOOTER DA PÁGINA]
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━

Footer simples, fundo branco, 
border-top 1px #F0F0F0:
- Esquerda: "© 2024 SKILLA Digital. 
  Feito em Luanda."
- Direita: Links — "Termos", 
  "Privacidade", "Carreiras", "Contacto"

━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
[UX, COMPORTAMENTO E RESPONSIVIDADE]
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━

ESTADOS VISUAIS:
- Hover nos cards de job: sombra 
  ligeiramente mais pronunciada e 
  cursor pointer
- Hover nos links da sidebar: fundo 
  #F9FAFB, texto escurece para #111111
- Botão "Enviar Proposta": hover escurece 
  o verde para (#0d8a00)

RESPONSIVIDADE:
- Em tablet (768px): Sidebar colapsa 
  para ícones apenas (sem labels). 
  Grid de KPIs muda para 2 colunas.
- Em mobile (375px): Sidebar transforma-se 
  em bottom navigation bar. Todos os 
  grids passam a coluna única.

MICROCOPY E DADOS:
- Toda a copy em Português de Angola
- Moedas sempre em formato: 
  "KZS 65.000,00"
- Datas em formato relativo: 
  "há 2 horas", "há 3 dias"
- Interface deve parecer 100% pronta 
  para produção: sem placeholder genérico, 
  usar dados realistas de exemplo
```



## 🗂️ Mapeamento Completo por Componente

---

### 🔵 NAVBAR SUPERIOR

|Elemento Visual|Tabela|Campo(s)|Query/Lógica|
|---|---|---|---|
|Avatar do utilizador|`perfis`|`url_avatar`|`WHERE id = [jwt.user_id]`|
|Nome no avatar (tooltip)|`perfis`|`nome_completo`|`WHERE id = [jwt.user_id]`|
|Badge de notificações (sino)|`notificacoes`|`lida = false`|`COUNT(*) WHERE usuario_id = [jwt.user_id] AND lida = false`|
|Badge de mensagens|`mensagens`|`lida = false`|`COUNT(*) WHERE remetente_id != [jwt.user_id] AND lida = false` via JOIN em `conversas` onde `freelancer_id = [jwt.user_id]`|

---

### 🟢 SIDEBAR ESQUERDA

|Elemento Visual|Tabela|Campo(s)|Query/Lógica|
|---|---|---|---|
|Avatar grande|`perfis`|`url_avatar`|`WHERE id = [jwt.user_id]`|
|Nome completo|`perfis`|`nome_completo`|`WHERE id = [jwt.user_id]`|
|Estrelas + nota|`perfis`|`avaliacao_media` + `total_avaliacoes`|`WHERE id = [jwt.user_id]`|
|Badge "Destacado" (se ativo)|`perfis`|`esta_destacado = true` + `destaque_expira_em > now()`|Mostrar badge verde "Destacado" se condição verdadeira|
|Bloco de Créditos (número)|`perfis`|`saldo_creditos`|`WHERE id = [jwt.user_id]`|
|Botão "Comprar mais" créditos|`transacoes_credito`|—|Redireciona para tela de compra de créditos|

---

### 📊 ROW 2 — KPI CARDS (Os 4 Cartões de Métricas)

| Card Visual              | Tabela(s)                         | Campo(s)                                   | Query/Lógica Exacta                                                                                                                                          |
| ------------------------ | --------------------------------- | ------------------------------------------ | ------------------------------------------------------------------------------------------------------------------------------------------------------------ |
| **"Trabalhos Ativos"**   | `contratos`                       | `status_contrato`                          | `COUNT(*) WHERE freelancer_id = [jwt.user_id] AND status_contrato = 'ativo'`                                                                                 |
| **"Propostas Enviadas"** | `propostas`                       | `status`                                   | `COUNT(*) WHERE freelancer_id = [jwt.user_id] AND status = 'pendente'`                                                                                       |
| **"Total Ganho (mês)"**  | `transacoes_escrow` + `contratos` | `valor_liquido_freelancer` + `liberado_em` | `SUM(valor_liquido_freelancer) WHERE carteira_destino_id = [carteira do freelancer] AND status_pagamento = 'liberado' AND MONTH(liberado_em) = MONTH(now())` |
| **"Avaliação Média"**    | `perfis`                          | `avaliacao_media` + `total_avaliacoes`     | `WHERE id = [jwt.user_id]` — dados pré-calculados, sem query pesada                                                                                          |

---

### 📋 ROW 3 COLUNA ESQUERDA — "Trabalhos em Andamento"

|Elemento Visual|Tabela(s)|Campo(s)|Query/Lógica Exacta|
|---|---|---|---|
|Lista de contratos ativos|`contratos`|`id`, `status_contrato`, `valor_acordado`, `data_limite`, `dias_entrega`|`WHERE freelancer_id = [jwt.user_id] AND status_contrato = 'ativo' ORDER BY data_limite ASC LIMIT 3`|
|Título do Job|`trabalhos`|`titulo`|JOIN `trabalhos ON contratos.trabalho_id = trabalhos.id`|
|Avatar + Nome do Cliente|`perfis`|`url_avatar`, `nome_completo`|JOIN `perfis ON contratos.cliente_id = perfis.id`|
|Badge de status do contrato|`contratos`|`status_contrato` + `status_pagamento`|Lógica: `'ativo'` → "Em Andamento" (verde); `'em_disputa'` → "Em Disputa" (âmbar)|
|Barra de progresso|`contratos`|`criado_em` + `data_limite`|Cálculo frontend: `(dias_passados / dias_entrega) * 100`|
|"Entrega em X dias"|`contratos`|`data_limite`|`DATEDIFF(data_limite, now())`|
|Valor do contrato|`contratos`|`valor_acordado`|Exibido em formato `KZS 65.000,00`|
|Botão "Ver Sala de Trabalho"|`conversas`|`id`|JOIN `conversas ON contratos.id = conversas.contrato_id` para obter `conversa_id` e navegar|

---

### 📨 ROW 3 COLUNA DIREITA — "As minhas Propostas"

|Elemento Visual|Tabela(s)|Campo(s)|Query/Lógica Exacta|
|---|---|---|---|
|Lista de propostas recentes|`propostas`|`id`, `valor_proposto`, `status`, `criado_em`|`WHERE freelancer_id = [jwt.user_id] ORDER BY criado_em DESC LIMIT 5`|
|Título do Job associado|`trabalhos`|`titulo`|JOIN `trabalhos ON propostas.trabalho_id = trabalhos.id`|
|Valor proposto|`propostas`|`valor_proposto`|Exibido em `KZS`|
|Badge de status|`propostas`|`status`|`'pendente'` → Âmbar; `'aceita'` → Verde; `'rejeitada'` → Vermelho|
|Data relativa ("há 2 horas")|`propostas`|`criado_em`|Cálculo frontend com `criado_em`|
|Créditos gastos (tooltip)|`propostas`|`creditos_gastos`|Exibido como info secundária: "1 crédito gasto"|

---

### 🎯 ROW 4 — "Jobs Recomendados para Si"

|Elemento Visual|Tabela(s)|Campo(s)|Query/Lógica Exacta|
|---|---|---|---|
|Lista de jobs recomendados|`trabalhos` + `trabalho_habilidades` + `perfil_habilidades`|`status`, `titulo`, `tipo_trabalho`, `orcamento_fixo`, `criado_em`|`SELECT trabalhos.* FROM trabalhos INNER JOIN trabalho_habilidades ON trabalhos.id = trabalho_habilidades.trabalho_id WHERE trabalho_habilidades.habilidade_id IN (SELECT habilidade_id FROM perfil_habilidades WHERE perfil_id = [jwt.user_id]) AND trabalhos.status = 'aberto' ORDER BY trabalhos.criado_em DESC LIMIT 4`|
|Avatar + Nome do Cliente|`perfis`|`url_avatar`, `nome_completo`|JOIN `perfis ON trabalhos.cliente_id = perfis.id`|
|Avaliação do Cliente|`perfis`|`avaliacao_media`|JOIN no perfil do `cliente_id`|
|Badge "Impulsionado"|`perfis`|`esta_destacado = true`|JOIN no perfil do `cliente_id`; mostrar badge roxo se verdadeiro|
|Tags de habilidades|`habilidades` + `trabalho_habilidades`|`nome`|JOIN para exibir as habilidades do job como badges|
|Preço do job|`trabalhos`|`orcamento_fixo` ou `taxa_hora_min` + `taxa_hora_max`|Lógica: se `tipo_trabalho = 'preco_fixo'` → exibe `orcamento_fixo`; se `'por_hora'` → exibe `KZS X /h`|
|Botão "Enviar Proposta"|`propostas`|`freelancer_id` + `trabalho_id`|Verificação prévia: `SELECT COUNT(*) FROM propostas WHERE freelancer_id = [jwt.user_id] AND trabalho_id = [id]` — se já enviou, botão muda para "Proposta Enviada" (desativado)|
|Verificação de créditos (antes de abrir formulário)|`perfis`|`saldo_creditos >= 1`|Se `saldo_creditos < 1` → botão abre modal "Créditos insuficientes. Comprar mais?"|

---

### 🔔 PAINEL DE NOTIFICAÇÕES (Dropdown ao clicar no sino)

|Elemento Visual|Tabela|Campo(s)|Query/Lógica Exacta|
|---|---|---|---|
|Lista de notificações|`notificacoes`|`titulo`, `corpo`, `lida`, `criado_em`, `tipo_referencia`|`WHERE usuario_id = [jwt.user_id] ORDER BY criado_em DESC LIMIT 10`|
|Indicador de não lida (ponto verde)|`notificacoes`|`lida = false`|Renderiza ponto se `lida = false`|
|Ação ao clicar|`notificacoes`|`id_referencia` + `tipo_referencia`|Redireciona para rota correspondente (`/trabalho/[id]`, `/contrato/[id]`, etc.) e faz `UPDATE notificacoes SET lida = true`|

---

## ⚠️ Campos do DBML Não Utilizados na Dashboard (reservados para outras telas)

| Campo                          | Tabela                 | Tela Correta                 |
| ------------------------------ | ---------------------- | ---------------------------- |
| `carta_apresentacao`           | `propostas`            | Detalhe da Proposta          |
| `url_arquivo` + `nome_arquivo` | `mensagens`            | Sala de Trabalho (Chat)      |
| `decisao_admin`                | `disputas`             | Painel do Admin              |
| `comprovativo_url`             | `transacoes_carteiras` | Tela da Carteira             |
| `url_projeto`                  | `itens_portfolio`      | Perfil Público               |
| `expira_em`                    | `trabalhos`            | Job Feed / Sistema Cron      |
| `comissao_plataforma`          | `contratos`            | Relatório Financeiro (Admin) |