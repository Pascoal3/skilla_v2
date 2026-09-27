# Database DBML — Skilla

**Status:** Draft
**Owner:** TODO(USER)
**Last updated:** 2026-09-26

---

## DBML Completo

```dbml
// ==========================================
// SKILLA — Esquema do Banco de Dados (DBML)
// Baseado nas migrations atuais (nomes PT-BR)
// ==========================================

// ------------------------------------------
// Catálogos e Localização
// ------------------------------------------

Table provincias {
  id         uuid        [pk]
  nome       varchar(100) [not null, unique]
  sigla      varchar(5)   [unique]
  criado_em  timestamp   [not null, default: `now()`]
}

Table categorias {
  id         uuid        [pk]
  nome       varchar(100) [not null, unique]
  slug       varchar(120) [not null, unique]
  url_icone  text        [null]
  criado_em  timestamp   [not null, default: `now()`]
}

Table habilidades {
  id         uuid        [pk]
  nome       varchar(100) [not null, unique]
  categoria  varchar(50)  [not null]
  criado_em  timestamp   [not null, default: `now()`]
}

// ------------------------------------------
// Usuários e Perfis
// ------------------------------------------

Table perfis {
  id                       uuid        [pk]
  primeiro_nome            varchar(100) [not null]
  sobrenome                varchar(100) [not null]
  nome_usuario             varchar(80)  [not null, unique]
  email                    varchar(255) [not null, unique]
  password                 varchar(255) [not null, note: 'bcrypt hash']
  funcao                   varchar(20)  [not null, note: 'cliente | freelancer']
  email_verified_at        timestamp   [null]
  remember_token           varchar(100) [null]
  provincia_id             uuid        [ref: > provincias.id, note: 'SET NULL']
  localizacao              text        [null]
  url_avatar               text        [null]
  bio                      text        [null]
  telefone                 varchar(30) [null]
  saldo_creditos           int         [not null, default: 10, note: 'Apenas freelancer']
  esta_destacado           boolean     [not null, default: false]
  destaque_expira_em       timestamp   [null]
  avaliacao_media          decimal(3,2) [not null, default: 0.00]
  total_avaliacoes         int         [not null, default: 0]
  total_trabalhos_concluidos int       [not null, default: 0]
  esta_ativo               boolean     [not null, default: true]
  criado_em                timestamp   [not null, default: `now()`]
  atualizado_em            timestamp   [not null, default: `now()`]
  
  Indexes {
    funcao
    esta_ativo
    esta_destacado
    avaliacao_media
  }
}

Table perfil_habilidades {
  id             uuid      [pk]
  perfil_id      uuid      [not null, ref: > perfis.id, note: 'CASCADE']
  habilidade_id  uuid      [not null, ref: > habilidades.id, note: 'CASCADE']
  criado_em      timestamp [not null, default: `now()`]
  
  Indexes {
    (perfil_id, habilidade_id) [unique]
  }
}

// ------------------------------------------
// Jobs (Trabalhos)
// ------------------------------------------

Table trabalhos {
  id                       uuid            [pk]
  cliente_id               uuid            [not null, ref: > perfis.id, note: 'CASCADE']
  categoria_id             uuid            [ref: > categorias.id, note: 'SET NULL']
  titulo                   text            [null]
  tamanho_projeto          varchar(20)     [null, note: 'pequeno | medio | grande']
  duracao_estimada         varchar(50)     [null]
  nivel_experiencia        varchar(20)     [null, note: 'iniciante | intermediario | especialista']
  possibilidade_efetivacao boolean         [not null, default: false]
  tipo_trabalho            varchar(20)     [null, note: 'preco_fixo | por_hora']
  orcamento_fixo           decimal(15,2)   [null]
  taxa_hora_min            decimal(15,2)   [null]
  taxa_hora_max            decimal(15,2)   [null]
  descricao                text            [null]
  status                   varchar(20)     [not null, default: 'rascunho', note: 'rascunho | aberto | em_andamento | concluido | cancelado | arquivado']
  proposta_aceita_id       uuid            [ref: > propostas.id, note: 'SET NULL']
  contagem_visualizacoes   int             [not null, default: 0]
  prazo                    date            [null]
  expira_em                date            [null, note: 'Auto-cancelamento 30 dias']
  criado_em                timestamp       [not null, default: `now()`]
  atualizado_em            timestamp       [not null, default: `now()`]
  
  Indexes {
    cliente_id
    categoria_id
    (status, criado_em)
    expira_em
  }
}

Table trabalho_habilidades {
  id             uuid [pk]
  trabalho_id    uuid [not null, ref: > trabalhos.id, note: 'CASCADE']
  habilidade_id  uuid [not null, ref: > habilidades.id, note: 'CASCADE']
  
  Indexes {
    (trabalho_id, habilidade_id) [unique]
  }
}

Table trabalho_anexos {
  id            uuid   [pk]
  trabalho_id   uuid   [not null, ref: > trabalhos.id, note: 'CASCADE']
  nome_arquivo  text   [not null]
  url_arquivo   text   [not null]
  tamanho_bytes int    [null]
  criado_em     timestamp [not null, default: `now()`]
}

// ------------------------------------------
// Propostas e Contratos
// ------------------------------------------

Table propostas {
  id                   uuid            [pk]
  trabalho_id          uuid            [not null, ref: > trabalhos.id, note: 'CASCADE']
  freelancer_id        uuid            [not null, ref: > perfis.id, note: 'CASCADE']
  carta_apresentacao   text            [not null]
  valor_proposto       decimal(15,2)   [not null]
  dias_entrega         int             [not null]
  status               varchar(20)     [not null, default: 'pendente', note: 'pendente | aceita | rejeitada']
  creditos_gastos      int             [not null, default: 1]
  criado_em            timestamp       [not null, default: `now()`]
  atualizado_em        timestamp       [not null, default: `now()`]
  
  Indexes {
    trabalho_id
    (freelancer_id, status)
  }
  
  // Unique constraint: 1 proposta por freelancer por trabalho
  // (trabalho_id, freelancer_id) [unique] — implementado via migration
}

Table contratos {
  id                   uuid            [pk]
  trabalho_id          uuid            [not null, ref: > trabalhos.id, note: 'CASCADE']
  proposta_id          uuid            [not null, ref: > propostas.id, note: 'CASCADE']
  cliente_id           uuid            [not null, ref: > perfis.id, note: 'CASCADE']
  freelancer_id        uuid            [not null, ref: > perfis.id, note: 'CASCADE']
  status_contrato      varchar(20)     [not null, default: 'ativo', note: 'ativo | em_disputa | concluido | cancelado']
  valor_acordado       decimal(15,2)   [not null]
  comissao_plataforma  decimal(15,2)   [null, note: '10% snapshot na retenção']
  valor_freelancer     decimal(15,2)   [null, note: '90% snapshot na retenção']
  dias_entrega         int             [not null]
  data_limite          date            [null]
  status_pagamento     varchar(20)     [not null, default: 'pendente', note: 'pendente | retido | liberado | devolvido_cliente']
  trabalho_entregue_em timestamp       [null]
  aprovado_em          timestamp       [null]
  criado_em            timestamp       [not null, default: `now()`]
  atualizado_em        timestamp       [not null, default: `now()`]
  
  Indexes {
    cliente_id
    freelancer_id
    status_contrato
    status_pagamento
  }
}

// ------------------------------------------
// Financeiro (Carteira, Escrow, Créditos)
// ------------------------------------------

Table carteiras {
  id                    uuid            [pk]
  usuario_id            uuid            [ref: > perfis.id, note: 'SET NULL, UNIQUE (1 por usuário)']
  iban_virtual          varchar(21)     [unique, null]
  numero_conta_interno  bigint          [unique, null]
  saldo                 decimal(15,2)   [not null, default: 0.00, note: 'Nunca negativo (CHECK + lockForUpdate)']
  tipo                  varchar(20)     [not null, default: 'usuario', note: 'usuario | plataforma']
  moeda                 varchar(3)      [not null, default: 'AOA']
  criado_em             timestamp       [not null, default: `now()`]
  atualizado_em         timestamp       [not null, default: `now()`]
  
  Indexes {
    tipo
    usuario_id [unique]
  }
}

Table transacoes_carteiras {
  id                    uuid            [pk]
  carteira_origem_id    uuid            [ref: > carteiras.id, note: 'SET NULL (entrada externa)']
  carteira_destino_id   uuid            [ref: > carteiras.id, note: 'SET NULL (saída externa)']
  valor                 decimal(15,2)   [not null, note: 'Sempre positivo']
  tipo                  varchar(30)     [not null, note: 'recarga | debito_escrow | credito_escrow | reembolso_escrow | saque | comissao | compra_creditos']
  metodo_pagamento      varchar(30)     [not null, default: 'interno', note: 'multicaixa_express | transferencia | interno']
  descricao             text            [null]
  id_referencia         uuid            [null]
  tipo_referencia       varchar(30)     [null, note: 'contrato | escrow | compra_creditos | saque']
  status                varchar(20)     [not null, default: 'concluido', note: 'pendente | concluido | falhou']
  criado_em             timestamp       [not null, default: `now()`, note: 'IMUTÁVEL - apenas INSERT']
  
  Indexes {
    (carteira_origem_id, carteira_destino_id) [name: 'idx_carteiras_origem_destino']
    tipo_referencia
    id_referencia
  }
}

Table transacoes_escrow {
  id                       uuid            [pk]
  contrato_id              uuid            [not null, ref: > contratos.id, note: 'CASCADE']
  carteira_origem_id       uuid            [not null, ref: > carteiras.id, note: 'Cliente']
  carteira_destino_id      uuid            [not null, ref: > carteiras.id, note: 'Freelancer']
  valor                    decimal(15,2)   [not null]
  valor_comissao           decimal(15,2)   [not null, note: '10% snapshot']
  valor_liquido_freelancer decimal(15,2)   [not null, note: '90% snapshot']
  status_pagamento         varchar(20)     [not null, default: 'retido', note: 'retido | liberado | devolvido_cliente']
  metodo_liberacao         varchar(30)     [null, note: 'aprovacao_cliente | decisao_admin']
  retido_em                timestamp       [not null, default: `now()`]
  liberado_em              timestamp       [null]
  
  // Imutável exceto: status_pagamento, liberado_em, metodo_liberacao
}

Table transacoes_credito {
  id               uuid      [pk]
  perfil_id        uuid      [not null, ref: > perfis.id, note: 'CASCADE']
  quantidade       int       [not null, note: '+entrada / -saída']
  tipo             varchar(30) [not null, note: 'compra | gasto_proposta | boost | ajuste_admin']
  descricao        text      [null]
  id_referencia    uuid      [null]
  tipo_referencia  varchar(30) [null, note: 'proposta | destaque']
  criado_em        timestamp [not null, default: `now()`, note: 'IMUTÁVEL - apenas INSERT']
}

Table contadores {
  id              int       [pk]
  chave           varchar(50) [unique]
  valor_atual     bigint    [not null]
  atualizado_em   timestamp [not null]
}

// ------------------------------------------
// Comunicação
// ------------------------------------------

Table conversas {
  id                 uuid      [pk]
  contrato_id        uuid      [not null, unique, ref: > contratos.id, note: 'CASCADE']
  cliente_id         uuid      [not null, ref: > perfis.id, note: 'CASCADE']
  freelancer_id      uuid      [not null, ref: > perfis.id, note: 'CASCADE']
  ultima_mensagem_em timestamp [null]
  criado_em          timestamp [not null, default: `now()`]
}

Table mensagens {
  id                 uuid      [pk]
  conversa_id        uuid      [not null, ref: > conversas.id, note: 'CASCADE']
  remetente_id       uuid      [not null, ref: > perfis.id, note: 'CASCADE']
  conteudo           text      [null]
  tipo_mensagem      varchar(20) [not null, default: 'texto', note: 'texto | arquivo']
  url_arquivo        text      [null]
  nome_arquivo       text      [null]
  tamanho_arquivo    int       [null]
  lida               boolean   [not null, default: false]
  criado_em          timestamp [not null, default: `now()`, note: 'Sem updated_at']
}

// ------------------------------------------
// Avaliações e Disputas
// ------------------------------------------

Table avaliacoes {
  id            uuid      [pk]
  contrato_id   uuid      [not null, ref: > contratos.id, note: 'CASCADE']
  avaliador_id  uuid      [not null, ref: > perfis.id, note: 'CASCADE']
  avaliado_id   uuid      [not null, ref: > perfis.id, note: 'CASCADE']
  nota          tinyint   [not null, note: '1-5']
  comentario    text      [null]
  criado_em     timestamp [not null, default: `now()`]
  
  Indexes {
    (contrato_id, avaliador_id) [unique]
  }
}

Table disputas {
  id               uuid      [pk]
  contrato_id      uuid      [not null, ref: > contratos.id, note: 'CASCADE']
  aberta_por       uuid      [not null, ref: > perfis.id, note: 'CASCADE']
  motivo           text      [not null]
  status           varchar(30) [not null, default: 'aberta', note: 'aberta | em_analise | resolvida_cliente | resolvida_freelancer | acordo_mutuo']
  decisao_admin    text      [null]
  resolvida_em     timestamp [null]
  criado_em        timestamp [not null, default: `now()`]
}

// ------------------------------------------
// Portfólio e Extras
// ------------------------------------------

Table portfolio_itens {
  id            uuid      [pk]
  freelancer_id uuid      [not null, ref: > perfis.id, note: 'CASCADE']
  titulo        text      [not null]
  descricao     text      [null]
  url_imagem    text      [null]
  url_projeto   text      [null]
  categoria_id  uuid      [ref: > categorias.id, note: 'SET NULL']
  criado_em     timestamp [not null, default: `now()`]
  atualizado_em timestamp [not null, default: `now()`]
}

Table destaques {
  id               uuid      [pk]
  freelancer_id    uuid      [not null, ref: > perfis.id, note: 'CASCADE']
  status           varchar(20) [not null, default: 'ativo']
  creditos_gastos  int       [not null]
  inicio_em        timestamp [not null, default: `now()`]
  expira_em        timestamp [not null]
  criado_em        timestamp [not null, default: `now()`]
}

Table notificacoes {
  id               uuid      [pk]
  usuario_id       uuid      [not null, ref: > perfis.id, note: 'CASCADE']
  tipo             varchar(50) [not null, note: 'proposta_recebida | proposta_aceita | proposta_rejeitada | mensagem_chat | trabalho_entregue | trabalho_aprovado | disputa_aberta | disputa_resolvida | job_expirado | creditos_baixos']
  titulo           text      [not null]
  corpo            text      [not null]
  id_referencia    uuid      [null]
  tipo_referencia  varchar(50) [null]
  lida             boolean   [not null, default: false]
  criado_em        timestamp [not null, default: `now()`]
}

Table saved_jobs {
  id         uuid      [pk]
  job_id     uuid      [not null, ref: > trabalhos.id, note: 'CASCADE']
  user_id    uuid      [not null, ref: > perfis.id, note: 'CASCADE']
  criado_em  timestamp [not null, default: `now()`]
  
  Indexes {
    (job_id, user_id) [unique]
  }
}
```

