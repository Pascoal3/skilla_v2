Tela 1: Minha carteira, onde apresenta info do usuário: saldo disponível (kz), saldo retido em escrow (Kz) - valores reservados em pagamentos em andamento, A receber (escrow retido) - recebíveis quando o escrow for liberado.

Ações: carregar saldo (Kz), ver extrato (do saldo em Kz), pedir saque.

Dados bancários: card com o IBAN com botão de copiar.



### Módulo: Carteira (Visão do Utilizador)

A tela **"A Minha Carteira"** atua como o painel financeiro centralizado e o hub do **"Banco Skilla"**. O seu objetivo é dar transparência total sobre a liquidez do utilizador, gerir garantias de contratos (escrow) e facilitar as operações de entrada e saída de capital no ecossistema da plataforma.

---

### 1. Visão Geral dos Saldos (Dashboard Financeiro)

A secção principal segmenta o capital do utilizador em três estados distintos, refletindo a sua disponibilidade real e o ciclo de vida dos contratos.

- **Saldo Disponível (Kz):**
    - **Definição:** Valor líquido e de livre movimentação. Pode ser usado para contratar novos serviços, pagar taxas da plataforma ou solicitado para saque.
    - **Regra de Negócio:** Aumenta com carregamentos de saldo confirmados e com a liberação de escrows aprovados. Diminui ao criar novos contratos ou ao efetuar saques.
- **Saldo Retido em Escrow (Kz):**
    - **Definição:** Valores bloqueados em garantia. Representa o dinheiro que o Cliente já pagou para iniciar um contrato, mas que a plataforma retém até que o trabalho seja entregue e aprovado.
    - **Regra de Negócio:** O valor é movido do "Saldo Disponível" para "Retido em Escrow" no momento da aceitação da proposta. Garante ao Freelancer que o dinheiro já está com a plataforma.
- **A Receber / Escrow Retido (Kz):**
    - **Definição:** Valores já "ganhos" pelo Freelancer (trabalho aprovado), mas que estão em período de compensação (clearing) ou retenção de segurança antes de se tornarem sacáveis.
    - **Regra de Negócio:** Após o período de retenção (ex: 7 dias sem disputas), o sistema move automaticamente este valor para o "Saldo Disponível".

---

### 2. Ações Disponíveis

Botões de ação para movimentação de capital dentro e fora do ecossistema Skilla.

- **Carregar Saldo:**
    - **Fluxo:** Inicia o processo de adição de fundos na carteira. O utilizador fará uma transferência bancária real para o IBAN do Banco Skilla.
- **Ver Extrato:**
    - **Fluxo:** Abre o histórico detalhado (ledger) de todas as transações financeiras do utilizador (entradas, saídas, retenções e liberações de escrow), com filtros por data e tipo de operação.
- **Pedir Saque:**
    - **Fluxo:** Solicita a transferência do "Saldo Disponível" para a conta bancária pessoal/externa do utilizador.
    - **Regra de Negócio:** O sistema deve validar se o utilizador tem o saldo mínimo para saque e se os seus dados bancários pessoais (de destino) estão devidamente registados e verificados na plataforma.

---

### 3. Dados Bancários (O "Banco Skilla")

Esta secção apresenta o identificador financeiro central da plataforma.

- **IBAN SKILLA (Universal):**
    - **Definição:** Este é o **IBAN mestre e universal** do Banco Skilla. Diferente de um sistema tradicional onde cada usuário teria um IBAN único, aqui **todos os utilizadores partilham este mesmo IBAN** para operações de entrada de capital.
    - **Função:** Atua como o identificador central para todas as operações de depósito e tesouraria dentro do ecossistema Skilla.
- **Botão Copiar:**
    - **Função:** Copia o IBAN para a área de transferência do dispositivo, facilitando a colagem na aplicação do banco real do utilizador no momento da transferência.
- **Instrução de Uso:**
    - **Texto:** "Use este IBAN para transferências para a sua carteira."

#### ️ Regras de Negócio Críticas para o IBAN Universal:

Como o IBAN é o mesmo para todos os usuários, o sistema do Banco Skilla precisa de um mecanismo infalível para **reconciliação bancária** (saber qual usuário enviou o dinheiro):

1. **Código de Referência Único (Obrigatório):** Ao clicar em "Carregar Saldo", o sistema deve gerar e exibir um **Código de Referência Único** (ex: `SKILLA-USER-8492` ou o ID da transação). O utilizador é obrigado a colocar este código no "Assunto" ou "Referência" da transferência bancária real.
2. **Conciliação Automática:** O sistema do Banco Skilla monitoriza as entradas neste IBAN universal. Quando detecta uma transferência, cruza o **valor** e o **código de referência** no assunto para creditar o saldo na carteira virtual do utilizador correto.
3. **Segurança:** Transferências feitas para o IBAN Skilla sem o código de referência correto devem entrar numa fila de "Pendentes/Análise Manual" para evitar perda de fundos ou crédito em contas erradas.

---

### Resumo do Fluxo no "Banco Skilla"

1. **Entrada (Inflow):** O utilizador transfere Kz do seu banco real para o **IBAN Universal Skilla** (usando o seu código de referência). O saldo da sua carteira virtual aumenta.
2. **Operação Interna (Internal Ledger):** O utilizador contrata um freela. O saldo sai de "Disponível" e vai para "Retido em Escrow". Quando o trabalho é aprovado, vai para "A Receber" e depois volta a "Disponível" na carteira do freela.
3. **Saída (Outflow):** O utilizador pede saque. O Banco Skilla processa a transferência do seu tesouro central para a conta bancária pessoal externa do utilizador.

Lembrando que essas operações são apenas fictícias, não tem ainda integração com métodos de pagamentos reais, como multicaixa, nem bancos nacionais.