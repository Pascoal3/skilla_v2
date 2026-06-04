## 1) Escopo final do “Banco Skilla”

### 1.1. Dinheiro (Kz / AOA) — Cliente e Freelancer

Operações:

- **Recarga (depósito simulado)**
- **Débito para Escrow** (contratação)
- **Crédito do Escrow** (pagamento ao freelancer após aprovação)
- **Comissão da plataforma** (10%)
- **Reembolso total do Escrow** (disputa/decisão)
- **Saque** (pode entrar no MVP ou na fase seguinte; fica no plano)

Registros obrigatórios:

- Toda movimentação de saldo gera **`transacoes_carteiras`**.
- Nunca alterar saldo sem transação correspondente.

### 1.2. Créditos (moeda interna) — Apenas Freelancer

Operações:

- **Compra de créditos** (debita Kz)
- **Gasto de créditos** (enviar proposta / boost futuramente)  
    Auditoria:
- Tudo em **`transacoes_credito`** (nova tabela).

---

## 2) Tabelas e Migrations (ajustadas)

### 2.1. `contadores` (NOVA) — para gerar `numero_conta_interno`

**Objetivo:** gerar número sequencial “decorável” e seguro com concorrência.

**Estrutura sugerida:**

- `id` (int pk)
- `chave` (varchar unique) ex: `numero_conta_interno`
- `valor_atual` (bigint)
- `atualizado_em`

**Regra:**

- Na criação de carteira, fazemos `SELECT ... FOR UPDATE` na linha `chave=numero_conta_interno`, incrementamos e usamos esse valor.

---

### 2.2. `carteiras` (ALTERAÇÃO)

Ajustes fechados:

- `usuario_id` passa a ser **nullable** (para permitir carteira `tipo=plataforma`)
- adicionar:
    - `iban_virtual` varchar(21) unique nullable
    - `numero_conta_interno` bigint unique nullable
- manter:
    - `saldo decimal(15,2)` default 0
    - `tipo` (`usuario|plataforma`)
    - `moeda` default `AOA`

**Regras app (por causa do MySQL):**

- Garantir via código:
    - 1 carteira por usuário (mesmo com `usuario_id` nullable)
    - só 1 carteira `tipo=plataforma` (seed + verificação)

---

### 2.3. `transacoes_credito` (NOVA)

Campos:

- `id` uuid pk
- `perfil_id` uuid fk perfis.id
- `quantidade` int (positivo compra, negativo gasto)
- `tipo` varchar (ex: `compra`, `gasto_proposta`, `boost`, `ajuste_admin`)
- `descricao` text null
- `id_referencia` uuid null
- `tipo_referencia` varchar null
- `criado_em` timestamp

---

### 2.4. `transacoes_carteiras` (AJUSTE DE “TIPO”)

Padronização dos `tipo` (string + validação em enum/const):

- `recarga`
- `debito_escrow`
- `credito_escrow`
- `reembolso_escrow`
- `comissao`
- `saque`
- `compra_creditos` **(novo)**

> Observação: compras de créditos viram transação financeira em Kz (`compra_creditos`) + transação de créditos (`transacoes_credito`).

---

## 3) Serviços (Services) — design final

### 3.1. `CounterService` (NOVO)

Responsável por trabalhar com a tabela `contadores`.

Funções:

- `next(string $chave): int`
    - abre `DB::transaction`
    - faz lock na linha do contador (`FOR UPDATE`)
    - incrementa e devolve o novo número

---

### 3.2. `IbanService`

Responsável por gerar:

- `numero_conta_interno` (via `CounterService`)
- `iban_virtual` a partir do número

Formato (21 chars sem espaços):

- `AO06` + `0010` + `0000` + `NNNNNNNNNNN` (11 dígitos)

Exemplo:

- `AO06001000000000000001`

Regras:

- `numero_conta_interno` deve ser 1..99999999999
- `accountNumber` = `str_pad($numero_conta_interno, 11, '0', STR_PAD_LEFT)`

---

### 3.3. `WalletService`

Responsável por:

- criar carteira do usuário (`getOrCreateWallet`)
- garantir IBAN ao criar carteira
- operações financeiras com lock:

Funções:

- `getOrCreateWallet(Perfil $perfil): Carteira`
- `depositar(Carteira $destino, decimal $valor, array $meta=[]): TransacaoCarteira`
- `debitar(Carteira $origem, decimal $valor, string $tipo, array $meta=[]): TransacaoCarteira`
- `transferirInterno(Carteira $origem, Carteira $destino, decimal $valor, string $tipo, array $meta=[])` _(opcional, útil em comissões/ajustes)_

