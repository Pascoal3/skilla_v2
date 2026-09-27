# ADR 0003: Modelo de Escrow e Trilha de Auditoria Financeira

**Status:** Accepted
**Owner:** TODO(USER)
**Last updated:** 2026-09-26

---

## Context

O Skilla implementa **escrow simulado** (MVP) → **escrow real** (pós-MVP com Multicaixa) para garantir pagamentos seguros entre cliente e freelancer.

Requisitos financeiros não-negociáveis:
1. **Atomicidade**: Aceitar proposta → Contrato + Escrow (retido) + Chat — tudo ou nada
2. **Precisão Monetária**: Zero erros de arredondamento; Kz (AOA) com 2 casas decimais
3. **Imutabilidade Auditoria**: Registros financeiros nunca alterados/apagados (compliance, disputa, reconciliação)
4. **Concorrência Segura**: Múltiplas operações simultâneas na mesma carteira não geram saldo negativo
5. **Rastreabilidade Total**: Cada centavo rastreável: origem → destino → motivo → referência (contrato/escrow/compra)
6. **Comissão Transparente**: 10% fixo, calculado no momento da retenção (snapshot), creditado à plataforma só na liberação
7. **Disputa Congela Tudo**: Escrow imutável durante disputa; só admin resolve

Alternativas consideradas para modelo de dados:
1. **Uma tabela `transactions` genérica** (type: escrow, wallet, credit) — Flexível, mas índices complexos, queries lentas, auditoria confusa
2. **Tabelas separadas por domínio** (`escrow_transactions`, `wallet_transactions`, `credit_transactions`) — **Escolhido**
3. **Event Sourcing** — Audit trail perfeito, mas complexidade alta, overkill para MVP
4. **Ledger Double-Entry (contabilidade partida dobrada)** — Correto contabilmente, mas verboso para MVP; planejado v1.5

---

## Decision

Implementar **três tabelas de auditoria independentes e imutáveis**, cada uma com propósito claro:

### 1. `transacoes_escrow` — Movimentações de Escrow (Retenção/Liberação/Reembolso)
```sql
CREATE TABLE transacoes_escrow (
    id UUID PRIMARY KEY,
    contrato_id UUID NOT NULL REFERENCES contratos(id),
    carteira_origem_id UUID NOT NULL REFERENCES carteiras(id),      -- Cliente
    carteira_destino_id UUID NOT NULL REFERENCES carteiras(id),      -- Freelancer
    valor DECIMAL(15,2) NOT NULL,                                    -- Total contrato
    valor_comissao DECIMAL(15,2) NOT NULL,                           -- 10% (snapshot)
    valor_liquido_freelancer DECIMAL(15,2) NOT NULL,                 -- 90%
    status_pagamento ENUM('retido','liberado','devolvido_cliente') DEFAULT 'retido',
    metodo_liberacao ENUM('aprovacao_cliente','decisao_admin') NULL,
    retido_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    liberado_em TIMESTAMP NULL,
    -- APENAS INSERT (nunca UPDATE/DELETE exceto status_pagamento + liberado_em)
);
```

### 2. `transacoes_carteiras` — Movimentações de Carteira (Kz)
```sql
CREATE TABLE transacoes_carteiras (
    id UUID PRIMARY KEY,
    carteira_origem_id UUID NULL REFERENCES carteiras(id),           -- NULL = entrada externa
    carteira_destino_id UUID NULL REFERENCES carteiras(id),          -- NULL = saída externa
    valor DECIMAL(15,2) NOT NULL,                                    -- Sempre positivo
    tipo ENUM('recarga','debito_escrow','credito_escrow','reembolso_escrow','saque','comissao','compra_creditos') NOT NULL,
    metodo_pagamento VARCHAR(50) DEFAULT 'interno',                  -- 'multicaixa', 'transferencia', 'interno'
    descricao TEXT NULL,
    id_referencia UUID NULL,                                         -- contrato_id, escrow_id, compra_creditos_id
    tipo_referencia VARCHAR(50) NULL,                                -- 'contrato','escrow','compra_creditos','saque'
    status ENUM('pendente','concluido','falhou') DEFAULT 'concluido',
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    -- APENAS INSERT
    INDEX idx_carteiras_origem_destino (carteira_origem_id, carteira_destino_id)
);
```

