# Especificação da API — Skilla

**Status:** Draft
**Owner:** TODO(USER)
**Last updated:** 2026-09-26

---

## Visão Geral

A API do Skilla segue **RESTful** com **JSON** como formato de troca. Autenticação via **JWT em cookie HttpOnly** (web) ou **Bearer Token** (mobile/futuro). Todas as rotas protegidas exigem autenticação; autorização via Policies (role + ownership + state).

**Base URL:** `https://api.skilla.ao/v1` (produção) / `http://localhost/api` (dev)

**Headers Padrão:**
```
Content-Type: application/json
Accept: application/json
X-Requested-With: XMLHttpRequest
```

**Códigos de Status:**
| Código | Significado |
|--------|-------------|
| 200 | Sucesso (GET, PUT, PATCH) |
| 201 | Criado (POST) |
| 400 | Requisição inválida (validação) |
| 401 | Não autenticado (token expirado/inválido) |
| 403 | Não autorizado (policy falhou) |
| 404 | Recurso não encontrado |
| 422 | Entidade não processável (regras de negócio) |
| 429 | Rate limit excedido |
| 500 | Erro interno |

**Formato de Erro Padrão:**
```json
{
  "success": false,
  "message": "Descrição legível do erro",
  "errors": {
    "campo": ["Mensagem de validação"]
  },
  "code": "ERROR_CODE"
}
```

---

## 1. Autenticação (`/api/auth`)

### `POST /api/auth/register`
Registra novo usuário (cliente ou freelancer).

**Request:**
```json
{
  "primeiro_nome": "João",
  "sobrenome": "Silva",
  "email": "joao@email.com",
  "password": "senha123456",
  "provincia_id": "uuid-da-provincia",
  "funcao": "freelancer"  // ou "cliente"
}
```

**Response 201:**
```json
{
  "success": true,
  "message": "Conta criada com sucesso!",
  "role": "freelancer",
  "redirect": "/painel/freelancer",
  "user": {
    "id": "uuid",
    "nome": "João Silva",
    "email": "joao@email.com",
    "funcao": "freelancer",
    "nome_usuario": "joao.silva.123"
  }
}
```
*Cookie `jwt_token` definido (HttpOnly, Secure, SameSite=Lax)*

---

### `POST /api/auth/login`
Autentica usuário existente.

**Request:**
```json
{
  "email": "joao@email.com",
  "password": "senha123456"
}
```

**Response 200:** Mesmo formato de registro + cookie JWT.

---

### `POST /api/auth/logout`
Invalida token (blocklist) e limpa cookie.

**Response 200:**
```json
{ "success": true, "message": "Logout realizado com sucesso." }
```

---

### `GET /api/auth/check-auth`
Verifica se token válido (para SSR/SPA hydration).

**Response 200:**
```json
{
  "authenticated": true,
  "user": { "id": "...", "nome": "...", "email": "...", "funcao": "freelancer", "nome_usuario": "..." }
}
```

---

### `POST /api/auth/refresh`
Renova access token (usa refresh token implícito no cookie).

**Response 200:** Novo token + user payload + cookie atualizado.

---

## 2. Perfis (`/api/profiles`)

### `GET /api/profiles/{id}`
Perfil público (visualização).

**Response 200:**
```json
{
  "id": "uuid",
  "primeiro_nome": "João",
  "sobrenome": "Silva",
  "nome_usuario": "joao.silva.123",
  "email": "joao@email.com",
  "funcao": "freelancer",
  "url_avatar": "/storage/avatars/uuid.jpg",
  "bio": "Desenvolvedor Full Stack...",
  "localizacao": "Luanda, Ingombota",
  "provincia": { "id": "...", "nome": "Luanda" },
  "avaliacao_media": 4.80,
  "total_avaliacoes": 12,
  "total_trabalhos_concluidos": 10,
  "esta_destacado": true,
  "skills": [
    { "id": "...", "nome": "React", "categoria": "frontend" },
    { "id": "...", "nome": "Node.js", "categoria": "backend" }
  ],
  "portfolio": [
    { "id": "...", "titulo": "E-commerce", "url_imagem": "...", "url_projeto": "https://..." }
  ]
}
```

---

### `PUT /api/profiles/{id}` (Owner only)
Atualiza próprio perfil.

**Request:**
```json
{
  "bio": "Nova bio...",
  "telefone": "+244 9XX XXX XXX",
  "localizacao": "Luanda, Talatona",
  "url_avatar": "file_upload" // multipart/form-data
}
```

---