Padrão de segurança:

- Em débito/crédito: `Carteira::where('id', $id)->lockForUpdate()->first()`

---

### 3.4. `CreditService`

Funções:

- `comprarCreditos(Perfil $freelancer, string $pacoteId)`
    
    - valida freelancer
    - valida saldo Kz suficiente
    - usa `WalletService->debitar(... tipo=compra_creditos ...)`
    - incrementa `perfis.saldo_creditos`
    - cria `transacoes_credito(tipo=compra, quantidade=+X)`
- `gastarCreditos(Perfil $freelancer, int $qtd, $tipo, $ref=null)`
    
    - decrementa `perfis.saldo_creditos`
    - cria `transacoes_credito(tipo=gasto_proposta, quantidade=-1, ref=proposta_id)`

---

### 3.5. `EscrowService`

Regras fechadas (sem parcial):

- `reter(Contrato $contrato)`:
    
    1. lock carteira do cliente
    2. validar saldo suficiente
    3. debitar cliente (`debito_escrow`)
    4. criar `transacoes_escrow` com:
        - `status_pagamento=retido`
        - `valor_comissao` (10%)
        - `valor_liquido_freelancer`
    5. atualizar contrato `status_pagamento=retido` + valores calculados
- `liberar(Contrato $contrato)`:
    
    1. validar `status_pagamento=retido` e não em disputa
    2. escrow `retido -> liberado`
    3. creditar freelancer (`credito_escrow`) com líquido
    4. creditar carteira plataforma (`comissao`) com comissão
    5. atualizar contrato: `liberado`, `concluido`
- `reembolsarTotal(Contrato $contrato)`:
    
    1. validar escrow `retido`
    2. escrow `retido -> devolvido_cliente`
    3. creditar cliente (`reembolso_escrow`) com valor total
    4. atualizar contrato `devolvido_cliente`

---

## 4) Controllers e rotas — definidas

### 4.1. Carteira (Kz)

- `GET /carteira` → `CarteiraController@show`
- `GET /carteira/extrato` → `CarteiraController@extrato`

### 4.2. Recarga

- `GET /carteira/recarga` → `RecargaController@create`
- `POST /carteira/recarga` → `RecargaController@store`

### 4.3. Créditos (freelancer)

- `GET /creditos/comprar` → `CreditosController@create`
- `POST /creditos/comprar` → `CreditosController@store`
- `GET /carteira/creditos/extrato` → `CarteiraController@extratoCreditos`

### 4.4. Escrow (contratos)

- `POST /contratos/{contrato}/escrow/confirmar` → `EscrowController@confirmar`
- `POST /contratos/{contrato}/escrow/liberar` → `EscrowController@liberar`
- (admin) `POST /contratos/{contrato}/escrow/reembolsar` → `EscrowController@reembolsarTotal`

### 4.5. Saques (fase seguinte ou MVP)

- `GET /saques/novo`, `POST /saques`
- admin: `GET /admin/saques`

---

## 5) Telas (MVP) — conteúdo final

1. **Minha Carteira** (`/carteira`)

- saldo Kz
- IBAN copiar
- retido em escrow (cliente) / a receber (freelancer)
- atalhos: recarga, extrato
- (freelancer) créditos + comprar/extrato

2. **Recarga** (`/carteira/recarga`)

- valor, método simulado, confirmar

3. **Extrato** (`/carteira/extrato`)

- filtros + lista

4. **Comprar créditos** (`/creditos/comprar`)

- pacotes + confirmar

5. **Extrato de créditos** (`/carteira/creditos/extrato`)
    
6. **Modal Confirmar Escrow** (na aceitação da proposta)
    

---

## 6) Seeds/Config

### Seed obrigatório

- Criar **carteira plataforma** (`tipo=plataforma`, `usuario_id=null`)
- Gerar IBAN dela também (para consistência visual)

### Config `config/skilla.php`

- `comissao_percentual = 0.10`
- `pacotes_creditos` (id, creditos, preco)
- limites (min/max recarga, min saque)

---

## 7) Ordem de implementação (atualizada)

1. Migrations: `contadores`, alter `carteiras`, criar `transacoes_credito`
2. Seed: contador inicial + carteira plataforma
3. Services: `CounterService`, `IbanService`, `WalletService`
4. Recarga (controller + tela)
5. Extrato (controller + tela)
6. Créditos (service + compra + extrato créditos)
7. Escrow (service + endpoints + modal no fluxo de contrato)
8. (opcional) Saques