// ==========================================
// SKILLA — Esquema do Banco de Dados Atualizado
// Foco: Flexibilidade, Rascunhos, Ciclo de Vida e Geolocalização
// ==========================================

// Tabela de Províncias para padronização de localização
Table provincias {
  id         uuid      [pk]
  nome       text      [not null, unique] // Ex: Luanda, Benguela, Huíla...
  sigla      varchar   [unique]           // Ex: LUE, BEN, HUI...
  criado_em  timestamp [not null, default: `now()`]
}

Table perfis {
  id                   uuid        [pk]
  primeiro_nome        text        [not null] // Para exibição no Painel
  sobrenome            text        [not null]
  nome_usuario         text        [not null, unique]
  email                text        [not null, unique]
  password_hash        text        [not null, note: 'Senha criptografada utilizando bcrypt ou argon2']
  funcao               varchar     [not null, note: 'cliente | freelancer | admin']
  
  // Localização
  provincia_id         uuid        [ref: > provincias.id] // Mapeamento da província do formulário
  localizacao          text        [note: 'Bairro ou endereço detalhado']
  
  url_avatar           text
  bio                  text
  telefone             text
  saldo_creditos       int         [not null, default: 10]
  esta_destacado       boolean     [not null, default: false]
  destaque_expira_em   timestamp
  avaliacao_media      float       [not null, default: 0]
  total_avaliacoes     int         [not null, default: 0]
  total_trabalhos_concluidos int   [not null, default: 0]
  esta_ativo           boolean     [not null, default: true]
  criado_em            timestamp   [not null, default: `now()`]
  atualizado_em        timestamp   [not null, default: `now()`]
}

Table habilidades {
  id         uuid      [pk]
  nome       text      [not null, unique]
  categoria  text      [not null]
  criado_em  timestamp [not null, default: `now()`]
}

Table perfil_habilidades {
  id              uuid      [pk]
  perfil_id       uuid      [not null, ref: > perfis.id]
  habilidade_id   uuid      [not null, ref: > habilidades.id]
  criado_em       timestamp [not null, default: `now()`]

  indexes {
    (perfil_id, habilidade_id) [unique]
  }
}

Table categorias {
  id         uuid      [pk]
  nome       text      [not null, unique]
  slug       text      [not null, unique]
  url_icone  text
  criado_em  timestamp [not null, default: `now()`]
}

// ==========================================
// TRABALHOS (Suporte a Rascunhos)
// ==========================================
Table trabalhos {
  id                   uuid      [pk]
  cliente_id           uuid      [not null, ref: > perfis.id]
  categoria_id         uuid      [ref: > categorias.id, note: 'Opcional em rascunhos, obrigatório ao publicar']
  titulo               text      [note: 'Opcional em rascunhos, obrigatório ao publicar']
  tamanho_projeto      varchar   [note: 'pequeno | medio | grande']
  duracao_estimada     varchar   [note: 'Ex: 1 a 3 meses']
  nivel_experiencia    varchar   [note: 'iniciante | intermediario | especialista']
  possibilidade_efetivacao boolean [default: false]
  tipo_trabalho        varchar   [note: 'preco_fixo | por_hora - Opcional em rascunhos']
  orcamento_fixo       float     
  taxa_hora_min        float     
  taxa_hora_max        float     
  descricao            text      [note: 'Opcional em rascunhos, obrigatório ao publicar']
  
  status               varchar   [not null, default: 'rascunho', note: 'rascunho | aberto | em_andamento | concluido | cancelado | arquivado']
  proposta_aceita_id   uuid      [ref: > propostas.id]
  contagem_visualizacoes int     [not null, default: 0]
  
  prazo                date
  expira_em            date      [note: 'Para o "Sistema" cancelar automaticamente jobs inativos após X dias']
  criado_em            timestamp   [not null, default: `now()`]
  atualizado_em        timestamp   [not null, default: `now()`]

  indexes {
    cliente_id
    categoria_id
    (status, criado_em)
  }
}

Table trabalho_habilidades {
  id            uuid [pk]
  trabalho_id   uuid [not null, ref: > trabalhos.id]
  habilidade_id uuid [not null, ref: > habilidades.id]

  indexes {
    (trabalho_id, habilidade_id) [unique]
  }
}

Table trabalho_anexos {
  id            uuid      [pk]
  trabalho_id   uuid      [not null, ref: > trabalhos.id]
  nome_arquivo  text      [not null]
  url_arquivo   text      [not null]
  tamanho_bytes int
  criado_em     timestamp [not null, default: `now()`]
}

// ==========================================
// PROPOSTAS E CONTRATOS
// ==========================================
Table propostas {
  id                 uuid      [pk]
  trabalho_id        uuid      [not null, ref: > trabalhos.id]
  freelancer_id      uuid      [not null, ref: > perfis.id]
  carta_apresentacao text      [not null]
  valor_proposto     float     [not null]
  dias_entrega       int       [not null]
  status             varchar   [not null, default: 'pendente', note: 'pendente | aceita | rejeitada']
  creditos_gastos    int       [not null, default: 1]
  criado_em          timestamp [not null, default: `now()`]
  atualizado_em      timestamp [not null, default: `now()`]

  indexes {
    trabalho_id
    (freelancer_id, status)
  }
}

