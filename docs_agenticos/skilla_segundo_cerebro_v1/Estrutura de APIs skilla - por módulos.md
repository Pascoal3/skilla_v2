# 🔐 1. API de Autenticação

Responsável por login, registo e segurança.

**Base:** `/api/auth`

Endpoints:

- `POST /register`
- `POST /login`
- `POST /logout`
- `GET /me` (dados do utilizador logado)

# 👤 2. API de Profiles (Utilizadores)

Baseado na tabela `profiles`

**Base:** `/api/profiles`

Endpoints:

- `GET /profiles/:id`
- `PUT /profiles/:id`
- `DELETE /profiles/:id` (admin)
- `GET /profiles?role=freelancer` (filtro)

Extras importantes:

- `PATCH /profiles/avatar`
- `PATCH /profiles/boost`

# 🧠 3. API de Skills

Tabela: `skills`

**Base:** `/api/skills`

- `GET /skills`
- `POST /skills` (admin)
- `DELETE /skills/:id`

# 🔗 4. API de Profile Skills

Tabela: `profile_skills`

**Base:** `/api/profile-skills`

- `POST /profile-skills` (adicionar skill)
- `DELETE /profile-skills/:id`
- `GET /profiles/:id/skills`

# 💼 5. API de Jobs

Tabela: `jobs`

**Base:** `/api/jobs`

- `GET /jobs`
- `POST /jobs`
- `GET /jobs/:id`
- `PUT /jobs/:id`
- `DELETE /jobs/:id`

Extras:

- `GET /jobs?category=design&budget_min=100`
- `POST /jobs/:id/views`


# 🔗 6. API de Job Skills

Tabela: `job_skills`

**Base:** `/api/job-skills`

- `POST /job-skills`
- `DELETE /job-skills/:id`

# 📩 7. API de Proposals

Tabela: `proposals`

**Base:** `/api/proposals`

- `POST /proposals`
- `GET /jobs/:id/proposals`
- `GET /proposals/:id`
- `PATCH /proposals/:id/status`

# 📄 8. API de Contracts

Tabela: `contracts`

**Base:** `/api/contracts`

- `POST /contracts` (aceitar proposta)
- `GET /contracts/:id`
- `PATCH /contracts/:id/status`
- `POST /contracts/:id/approve`

# 💰 9. API de Pagamentos (Escrow)

Tabela: `escrow_transactions`

**Base:** `/api/payments`

- `POST /payments/deposit`
- `POST /payments/release`
- `GET /contracts/:id/payments`
# 💳 10. API de Créditos

Tabela: `credit_transactions`

**Base:** `/api/credits`

- `GET /credits`
- `POST /credits/add`
- `POST /credits/use`

# 💬 11. API de Conversas

Tabela: `conversations`

**Base:** `/api/conversations`

- `GET /conversations`
- `POST /conversations`
- `GET /conversations/:id`
# 💬 12. API de Mensagens

Tabela: `messages`

**Base:** `/api/messages`

- `GET /conversations/:id/messages`
- `POST /messages`
- `PATCH /messages/:id/read`

# ⭐ 13. API de Reviews

Tabela: `reviews`

**Base:** `/api/reviews`

- `POST /reviews`
- `GET /profiles/:id/reviews`

# 🔔 14. API de Notificações

Tabela: `notifications`

**Base:** `/api/notifications`

- `GET /notifications`
- `PATCH /notifications/:id/read`

# 🚀 15. API de Boosts

Tabela: `boosts`

**Base:** `/api/boosts`

- `POST /boosts`
- `GET /profiles/:id/boosts`

# 🗂️ 16. API de Categorias

Tabela: `categories`

**Base:** `/api/categories`

- `GET /categories`
- `POST /categories` (admin)

# 🎨 17. API de Portfólio

Tabela: `portfolio_items`

**Base:** `/api/portfolio`

- `POST /portfolio`
- `GET /profiles/:id/portfolio`
- `DELETE /portfolio/:id`

# Organização PROFISSIONAL 

Em vez de criar tudo solto, será organizado assim:

/api  
	/auth  
	/profiles  
	/jobs  
	/proposals  
	/contracts  
	/payments  
	/messages  
	/reviews