### `POST /api/profiles/{id}/skills` (Freelancer only)
Adiciona/remove skills.

**Request:**
```json
{ "skills": ["uuid-skill-1", "uuid-skill-2"] }
```

---

## 3. Jobs (`/api/jobs`)

### `GET /api/jobs` (Feed Freelancer)
Lista jobs `aberto` com filtros e paginação.

**Query Params:**
| Param | Tipo | Descrição |
|-------|------|-----------|
| `search` | string | Busca textual (titulo, descricao) |
| `category` | string | Slug categoria OU 'urgente' OU 'remoto' |
| `budget_max` | integer | Orçamento máximo (Kz) |
| `prazo` | array | `['1_semana','1_mes','3_meses']` |
| `nivel` | array | `['iniciante','intermediario','especialista']` |
| `localizacao` | array | Nomes províncias |
| `sort` | string | `latest` (default), `budget_desc`, `proposals_asc` |
| `page` | integer | Página (default 1) |
| `per_page` | integer | Itens/página (default 15, max 50) |

**Response 200:**
```json
{
  "data": [
    {
      "id": "uuid",
      "titulo": "Site Institucional",
      "descricao": "Preciso de um site...",
      "tipo_trabalho": "preco_fixo",
      "orcamento_fixo": 150000.00,
      "prazo": "2026-10-15",
      "status": "aberto",
      "cliente": { "id": "...", "nome_usuario": "empresa.xyz", "avaliacao_media": 4.5 },
      "categoria": { "id": "...", "nome": "Desenvolvimento Web", "slug": "desenvolvimento-web" },
      "skills": [{ "id": "...", "nome": "Laravel" }, { "id": "...", "nome": "Vue.js" }],
      "propostas_count": 3,
      "esta_salvo": false
    }
  ],
  "links": { "first": "...", "last": "...", "prev": null, "next": "..." },
  "meta": { "current_page": 1, "last_page": 5, "per_page": 15, "total": 72 }
}
```

---

### `POST /api/jobs/save` (Cliente)
Salva/atualiza rascunho (wizard step).

**Request:** (qualquer subset de campos do job)
```json
{
  "titulo": "Site Institucional",
  "categoria_id": "uuid-cat",
  "tipo_trabalho": "preco_fixo",
  "orcamento_fixo": 150000,
  "descricao": "Detalhes...",
  "skills": ["uuid-skill-1", "uuid-skill-2"],
  "anexos": ["file1", "file2"] // multipart
}
```

**Response 200/201:** Job object (status `rascunho`).

---

### `PATCH /api/jobs/{id}/publish` (Cliente, Owner)
Publica job (validação rigorosa).

**Request:** Campos finais para publicação.

**Response 200:** Job object (status `aberto`, `expira_em` setado).

---

### `GET /api/jobs/{id}` (Público)
Detalhe completo do job.

**Response 200:** Job + cliente + skills + anexos + propostas (se cliente) + jobs similares.

---

### `POST /api/jobs/{id}/save` (Freelancer, Auth)
Toggle save/unsave job (favoritos).

**Response 200:**
```json
{ "saved": true }  // ou false
```

---

## 4. Propostas (`/api/proposals`)

### `POST /api/proposals/send` (Freelancer)
Envia proposta para job.

**Request:**
```json
{
  "job_id": "uuid-job",
  "valor_proposto": 120000.00,
  "dias_entrega": 10,
  "carta_apresentacao": "Tenho experiência...",
  "screening_answers": { "uuid-question-1": "Resposta..." } // opcional
}
```

**Response 200:**
```json
{ "success": true, "message": "Proposta enviada com sucesso!", "proposta_id": "uuid" }
```

**Erros Comuns:**
- 422: "Não tem créditos suficientes" / "Job não aceita propostas" / "Já enviou proposta"

---

### `GET /api/proposals` (Freelancer)
Minhas propostas enviadas.

**Response 200:** Lista paginada com status, job, cliente.

---

### `GET /api/jobs/{id}/proposals` (Cliente, Owner)
Propostas recebidas no job.

**Response 200:** Lista com freelancer, valor, prazo, carta, avaliação, portfólio.

---

### `POST /api/proposals/{id}/accept` (Cliente, Owner)
Aceita proposta → cria Contrato + Escrow + Chat.

**Response 200:**
```json
{
  "success": true,
  "contrato": { "id": "...", "status_contrato": "ativo", "status_pagamento": "retido", ... },
  "conversa": { "id": "..." }
}
```

---

### `POST /api/proposals/{id}/reject` (Cliente, Owner)
Rejeita proposta.

