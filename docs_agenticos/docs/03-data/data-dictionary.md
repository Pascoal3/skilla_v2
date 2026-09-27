# Dicionário de Dados — Skilla

**Status:** Draft
**Owner:** TODO(USER)
**Last updated:** 2026-09-26

---

## Convenções

- **PK** = Primary Key, **FK** = Foreign Key, **UK** = Unique Key
- **Tipo**: MySQL 8.0 (InnoDB)
- **Money**: `DECIMAL(15,2)` = Kwanzas (AOA) com 2 casas decimais
- **Enum**: Valores permitidos listados; armazenados como `VARCHAR` (flexibilidade)
- **Imutável**: Tabelas `transacoes_*` — apenas `INSERT` (auditoria)
- **Soft Delete**: Não usado; status `cancelado`/`arquivado`/`inativo` em vez de delete

---

## 1. Catálogos e Localização

### `provincias` (18 províncias Angola)
| Campo | Tipo | Null | Default | Constraints | Descrição |
|-------|------|------|---------|-------------|-----------|
| `id` | UUID | N | — | PK | Identificador único |
| `nome` | VARCHAR(100) | N | — | UK | Nome completo (ex.: Luanda, Benguela) |
| `sigla` | VARCHAR(5) | S | — | UK | Sigla oficial (ex.: LUE, BEN) |
| `criado_em` | TIMESTAMP | N | NOW() | — | Auditoria |

### `categorias`
| Campo | Tipo | Null | Default | Constraints | Descrição |
|-------|------|------|---------|-------------|-----------|
| `id` | UUID | N | — | PK | |
| `nome` | VARCHAR(100) | N | — | UK | Ex.: "Design Gráfico", "Desenvolvimento Web" |
| `slug` | VARCHAR(120) | N | — | UK | URL-friendly (ex.: "design-grafico") |
| `url_icone` | TEXT | S | — | — | Caminho ícone (opcional) |
| `criado_em` | TIMESTAMP | N | NOW() | — | |

### `habilidades`
| Campo | Tipo | Null | Default | Constraints | Descrição |
|-------|------|------|---------|-------------|-----------|
| `id` | UUID | N | — | PK | |
| `nome` | VARCHAR(100) | N | — | UK | Ex.: "React", "Figma", "SEO" |
| `categoria` | VARCHAR(50) | N | — | — | Agrupamento lógico (ex.: "frontend", "design") |
| `criado_em` | TIMESTAMP | N | NOW() | — | |

---

## 2. Usuários e Perfis

### `perfis` (Entidade Central)
| Campo | Tipo | Null | Default | Constraints | Descrição |
|-------|------|------|---------|-------------|-----------|
| `id` | UUID | N | — | PK | JWT subject |
| `primeiro_nome` | VARCHAR(100) | N | — | — | |
| `sobrenome` | VARCHAR(100) | N | — | — | |
| `nome_usuario` | VARCHAR(80) | N | — | UK | Slug auto: `joao.silva.123` |
| `email` | VARCHAR(255) | N | — | UK | Login + recuperação |
| `password` | VARCHAR(255) | N | — | — | Bcrypt hash (cost 12) |
| `funcao` | VARCHAR(20) | N | — | CHECK IN ('cliente','freelancer') | Role imutável pós-registro |
| `email_verified_at` | TIMESTAMP | S | — | — | Laravel verification |
| `remember_token` | VARCHAR(100) | S | — | — | Laravel remember me |
| `provincia_id` | UUID | S | — | FK → provincias.id (SET NULL) | Localização |
| `localizacao` | TEXT | S | — | — | Bairro/endereço livre |
| `url_avatar` | TEXT | S | — | — | Storage path (público) |
| `bio` | TEXT | S | — | — | Descrição profissional |
| `telefone` | VARCHAR(30) | S | — | — | Formato: +244 9XX XXX XXX |
| `saldo_creditos` | INT | N | 10 (freelancer) / 0 (cliente) | — | **Apenas freelancer usa**; 1 crédito = 1 proposta |
| `esta_destacado` | BOOLEAN | N | FALSE | — | Boost ativo (ordenação feed) |
| `destaque_expira_em` | TIMESTAMP | S | — | — | Expiração boost (30d padrão) |
| `avaliacao_media` | DECIMAL(3,2) | N | 0.00 | — | Média 1–5 (2 casas) |
| `total_avaliacoes` | INT | N | 0 | — | Contador |
| `total_trabalhos_concluidos` | INT | N | 0 | — | Contador (freelancer) |
| `esta_ativo` | BOOLEAN | N | TRUE | — | Soft ban (FALSE = bloqueado) |
| `criado_em` | TIMESTAMP | N | NOW() | — | |
| `atualizado_em` | TIMESTAMP | N | NOW() | — | |

