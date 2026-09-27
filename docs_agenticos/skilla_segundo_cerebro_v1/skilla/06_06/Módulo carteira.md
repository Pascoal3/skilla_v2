## 1) O que o módulo de “Carteira” precisa cobrir (escopo)

### 1.1. Dinheiro (Kz / AOA) — para Cliente e Freelancer

- **Recarga simulada** (cliente e freelancer, se quiseres permitir).
- **Pagamento com Escrow** (cliente contrata → dinheiro fica retido).
- **Liberação do Escrow** (cliente aprova → freelancer recebe líquido, plataforma recebe comissão).
- **Reembolso do Escrow** (disputa resolvida para o cliente ou cancelamento conforme regra).
- **Saque** (principalmente freelancer; cliente opcional).
- **Extrato** (histórico auditável e filtros).

### 1.2. Créditos (moeda interna) — só freelancer

- **Compra de créditos** (pacotes).
- **Gasto de créditos** ao enviar proposta.
- **Extrato de créditos** (auditoria separada do dinheiro).

---

## 2) Telas (UI) necessárias + o que cada uma deve ter

### 2.1. Tela: “Minha Carteira” (Cliente/Freelancer)

**Objetivo:** visão geral financeira.

**Componentes:**

- Card “Saldo disponível (Kz)”
- Card “Saldo retido em Escrow (Kz)” _(calculado; ver regra abaixo)_
- Card “IBAN Skilla” (formatado + botão copiar)
- Botões:
    - “Carregar saldo”
    - “Ver extrato”
    - “Pedir saque” _(se habilitado)_
- Se freelancer:
    - Card “Créditos disponíveis”
    - Botão “Comprar créditos”
    - Botão “Extrato de créditos”

**Regras de exibição:**

- “Saldo retido” não é o `saldo` da carteira; é a soma dos escrows “retidos” onde o usuário é cliente (ou eventualmente freelancer, se quiseres mostrar recebíveis futuros).
- Para freelancer, mostrar também “A receber (escrow retido)” (soma dos escrows retidos onde ele é destino).

---

### 2.2. Tela: “Carregar saldo” (simulação)

**Objetivo:** simular depósito.

**Componentes:**

- Input valor (Kz)
- Seleção “Método” (ex: Multicaixa Express (desabilitado), "Multicaixa" (desabilitado) - caso apertar nos desabilitados, mostrar modal de info: "Disponível em breve", "Banco Skilla" como o único disponível (habilitado))
- Resumo: valor + taxa (se tiver)
- Botão “Confirmar recarga”
- Resultado: “Recarga concluída” + link para extrato

**Regras:**

- Valor mínimo (ex: 2000 Kz) e máximo (50000 kzs).
- - Atualizar saldo da carteira.
- Criar `transacoes_carteiras` tipo `recarga`.


---

### 2.3. Tela: “Extrato” (transações em Kz)

**Objetivo:** auditoria e transparência.

**Componentes:**

- Filtros: período, tipo, status (concluído/pendente/falhou)
- Lista com:
    - data/hora
    - tipo (recarga, debito_escrow, credito_escrow, reembolso, saque, comissão)
    - valor (entrada/saída)
    - descrição
    - “ver detalhes” (abre modal/página)

**Detalhes** devem mostrar:

- origem/destino (IBAN virtual)
- id de referência (contrato/escrow)
- status

---

### 2.4. Tela: “Comprar créditos” (freelancer)

**Componentes:**

- Pacotes (ex: 10, 30, 100 créditos) com preço em Kz
- Mostra saldo Kz atual
- Confirmação: “Vai debitar X Kz da tua carteira”
- Botão “Comprar”

**Regras:**

- Débito no saldo Kz do freelancer (transação dinheiro)
- Crédito no `saldo_creditos` (e lançar transação de créditos)

---

### 2.5. Tela: “Extrato de créditos” (freelancer)