---

## Notas de Implementação

1. **Nomes PT-BR**: Todas as tabelas e colunas usam português (ex.: `trabalhos`, `propostas`, `carteiras`) — alinhado com o domínio e equipe.
2. **UUID Ordered**: `HasUuid` trait gera UUID v4 ordered (timestamp-first) para melhor performance de índice.
3. **Money**: `DECIMAL(15,2)` em **todas** colunas monetárias — evita problemas de ponto flutuante.
4. **Imutabilidade**: Tabelas `transacoes_*` são **append-only** (apenas INSERT). Enforced via Policies + Code Review.
5. **FKs**: `CASCADE` para dependências fortes (job→propostas), `SET NULL` para referências opcionais (job→categoria), `RESTRICT` implícito para catálogos (não deletar categoria se usada).
6. **Índices Compostos**: Otimizados para queries reais: `(status, criado_em)`, `(freelancer_id, status)`, `(carteira_origem_id, carteira_destino_id)`.
6. **Tabelas Legadas**: Tabelas com nomes EN (`jobs`, `proposals`, `contracts`, `wallets`, etc.) existem no código mas **não são usadas** — remoção planejada em limpeza futura.

---

## Related docs
- [database-schema.md](database-schema.md) (Descrição tabular detalhada)
- [data-mapping.md](data-mapping.md) (Fluxos → Tabelas)
- [data-dictionary.md](data-dictionary.md) (Campos críticos)
- [../02-architeture/ADRs/0003-escrow-audit-trail.md](../02-architeture/ADRs/0003-escrow-audit-trail.md)
- [../01-product/business-rules.md](../01-product/business-rules.md)