> **Nota:** `saldo_creditos`, `esta_destacado`, `destaque_expira_em` só têm significado para `funcao='freelancer'`. Para clientes, mantêm defaults (0, FALSE, NULL).

### `perfil_habilidades` (N:M)
| Campo | Tipo | Null | Default | Constraints | Descrição |
|-------|------|------|---------|-------------|-----------|
| `id` | UUID | N | — | PK | |
| `perfil_id` | UUID | N | — | FK → perfis.id (CASCADE) | |
| `habilidade_id` | UUID | N | — | FK → habilidades.id (CASCADE) | |
| `criado_em` | TIMESTAMP | N | NOW() | — | |
| **UK** | `(perfil_id, habilidade_id)` | — | — | — | 1 skill por perfil |

---

## 3. Jobs (Trabalhos)

### `trabalhos`
| Campo | Tipo | Null | Default | Constraints | Descrição |
|-------|------|------|---------|-------------|-----------|
| `id` | UUID | N | — | PK | |
| `cliente_id` | UUID | N | — | FK → perfis.id (CASCADE) | Apenas `funcao='cliente'` |
| `categoria_id` | UUID | S | — | FK → categorias.id (SET NULL) | Obrigatório ao publicar |
| `titulo` | TEXT | S | — | — | Mín 5 chars (publicar) |
| `tamanho_projeto` | VARCHAR(20) | S | — | CHECK IN ('pequeno','medio','grande') | |
| `duracao_estimada` | VARCHAR(50) | S | — | — | Ex.: "1 a 3 meses" |
| `nivel_experiencia` | VARCHAR(20) | S | — | CHECK IN ('iniciante','intermediario','especialista') | |
| `possibilidade_efetivacao` | BOOLEAN | N | FALSE | — | Chance de contratação CLT |
| `tipo_trabalho` | VARCHAR(20) | S | — | CHECK IN ('preco_fixo','por_hora') | Obrigatório ao publicar |
| `orcamento_fixo` | DECIMAL(15,2) | S | — | — | Se `preco_fixo`; > 0 |
| `taxa_hora_min` | DECIMAL(15,2) | S | — | — | Se `por_hora`; > 0 |
| `taxa_hora_max` | DECIMAL(15,2) | S | — | — | Se `por_hora`; ≥ min |
| `descricao` | TEXT | S | — | — | Mín 20 chars (publicar) |
| `status` | VARCHAR(20) | N | 'rascunho' | CHECK IN ('rascunho','aberto','em_andamento','concluido','cancelado','arquivado') | Máquina de estados |
| `proposta_aceita_id` | UUID | S | — | FK → propostas.id (SET NULL) | Setado na aceitação |
| `contagem_visualizacoes` | INT | N | 0 | — | Incremento único/sessão |
| `prazo` | DATE | S | — | — | Deadline do job |
| `expira_em` | DATE | S | — | — | Auto-cancelamento: `criado_em + 30d` |
| `criado_em` | TIMESTAMP | N | NOW() | — | |
| `atualizado_em` | TIMESTAMP | N | NOW() | — | |

**Estados Válidos:**
```
rascunho → aberto → em_andamento → concluido
                    ↘ cancelado
                    ↘ arquivado (manual admin)
```

