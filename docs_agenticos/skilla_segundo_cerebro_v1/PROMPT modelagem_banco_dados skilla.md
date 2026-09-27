
Para traduzir e mandar ao dbdiagram.


```
// SKILLA — Database Schema

// Format: DBML (dbdiagram.io)

  

Table profiles {

  id                   uuid        [pk]

  full_name            text        [not null]

  username             text        [not null, unique]

  email                text        [not null, unique]

  role                 varchar     [not null, note: 'client | freelancer']

  avatar_url           text

  bio                  text

  location             text

  phone                text

  credits_balance      int         [not null, default: 10]

  is_boosted           boolean     [not null, default: false]

  boost_expires_at     timestamp

  avg_rating           float       [not null, default: 0]

  total_reviews        int         [not null, default: 0]

  total_jobs_completed int         [not null, default: 0]

  is_active            boolean     [not null, default: true]

  created_at           timestamp   [not null, default: `now()`]

  updated_at           timestamp   [not null, default: `now()`]

}

  

Table skills {

  id         uuid      [pk]

  name       text      [not null, unique]

  category   text      [not null]

  created_at timestamp [not null, default: `now()`]

}

  

Table profile_skills {

  id         uuid      [pk]

  profile_id uuid      [not null, ref: > profiles.id]

  skill_id   uuid      [not null, ref: > skills.id]

  created_at timestamp [not null, default: `now()`]

  

  indexes {

    (profile_id, skill_id) [unique]

  }

}

  

Table categories {

  id         uuid      [pk]

  name       text      [not null, unique]

  slug       text      [not null, unique]

  icon_url   text

  created_at timestamp [not null, default: `now()`]

}

  

Table jobs {

  id                   uuid      [pk]

  client_id            uuid      [not null, ref: > profiles.id]

  category_id          uuid      [not null, ref: > categories.id]

  title                text      [not null]

  description          text      [not null]

  budget_min           float     [not null]

  budget_max           float     [not null]

  work_type            varchar   [not null, note: 'fixed | hourly']

  deadline             date

  status               varchar   [not null, default: 'open', note: 'open | in_progress | completed | cancelled']

  accepted_proposal_id uuid      [ref: > proposals.id]

  views_count          int       [not null, default: 0]

  created_at           timestamp [not null, default: `now()`]

  updated_at           timestamp [not null, default: `now()`]

  

  indexes {

    client_id

    category_id

    (status, created_at)

    (category_id, status)

  }

}

  

Table job_skills {

  id       uuid [pk]

  job_id   uuid [not null, ref: > jobs.id]

  skill_id uuid [not null, ref: > skills.id]

  

  indexes {

    (job_id, skill_id) [unique]

  }

}

  

Table proposals {

  id             uuid      [pk]

  job_id         uuid      [not null, ref: > jobs.id]

  freelancer_id  uuid      [not null, ref: > profiles.id]

  cover_letter   text      [not null]

  proposed_value float     [not null]

  delivery_days  int       [not null]

  status         varchar   [not null, default: 'pending', note: 'pending | accepted | rejected']

  credits_spent  int       [not null, default: 1]

  created_at     timestamp [not null, default: `now()`]

  updated_at     timestamp [not null, default: `now()`]

  

  indexes {

    job_id

    (freelancer_id, status)

    (job_id, freelancer_id) [unique]

  }

}

  

Table contracts {

  id                  uuid      [pk]

  job_id              uuid      [not null, ref: > jobs.id]

  proposal_id         uuid      [not null, ref: > proposals.id]

  client_id           uuid      [not null, ref: > profiles.id]

  freelancer_id       uuid      [not null, ref: > profiles.id]

  agreed_value        float     [not null]

  platform_commission float     [note: '10% do agreed_value']

  freelancer_amount   float     [note: '90% do agreed_value']

  delivery_days       int       [not null]

  deadline_date       date

  payment_status      varchar   [not null, default: 'pending', note: 'pending | held | released | refunded']

  work_delivered_at   timestamp

  approved_at         timestamp

  created_at          timestamp [not null, default: `now()`]

  updated_at          timestamp [not null, default: `now()`]

  

  indexes {

    client_id

    freelancer_id

    job_id

  }

}

  

Table escrow_transactions {

  id                    uuid      [pk]

  contract_id           uuid      [not null, ref: > contracts.id]

  client_id             uuid      [not null, ref: > profiles.id]

  freelancer_id         uuid      [not null, ref: > profiles.id]

  amount                float     [not null]

  commission_amount     float     [not null]

  freelancer_net_amount float     [not null]

  payment_status        varchar   [not null, default: 'pending', note: 'pending | held | released | refunded']

  deposited_at          timestamp

  released_at           timestamp

  created_at            timestamp [not null, default: `now()`]

}

  

Table credit_transactions {

  id            uuid      [pk]

  user_id       uuid      [not null, ref: > profiles.id]

  type          varchar   [not null, note: 'credit_purchase | proposal_debit | commission | escrow_deposit | escrow_release | boost_purchase']

  amount        int       [not null, note: 'positivo=entrada, negativo=saida']

  balance_after int       [not null]

  description   text

  reference_id  uuid

  created_at    timestamp [not null, default: `now()`]

  

  indexes {

    user_id

  }

}

  

Table conversations {

  id              uuid      [pk]

  contract_id     uuid      [not null, unique, ref: - contracts.id]

  client_id       uuid      [not null, ref: > profiles.id]

  freelancer_id   uuid      [not null, ref: > profiles.id]

  last_message_at timestamp

  created_at      timestamp [not null, default: `now()`]

}

  

Table messages {

  id              uuid      [pk]

  conversation_id uuid      [not null, ref: > conversations.id]

  sender_id       uuid      [not null, ref: > profiles.id]

  content         text

  message_type    varchar   [not null, default: 'text', note: 'text | file | image | link']

  file_url        text

  file_name       text

  file_size       int

  is_read         boolean   [not null, default: false]

  created_at      timestamp [not null, default: `now()`]

  

  indexes {

    (conversation_id, created_at)

    sender_id

  }

}

  

Table reviews {

  id          uuid      [pk]

  contract_id uuid      [not null, ref: > contracts.id]

  reviewer_id uuid      [not null, ref: > profiles.id]

  reviewed_id uuid      [not null, ref: > profiles.id]

  rating      int       [not null, note: '1 a 5']

  comment     text

  created_at  timestamp [not null, default: `now()`]

  

  indexes {

    (contract_id, reviewer_id) [unique]

  }

}

  

Table portfolio_items {

  id            uuid      [pk]

  freelancer_id uuid      [not null, ref: > profiles.id]

  title         text      [not null]

  description   text

  image_url     text

  project_url   text

  category_id   uuid      [ref: > categories.id]

  created_at    timestamp [not null, default: `now()`]

  updated_at    timestamp [not null, default: `now()`]

  

  indexes {

    freelancer_id

  }

}

  

Table notifications {

  id             uuid      [pk]

  user_id        uuid      [not null, ref: > profiles.id]

  type           varchar   [not null, note: 'new_proposal | proposal_accepted | proposal_rejected | new_message | job_update | payment_update | new_review']

  title          text      [not null]

  body           text      [not null]

  reference_id   uuid

  reference_type varchar   [note: 'job | proposal | message | contract | review']

  is_read        boolean   [not null, default: false]

  created_at     timestamp [not null, default: `now()`]

  

  indexes {

    (user_id, is_read, created_at)

  }

}

  

Table boosts {

  id            uuid      [pk]

  freelancer_id uuid      [not null, ref: > profiles.id]

  status        varchar   [not null, default: 'active', note: 'active | expired']

  credits_spent int       [not null]

  started_at    timestamp [not null, default: `now()`]

  expires_at    timestamp [not null]

  created_at    timestamp [not null, default: `now()`]

}
```