### 3. `transacoes_credito` — Movimentações de Créditos (Propostas/Boost)
```sql
CREATE TABLE transacoes_credito (
    id UUID PRIMARY KEY,
    perfil_id UUID NOT NULL REFERENCES perfis(id),
    quantidade INT NOT NULL,                                         -- Positivo = entrada, Negativo = saída
    tipo ENUM('compra','gasto_proposta','boost','ajuste_admin') NOT NULL,
    descricao TEXT NULL,
    id_referencia UUID NULL,                                         -- proposta_id, destaque_id
    tipo_referencia VARCHAR(50) NULL,                                -- 'proposta','destaque'
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    -- APENAS INSERT
);
```

### Regras de Ouro (Enforced em Código)

| Regra | Implementação |
|-------|---------------|
| **Apenas INSERT** | Models sem `$fillable` para `id`, `criado_em`; Policies `delete()` → `false`; `update()` → `false` (exceto `status_pagamento` + `liberado_em` em `EscrowTransaction`) |
| **Locking Pessimista** | `WalletService::debitar/depositar` usa `Wallet::where('id', $id)->lockForUpdate()->firstOrFail()` |
| **Transação Atômica** | `DB::transaction()` em `EscrowService::reter/liberar/reembolsarTotal`, `ContractService::approveWork`, `ProposalService::accept` |
| **Snapshot Comissão** | `EscrowService::reter()` calcula e persiste `valor_comissao` + `valor_liquido_freelancer` — **não recalcula** na liberação |
| **Reconciliação Diária** | Command `wallet:reconcile` verifica `SUM(valor) WHERE carteira_destino=X - SUM(valor) WHERE carteira_origem=X = carteiras.saldo` |
| **Idempotência Futura** | `id_referencia` + `tipo_referencia` únicos por operação externa (webhook Multicaixa) |

---

## Consequences

### Positivas
- **Auditoria Clara**: Cada tabela tem semântica única; queries de extrato simples e performáticas
- **Compliance Ready**: Imutabilidade atende requisitos LGPD/BNA; logs completos para disputas judiciais
- **Performance**: Índices diretos por `carteira_origem_id`, `carteira_destino_id`, `contrato_id`, `perfil_id`
- **Separação de Responsabilidades**: Escrow (contrato) ≠ Carteira (saldo usuário) ≠ Créditos (sistema propostas)
- **Debugging Fácil**: Rastrear fluxo: `transacoes_carteiras` (saldo) → `transacoes_escrow` (retenção) → `contratos` (estado)

### Negativas
- **Duplicação Controlada**: `transacoes_escrow` referencia `carteira_origem/destino` que também aparecem em `transacoes_carteiras` (intencional: visões diferentes)
- **Reconciliação Necessária**: Requer job diário para garantir consistência (já implementado)
- **Mais Tabelas**: 3 tabelas vs 1 genérica (trade-off aceito por clareza)

### Riscos
| Risco | Mitigação |
|-------|-----------|
| Inconsistência carteira vs transações | `wallet:reconcile` daily + alerta se divergência > 0.01 Kz; transações ACID + lockForUpdate |
| Bug permite UPDATE/DELETE auditoria | Policies `update/delete` → `false`; Code review obrigatório; Testes unitários verificam imutabilidade |
| Race condition saldo negativo | `lockForUpdate` em todos débitos/créditos; teste concorrência k6 50 VUs mesma carteira |

---

## Alternatives Considered

| Alternativa | Prós | Contras | Decisão |
|-------------|------|---------|---------|
| **Tabela Única `transactions` (type + polymorphic)** | Simples, uma tabela | Polymorphic relations lentas; índices compostos complexos; auditoria confusa | Rejeitado |
| **Event Sourcing (Event Store)** | Auditoria perfeita, replay, temporal queries | Complexidade alta; nova infra; curva aprendizado; overkill MVP | Rejeitado (planejado v1.5 para ledger contábil) |
| **Double-Entry Ledger (partida dobrada)** | Correto contabilmente; balanceamento automático | Verboso; 2+ linhas por operação; complexo para devs não-contadores | Rejeitado MVP — Planejar v1.5 |
| **Snapshot Balance em Carteira (sem transações)** | Simples | Sem rastreabilidade; impossível auditar; não compliance | Rejeitado |

---

## Related docs
- [business-logic-security.md](../01-product/business-logic-security.md) (BL13, BL14, BL15)
- [business-rules.md](../01-product/business-rules.md) (BR05, BR06)
- [architeture-document.md](architeture-document.md) (sequências Escrow)
- [TRD.md](TRD.md) (Financial RNFs)
- [security-guidelines.md](security-guidelines.md) (Financial Security)
- [../03-data/database-schema.md](../03-data/database-schema.md) (DDL completo)
- [../03-data/database-dbml.md](../03-data/database-dbml.md) (DBML)