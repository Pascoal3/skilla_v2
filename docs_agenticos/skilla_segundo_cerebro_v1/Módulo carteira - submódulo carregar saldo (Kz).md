Tem o card de inserir o valor que o cliente deseja carregar, o mínimo são 2.000kzs, caso o valor esteja abaixo disso, deve aparecer uma mensagem de erro, vermelha, reforçando que "O valor mínimo é 2.000 Kz"

Depois, segundo card, método de recarga, temos três opções, das quais, duas estão desabilitadas, nas desabilitadas temos "Multicaixa Express" e "Multicaixa", a única disponível (habilitada) é "Banco Skilla".

Terceiro card, resumo da recarga, onde vai o valor da recarga: que é igual ao valor inserido no primeiro card, deve ser feita essa atribuição dinamicamente (automaticamente), para aparecer ao mesmo tempo que se digita o valor no primeiro card, tem embaixo taxa de serviço, também deve aparecer dinamicamente, sendo 10% do valor introduzido no primeiro card, depois temos total a pagar, também deve aparecer automaticamente, sendo que é o valor por carregar (colocado no primeiro card) menos a taxa de serviço.

E o botão de confirma recarga, que quando apertado, ativa o modal de recarga concluída, que informa que a recarga foi concluída, "Seu saldo de (valor carregado) foi carregado com sucesso em sua conta Skilla."

Com botão de "Ver extrato" e "Voltar para carteira"

O botão de voltar para carteira leva para a tela inicial da carteira, mas os dados lá como saldo disponível deve ser atualizado (acrescer) após cada recarga.

Quando a recarga é feita, automaticamente é adicionado um registo no extrato com tipo de recarga (no caso recarga de saldo), método de recarga, ex: "Depósito via Multicaixa Express", hora, valor de recarga, "+" antes do valor que foi acrescido, ex: + 50.000,00 Kz e estado (concluído ou pendente), nesse concluído, mas pode ser por exemplo pagamento de projeto ou assim, que pode se dar o caso de estar pendente.


# Submódulo: Carregar Saldo

## 1. Visão Geral e Navegação

Esta tela permite ao utilizador adicionar fundos à sua Carteira Skilla. O fluxo foi desenhado para ser transparente, mostrando o método utilizado, as taxas aplicadas e o resumo matemático antes da confirmação final.

- **Navegação:** Acessível via `Carteira > Minha carteira > Carregar saldo` (Breadcrumbs visíveis no topo).

---

## 2. Estrutura da Interface (Os 3 Cards)

A tela é composta por três secções (cards) verticais que guiam o utilizador passo a passo.

### Card 1: Inserção de Valor (Input)

- **Descrição:** Campo numérico principal onde o cliente define o montante que deseja carregar na plataforma.
- **Regra de Validação (Mínimo):** O sistema exige um depósito mínimo.
    - Se o valor digitado for inferior a **2.000 Kz**, o sistema dispara um alerta visual dinâmico em tempo real.
    - **Feedback de Erro:** Exibe um ícone de alerta vermelho acompanhado do texto: _"O valor mínimo é 2.000 Kz"_ ao lado ou abaixo do campo de input, bloqueando a ação de confirmar até que a regra seja cumprida.

### Card 2: Método de Recarga

- **Descrição:** Lista de opções de provedores de pagamento.
- **Regra de Interface (Disponibilidade):** A interface deve suportar estados _Habilitados_ e _Desabilitados_ nativamente.
    - **Opção 1 (Desabilitada):** _Multicaixa Express_ (Subtítulo: "Indisponível no momento") – Apresenta opacidade reduzida e um ícone de cadeado.
    - **Opção 2 (Habilitada/Selecionada por defeito):** _Banco Skilla_ (Subtítulo: "Transferência instantânea") – Destacada com borda azul e um ícone de _check_ azul indicando a seleção ativa.
    - **Opção 3 (Desabilitada):** _Multicaixa_ (Subtítulo: "Referência de pagamento") – Apresenta opacidade reduzida e ícone de cadeado.

### Card 3: Resumo da Recarga (Cálculo Dinâmico)

- **Descrição:** Uma fatura prévia ("recibo" visual) que se atualiza automaticamente (_two-way binding_) à medida que o utilizador digita o valor no Card 1.
- **Lógica Matemática:**
    - **Valor da recarga:** Espelha exatamente o valor inserido no Card 1.
    - **Taxa de serviço:** Calculada automaticamente sendo **10%** do valor introduzido no Card 1. _(Nota na UI: Na imagem de exemplo aparece 0 Kz, mas a regra de negócio a programar deve forçar o cálculo de 10%)._
    - **Total a pagar:** Calculado dinamicamente com a fórmula: `Valor da recarga - Taxa de serviço`. _(Nota de Produto: Geralmente, em top-ups, a taxa é somada ao valor a pagar, ou descontada do saldo final a receber. Garantir com a equipa financeira que a fórmula exata é esta subtraída no ato de pagar)._

---

## 3. Confirmação e Modal de Sucesso

### Botão Principal [ Confirmar recarga ]

- Fixo no fundo do ecrã (fundo escuro/azul escuro, texto branco com seta indicativa).
- Só fica clicável (ativo) se a validação do Card 1 (>= 2.000 Kz) for cumprida.
- Ao ser clicado, processa a intenção e abre instantaneamente o **Modal de Recarga Concluída**.

### Modal: Recarga Concluída

Apresentado em formato de _overlay_ ou ecrã de sucesso centralizado:

- **Visual:** Ícone circular com _check_ verde.
- **Título:** "Recarga concluída".
- **Mensagem Dinâmica:** _"Seu saldo de [Valor Inserido] foi carregado com sucesso em sua conta Skilla."_ (O valor deve refletir o montante exato da transação).
- **Ações de Saída do Modal:**
    - **[ Ver extrato ] (Botão Primário Azul):** Redireciona o utilizador diretamente para o submódulo de Extrato.
    - **[ Voltar para carteira ] (Botão Secundário/Texto):** Redireciona o utilizador para a tela inicial ("Minha carteira").

---

## 4. Regras de Negócio de Back-end (Triggers do Sistema)

Imediatamente após o clique em "Confirmar recarga" e a exibição do modal de sucesso, o sistema deve executar duas ações cruciais em _background_:

1. **Atualização do Saldo (Wallet Update):**
    - O valor da recarga deve ser **acrescido (somado)** ao _Saldo Disponível (Kz)_ do utilizador.
    - Ao clicar em "Voltar para carteira", o utilizador já deve ver o card superior com o valor atualizado.
2. **Geração de Registo no Extrato (Ledger Entry):**
    - Uma nova linha de transação é criada automaticamente e injetada no topo do Extrato (sob a aba "HOJE").
    - **Dados a injetar:**
        - **Ação:** _Recarga de Saldo_.
        - **Método (Subtítulo):** Dinâmico consoante a escolha (ex: _"Depósito via Banco Skilla"_ ou _"Depósito via Multicaixa Express"_).
        - **Hora:** Timestamp do momento exato do clique.
        - **Valor:** Formatado com sinal positivo e cor indicativa (ex: `+ 50.000,00 Kz`).
        - **Estado:** `CONCLUÍDO` (neste fluxo específico de transferência instantânea). _Nota: O sistema deve suportar o estado `PENDENTE` caso no futuro sejam ativadas as referências Multicaixa que demoram a compensar._