# Riscos de Fraude e Controles de Segurança — Lógica de Negócio

**Status:** Draft
**Owner:** TODO(USER)
**Last updated:** 2026-09-26

---

## Visão Geral

Este documento mapeia vetores de abuso específicos do domínio (marketplace freelance com escrow) e os controles implementados ou planejados. Foca em **lógica de negócio** — não em vulnerabilidades de infraestrutura (cobertas em `../02-architeture/security-guidelines.md`).

---

## Matriz de Riscos

| # | Vetor de Ataque | Ator | Impacto | Probabilidade | Controle Primário | Controle Secundário | Status |
|---|-----------------|------|---------|---------------|-------------------|---------------------|--------|
| BL01 | **Spam de propostas** (bot envia centenas) | Freelancer malicioso | Degradação UX cliente; custos infra | Alta | Créditos (1/proposta) + Rate limit (10/min) | Captcha no envio (futuro); detecção de padrão anômalo | ✅ MVP |
| BL02 | **Proposta fantasma** (freelancer propõe, cliente aceita, freelancer some) | Freelancer | Cliente perde tempo; escrow retido indevidamente | Média | Contrato exige entrega + aprovação; expiração job 30d; disputa automática se não entrega | Notificações de lembrete; auto-cancelamento se freelancer inativo | ✅ MVP |
| BL03 | **Cliente aceita mas não financia escrow** (saldo insuficiente) | Cliente | Freelancer trabalha "de graça"; contrato travado | Média | Validação saldo **antes** de aceitar (`WalletService::debitar` com lock) | Recarga simulada rápida; notificação saldo baixo | ✅ MVP |
| BL04 | **Chargeback simulado** (cliente aprova, depois contesta / quer dinheiro de volta) | Cliente | Perda financeira plataforma/freelancer | Baixa | Aprovação **irreversível** (confirmação explícita); logs imutáveis; disputa só **antes** de aprovar | Terms of Service: "aprovação = aceite final"; admin audit trail | ✅ MVP |
| BL05 | **Colusão cliente-freelancer** (lavagem: cliente paga, freelancer devolve por fora) | Ambos | Lavagem de dinheiro; evasão comissão | Baixa | KYC progressivo (BI + telefone); limites de saque; monitoramento padrões (valor alto, mesmo IP, mesmo device) | Relatório suspeito (STR) para BNA (futuro); limitar valor por contrato no MVP | 🟡 Parcial |
| BL06 | **Auto-contratação** (mesmo user cria 2 perfis: cliente + freelancer) | Usuário único | Infla métricas; ganha créditos/avaliações falsas | Média | Verificação telefone único; device fingerprint (futuro); admin review perfis suspeitos | Regra: 1 CPF/BI = 1 conta (futuro KYC) | 🟡 Parcial |
| BL07 | **Manipulação de avaliações** (troca de 5 estrelas combinada) | Ambos | Reputação artificial | Média | Avaliação só **após** contrato concluído + pagamento liberado; 1 por parte por contrato | Detecção padrão: avaliações mútuas sempre 5, mesmo IP, tempo curto | ✅ MVP |
| BL08 | **Disputa frívola** (abre disputa para pressionar / travar fundos) | Cliente ou Freelancer | Congela escrow; custo operacional admin | Média | Disputa requer motivo obrigatório; admin decide com base em evidências (chat, arquivos); penalidade reincidente (banimento temporário) | Métrica: taxa disputa/contrato > 20% → flag | ✅ MVP |
| BL09 | **Elevação de privilégio** (freelancer acessa painel cliente / admin) | Atacante | Vazamento dados; ações indevidas | Baixa | Policies/Gates em **todos** controllers; middleware `role`; testes automatizados de autorização | Pentest periódico; bug bounty | ✅ MVP |
| BL10 | **Enumeração de usuários** (testa emails no login/registro) | Atacante externo | Reconhecimento; spam/phishing | Alta | Rate limit + mensagens genéricas ("se email existe, enviaremos link") | Monitoramento tentativas falhas por IP | ✅ MVP |
| BL11 | **Upload malicioso** (arquivo .php disfarçado de .jpg; PDF com JS) | Freelancer/Cliente | RCE no storage; phishing via chat | Média | Validação MIME real (`finfo`), extensão permitida, rename UUID, storage privado, headers `Content-Disposition: attachment` | Antivírus scan (ClamAV) no queue worker (futuro) | ✅ MVP |
| BL12 | **Replay de webhook pagamento** (Multicaixa futuro) | Atacante externo | Crédito duplicado na carteira | Média | Idempotency key (reference ID único) + status `pendente|concluido|falhou` em `transacoes_carteiras` | Verificação assinatura HMAC do provedor | 🟡 Planejado |
| BL13 | **Race condition carteira** (duas requisições debitam mesmo saldo) | Concorrência | Saldo negativo; perda financeira | Média | `lockForUpdate()` em `WalletService::debitar/depositar`; transação DB serializável | Teste de carga concorrente (k6) | ✅ MVP |
| BL14 | **Escrow bypass** (libera sem aprovação cliente / sem entrega freelancer) | Atacante com acesso admin/bug | Perda fundos cliente/freelancer | Baixa | `EscrowService` métodos `private` + Policies; só `ContractService::approveWork` chama `liberar`; admin action auditada | Logs imutáveis; 2FA para admin (futuro) | ✅ MVP |
| BL15 | **Manipulação de comissão** (altera % no runtime) | Admin malicioso / bug | Perda receita plataforma | Baixa | Comissão em `config('skilla.comissao_percentual')` + snapshot no escrow (`valor_comissao` persistido) | Deploy imutável config; code review obrigatório | ✅ MVP |