### `trabalho_habilidades` (N:M)
| Campo | Tipo | Null | Default | Constraints |
|-------|------|------|---------|-------------|
| `id` | UUID | N | — | PK |
| `trabalho_id` | UUID | N | — | FK → trabalhos.id (CASCADE) |
| `habilidade_id` | UUID | N | — | FK → habilidades.id (CASCADE) |
| **UK** | `(trabalho_id, habilidade_id)` | — | — | — |

### `trabalho_anexos`
| Campo | Tipo | Null | Default | Constraints | Descrição |
|-------|------|------|---------|-------------|-----------|
| `id` | UUID | N | — | PK | |
| `trabalho_id` | UUID | N | — | FK → trabalhos.id (CASCADE) | |
| `nome_arquivo` | TEXT | N | — | — | Nome original |
| `url_arquivo` | TEXT | N | — | — | Storage path (privado) |
| `tamanho_bytes` | INT | S | — | — | Bytes |
| `criado_em` | TIMESTAMP | N | NOW() | — | |

---

## 4. Propostas e Contratos

### `propostas`
| Campo | Tipo | Null | Default | Constraints | Descrição |
|-------|------|------|---------|-------------|-----------|
| `id` | UUID | N | — | PK | |
| `trabalho_id` | UUID | N | — | FK → trabalhos.id (CASCADE) | |
| `freelancer_id` | UUID | N | — | FK → perfis.id (CASCADE) | Apenas `funcao='freelancer'` |
| `carta_apresentacao` | TEXT | N | — | — | 50–2000 chars |
| `valor_proposto` | DECIMAL(15,2) | N | — | > 0 | Em Kz |
| `dias_entrega` | INT | N | — | ≥ 1 | Prazo proposto |
| `status` | VARCHAR(20) | N | 'pendente' | CHECK IN ('pendente','aceita','rejeitada') | Terminal: aceita/rejeitada |
| `creditos_gastos` | INT | N | 1 | — | Sempre 1 no MVP |
| `criado_em` | TIMESTAMP | N | NOW() | — | |
| `atualizado_em` | TIMESTAMP | N | NOW() | — | |

**UK:** `(trabalho_id, freelancer_id)` — 1 proposta por freelancer/job

### `contratos`
| Campo | Tipo | Null | Default | Constraints | Descrição |
|-------|------|------|---------|-------------|-----------|
| `id` | UUID | N | — | PK | |
| `trabalho_id` | UUID | N | — | FK → trabalhos.id (CASCADE) | |
| `proposta_id` | UUID | N | — | FK → propostas.id (CASCADE) | |
| `cliente_id` | UUID | N | — | FK → perfis.id (CASCADE) | |
| `freelancer_id` | UUID | N | — | FK → perfis.id (CASCADE) | |
| `status_contrato` | VARCHAR(20) | N | 'ativo' | CHECK IN ('ativo','em_disputa','concluido','cancelado') | |
| `valor_acordado` | DECIMAL(15,2) | N | — | = proposta.valor_proposto | Snapshot imutável |
| `comissao_plataforma` | DECIMAL(15,2) | S | — | 10% (snapshot na retenção) | `ROUND(valor_acordado * 0.10, 2)` |
| `valor_freelancer` | DECIMAL(15,2) | S | — | 90% (snapshot na retenção) | `valor_acordado - comissao_plataforma` |
| `dias_entrega` | INT | N | — | = proposta.dias_entrega | |
| `data_limite` | DATE | S | — | `criado_em + dias_entrega` | Deadline entrega |
| `status_pagamento` | VARCHAR(20) | N | 'pendente' | CHECK IN ('pendente','retido','liberado','devolvido_cliente') | |
| `trabalho_entregue_em` | TIMESTAMP | S | — | — | Freelancer submete |
| `aprovado_em` | TIMESTAMP | S | — | — | Cliente aprova |
| `criado_em` | TIMESTAMP | N | NOW() | — | |
| `atualizado_em` | TIMESTAMP | N | NOW() | — | |

**Estados Pagamento:**
```
pendente → retido → liberado
                ↘ devolvido_cliente
```

