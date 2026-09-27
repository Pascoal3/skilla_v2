Temos o botão de exportar (PDF), botão de filtrar transações, últimos 30 dias, tipo: Recarga, Saque

Depois um h3 que mostra a data da atividade, por dia (hoje, ontem, anteontem, as mais antigas, (antes de "anteontem")  ficam com a data mesmo, dd/mm/aaaa).

Ao exportar, as informações que devem aparecer são...



### Submódulo: Extrato de Transações (Visão do Cliente)

O **Extrato** é o histórico completo e auditável de todas as movimentações financeiras da carteira do utilizador. Permite visualizar, filtrar e exportar o fluxo de caixa em Kwanzas (Kz), oferecendo transparência total sobre entradas, saídas e estados de cada operação.

---

## 1. Cabeçalho e Navegação

### Breadcrumb (Navegação Contextual)

- **Carteira > Minha carteira > Extrato**
- Permite ao utilizador navegar de volta para a carteira principal a qualquer momento.

### Título e Descrição

- **Título:** "Extrato"
- **Subtítulo:** "Gerencie seu fluxo de caixa em Kwanzas (Kz)"

### Botão Voltar

- Localizado no canto superior direito, permite retornar à tela anterior (Minha Carteira).

### Botão Exportar

- **Função:** Gera um documento PDF com o histórico de transações filtrado.
- **Regra de Negócio:** O PDF deve respeitar os filtros ativos no momento da exportação (período e tipo de transação).

---

## 2. Sistema de Filtros

### Botão "Filtrar transações"

- Abre um painel/modal com opções avançadas de filtragem.
- **Badge numérico:** Indica quantos filtros estão ativos no momento (ex: "2" quando há período e tipo selecionados).

### Chips de Filtros Ativos

Os filtros aplicados são exibidos como "chips" removíveis:

- **Período:** "Últimos 30 dias" (com botão X para remover)
- **Tipo:** "Tipo: Recarga, Saque" (com botão X para remover)

### Opções de Filtro Disponíveis

#### A. Filtro por Período

- **Últimos 7 dias**
- **Últimos 30 dias** (padrão)
- **Últimos 90 dias**
- **Este mês**
- **Mês anterior**
- **Personalizado:** Seleção de data inicial e final

#### B. Filtro por Tipo de Transação

- **Recarga** (entradas de saldo via depósito)
- **Saque** (saídas para conta bancária pessoal)
- **Pagamento de Projeto** (escrow retido ou liberado)
- **Assinatura** (planos Skilla Pro, taxas de plataforma)
- **Reembolso** (devoluções de disputas)
- **Todas** (sem filtro de tipo)

#### C. Filtro por Estado (opcional)

- **Concluído**
- **Pendente**
- **Cancelado**
- **Em análise**

---

## 3. Agrupamento Temporal das Transações

As transações são agrupadas cronologicamente por **data de ocorrência**, com cabeçalhos de seção que facilitam a leitura:

### Regras de Exibição de Data

|Período|Formato de Exibição|Exemplo|
|---|---|---|
|Dia atual|**HOJE**|"HOJE"|
|Dia anterior|**ONTEM**|"ONTEM"|
|Dois dias atrás|**ANTEONTEM**|"ANTEONTEM"|
|Mais antigo|**Data completa**|"15/03/2024"|

### Comportamento

- Cada grupo de data é separado por um **h3** com o rótulo correspondente.
- As transações dentro de cada grupo são ordenadas por **hora** (mais recente primeiro).
- Se não houver transações no período filtrado, exibir mensagem: "Nenhuma transação encontrada para este período."

---

## 4. Estrutura de Cada Transação (Card)

Cada transação é representada por um card horizontal com as seguintes informações:

### Elementos Visuais

#### A. Ícone de Tipo (Esquerda)

- **Recarga:** Seta para cima (↑) em fundo verde/positivo
- **Saque:** Seta para baixo (↓) em fundo vermelho/negativo
- **Pagamento de Projeto:** Relógio (⏱) em fundo amarelo/neutro (pendente) ou verde (concluído)
- **Assinatura:** Ícone de estrela/coroa

#### B. Informações Principais (Centro-Esquerda)

- **Título da Transação:** Nome descritivo (ex: "Recarga de Saldo", "Saque Bancário", "Pagamento de Projeto")
- **Subtítulo/Detalhe:** Informação contextual (ex: "Depósito via Multicaixa Express", "Transferência para BFA", "UI Design Kit Pro")
- **Horário:** Hora exata da transação (ex: "14:20", "09:45")