**Response 200:** `{ "success": true, "message": "Proposta rejeitada." }`

---

## 5. Contratos (`/api/contracts`)

### `PATCH /api/contracts/{id}/submit` (Freelancer, Owner)
Marca trabalho como entregue.

**Response 200:**
```json
{ "success": true, "message": "Trabalho entregue. Aguardando aprovação.", "trabalho_entregue_em": "2026-09-26T14:30:00Z" }
```

---

### `PATCH /api/contracts/{id}/approve` (Cliente, Owner)
Aprova entrega → libera escrow (90% freelancer, 10% plataforma).

**Response 200:**
```json
{
  "success": true,
  "message": "Pagamento liberado!",
  "contrato": { "status_contrato": "concluido", "status_pagamento": "liberado", "aprovado_em": "..." }
}
```

---

### `POST /api/contracts/{id}/dispute` (Qualquer parte)
Abre disputa → congela escrow.

**Request:**
```json
{ "motivo": "O trabalho não atende aos requisitos combinados..." }
```

**Response 200:**
```json
{ "success": true, "message": "Disputa aberta. Admin será notificado.", "disputa_id": "uuid" }
```

---

### `GET /api/contracts/{id}` (Partes do contrato)
Detalhe do contrato com status, pagamentos, marcos.

---

## 6. Carteira (`/api/wallet`)

### `GET /api/wallet/balance` (Auth)
Saldo atual da carteira.

**Response 200:**
```json
{
  "saldo": 45000.00,
  "moeda": "AOA",
  "iban_virtual": "AO06 0000 0000 0000 0000 0",
  "numero_conta_interno": 100001
}
```

---

### `POST /api/wallet/deposit` (Auth)
Recarga simulada (MVP: admin aprova comprovante).

**Request:**
```json
{ "valor": 50000.00, "metodo_pagamento": "multicaixa_express", "comprovante": "file_upload" }
```

**Response 200:** Transação criada (status `pendente` até admin aprovar).

---

### `GET /api/wallet/statement` (Auth)
Extrato paginado (`transacoes_carteiras`).

**Query:** `page`, `per_page`, `tipo` (filter), `data_inicio`, `data_fim`.

---

### `GET /api/wallet/credits/statement` (Freelancer)
Extrato de créditos (`transacoes_credito`).

---

## 7. Créditos (`/api/credits`)

### `GET /api/credits` (Freelancer)
Saldo de créditos + pacotes disponíveis.

**Response 200:**
```json
{
  "saldo_creditos": 15,
  "pacotes": [
    { "id": "basic", "creditos": 10, "preco": 1500.00 },
    { "id": "pro", "creditos": 30, "preco": 4000.00 },
    { "id": "premium", "creditos": 100, "preco": 12000.00 }
  ]
}
```

---

### `POST /api/credits/buy` (Freelancer)
Compra pacote de créditos (paga com saldo carteira).

**Request:**
```json
{ "pacote_id": "pro" }
```

**Response 200:** Créditos creditados + transações criadas.

---

### `POST /api/credits/boost` (Freelancer)
Ativa boost de perfil (gasta créditos).

**Response 200:**
```json
{ "success": true, "message": "Perfil destacado por 30 dias!", "expira_em": "2026-10-26T14:30:00Z" }
```

---

## 8. Chat Tempo Real (WebSocket + REST)

### REST — Histórico e Envio Arquivos

#### `GET /api/chat/{conversaId}/messages`
Histórico paginado (mais recentes primeiro).

**Query:** `page`, `per_page` (default 50).

**Response 200:**
```json
{
  "data": [
    {
      "id": "uuid",
      "conversa_id": "uuid",
      "remetente_id": "uuid",
      "remetente_nome": "João Silva",
      "conteudo": "Olá, tudo bem?",
      "tipo_mensagem": "texto",
      "url_arquivo": null,
      "lida": true,
      "criado_em": "2026-09-26T14:30:00Z"
    }
  ],
  "meta": { "current_page": 1, "per_page": 50, "total": 120 }
}
```

---

#### `POST /api/chat/send` (Auth, Parte da conversa)
Envia mensagem (texto ou arquivo).

**Request (multipart/form-data):**
```
conversa_id: uuid
conteudo: "Mensagem de texto" (opcional se arquivo)
arquivo: file (opcional, max 5MB, pdf/jpg/png/webp)
```

**Response 200:** Message object criado.

---

### WebSocket (Laravel Reverb)