**Componentes:**

- Lista de `transacoes_credito`:
    - compra, gasto_proposta, destaque, ajuste_admin etc.
    - quantidade (+/-)
    - saldo após 
    - referência (proposta, destaque…)

---

### 2.6. Tela/Modal: “Confirmar Pagamento (Escrow)” (cliente ao aceitar proposta)

**Objetivo:** UX bancária: consentimento.

**Componentes:**

- Mostra valor
- Mostra “De: teu IBAN”
- “Para: Conta Garantia Skilla / Escrow”
- Aviso: “Ficará retido até aprovação”
- Botão “Confirmar e reter valor”
- Botão “Cancelar”

---

### 2.7. Tela: “Pedir Saque” (freelancer)

**Componentes:**

- Valor
- IBAN fictício externo (se for obrigatório: cadastrar/editar)
- Confirmação
- Status do saque (pendente → processando → concluído/falhou)

> Nota: no teu DB atual, saque está como `transacoes_carteiras.tipo = saque`, mas não tens uma entidade própria para “pedido de saque”. Podes fazer só com `transacoes_carteiras` (status pendente/concluído) ou criar `saques` para fluxo admin. Eu recomendaria uma tabela `saques` para operar melhor.

---

### 2.8. Tela Admin (mínimo viável)

- Listar saques pendentes e marcar como concluído/falhou.
- Ver escrows e estado.
- Resolver disputas (já tens `disputas`).

---

## 3) Fluxos principais (end-to-end)

### 3.1. Recarga simulada

1. Usuário abre “Carregar saldo”
2. Informa valor e confirma
3. Backend:
    - `DB::transaction`
    - Cria `transacoes_carteiras (tipo=recarga, status=concluido)`
    - Incrementa `carteiras.saldo`

---

### 3.2. Envio de proposta (freelancer gasta créditos)

1. Freelancer clica “Enviar proposta”
2. Backend valida:
    - job está `aberto`
    - freelancer tem créditos suficientes
3. `DB::transaction`:
    - Cria `propostas`
    - Decrementa `perfis.saldo_creditos`
    - Cria `transacoes_credito` (tipo `gasto_proposta`, ref proposta_id)

---

### 3.3. Aceitar proposta → criar contrato + reter escrow (cliente)

**Ideal:** 2 passos para UX (criar contrato → confirmar pagamento escrow).  
Ou 1 passo só (aceitar já retém). Recomendo 2 passos.

**Passo A — aceitar proposta**

- Cria contrato com `status_pagamento=pendente` e `status_contrato=ativo` (ou “aguardando_pagamento” se criares esse status).
- Mostra modal para confirmar escrow.

**Passo B — confirmar escrow**  
`DB::transaction`:

1. Validar saldo do cliente >= valor_acordado
2. Debitar carteira do cliente:
    - `carteiras.saldo -= valor`
    - `transacoes_carteiras` tipo `debito_escrow`
3. Criar registro em `transacoes_escrow`:
    - origem = carteira cliente
    - destino = carteira freelancer
    - status = `retido`
    - comissao = 10%
    - liquido = valor - comissao
4. Atualizar contrato:
    - `status_pagamento = retido`
    - guardar comissao/valor_freelancer

---

### 3.4. Aprovação do trabalho → liberar escrow (cliente)

`DB::transaction`:

1. Validar contrato ativo e `status_pagamento=retido`
2. Atualizar `transacoes_escrow.status_pagamento = liberado`
3. Creditar freelancer (liquido):
    - `carteiras.saldo += valor_liquido_freelancer`
    - `transacoes_carteiras` tipo `credito_escrow`
4. Creditar carteira da plataforma (comissão):
    - (tens `carteiras.tipo=plataforma`) → `saldo += valor_comissao`
    - `transacoes_carteiras` tipo `comissao`
5. Atualizar contrato:
    - `status_pagamento = liberado`
    - `status_contrato = concluido`
    - timestamps `aprovado_em`