Table contratos {
  id                  uuid      [pk]
  trabalho_id         uuid      [not null, ref: > trabalhos.id]
  proposta_id         uuid      [not null, ref: > propostas.id]
  cliente_id          uuid      [not null, ref: > perfis.id]
  freelancer_id       uuid      [not null, ref: > perfis.id]
  
  status_contrato     varchar   [not null, default: 'ativo', note: 'ativo | em_disputa | concluido | cancelado']
  valor_acordado      float     [not null]
  comissao_plataforma float     
  valor_freelancer    float     
  
  dias_entrega        int       [not null]
  data_limite         date
  status_pagamento    varchar   [not null, default: 'pendente', note: 'pendente | retido | liberado | devolvido_cliente']
  
  trabalho_entregue_em timestamp
  aprovado_em         timestamp
  criado_em           timestamp [not null, default: `now()`]
  atualizado_em       timestamp [not null, default: `now()`]
  
  indexes {
    cliente_id
    freelancer_id
  }
}

Table disputas {
  id                  uuid      [pk]
  contrato_id         uuid      [not null, ref: > contratos.id]
  aberta_por          uuid      [not null, ref: > perfis.id]
  motivo              text      [not null]
  status              varchar   [not null, default: 'aberta', note: 'aberta | em_analise | resolvida_cliente | resolvida_freelancer | acordo_mutuo']
  decisao_admin       text      
  criado_em           timestamp [not null, default: `now()`]
  resolvida_em        timestamp
}

// ==========================================
// SISTEMA DE CARTEIRAS E ESCROW
// ==========================================
Table carteiras {
  id            uuid      [pk]
  usuario_id    uuid      [not null, unique, ref: > perfis.id]
  saldo         decimal(15,2) [not null, default: 0]
  tipo          varchar   [not null, default: 'usuario', note: 'usuario | plataforma']
  moeda         varchar   [not null, default: 'AOA']
  criado_em     timestamp [not null, default: `now()`]
  atualizado_em timestamp [not null, default: `now()`]
}

Table transacoes_carteiras {
  id              uuid      [pk]
  carteira_origem_id uuid   [ref: > carteiras.id]
  carteira_destino_id uuid  [ref: > carteiras.id]
  valor           decimal(15,2) [not null]
  tipo            varchar   [not null, note: 'recarga | debito_escrow | credito_escrow | reembolso_escrow | saque | comissao']
  metodo_pagamento varchar  [default: 'interno']
  descricao       text
  id_referencia   uuid      
  status          varchar   [not null, default: 'concluido', note: 'pendente | concluido | falhou']
  criado_em       timestamp [not null, default: `now()`]
}

Table transacoes_escrow {
  id                    uuid      [pk]
  contrato_id           uuid      [not null, ref: > contratos.id]
  carteira_origem_id    uuid      [not null, ref: > carteiras.id]
  carteira_destino_id   uuid      [not null, ref: > carteiras.id]
  valor                 decimal(15,2) [not null]
  valor_comissao        decimal(15,2) [not null]
  valor_liquido_freelancer decimal(15,2) [not null]
  status_pagamento      varchar   [not null, default: 'retido', note: 'retido | liberado | devolvido_cliente']
  metodo_liberacao      varchar   [note: 'aprovacao_cliente | decisao_admin']
  retido_em             timestamp [not null, default: `now()`]
  liberado_em           timestamp
}

Table conversas {
  id                 uuid      [pk]
  contrato_id        uuid      [not null, unique, ref: - contratos.id]
  cliente_id         uuid      [not null, ref: > perfis.id]
  freelancer_id      uuid      [not null, ref: > perfis.id]
  ultima_mensagem_em timestamp
  criado_em          timestamp [not null, default: `now()`]
}

Table mensagens {
  id              uuid      [pk]
  conversa_id     uuid      [not null, ref: > conversas.id]
  remetente_id    uuid      [not null, ref: > perfis.id]
  conteudo        text
  tipo_mensagem   varchar   [not null, default: 'texto']
  url_arquivo     text
  nome_arquivo    text
  tamanho_arquivo int
  lida            boolean   [not null, default: false]
  criado_em       timestamp [not null, default: `now()`]
}

Table avaliacoes {
  id           uuid      [pk]
  contrato_id  uuid      [not null, ref: > contratos.id]
  avaliador_id uuid      [not null, ref: > perfis.id]
  avaliado_id  uuid      [not null, ref: > perfis.id]
  nota         int       [not null]
  comentario   text
  criado_em     timestamp [not null, default: `now()`]
}

Table itens_portfolio {
  id            uuid      [pk]
  freelancer_id uuid      [not null, ref: > perfis.id]
  titulo        text      [not null]
  descricao     text
  url_imagem    text
  url_projeto   text
  categoria_id  uuid      [ref: > categorias.id]
  criado_em     timestamp [not null, default: `now()`]
  atualizado_em timestamp [not null, default: `now()`]
}

Table notificacoes {
  id              uuid      [pk]
  usuario_id      uuid      [not null, ref: > perfis.id]
  tipo            varchar   [not null]
  titulo          text      [not null]
  corpo           text      [not null]
  id_referencia   uuid
  tipo_referencia varchar   
  lida            boolean   [not null, default: false]
  criado_em       timestamp [not null, default: `now()`]
}

Table destaques {
  id              uuid      [pk]
  freelancer_id   uuid      [not null, ref: > perfis.id]
  status          varchar   [not null, default: 'ativo']
  creditos_gastos int       [not null]
  inicio_em       timestamp [not null, default: `now()`]
  expira_em       timestamp [not null]
  criado_em       timestamp [not null, default: `now()`]
}