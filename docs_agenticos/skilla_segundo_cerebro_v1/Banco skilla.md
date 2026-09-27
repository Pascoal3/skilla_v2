A tua modelagem de dados já está muito bem encaminhada. Tu já tens a base necessária (`carteiras`, `transacoes_carteiras` e `transacoes_escrow`). Para transformar isso num "Banco Skilla" funcional e seguro, não precisas de mudar a estrutura drasticamente, mas sim de **refinar os tipos de dados** e **implementar a lógica de transações**.

Aqui estão as instruções detalhadas de como deves proceder:

---

### 1. Ajuste Crítico na Modelagem (O Erro do `float`)

**Regra de Ouro:** Nunca, jamais, uses `float` ou `double` para dinheiro.
Floats têm erros de arredondamento binário (ex: `0.1 + 0.2` pode resultar em `0.30000000000000004`). Em sistemas financeiros, isso causa furos no saldo.

**O que mudar:**
*   Nas tabelas `carteiras`, `transacoes_carteiras`, `transacoes_escrow` e `contratos`, altera todos os campos de valor de `float` para **`decimal(15,2)`**.
    *   `15` é a precisão total (números totais).
    *   `2` são as casas decimais.

---

### 2. Mapeamento do Fluxo de Dados (O Ciclo do Dinheiro)

O "Banco Skilla" funciona como um **Ledger (Livro Razão)**. O saldo da carteira é apenas o reflexo da soma de todas as transações.

#### Passo A: Recarga (Cliente $\rightarrow$ Banco Skilla)
1.  Cliente solicita recarga de 10.000 Kz.
2.  Cria-se um registo em `transacoes_carteiras`: `valor: 10000`, `tipo: 'recarga'`, `status: 'concluido'`.
3.  Atualiza-se `carteiras.saldo = carteiras.saldo + 10000`.

#### Passo B: Contratação/Retenção (Carteira Cliente $\rightarrow$ Escrow)
Quando o cliente aceita a proposta:
1.  Verifica se `carteiras.saldo >= valor_acordado`.
2.  **Débito na Carteira:** `transacoes_carteiras` $\rightarrow$ `valor: -8000`, `tipo: 'debito_escrow'`.
3.  **Atualização Saldo:** `carteiras.saldo = carteiras.saldo - 8000`.
4.  **Criação Escrow:** Insere em `transacoes_escrow` $\rightarrow$ `status: 'retido'`, `valor: 8000`.

#### Passo C: Liberação (Escrow $\rightarrow$ Carteira Freelancer + Taxa)
Quando o cliente clica em "Aprovar Trabalho":
1.  Altera `transacoes_escrow.status` para `'liberado'`.
2.  **Cálculo de Comissão:** (Ex: 10% de 8000 = 800).
3.  **Crédito Freelancer:** `transacoes_carteiras` $\rightarrow$ `valor: 7200`, `tipo: 'credito_escrow'`.
4.  **Crédito Plataforma:** `transacoes_carteiras` $\rightarrow$ `valor: 800`, `tipo: 'comissao'` (para uma carteira mestre do Admin).
5.  **Atualização Saldo:** `carteiras.saldo` do freelancer aumenta 7200.

#### Passo D: Disputa/Reembolso (Escrow $\rightarrow$ Carteira Cliente)
Se o Admin decidir devolver o dinheiro:
1.  Altera `transacoes_escrow.status` para `'devolvido_cliente'`.
2.  **Crédito Cliente:** `transacoes_carteiras` $\rightarrow$ `valor: 8000`, `tipo: 'reembolso_escrow'`.
3.  **Atualização Saldo:** `carteiras.saldo` do cliente aumenta 8000.

---

### 3. O que deves saber antes de implementar (Lógica de Programação)

Como estás a usar **Laravel**, deves aplicar estes três conceitos obrigatoriamente:

#### A. Database Transactions (`DB::transaction`)
Um pagamento nunca pode ser "meio feito". Se o sistema tirar dinheiro do cliente, mas falhar ao criar o registo no Escrow, o dinheiro desaparece.
```php
DB::transaction(function () use ($cliente, $valor) {
    // 1. Tira dinheiro da carteira
    // 2. Cria transação de débito
    // 3. Cria registo no escrow
    // Se qualquer linha falhar, o Laravel faz "rollback" e nada é alterado.
});
```

#### B. Race Conditions (Locking)
Imagina que um cliente clica no botão "Pagar" duas vezes muito rápido. Se o sistema ler o saldo duas vezes antes de subtrair, ele pode gastar o mesmo dinheiro duas vezes.
*   **Solução:** Usa `lockForUpdate()` no Eloquent ao ler o saldo da carteira. Isso "tranca" a linha do banco de dados até que a transação termine.

#### C. Idempotência
Garante que a mesma transação não seja processada duas vezes. Usa o `id_referencia` (que já tens na tabela) para verificar se aquele pagamento de um contrato específico já foi efetuado.

---

### 4. Sugestões de Melhoria na Modelagem

Para que o "Banco Skilla" seja profissional, adiciona isto:

1.  **Carteira da Plataforma:** Cria um perfil de usuário "ADMIN" e uma carteira para ele. Todas as comissões (`tipo: 'comissao'`) devem cair nesta carteira para que possas saber quanto a plataforma lucrou.
2.  **Logs de Auditoria:** A tabela `transacoes_carteiras` é o teu log. Nunca permitas a edição (`UPDATE`) de um valor de transação. Se houve um erro, cria-se uma **transação de estorno** (uma nova linha com valor oposto).
3.  **Estado do Pagamento no Contrato:** Sincroniza o `contratos.status_pagamento` com o `transacoes_escrow.status_pagamento` através de *Observers* ou *Events* no Laravel.

### Resumo do Mapeamento para Implementação

| Ação                | Tabela Carteiras (Saldo)      | Tabela Transações Carteiras  | Tabela Escrow       |
| :------------------ | :---------------------------- | :--------------------------- | :------------------ |
| **Recarga**         | $\uparrow$ Aumenta            | `tipo: recarga` (+)          | -                   |
| **Aceitar Job**     | $\downarrow$ Diminui          | `tipo: debito_escrow` (-)    | `status: retido`    |
| **Aprovar Job**     | $\uparrow$ Freelancer Aumenta | `tipo: credito_escrow` (+)   | `status: liberado`  |
| **Taxa Plataforma** | $\uparrow$ Admin Aumenta      | `tipo: comissao` (+)         | -                   |
| **Reembolso**       | $\uparrow$ Cliente Aumenta    | `tipo: reembolso_escrow` (+) | `status: devolvido` |