## Mapeamento dos Serviços Bancários na Skilla

Aqui está como cada função bancária se traduz na lógica do teu sistema:

### 1. 🏧 Recarga (Depósito)

- **Banco Real:** Transferência Multicaixa → Conta Corrente.
- **Skilla:** Usuário clica em "Carregar Saldo" → Simula pagamento MCX → Saldo da `carteiras` aumenta.
- **Tabela:** `transacoes_carteiras` (tipo: `recarga`).
- **IBAN:** O dinheiro entra na conta identificada pelo IBAN virtual do usuário.

### 2. 💸 Transferência (O Fluxo Escrow)

Aqui a "Transferência" é interna.

- **Cenário:** Cliente contrata Freelancer.
- **Passo 1 (Autorização):** Modal pede consentimento: _"Autoriza debitar 65.000 KZS da sua conta **** ?"
- **Passo 2 (Débito):** Saldo do Cliente diminui.
- **Passo 3 (Retenção/Escrow):** O dinheiro **não vai** para o Freelancer ainda. Vai para uma "Conta de Garantia" (Tabela `transacoes_escrow`).
    - _Status:_ `Pendente` ou `Retido`.
    - _Visualização:_ No extrato do Cliente aparece como "Transferência em andamento para IBAN **AO06...002** (do freelancer)".
- **Passo 4 (Conclusão):**
    - **Sucesso:** Cliente aprova → Status muda para `Liberado` → Saldo do Freelancer aumenta.
    - **Falha/Rejeição:** Cliente rejeita → Status muda para `Devolvido` → Saldo do Cliente é estornado.

### 3. 🏦 Saque (Withdrawal)

- **Banco Real:** Pedir transferência para BAI/BFA real.
- **Skilla (Fase 1):** Botão "Pedir Saque". O saldo diminui na Skilla, fica status "Em processamento". Admin valida manualmente e faz transferência real fora do sistema.
- **Skilla (Fase 2):** Integração API Pagamentos.
- **Tabela:** `transacoes_carteiras` (tipo: `saque`).
- **Segurança:** O usuário deve cadastrar um IBAN **Real** externo no perfil para receber o saque.

### 4. 📄 Extrato (Statement)

- **Banco Real:** PDF com histórico de movimentos.
- **Skilla:** Página "Minhas Transações".
- **Dados:** Vem da tabela `transacoes_carteiras` e `transacoes_escrow`.
- **Visual:**
    - 🟢 Entrada (Recarga, Recebimento de Projeto)
    - 🔴 Saída (Pagamento de Proposta, Saque, Contratação)
    - 🟠 Bloqueado (Valor em Escrow)


##  🏦 Estrutura do IBAN Skilla

Para Angola, o IBAN padrão tem **21 caracteres**. Para manter o realismo, vamos seguir esse padrão, mas simplificado para geração interna.

### Formato Sugerido (21 Dígitos)

text

```
AO06 0010 0000 0000 0000 0001
││││ ││││ ││││ ││││ ││││ ││││
││││ ││││ ││││ └──────┴──────┘── Número da Conta (Único)
││││ ││││ └─────── Entidade/Filial (Fixo: 0000)
││││ └─────── Código do Banco (Fixo: 0010)
│││ └───────── Dígitos de Controlo (Fixo: 06 para Angola)
││ └───────── Código do País (AO)
```

- **Total:** 21 Caracteres (incluindo letras).
- **Geração:** Os últimos 11 dígitos serão sequenciais ou baseados no ID do usuário para garantir unicidade.
- **Visualização:** `AO06 0010 0000 0000 0000 0001` (com espaços para leitura).
- **Cópia:** `AO06001000000000000001` (sem espaços para colar).

0006 0000 1740 7445 3017 0



## 2. 🗄️ Atualização no Banco de Dados

Precisas de guardar este IBAN na tabela `carteiras`.

### Migration

PHP

```
Schema::table('carteiras', function (Blueprint $table) {
    // Adiciona coluna para o IBAN virtual
    $table->string('iban_virtual', 21)->unique()->nullable()->after('usuario_id');
    
    // Opcional: Número de conta interno (para gerar o IBAN)
    $table->unsignedBigInteger('numero_conta_interno')->unique()->nullable()->after('iban_virtual');
});
```

### Model `Carteira.php`