**Conexão:**
```javascript
import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

window.Pusher = Pusher;
window.Echo = new Echo({
  broadcaster: 'pusher',
  key: 'skilla', // REVERB_APP_KEY
  wsHost: 'api.skilla.ao', // ou localhost
  wsPort: 443, // WSS
  forceTLS: true,
  authEndpoint: '/api/broadcasting/auth',
  auth: {
    headers: {
      Authorization: `Bearer ${token}` // ou cookie automático
    }
  }
});
```

**Canais Privados:** `private-conversation.{conversaId}`

**Eventos:**

| Evento | Direção | Payload |
|--------|---------|---------|
| `MessageSent` | Broadcast → Clients | `{ id, conversa_id, remetente_id, conteudo, tipo_mensagem, url_arquivo, nome_arquivo, criado_em }` |
| `MessageRead` | Broadcast → Sender | `{ conversa_id, message_ids: [...] }` |
| `TypingIndicator` | Broadcast → Other | `{ conversa_id, user_id, is_typing: true/false }` |

**Enviar Mensagem via WS (Opcional):**
```javascript
window.Echo.private(`conversation.${conversaId}`)
  .whisper('typing', { is_typing: true });

// Para enviar mensagem via REST (recomendado) + WS para real-time
```

---

## 9. Notificações (`/api/notifications`)

### `GET /api/notifications` (Auth)
Lista paginada.

**Query:** `page`, `per_page`, `lida` (true/false), `tipo`.

**Response 200:** Lista com `id`, `tipo`, `titulo`, `corpo`, `lida`, `criado_em`, `referencia`.

---

### `PATCH /api/notifications/{id}/read` (Auth)
Marca como lida.

**Response 200:** `{ "success": true }`

---

### `POST /api/notifications/read-all` (Auth)
Marca todas como lidas.

---

## 10. Avaliações (`/api/reviews`)

### `POST /api/reviews` (Auth, Parte do contrato concluído)
Cria avaliação.

**Request:**
```json
{
  "contrato_id": "uuid",
  "nota": 5,
  "comentario": "Excelente profissional!"
}
```

**Response 201:** Review object + média atualizada do avaliado.

---

### `GET /api/profiles/{id}/reviews` (Público)
Avaliações recebidas por um perfil.

---

## 11. Admin (`/api/admin`) — Futuro v1.0

| Endpoint | Método | Descrição |
|----------|--------|-----------|
| `/api/admin/users` | GET | Listar/filtrar usuários |
| `/api/admin/users/{id}/ban` | POST | Banir/desbanir |
| `/api/admin/users/{id}/adjust-credits` | POST | Ajustar créditos |
| `/api/admin/users/{id}/adjust-balance` | POST | Ajustar saldo carteira |
| `/api/admin/jobs` | GET | Listar jobs |
| `/api/admin/contracts` | GET | Listar contratos |
| `/api/admin/disputes` | GET | Listar disputas abertas |
| `/api/admin/disputes/{id}/resolve` | POST | Resolver disputa (cliente/freelancer/mutuo) |
| `/api/admin/transactions` | GET | Extrato completo |
| `/api/admin/reconcile` | POST | Forçar reconciliação carteiras |

---

## 12. Rate Limiting (Headers de Resposta)

```
X-RateLimit-Limit: 60
X-RateLimit-Remaining: 59
X-RateLimit-Reset: 1695745200
Retry-After: 60  (quando 429)
```

**Limites por Contexto:**
| Contexto | Limite | Janela |
|----------|--------|--------|
| Login | 5 req | 1 min |
| Registro | 3 req | 1 min |
| Propostas (enviar) | 10 req | 1 min |
| Chat (mensagens) | 30 req | 1 min |
| API Geral | 60 req | 1 min |
| WebSocket (msg) | 30 msg | 1 min |

---

## 13. Versionamento e Depreciação

- Versão no path: `/api/v1/...`
- Depreciação: Header `Sunset: Sat, 01 Jan 2027 00:00:00 GMT` + aviso 90 dias
- Changelog: `../07-maintenance/changelog.md`

---

## Related docs
- [../01-product/functional-requirements.md](../01-product/functional-requirements.md) (RFs)
- [../01-product/use-cases.md](../01-product/use-cases.md) (UCs)
- [../03-data/data-mapping.md](../03-data/data-mapping.md) (Endpoint → Entidades)
- [../02-architeture/security-guidelines.md](../02-architeture/security-guidelines.md) (AuthZ, Rate Limit)
- [../05-design/screen-specification.md](../05-design/screen-specification.md) (Telas ↔ Endpoints)