---

### 3.5. Disputa → reembolso (admin ou decisão)

Quando disputa resulta em favor do cliente:  
`DB::transaction`:

1. Validar `transacoes_escrow.retido`
2. Atualizar escrow para `devolvido_cliente`
3. Creditar cliente `carteiras.saldo += valor`
4. `transacoes_carteiras` tipo `reembolso_escrow`
5. Atualizar contrato `status_pagamento=devolvido_cliente`, `status_contrato=cancelado` (ou “concluído com reembolso”, depende da tua regra)

> Reembolso parcial: teu modelo atual não suporta bem parcial porque `transacoes_escrow.valor` é único. Dá para suportar parcial criando “ajustes” (ex: criar mais de uma transação de escrow por contrato) ou adicionando campos de reembolso. Se queres parcial, eu já planeava isso agora.

---

### 3.6. Saque (freelancer)

1. Freelancer pede saque (valor)
2. `DB::transaction`:
    - validar saldo suficiente
    - debitar carteira (ou “reservar”)
    - criar transação `saque` com status `pendente`
3. Admin marca como concluído/falhou:
    - se falhou → estornar (criar transação de estorno e devolver saldo)

---

## 4) Ajustes recomendados na modelagem (migrations)

O teu DB está bom, mas para “carteira” ficar forte, eu sugiro:

### 4.1. Garantir **carteira da plataforma**

- Criar uma carteira `tipo=plataforma` única (sem usuario_id).
- Ajustar schema:
    - em `carteiras.usuario_id` hoje está `not null, unique`. Para carteira plataforma, precisa permitir null.
    - Solução: `usuario_id nullable` + índice unique parcial (Postgres) ou regra na app (MySQL).

**Migration (ideia):**

- `usuario_id` nullable
- `tipo` indexado
- seed para criar carteira da plataforma.

### 4.2. `transacoes_credito` (não está no dbdiagram)

Tu mencionas no texto, mas não está no código dbdiagram. Criar tabela:

Campos sugeridos:

- `id uuid pk`
- `perfil_id uuid ref perfis`
- `quantidade int` (positivo/negativo)
- `tipo varchar` (`compra`, `gasto_proposta`, `boost`, `ajuste_admin`)
- `descricao text`
- `id_referencia uuid` + `tipo_referencia varchar`
- `criado_em timestamp`

### 4.3. Números inteiros para dinheiro (opcional, mas recomendado)

Hoje usas `decimal(15,2)`. Em AOA, centavos existem mas no mundo real quase não se usa; ainda assim ok.  
Para máxima consistência: guardar em **inteiro de “centavos”** (ou “kz * 100”). Se não quiseres migrar agora, mantém decimal.

### 4.4. Locks/Concorrência

Adicionar “controle” por transação e evitar double spend:

- Em operações críticas, usar `SELECT ... FOR UPDATE` na carteira e no escrow.

---

## 5) Camadas do Laravel (o que criar)

## 5.1. Models (Eloquent)

- `Carteira`
- `TransacaoCarteira`
- `TransacaoEscrow`
- `TransacaoCredito` _(nova)_
- (opcional) `Saque` _(se separar)_

Relacionamentos:

- Perfil `hasOne Carteira`
- Carteira `hasMany TransacaoCarteira` (como origem e como destino)
- Contrato `hasOne TransacaoEscrow` (ou hasMany se fores suportar parcial)

---

## 5.2. Services (onde fica a regra de negócio)

Recomendação: **não** colocar lógica de saldo em Controller.

### `WalletService`

Responsabilidades:

- criar carteira ao criar perfil (`firstOrCreate`)
- gerar IBAN virtual / numero_conta_interno
- `depositar($carteira, $valor, $descricao, $metodo)`
- `debitar($carteira, $valor, $tipo, $descricao, $ref=null)` com lock