PHP

```
class Carteira extends Model {
    // ...
    
    // Accessor para formatar o IBAN com espaços
    public function getIbanFormatadoAttribute() {
        if (!$this->iban_virtual) return '';
        // Remove espaços e insere a cada 4 caracteres para exibição
        $clean = str_replace(' ', '', $this->iban_virtual);
        return trim(chunk_split($clean, 4, ' '));
    }
}
```

---

## 3. ⚙️ Serviço de Geração de IBAN (`IbanService`)

Cria um serviço dedicado para gerar este número único quando a carteira é criada.

PHP

```
// app/Services/IbanService.php
namespace App\Services;

use App\Models\Carteira;

class IbanService {
    
    public function generate(Carteira $carteira) {
        // Estratégia: Usar um ID sequencial ou hash do UUID do usuário
        // Para ser "fácil de decorar" como pediste, vamos usar um sequencial simples
        // ou os últimos dígitos do ID do usuário se preferires algo aleatório.
        
        // Opção A (Sequencial - Mais fácil de decorar): 00000000001, 00000000002
        $accountNumber = str_pad($carteira->id, 11, '0', STR_PAD_LEFT); 
        
        // Montagem do IBAN Angolano Padrão
        // AO06 (País+Check) + 0010 (Banco) + 0000 (Agência) + Account (11 digits)
        $iban = 'AO06' . '0010' . '0000' . $accountNumber;
        
        // Garante que tem 21 chars
        $iban = substr($iban, 0, 21); 

        $carteira->update([
            'iban_virtual' => $iban,
            'numero_conta_interno' => $carteira->id // Ou um contador separado
        ]);

        return $iban;
    }
}
```

_Nota: Deves chamar este serviço no `WalletService` quando crias a carteira (`firstOrCreate`)._

---

## 4. 💻 Frontend: Botão de Copiar IBAN

No Blade do Dashboard (Perfil ou Carteira):

HTML

```
<div class="mt-4 p-4 bg-surface-container-lowest rounded-lg border border-outline">
    <p class="text-label-sm text-on-tertiary-container mb-1">IBAN Skilla</p>
    <div class="flex items-center justify-between gap-2">
        <!-- Exibição Formatada -->
        <span class="font-mono text-body-md font-bold text-black-pure" id="iban-display">
            {{ $carteira->iban_formatado }}
        </span>
        
        <!-- Botão Copiar -->
        <button onclick="copyIban('{{ $carteira->iban_virtual }}')" 
                class="p-2 hover:bg-outline-variant rounded-md transition-colors" 
                title="Copiar IBAN">
            <span class="material-symbols-outlined text-[20px]">content_copy</span>
        </button>
    </div>
    <p id="copy-feedback" class="text-xs text-green-600 mt-2 hidden">IBAN copiado!</p>
</div>

<script>
function copyIban(iban) {
    // Copia sem espaços para uso em sistemas
    navigator.clipboard.writeText(iban).then(() => {
        const feedback = document.getElementById('copy-feedback');
        feedback.classList.remove('hidden');
        setTimeout(() => feedback.classList.add('hidden'), 2000);
    });
}
</script>
```

---

## 5. 🔄 Mapeamento dos Serviços Bancários na Skilla

Aqui está como cada função bancária se traduz na lógica do teu sistema:

### 1. 🏧 Recarga (Depósito)

- **Banco Real:** Transferência Multicaixa → Conta Corrente.
- **Skilla:** Usuário clica em "Carregar Saldo" → Simula pagamento MCX → Saldo da `carteiras` aumenta.
- **Tabela:** `transacoes_carteiras` (tipo: `recarga`).
- **IBAN:** O dinheiro entra na conta identificada pelo IBAN virtual do usuário.

### 2. 💸 Transferência (O Fluxo Escrow)

Esta é a parte crucial que descreveste. Aqui a "Transferência" é interna.

- **Cenário:** Cliente contrata Freelancer.
- **Passo 1 (Autorização):** Modal pede consentimento: _"Autoriza debitar 65.000 KZS do seu IBAN **AO06...001**?"_
- **Passo 2 (Débito):** Saldo do Cliente diminui.
- **Passo 3 (Retenção/Escrow):** O dinheiro **não vai** para o Freelancer ainda. Vai para uma "Conta de Garantia" (Tabela `transacoes_escrow`).
    - _Status:_ `Pendente` ou `Retido`.
    - _Visualização:_ No extrato do Cliente aparece como "Transferência em andamento para IBAN **AO06...002**".