**Estados Contrato:**
```
ativo → em_disputa → resolvida_cliente → cancelado + devolvido_cliente
      ↘ resolvida_freelancer → concluido + liberado
      ↘ acordo_mutuo → (split custom)
```

---

## 5. Financeiro (Carteira, Escrow, Créditos)

### `carteiras`
| Campo | Tipo | Null | Default | Constraints | Descrição |
|-------|------|------|---------|-------------|-----------|
| `id` | UUID | N | — | PK | |
| `usuario_id` | UUID | S | — | FK → perfis.id (SET NULL, UK) | NULL = carteira plataforma |
| `iban_virtual` | VARCHAR(21) | S | — | UK | Formato: AO06 0000 0000 0000 0000 0 |
| `numero_conta_interno` | BIGINT | S | — | UK | Sequence via `contadores` |
| `saldo` | DECIMAL(15,2) | N | 0.00 | CHECK (saldo >= 0) | **Nunca negativo** |
| `tipo` | VARCHAR(20) | N | 'usuario' | CHECK IN ('usuario','plataforma') | 1 plataforma (singleton) |
| `moeda` | VARCHAR(3) | N | 'AOA' | — | Fixo Kwanzas |
| `criado_em` | TIMESTAMP | N | NOW() | — | |
| `atualizado_em` | TIMESTAMP | N | NOW() | — | |

### `transacoes_carteiras` (Imutável — Apenas INSERT)
| Campo | Tipo | Null | Default | Constraints | Descrição |
|-------|------|------|---------|-------------|-----------|
| `id` | UUID | N | — | PK | |
| `carteira_origem_id` | UUID | S | — | FK → carteiras.id (SET NULL) | NULL = entrada externa (recarga) |
| `carteira_destino_id` | UUID | S | — | FK → carteiras.id (SET NULL) | NULL = saída externa (saque) |
| `valor` | DECIMAL(15,2) | N | — | > 0 | Sempre positivo |
| `tipo` | VARCHAR(30) | N | — | CHECK IN ('recarga','debito_escrow','credito_escrow','reembolso_escrow','saque','comissao','compra_creditos') | |
| `metodo_pagamento` | VARCHAR(30) | N | 'interno' | — | 'multicaixa_express','transferencia','interno' |
| `descricao` | TEXT | S | — | — | Legível humano |
| `id_referencia` | UUID | S | — | — | contrato_id, escrow_id, compra_creditos_id |
| `tipo_referencia` | VARCHAR(30) | S | — | — | 'contrato','escrow','compra_creditos','saque' |
| `status` | VARCHAR(20) | N | 'concluido' | CHECK IN ('pendente','concluido','falhou') | |
| `criado_em` | TIMESTAMP | N | NOW() | — | **Imutável** |

**Tipos Principais:**
- `recarga`: Cliente adiciona Kz (entrada)
- `debito_escrow`: Cliente paga escrow (saída)
- `credito_escrow`: Freelancer recebe liberação (entrada)
- `reembolso_escrow`: Cliente recebe reembolso (entrada)
- `comissao`: Plataforma recebe 10% (entrada)
- `compra_creditos`: Cliente compra créditos (saída Kz → entrada créditos)
- `saque`: Freelancer saca (saída)

### `transacoes_escrow` (Imutável — Apenas INSERT + status/liberado_em)
| Campo | Tipo | Null | Default | Constraints | Descrição |
|-------|------|------|---------|-------------|-----------|
| `id` | UUID | N | — | PK | |
| `contrato_id` | UUID | N | — | FK → contratos.id (CASCADE) | |
| `carteira_origem_id` | UUID | N | — | FK → carteiras.id | Cliente |
| `carteira_destino_id` | UUID | N | — | FK → carteiras.id | Freelancer |
| `valor` | DECIMAL(15,2) | N | — | = contrato.valor_acordado | Total retido |
| `valor_comissao` | DECIMAL(15,2) | N | — | **Snapshot 10%** | `ROUND(valor * 0.10, 2)` |
| `valor_liquido_freelancer` | DECIMAL(15,2) | N | — | **Snapshot 90%** | `valor - valor_comissao` |
| `status_pagamento` | VARCHAR(20) | N | 'retido' | CHECK IN ('retido','liberado','devolvido_cliente') | Mutável: retido→liberado|devolvido |
| `metodo_liberacao` | VARCHAR(30) | S | — | — | 'aprovacao_cliente' ou 'decisao_admin' |
| `retido_em` | TIMESTAMP | N | NOW() | — | Momento da retenção |
| `liberado_em` | TIMESTAMP | S | — | — | Momento liberação/reembolso |

