# Descrição do Diagrama ER – Plataforma Skilla

O diagrama representa a estrutura de um sistema de marketplace freelance (tipo Upwork/Fiverr), onde existem **clientes, freelancers, trabalhos, propostas, contratos e comunicação**.

Ele está organizado em múltiplas entidades interligadas, garantindo **normalização, rastreabilidade e escalabilidade**.


## 1. Entidade: `profiles`

Esta é a entidade central do sistema (núcleo dos utilizadores).

### 🔹 Função:

Armazena os dados de todos os utilizadores, sejam:

- Clientes
- Freelancers
- Administradores

### 🔹 Principais atributos:

- `id` → identificador único
- `full_name`, `username`, `email`
- `role` → define o tipo de utilizador
- `bio`, `avatar_url`, `location`
- `credits_balance` → saldo interno
- `avg_rating`, `total_reviews`, `total_jobs_completed`
- `is_active`, `is_boosted`

### 🔹 Relacionamentos:

- 1:N com `jobs` (um cliente cria vários jobs)
- 1:N com `proposals` (um freelancer envia várias propostas)
- 1:N com `contracts` (participa como cliente ou freelancer)
- 1:N com `messages`, `notifications`, `reviews`, `boosts`

---

##  2. Entidade: `skills`

### 🔹 Função:

Armazena habilidades disponíveis na plataforma.

### 🔹 Relacionamentos:

- N:N com `profiles` (via `profile_skills`)
- N:N com `jobs` (via `job_skills`)

---

## 3. Tabela intermediária: `profile_skills`

Resolve relacionamento muitos-para-muitos:

- Um perfil pode ter várias skills
- Uma skill pode pertencer a vários perfis

---

## 🔗 4. Tabela intermediária: `job_skills`

Relaciona:

- Jobs ↔ Skills

Permite que um job exija múltiplas habilidades.

---

## 5. Entidade: `jobs`

### 🔹 Função:

Representa trabalhos publicados pelos clientes.

### 🔹 Atributos:

- `client_id` → dono do job
- `category_id`
- `title`, `description`
- `budget_min`, `budget_max`
- `work_type`, `deadline`
- `status`
- `views_count`

### 🔹 Relacionamentos:

- 1:N com `proposals`
- N:N com `skills`
- 1:1 com `contracts` (quando aceito)

---

## 6. Entidade: `proposals`

### 🔹 Função:

Propostas enviadas por freelancers.

### 🔹 Atributos:

- `job_id`
- `freelancer_id`
- `cover_letter`
- `proposed_value`
- `delivery_days`
- `status`

### 🔹 Relação:

- Muitos freelancers → 1 job

---

## 7. Entidade: `contracts`

### 🔹 Função:

Formaliza um acordo após aceitação de proposta.

### 🔹 Atributos:

- `job_id`, `proposal_id`
- `client_id`, `freelancer_id`
- `agreed_value`
- `platform_commission`
- `freelancer_amount`
- `deadline_date`
- `payment_status`
- `work_delivered_at`, `approved_at`

### 🔹 Relação:

- Base para:
    - pagamentos
    - mensagens
    - avaliações

---

## 8. Entidade: `escrow_transactions`

### 🔹 Função:

Gerir pagamentos seguros (escrow).

### 🔹 Atributos:

- `contract_id`
- `amount`, `commission_amount`
- `freelancer_net_amount`
- `deposited_at`, `released_at`

### 🔹 Importância:

Garante segurança financeira entre cliente e freelancer.

---

## 9. Entidade: `credit_transactions`

### 🔹 Função:

Controla movimentações internas de saldo.

### 🔹 Atributos:

- `user_id`
- `type` (entrada/saída)
- `amount`
- `balance_after`

---

## 10. Entidade: `categories`

### 🔹 Função:

Classificação dos jobs.

### 🔹 Relação:

- 1:N com `jobs`
- 1:N com `portfolio_items`

---

## 11. Entidade: `portfolio_items`

### 🔹 Função:

Portfólio dos freelancers.

### 🔹 Atributos:

- `freelancer_id`
- `title`, `description`
- `image_url`, `project_url`
- `category_id`

---

## 12. Entidade: `boosts`

### 🔹 Função:

Sistema de destaque pago para freelancers.

### 🔹 Atributos:

- `freelancer_id`
- `credits_spent`
- `started_at`, `expires_at`

---

## 13. Entidade: `notifications`

### 🔹 Função:

Notificações do sistema.

### 🔹 Atributos:

- `user_id`
- `type`, `title`, `body`
- `is_read`

---

## 14. Entidade: `conversations`

### 🔹 Função:

Representa uma conversa entre cliente e freelancer.

### 🔹 Relação:

- Ligada a um `contract`

---

## 15. Entidade: `messages`

### 🔹 Função:

Mensagens dentro das conversas.

### 🔹 Atributos:

- `conversation_id`
- `sender_id`
- `content`
- `file_url`, `file_name`

---

## 16. Entidade: `reviews`

### 🔹 Função:

Avaliações após conclusão do trabalho.

### 🔹 Atributos:

- `contract_id`
- `reviewer_id`
- `reviewed_id`
- `rating`, `comment`

---

# VISÃO GERAL DO FLUXO DO SISTEMA

O funcionamento segue esta lógica:

1. Cliente cria um **job**
2. Freelancers enviam **proposals**
3. Cliente aceita → cria um **contract**
4. Pagamento é gerido via **escrow_transactions**
5. Comunicação via **messages**
6. Após conclusão → **reviews**
7. Sistema usa:
    - `notifications`
    - `credits`
    - `boosts`