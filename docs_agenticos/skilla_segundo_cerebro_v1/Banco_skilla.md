Acho essa ideia **excelente e estrategicamente correta**.

Para um projeto acadêmico ou um MVP (Mínimo Produto Viável), tentar integrar gateways de pagamento reais (como Multicaixa Express ou Stripe) logo no início pode atrasar o desenvolvimento devido à burocracia de chaves de API, contas empresariais e taxas.

Criar o **"Banco Skilla"** transforma o teu sistema em algo chamado **Virtual Wallet (Carteira Virtual)**. Isso permite que você teste toda a lógica financeira sem gastar um único centavo.

### Como isso funciona na prática (Lógica de Negócio):

1. **Recarga (Top-up):** O usuário clica em "Adicionar Saldo", escolhe um valor (ex: 5.000 Kz) e o sistema apenas "simula" que o pagamento foi feito e adiciona esse valor ao saldo do Banco Skilla.
2. **Pagamento via Escrow:** Quando o cliente aceita a proposta, o dinheiro sai do **Banco Skilla (Cliente)** →→ vai para o **Banco Skilla (Retenção/Escrow)**.
3. **Liberação:** Quando o cliente aprova o trabalho, o dinheiro sai do **Banco Skilla (Retenção)** →→ vai para o **Banco Skilla (Freelancer)**, descontando a comissão da plataforma.

---

### O que precisamos mudar no Banco de Dados?

Atualmente, você tem `credits_balance` no perfil. No entanto, **Créditos** (usados para enviar propostas) são diferentes de **Dinheiro/Saldo** (usado para pagar jobs).

Para fazer isso de forma profissional, devemos criar uma tabela de **Wallets (Carteiras)** e uma de **Wallet Transactions (Transações da Carteira)**.

Aqui está o código **DBML atualizado (em Inglês)** para você adicionar ao seu `dbdiagram.io`. Eu adicionei a lógica do Banco Skilla:

dbml

```
// --- ADICIONE ESTAS TABELAS AO SEU ESQUEMA EXISTENTE ---

Table wallets {
  id            uuid      [pk]
  user_id       uuid      [not null, unique, ref: > profiles.id]
  balance       float     [not null, default: 0, note: 'Current available balance in Kz']
  currency      varchar   [not null, default: 'AOA']
  created_at    timestamp [not null, default: `now()`]
  updated_at    timestamp [not null, default: `now()`]
}

Table wallet_transactions {
  id            uuid      [pk]
  wallet_id     uuid      [not null, ref: > wallets.id]
  amount        float     [not null, note: 'Positive for deposit, negative for payment']
  type          varchar   [not null, note: 'top_up | escrow_deposit | escrow_release | payout | commission']
  description   text
  reference_id  uuid      [note: 'ID of the contract or top-up request']
  status        varchar   [not null, default: 'completed', note: 'pending | completed | failed']
  created_at    timestamp [not null, default: `now()`]
}

// --- AJUSTE NA TABELA DE ESCROW PARA CONECTAR COM A WALLET ---
// O escrow_transactions agora deve ser visto como um movimento entre wallets
```

---

### Como implementar isso no Laravel (Passo a Passo Técnico):

Para que o "Banco Skilla" funcione, você precisará criar um novo **Service**.

**1. Criar o WalletService:**  
Este serviço será responsável por toda a matemática financeira para evitar erros de saldo.

Bash

```
# No terminal
touch app/Services/WalletService.php
```

**2. Lógica Interna do WalletService (Exemplo):**

PHP

```
class WalletService {
    // Simula a recarga de saldo
    public function depositFunds($userId, $amount) {
        $wallet = Wallet::where('user_id', $userId)->first();
        $wallet->increment('balance', $amount);
        
        WalletTransaction::create([
            'wallet_id' => $wallet->id,
            'amount' => $amount,
            'type' => 'top_up',
            'description' => 'Simulated top-up via Banco Skilla'
        ]);
    }

    // Move dinheiro do cliente para o Escrow (Retenção)
    public function moveToEscrow($clientId, $amount, $contractId) {
        $wallet = Wallet::where('user_id', $clientId)->first();
        
        if($wallet->balance < $amount) {
            throw new \Exception("Insufficient funds in Banco Skilla");
        }

        $wallet->decrement('balance', $amount);
        
        WalletTransaction::create([
            'wallet_id' => $wallet->id,
            'amount' => -$amount,
            'type' => 'escrow_deposit',
            'reference_id' => $contractId
        ]);
    }
}
```

### Vantagens dessa abordagem para a sua tese/projeto:

1. **Rastreabilidade:** Você poderá mostrar ao orientador um histórico completo de transações (`WalletTransaction`), provando que o sistema é auditável.
2. **Segurança:** Você implementa a lógica de "Saldo Insuficiente" antes mesmo de ter um banco real.
3. **Demonstração:** Na hora da apresentação, você pode criar um botão "Adicionar 10.000 Kz (Simulado)" e fazer todo o fluxo de contratação e pagamento ao vivo, sem depender de internet ou APIs externas que podem falhar.