> **Regra:** `valor_comissao` e `valor_liquido_freelancer` são **calculados uma vez** na retenção (`EscrowService::reter`) e **nunca recalculados**. Garante que comissão não muda se config mudar.

### `transacoes_credito` (Imutável — Apenas INSERT)
| Campo | Tipo | Null | Default | Constraints | Descrição |
|-------|------|------|---------|-------------|-----------|
| `id` | UUID | N | — | PK | |
| `perfil_id` | UUID | N | — | FK → perfis.id (CASCADE) | Freelancer |
| `quantidade` | INT | N | — | — | Positivo = entrada, Negativo = saída |
| `tipo` | VARCHAR(30) | N | — | CHECK IN ('compra','gasto_proposta','boost','ajuste_admin') | |
| `descricao` | TEXT | S | — | — | |
| `id_referencia` | UUID | S | — | — | proposta_id, destaque_id |
| `tipo_referencia` | VARCHAR(30) | S | — | — | 'proposta','destaque' |
| `criado_em` | TIMESTAMP | N | NOW() | — | **Imutável** |

### `contadores` (Sequence para `numero_conta_interno`)
| Campo | Tipo | Null | Default | Constraints |
|-------|------|------|---------|-------------|
| `id` | INT | N | 1 | PK (single row) |
| `chave` | VARCHAR(50) | N | — | UK |
| `valor_atual` | BIGINT | N | — | Auto-increment manual |
| `atualizado_em` | TIMESTAMP | N | NOW() | — |

---

## 6. Comunicação

### `conversas` (1 por Contrato)
| Campo | Tipo | Null | Default | Constraints |
|-------|------|------|---------|-------------|
| `id` | UUID | N | — | PK |
| `contrato_id` | UUID | N | — | FK → contratos.id (CASCADE, UK) |
| `cliente_id` | UUID | N | — | FK → perfis.id (CASCADE) |
| `freelancer_id` | UUID | N | — | FK → perfis.id (CASCADE) |
| `ultima_mensagem_em` | TIMESTAMP | S | — | Para ordenação |
| `criado_em` | TIMESTAMP | N | NOW() | — |

### `mensagens`
| Campo | Tipo | Null | Default | Constraints | Descrição |
|-------|------|------|---------|-------------|-----------|
| `id` | UUID | N | — | PK | |
| `conversa_id` | UUID | N | — | FK → conversas.id (CASCADE) | |
| `remetente_id` | UUID | N | — | FK → perfis.id (CASCADE) | |
| `conteudo` | TEXT | S | — | — | Texto (se tipo=texto) |
| `tipo_mensagem` | VARCHAR(20) | N | 'texto' | CHECK IN ('texto','arquivo') | |
| `url_arquivo` | TEXT | S | — | — | Storage path (privado) |
| `nome_arquivo` | TEXT | S | — | — | Nome original |
| `tamanho_arquivo` | INT | S | — | — | Bytes |
| `lida` | BOOLEAN | N | FALSE | — | Marcação leitura |
| `criado_em` | TIMESTAMP | N | NOW() | — | **Sem updated_at** |

---

## 7. Avaliações e Disputas