---

## Controles Transversais

### 1. Auditoria Imutável (Audit Trail)
- **Tabelas:** `transacoes_carteiras`, `transacoes_escrow`, `transacoes_credito`, `logs`
- **Princípio:** Apenas `INSERT`; nunca `UPDATE`/`DELETE` em registros financeiros
- **Campos-chave:** `id_referencia`, `tipo_referencia` (contrato, escrow, compra_creditos), `criado_em`, `status`
- **Query de reconciliação:** `SELECT SUM(valor) FROM transacoes_carteiras WHERE carteira_destino_id = X` vs `carteiras.saldo`

### 2. Transações ACID + Locking
```php
// Exemplo: WalletService::debitar
DB::transaction(function () use ($walletId, $amount) {
    $wallet = Wallet::where('id', $walletId)->lockForUpdate()->firstOrFail();
    if ($wallet->saldo < $amount) throw new \Exception('Saldo insuficiente');
    $wallet->saldo -= $amount;
    $wallet->save();
    WalletTransaction::create([...]);
});
```

### 3. Idempotência (Futuro - Crítico para Pagamentos Reais)
- Header `X-Idempotency-Key` (UUID v4) em endpoints mutantes
- Tabela `idempotency_keys` (key, response, created_at, expires_at)
- Middleware verifica antes de processar; retorna response cacheado se existe

### 4. Rate Limiting por Contexto
| Contexto | Limite | Chave |
|----------|--------|-------|
| Login | 5/min | IP + email |
| Registro | 3/min | IP |
| Enviar proposta | 10/min | user_id |
| Chat (mensagens) | 30/min | user_id |
| API geral | 60/min | IP + user_id |

### 5. Princípio Menor Privilégio (Policies)
```php
// Exemplo: ContractPolicy
public function approveWork(User $user, Contract $contract): bool
{
    return $user->id === $contract->cliente_id
        && $contract->status_pagamento === 'retido'
        && $contract->trabalho_entregue_em !== null
        && $contract->status_contrato === 'ativo';
}
```

### 6. Validação de Arquivos (Upload Seguro)
```php
$allowedMimes = ['application/pdf', 'image/jpeg', 'image/png', 'image/webp'];
$maxSize = 5 * 1024 * 1024; // 5MB

$file = $request->file('arquivo');
if (!in_array($file->getMimeType(), $allowedMimes)) abort(422, 'Tipo não permitido');
if ($file->getSize() > $maxSize) abort(422, 'Arquivo muito grande');
$filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
$file->storeAs("private/chat/{$conversaId}", $filename, 'private');
```

---

## Gaps Conhecidos (TODO / Assumptions)

| Gap | Descrição | Mitigação Temporária | Prazo |
|-----|-----------|---------------------|-------|
| KYC forte | Sem verificação BI + selfie + liveness no MVP | Registro com telefone + email verificado; admin review manual suspeitos | v1.0 |
| Idempotência webhooks | Não implementada ainda | Processamento manual de duplicatas (baixo volume MVP) | Pós-MVP (Multicaixa) |
| Device fingerprint | Não implementado | Rate limit por IP + user_agent | v1.0 |
| Antivírus upload | Não implementado | Tipos restritos + storage privado + headers download | Pós-MVP |
| 2FA Admin | Não implementado | Acesso admin restrito por IP (VPN) + senha forte | v1.0 |
| Limites de valor/volume | Não configurados no MVP | Hardcoded no Service (ex.: max 10M Kz/job) | v1.0 |
| Relatórios STR (BNA) | Não implementado | Logs completos para auditoria manual | v1.5 |

---

## Testes de Segurança de Lógica (Recomendados)

1. **Concorrência:** `k6` script simula 50 requisições simultâneas `debitar` na mesma carteira → saldo nunca negativo
2. **Autorização:** Pest tests para cada Policy (cliente não acessa contrato alheio, freelancer não aprova, etc.)
3. **Escrow:** Teste integração: aceitar proposta → saldo cliente -valor; escrow `retido`; aprovar → freelancer +90%, plataforma +10%
4. **Disputa:** Abrir disputa → escrow congelado; tentar aprovar → 403; admin resolve → fluxo correto
5. **Upload:** Tentar enviar `.php`, `.exe`, `.svg` (XSS), PDF com JS → todos rejeitados
6. **Rate limit:** Burst 100 requests login → 429 após 5; burst propostas → 429 após 10

---

## Related docs
- [business-rules.md](business-rules.md)
- [functional-requirements.md](functional-requirements.md)
- [../02-architeture/security-guidelines.md](../02-architeture/security-guidelines.md)
- [../03-data/database-schema.md](../03-data/database-schema.md) (tabelas de auditoria)
- [../02-architeture/ADRs/0003-escrow-audit-trail.md](../02-architeture/ADRs/0003-escrow-audit-trail.md)