### `CreditService`

- `comprarCreditos(perfil, pacoteId)` (debita dinheiro e credita créditos)
- `gastarCreditos(perfil, quantidade, tipo, ref)`

### `EscrowService`

- `reter(Contrato $contrato)` (debita cliente, cria escrow, atualiza contrato)
- `liberar(Contrato $contrato, $metodo_liberacao='aprovacao_cliente')`
- `reembolsar(Contrato $contrato, $metodo_liberacao='decisao_admin', $valorParcial=null)` _(se for suportar parcial)_

### `CommissionService` (opcional)

- calcula comissão (10% agora, mas prepara para mudar por categoria/nível)
- arredondamentos

### `StatementService` (opcional)

- busca e formata extrato com filtros, paginação, “tipo/entrada/saída”.

---

## 5.3. Controllers (HTTP)

### `CarteiraController`

- `show()` → página “Minha Carteira”
- `extrato(Request $r)` → lista transações dinheiro
- `extratoCreditos()` → lista transações de créditos (freelancer)

### `RecargaController`

- `create()` → tela recarga
- `store()` → processa recarga simulada

### `CreditosController`

- `index()` → tela comprar créditos
- `store()` → compra pacote

### `EscrowController` (ou dentro de Contratos)

- `confirmar(Contrato $contrato)` → reter escrow
- `liberar(Contrato $contrato)` → quando cliente aprova
- (admin) `reembolsar(Contrato $contrato)` → após disputa

### `SaquesController`

- `create()`, `store()`
- Admin: `indexPendentes()`, `updateStatus()`

---

## 6) Regras de negócio e validações (checklist)

### Dinheiro

- Não permitir saldo negativo.
- Só cliente do contrato pode confirmar escrow.
- Só liberar escrow se:
    - contrato `ativo`
    - `status_pagamento=retido`
    - não está `em_disputa`
- Reembolso só se:
    - `status_pagamento=retido`
    - disputa resolvida para cliente (ou cancelamento dentro da regra)
- Comissão:
    - armazenar no contrato e no escrow (para auditoria).

### Créditos

- Apenas freelancer pode comprar/gastar.
- Gasto de crédito deve ser transacional com criação da proposta.
- Impedir dupla submissão (idempotência).

### Auditoria

- Toda mutação de saldo deve gerar `transacoes_*`.
- Nunca editar `saldo` sem transação correspondente.

---

## 7) Rotas sugeridas (Laravel)

- `GET /carteira` (minha carteira)
    
- `GET /carteira/extrato`
    
- `GET /carteira/creditos/extrato` (freelancer)
    
- `GET /carteira/recarga`
    
- `POST /carteira/recarga`
    
- `GET /creditos/comprar` (freelancer)
    
- `POST /creditos/comprar`
    
- `POST /contratos/{contrato}/escrow/confirmar`
    
- `POST /contratos/{contrato}/escrow/liberar`
    
- `GET /saques/novo`
    
- `POST /saques`
    
- `GET /admin/saques` etc.
    

---

## 8) Seeds/Configurações iniciais

- Seed: criar `carteira plataforma`.
- Config `config/skilla.php`:
    - `comissao_percentual = 0.10`
    - `creditos_iniciais = 10`
    - `valor_min_recarga`
    - `valor_min_saque`
    - `pacotes_creditos` (id, creditos, preco_kz)

---

## 9) Ordem de implementação (para não travar)

1. **Migrations** (ajustes + transacoes_credito + carteira plataforma + iban_virtual)
2. **Models + relations**
3. **WalletService** (depositar/debitar com DB transaction + locks)
4. **Recarga** (tela + controller)
5. **Extrato** (tela + query)
6. **CreditService** + compra créditos + extrato créditos
7. **EscrowService** (reter/liberar/reembolsar)
8. Integração com fluxo de contrato (aceitar proposta → modal → confirmar escrow)
9. Saques + admin