#### C. Valor e Estado (Direita)

- **Valor:**
    - **Positivo (+):** Entradas de dinheiro (ex: "+ 50.000,00 Kz") em cor verde/positiva
    - **Negativo (-):** Saídas de dinheiro (ex: "- 125.000,00 Kz") em cor preta/negativa
- **Badge de Estado:**
    - **Concluído:** Badge verde com texto "CONCLUÍDO"
    - **Pendente:** Badge cinza/amarelo com texto "PENDENTE"
    - **Cancelado:** Badge vermelho com texto "CANCELADO"
    - **Em análise:** Badge laranja com texto "EM ANÁLISE"

---

## 5. Exportação para PDF

### Informações que Devem Aparecer no PDF

#### A. Cabeçalho do Documento

- **Logo Skilla**
- **Título:** "Extrato de Transações"
- **Período do Extrato:** (ex: "01/03/2024 a 31/03/2024")
- **Data de Geração:** Data e hora em que o PDF foi gerado
- **Dados do Utilizador:** Nome completo, ID do utilizador, email

#### B. Resumo Financeiro

- **Saldo Inicial:** Saldo no início do período filtrado
- **Total de Entradas:** Soma de todas as transações positivas no período
- **Total de Saídas:** Soma de todas as transações negativas no período
- **Saldo Final:** Saldo no final do período filtrado

#### C. Lista de Transações (Tabela)

Cada transação deve conter:

|Coluna|Informação|
|---|---|
|**Data/Hora**|Data completa (dd/mm/aaaa) e hora (HH:MM)|
|**Descrição**|Título da transação|
|**Detalhes**|Informação contextual (método de pagamento, projeto associado, etc.)|
|**Referência**|Código único da transação (ex: TXN-2024-001234)|
|**Tipo**|Recarga, Saque, Pagamento, Assinatura, etc.|
|**Estado**|Concluído, Pendente, Cancelado, Em análise|
|**Valor (Kz)**|Valor da transação com sinal (+/-)|

#### D. Rodapé do Documento

- **Total de Transações:** Número de registros no extrato
- **Assinatura Digital:** Hash ou código de validação do documento
- **Nota Legal:** "Este documento é um extrato informativo gerado pela plataforma Skilla. Para fins legais, consulte o histórico oficial na sua carteira."

### Formatação do PDF

- **Orientação:** Retrato (A4)
- **Fonte:** Sans-serif legível (ex: Inter, Roboto)
- **Cores:** Manter identidade visual Skilla (verde neon para destaques, preto para texto principal)
- **Paginação:** Numerar páginas (ex: "Página 1 de 3")
- **Quebra de Página:** Evitar quebrar transações no meio da página

---

## 6. Tipos de Transações (Catálogo Completo)

### Entradas (Positivas)

1. **Recarga de Saldo:** Depósito manual via IBAN Skilla ou gateway de pagamento
2. **Liberação de Escrow:** Aprovação de trabalho pelo cliente (freelancer recebe)
3. **Reembolso:** Devolução de valor por disputa favorável ou cancelamento
4. **Bónus/Promoção:** Créditos oferecidos pela plataforma

### Saídas (Negativas)

1. **Saque Bancário:** Transferência para conta bancária pessoal
2. **Pagamento de Projeto:** Retenção de escrow ao aceitar proposta (cliente paga)
3. **Assinatura Mensal:** Plano Skilla Pro ou taxas recorrentes
4. **Taxas de Plataforma:** Comissão sobre transações (se aplicável)
5. **Disputa Perdida:** Valor retido em caso de disputa desfavorável

---

## 7. Regras de Negócio Adicionais

### A. Atualização em Tempo Real

- O extrato deve refletir transações em tempo real ou com delay máximo de 5 minutos.
- Transações pendentes devem aparecer imediatamente com estado "PENDENTE".

### B. Imutabilidade do Histórico

- Transações concluídas não podem ser editadas ou removidas do extrato.
- Em caso de estorno ou correção, gerar uma nova transação de ajuste (não alterar a original).

### C. Retenção de Dados

- O extrato deve manter histórico mínimo de **5 anos** para fins fiscais e legais.
- Transações anteriores a 5 anos podem ser arquivadas, mas acessíveis via solicitação ao suporte.

### D. Segurança

- O extrato só é acessível ao proprietário da carteira (autenticação obrigatória).
- O PDF exportado deve conter marca d'água ou código de validação para prevenir falsificações.