### `avaliacoes`
| Campo | Tipo | Null | Default | Constraints | Descrição |
|-------|------|------|---------|-------------|-----------|
| `id` | UUID | N | — | PK | |
| `contrato_id` | UUID | N | — | FK → contratos.id (CASCADE) | Gate: contrato concluido+liberado |
| `avaliador_id` | UUID | N | — | FK → perfis.id (CASCADE) | Quem avalia |
| `avaliado_id` | UUID | N | — | FK → perfis.id (CASCADE) | Quem recebe |
| `nota` | TINYINT | N | — | CHECK BETWEEN 1 AND 5 | 1–5 estrelas |
| `comentario` | TEXT | S | — | — | Máx 1000 chars |
| `criado_em` | TIMESTAMP | N | NOW() | — | |

**UK:** `(contrato_id, avaliador_id)` — 1 avaliação por parte por contrato

### `disputas`
| Campo | Tipo | Null | Default | Constraints | Descrição |
|-------|------|------|---------|-------------|-----------|
| `id` | UUID | N | — | PK | |
| `contrato_id` | UUID | N | — | FK → contratos.id (CASCADE) | |
| `aberta_por` | UUID | N | — | FK → perfis.id (CASCADE) | Cliente ou freelancer |
| `motivo` | TEXT | N | — | — | Descrição obrigatória |
| `status` | VARCHAR(30) | N | 'aberta' | CHECK IN ('aberta','em_analise','resolvida_cliente','resolvida_freelancer','acordo_mutuo') | |
| `decisao_admin` | TEXT | S | — | — | Justificativa admin |
| `resolvida_em` | TIMESTAMP | S | — | — | |
| `criado_em` | TIMESTAMP | N | NOW() | — | |

---

## 8. Portfólio e Extras

### `portfolio_itens`
| Campo | Tipo | Null | Default | Constraints |
|-------|------|------|---------|-------------|
| `id` | UUID | N | — | PK |
| `freelancer_id` | UUID | N | — | FK → perfis.id (CASCADE) |
| `titulo` | TEXT | N | — | — |
| `descricao` | TEXT | S | — | — |
| `url_imagem` | TEXT | S | — | Storage path (público) |
| `url_projeto` | TEXT | S | — | Link externo (opcional) |
| `categoria_id` | UUID | S | — | FK → categorias.id (SET NULL) |
| `criado_em` | TIMESTAMP | N | NOW() | — |
| `atualizado_em` | TIMESTAMP | N | NOW() | — |

### `destaques` (Boost)
| Campo | Tipo | Null | Default | Constraints | Descrição |
|-------|------|------|---------|-------------|-----------|
| `id` | UUID | N | — | PK | |
| `freelancer_id` | UUID | N | — | FK → perfis.id (CASCADE) | |
| `status` | VARCHAR(20) | N | 'ativo' | — | 'ativo','expirado' |
| `creditos_gastos` | INT | N | — | — | Custo em créditos |
| `inicio_em` | TIMESTAMP | N | NOW() | — | |
| `expira_em` | TIMESTAMP | N | — | — | `inicio_em + 30d` (config) |
| `criado_em` | TIMESTAMP | N | NOW() | — | |

### `notificacoes`
| Campo | Tipo | Null | Default | Constraints | Descrição |
|-------|------|------|---------|-------------|-----------|
| `id` | UUID | N | — | PK | |
| `usuario_id` | UUID | N | — | FK → perfis.id (CASCADE) | Destinatário |
| `tipo` | VARCHAR(50) | N | — | — | 'proposta_recebida','proposta_aceita','proposta_rejeitada','mensagem_chat','trabalho_entregue','trabalho_aprovado','disputa_aberta','disputa_resolvida','job_expirado','creditos_baixos' |
| `titulo` | TEXT | N | — | — | Curto |
| `corpo` | TEXT | N | — | — | Detalhado |
| `id_referencia` | UUID | S | — | — | Entidade relacionada |
| `tipo_referencia` | VARCHAR(50) | S | — | — | 'proposta','contrato','mensagem','disputa','job' |
| `lida` | BOOLEAN | N | FALSE | — | |
| `criado_em` | TIMESTAMP | N | NOW() | — | |