- **Passo 4 (Conclusão):**
    - **Sucesso:** Cliente aprova → Status muda para `Liberado` → Saldo do Freelancer aumenta.
    - **Falha/Rejeição:** Cliente rejeita → Status muda para `Devolvido` → Saldo do Cliente é estornado.

### 3. 🏦 Saque (Withdrawal)

- **Banco Real:** Pedir transferência para BAI/BFA real.
- **Skilla (Fase 1):** Botão "Pedir Saque". O saldo diminui na Skilla, fica status "Em processamento". Admin valida manualmente e faz transferência real fora do sistema.
- **Skilla (Fase 2):** Integração API Pagamentos.
- **Tabela:** `transacoes_carteiras` (tipo: `saque`).
- **Segurança:** O usuário deve cadastrar um IBAN **Real** externo no perfil para receber o saque.

### 4. 📄 Extrato (Statement)

- **Banco Real:** PDF com histórico de movimentos.
- **Skilla:** Página "Minhas Transações".
- **Dados:** Vem da tabela `transacoes_carteiras` e `transacoes_escrow`.
- **Visual:**
    - 🟢 Entrada (Recarga, Recebimento de Projeto)
    - 🔴 Saída (Pagamento de Proposta, Saque, Contratação)
    - 🟠 Bloqueado (Valor em Escrow)

---

## 6. 📝 Exemplo de Fluxo no Código (Controller)

Aqui está como implementar a lógica do Modal de Consentimento e Escrow que descreveste:

PHP

```
// ContractController.php

public function confirmEscrow(Request $request, Contrato $contrato) {
    $cliente = auth()->user()->perfil;
    $valor = $contrato->valor_acordado;

    // 1. Validar Saldo
    if ($cliente->carteira->saldo < $valor) {
        return response()->json(['erro' => 'Saldo insuficiente no IBAN'], 402);
    }

    // 2. Confirmar Consentimento (O frontend já deve ter pedido isso no modal)
    // 3. Executar a "Transferência Pendente" (Escrow)
    try {
        $paymentService->executeEscrow($contrato);
        
        return response()->json([
            'sucesso' => true, 
            'mensagem' => 'Valor retido com sucesso. Transferência pendente para o Freelancer.'
        ]);
    } catch (\Exception $e) {
        return response()->json(['erro' => $e->getMessage()], 500);
    }
}
```

### No Frontend (Modal)

HTML

```
<!-- Modal de Confirmação de Pagamento -->
<div id="escrow-modal" class="hidden">
    <h3>Confirmar Pagamento Escrow</h3>
    <p>Está a transferir <strong>65.000 KZS</strong></p>
    <p>De: <span class="font-mono">AO06...001</span> (Sua Conta)</p>
    <p>Para: <span class="font-mono">AO06...002</span> (Conta Garantia Skilla)</p>
    <p class="text-sm text-gray-500">O valor ficará retido até aprovar o trabalho.</p>
    
    <button onclick="confirmPayment()">Confirmar e Retirar Saldo</button>
</div>
```

---

## 7. ✅ Resumo das Vantagens Desta Abordagem

1. **Profissionalismo:** O usuário sente que está a usar uma ferramenta financeira séria.
2. **Clareza:** O conceito de "IBAN" facilita explicar para onde o dinheiro está a ir (Ex: "O dinheiro está no IBAN de Garantia").
3. **Escalabilidade:** Se no futuro integrares com um gateway de pagamento real (como Proxypay ou Stripe), já tens o campo `iban_virtual` pronto para mapear.
4. **Segurança:** O IBAN é apenas um identificador visual. A segurança real está nas transações do banco de dados (`DB::transaction`).

### ⚠️ Nota Importante

Deixa claro nos Termos de Uso que o **IBAN Skilla é virtual e interno**. Ele não serve para receber transferências de bancos externos (BAI, BFA, etc.) diretamente, a menos que tenhas uma integração bancária corporativa real. Ele serve para identificar a conta do usuário **dentro da plataforma**.

Queres que eu gere o código completo do `IbanService` e a migration atualizada?