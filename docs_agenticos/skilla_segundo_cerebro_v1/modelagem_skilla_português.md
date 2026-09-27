
```

// ==========================================

// SKILLA — Esquema do Banco de Dados Atualizado (Banco Skilla)

// Inclui: Contadores, Carteiras com IBAN, Transações de Crédito e padronizações

// ==========================================

  

// Tabela de contadores para geração sequencial (Opção A)

Table contadores {

  id            int [pk, increment]

  chave         varchar(100) [not null, unique, note: 'Ex: numero_conta_interno']

  valor_atual   bigint [not null, default: 0, note: 'Próximo número a ser utilizado']

  atualizado_em timestamp [not null, default: `now()`]

}

  

// Tabela de Províncias

Table provincias {

  id         uuid [pk]

  nome       text [not null, unique]

  sigla      varchar [unique]

  criado_em  timestamp [not null, default: `now()`]

}

  

Table perfis {

  id                          uuid [pk]

  primeiro_nome               text [not null]

  sobrenome                   text [not null]

  nome_usuario                text [not null, unique]

  email                       text [not null, unique]

  password_hash               text [not null]

  funcao                      varchar [not null, note: 'cliente | freelancer | admin']

  provincia_id                uuid [ref: > provincias.id]

  localizacao                 text

  url_avatar                  text

  bio                         text

  telefone                    text

  saldo_creditos              int [not null, default: 10]

  esta_destacado              boolean [not null, default: false]

  destaque_expira_em          timestamp

  avaliacao_media             float [not null, default: 0]

  total_avaliacoes            int [not null, default: 0]

  total_trabalhos_concluidos  int [not null, default: 0]

  esta_ativo                  boolean [not null, default: true]

  criado_em                   timestamp [not null, default: `now()`]

  atualizado_em               timestamp [not null, default: `now()`]

}

  

Table habilidades {

  id         uuid [pk]

  nome       text [not null, unique]

  categoria  text [not null]

  criado_em  timestamp [not null, default: `now()`]

}

  

Table perfil_habilidades {

  id             uuid [pk]

  perfil_id      uuid [not null, ref: > perfis.id]

  habilidade_id  uuid [not null, ref: > habilidades.id]

  criado_em      timestamp [not null, default: `now()`]

  

  indexes {

    (perfil_id, habilidade_id) [unique]

  }

}

  

Table categorias {

  id         uuid [pk]

  nome       text [not null, unique]

  slug       text [not null, unique]

  url_icone  text

  criado_em  timestamp [not null, default: `now()`]

}

  

// Trabalhos

Table trabalhos {

  id                          uuid [pk]

  cliente_id                  uuid [not null, ref: > perfis.id]

  categoria_id                uuid [ref: > categorias.id]

  titulo                      text

  tamanho_projeto             varchar

  duracao_estimada            varchar

  nivel_experiencia           varchar

  possibilidade_efetivacao    boolean [default: false]

  tipo_trabalho               varchar [note: 'preco_fixo | por_hora']

  orcamento_fixo              decimal(15,2)

  taxa_hora_min               decimal(15,2)

  taxa_hora_max               decimal(15,2)

  descricao                   text

  status                      varchar [not null, default: 'rascunho', note: 'rascunho | aberto | em_andamento | concluido | cancelado | arquivado']

  proposta_aceita_id          uuid [ref: > propostas.id]

  contagem_visualizacoes      int [not null, default: 0]

  prazo                       date

  expira_em                   date

  criado_em                   timestamp [not null, default: `now()`]

  atualizado_em               timestamp [not null, default: `now()`]

  

  indexes {

    cliente_id

    categoria_id

    (status, criado_em)

  }

}

  

Table trabalho_habilidades {

  id             uuid [pk]

  trabalho_id    uuid [not null, ref: > trabalhos.id]

  habilidade_id  uuid [not null, ref: > habilidades.id]

  

  indexes {

    (trabalho_id, habilidade_id) [unique]

  }

}

  

Table trabalho_anexos {

  id            uuid [pk]

  trabalho_id   uuid [not null, ref: > trabalhos.id]

  nome_arquivo  text [not null]

  url_arquivo   text [not null]

  tamanho_bytes int

  criado_em     timestamp [not null, default: `now()`]

}

  

// Propostas e Contratos

Table propostas {

  id                  uuid [pk]

  trabalho_id         uuid [not null, ref: > trabalhos.id]

  freelancer_id       uuid [not null, ref: > perfis.id]

  carta_apresentacao  text [not null]

  valor_proposto      decimal(15,2) [not null]

  dias_entrega        int [not null]

  status              varchar [not null, default: 'pendente', note: 'pendente | aceita | rejeitada']

  creditos_gastos     int [not null, default: 1]

  criado_em           timestamp [not null, default: `now()`]

  atualizado_em       timestamp [not null, default: `now()`]

  

  indexes {

    trabalho_id

    (freelancer_id, status)

  }

}

  

Table contratos {

  id                     uuid [pk]

  trabalho_id            uuid [not null, ref: > trabalhos.id]

  proposta_id            uuid [not null, ref: > propostas.id]

  cliente_id             uuid [not null, ref: > perfis.id]

  freelancer_id          uuid [not null, ref: > perfis.id]

  status_contrato        varchar [not null, default: 'ativo', note: 'ativo | em_disputa | concluido | cancelado']

  valor_acordado         decimal(15,2) [not null]

  comissao_plataforma    decimal(15,2)

  valor_freelancer       decimal(15,2)

  dias_entrega           int [not null]

  data_limite            date

  status_pagamento       varchar [not null, default: 'pendente', note: 'pendente | retido | liberado | devolvido_cliente']

  trabalho_entregue_em   timestamp

  aprovado_em            timestamp

  criado_em              timestamp [not null, default: `now()`]

  atualizado_em          timestamp [not null, default: `now()`]

  

  indexes {

    cliente_id

    freelancer_id

  }

}

  

Table disputas {

  id            uuid [pk]

  contrato_id   uuid [not null, ref: > contratos.id]

  aberta_por    uuid [not null, ref: > perfis.id]

  motivo        text [not null]

  status        varchar [not null, default: 'aberta', note: 'aberta | em_analise | resolvida_cliente | resolvida_freelancer | acordo_mutuo']

  decisao_admin text

  criado_em     timestamp [not null, default: `now()`]

  resolvida_em  timestamp

}

  

// Carteiras e Transações

Table carteiras {

  id                    uuid [pk]

  usuario_id            uuid [ref: > perfis.id, note: 'Nullable para carteira plataforma']

  iban_virtual          varchar(21) [unique, note: 'IBAN virtual Skilla']

  numero_conta_interno  bigint [unique, note: 'Número sequencial gerado via contador']

  saldo                 decimal(15,2) [not null, default: 0]

  tipo                  varchar [not null, default: 'usuario', note: 'usuario | plataforma']

  moeda                 varchar [not null, default: 'AOA']

  criado_em             timestamp [not null, default: `now()`]

  atualizado_em         timestamp [not null, default: `now()`]

  

  indexes {

    usuario_id

    tipo

  }

}

  

Table transacoes_carteiras {

  id                    uuid [pk]

  carteira_origem_id    uuid [ref: > carteiras.id]

  carteira_destino_id   uuid [ref: > carteiras.id]

  valor                 decimal(15,2) [not null]

  tipo                  varchar [not null, note: 'recarga | debito_escrow | credito_escrow | reembolso_escrow | saque | comissao | compra_creditos']

  metodo_pagamento      varchar [default: 'interno']

  descricao             text

  id_referencia         uuid

  tipo_referencia       varchar

  status                varchar [not null, default: 'concluido', note: 'pendente | concluido | falhou']

  criado_em             timestamp [not null, default: `now()`]

}

  

Table transacoes_escrow {

  id                          uuid [pk]

  contrato_id                 uuid [not null, ref: > contratos.id]

  carteira_origem_id          uuid [not null, ref: > carteiras.id]

  carteira_destino_id         uuid [not null, ref: > carteiras.id]

  valor                       decimal(15,2) [not null]

  valor_comissao              decimal(15,2) [not null]

  valor_liquido_freelancer    decimal(15,2) [not null]

  status_pagamento            varchar [not null, default: 'retido', note: 'retido | liberado | devolvido_cliente']

  metodo_liberacao            varchar [note: 'aprovacao_cliente | decisao_admin']

  retido_em                   timestamp [not null, default: `now()`]

  liberado_em                 timestamp

}

  

// Transações de Créditos

Table transacoes_credito {

  id                uuid [pk]

  perfil_id         uuid [not null, ref: > perfis.id]

  quantidade        int [not null, note: 'Positivo para compra, negativo para gasto']

  tipo              varchar [not null, note: 'compra | gasto_proposta | boost | ajuste_admin']

  descricao         text

  id_referencia     uuid

  tipo_referencia   varchar

  criado_em         timestamp [not null, default: `now()`]

}

  

// Comunicação

Table conversas {

  id                  uuid [pk]

  contrato_id         uuid [not null, unique, ref: - contratos.id]

  cliente_id          uuid [not null, ref: > perfis.id]

  freelancer_id       uuid [not null, ref: > perfis.id]

  ultima_mensagem_em  timestamp

  criado_em           timestamp [not null, default: `now()`]

}

  

Table mensagens {

  id                uuid [pk]

  conversa_id       uuid [not null, ref: > conversas.id]

  remetente_id      uuid [not null, ref: > perfis.id]

  conteudo          text

  tipo_mensagem     varchar [not null, default: 'texto']

  url_arquivo       text

  nome_arquivo      text

  tamanho_arquivo   int

  lida              boolean [not null, default: false]

  criado_em         timestamp [not null, default: `now()`]

}

  

// Reputação e outros

Table avaliacoes {

  id            uuid [pk]

  contrato_id   uuid [not null, ref: > contratos.id]

  avaliador_id  uuid [not null, ref: > perfis.id]

  avaliado_id   uuid [not null, ref: > perfis.id]

  nota          int [not null]

  comentario    text

  criado_em     timestamp [not null, default: `now()`]

}

  

Table itens_portfolio {

  id             uuid [pk]

  freelancer_id  uuid [not null, ref: > perfis.id]

  titulo         text [not null]

  descricao      text

  url_imagem     text

  url_projeto    text

  categoria_id   uuid [ref: > categorias.id]

  criado_em      timestamp [not null, default: `now()`]

  atualizado_em  timestamp [not null, default: `now()`]

}

  

Table notificacoes {

  id                uuid [pk]

  usuario_id        uuid [not null, ref: > perfis.id]

  tipo              varchar [not null]

  titulo            text [not null]

  corpo             text [not null]

  id_referencia     uuid

  tipo_referencia   varchar

  lida              boolean [not null, default: false]

  criado_em         timestamp [not null, default: `now()`]

}

  

Table destaques {

  id                uuid [pk]

  freelancer_id     uuid [not null, ref: > perfis.id]

  status            varchar [not null, default: 'ativo']

  creditos_gastos   int [not null]

  inicio_em         timestamp [not null, default: `now()`]

  expira_em         timestamp [not null]

  criado_em         timestamp [not null, default: `now()`]

}
```