### `saved_jobs` (Favoritos)
| Campo | Tipo | Null | Default | Constraints |
|-------|------|------|---------|-------------|
| `id` | UUID | N | — | PK |
| `job_id` | UUID | N | — | FK → trabalhos.id (CASCADE) |
| `user_id` | UUID | N | — | FK → perfis.id (CASCADE) |
| `criado_em` | TIMESTAMP | N | NOW() | — |
| **UK** | `(job_id, user_id)` | — | — | 1 favorito por user/job |

---

## 9. Valores de Enum (Referência Rápida)

| Tabela.Campo | Valores Permitidos |
|--------------|-------------------|
| `perfis.funcao` | `cliente`, `freelancer` |
| `trabalhos.status` | `rascunho`, `aberto`, `em_andamento`, `concluido`, `cancelado`, `arquivado` |
| `trabalhos.tipo_trabalho` | `preco_fixo`, `por_hora` |
| `trabalhos.tamanho_projeto` | `pequeno`, `medio`, `grande` |
| `trabalhos.nivel_experiencia` | `iniciante`, `intermediario`, `especialista` |
| `propostas.status` | `pendente`, `aceita`, `rejeitada` |
| `contratos.status_contrato` | `ativo`, `em_disputa`, `concluido`, `cancelado` |
| `contratos.status_pagamento` | `pendente`, `retido`, `liberado`, `devolvido_cliente` |
| `carteiras.tipo` | `usuario`, `plataforma` |
| `transacoes_carteiras.tipo` | `recarga`, `debito_escrow`, `credito_escrow`, `reembolso_escrow`, `saque`, `comissao`, `compra_creditos` |
| `transacoes_carteiras.status` | `pendente`, `concluido`, `falhou` |
| `transacoes_escrow.status_pagamento` | `retido`, `liberado`, `devolvido_cliente` |
| `transacoes_escrow.metodo_liberacao` | `aprovacao_cliente`, `decisao_admin` |
| `transacoes_credito.tipo` | `compra`, `gasto_proposta`, `boost`, `ajuste_admin` |
| `mensagens.tipo_mensagem` | `texto`, `arquivo` |
| `avaliacoes.nota` | `1`, `2`, `3`, `4`, `5` |
| `disputas.status` | `aberta`, `em_analise`, `resolvida_cliente`, `resolvida_freelancer`, `acordo_mutuo` |
| `notificacoes.tipo` | `proposta_recebida`, `proposta_aceita`, `proposta_rejeitada`, `mensagem_chat`, `trabalho_entregue`, `trabalho_aprovado`, `disputa_aberta`, `disputa_resolvida`, `job_expirado`, `creditos_baixos` |

---

## 10. Configuração de Valores Monetários (config/skilla.php)

```php
return [
    'comissao_percentual' => 0.10,        // 10% plataforma
    'pacotes_creditos' => [
        ['id' => 'basic', 'creditos' => 10, 'preco' => 1500.00],
        ['id' => 'pro', 'creditos' => 30, 'preco' => 4000.00],
        ['id' => 'premium', 'creditos' => 100, 'preco' => 12000.00],
    ],
    'limites' => [
        'min_recarga' => 500,      // Kz mínimo recarga carteira
        'min_saque' => 1000,       // Kz mínimo saque
        'max_job_valor' => 10000000, // 10M Kz max job (futuro)
        'max_saque_diario' => 500000, // 500K Kz/dia (futuro)
    ],
    'boost' => [
        'custo_creditos' => 50,      // Créditos para boost 30d
        'duracao_dias' => 30,
    ],
    'job' => [
        'expiracao_dias' => 30,      // Auto-cancelamento
        'max_propostas' => 15,       // Limite propostas/job
    ],
];
```

---

## Related docs
- [database-schema.md](database-schema.md)
- [database-dbml.md](database-dbml.md)
- [data-mapping.md](data-mapping.md)
- [../01-product/business-rules.md](../01-product/business-rules.md)
- [../02-architeture/ADRs/0003-escrow-audit-trail.md](../02-architeture/ADRs/0003-escrow-audit-trail.md)
- [../04-api/api-specification.md](../04-api/api-specification.md)