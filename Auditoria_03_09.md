# Auditoria de Autenticação e Disponibilidade de Dados do Utilizador
**Data:** 03/09/2026  
**Projeto:** Skilla (Laravel + Frontend JS com templates `App.templates.*`)

---

## A) Resumo executivo

- **Método de autenticação:** JWT em cookie HTTP-only (`jwt_token`) via `tymon/jwt-auth`. Guard principal: `api` (driver `jwt`), mas rotas web usam middleware `jwt.cookie` que lê o cookie e autentica via `JWTAuth::setToken($token)->authenticate()`.
- **Model autenticável:** `App\Models\Perfil` (implementa `JWTSubject`, estende `Authenticatable`). Tabela `perfis`.
- **Campos de nome:** `primeiro_nome`, `sobrenome`, `nome_usuario` estão na tabela `perfis` (model `Perfil`). Accessor `nome_completo` concatena primeiro + sobrenome.
- **Login/Signup retornam JSON** com objeto `user` contendo `id`, `nome` (nome_completo), `email`, `funcao`, `nome_usuario`.
- **O que falta para o greeting dinâmico:** O frontend (SPA em `painel_cliente.blade.php`) renderiza o template `inicio` mas **não injeta o nome** no elemento `#greeting-user-name`. O payload do login/signup já traz `user.nome` — basta ler e popular o DOM no momento do render da rota `inicio`.

---

## B) Arquitetura de autenticação (detalhada)

| Item | Detalhe | Arquivo/Linha |
|------|---------|---------------|
| **Guard padrão** | `web` (session) via `AUTH_GUARD`, mas rotas protegidas usam `jwt.cookie` | `config/auth.php:8`, `bootstrap/app.php:21` |
| **Provider** | `users` → `App\Models\Perfil` (eloquent) | `config/auth.php:24-27` |
| **Model autenticável** | `Perfil` implements `JWTSubject`, `getJWTIdentifier()` retorna `getKey()` | `app/Models/Perfil.php:15-72` |
| **Middleware de autenticação** | `jwt.cookie` (`App\Http\Middleware\JwtMiddleware`) lê cookie `jwt_token`, valida via `JWTAuth`, seta `Auth::setUser($user)` e `$request->setUserResolver()` | `app/Http/Middleware/JwtMiddleware.php:16-50` |
| **Alias de middleware** | `jwt.cookie` e `jwt.auth` apontam para `JwtMiddleware`; `role` → `RoleMiddleware` | `bootstrap/app.php:19-23` |
| **Cookies** | JWT armazenado em cookie `jwt_token` (HTTP-only, SameSite=Lax, path=/). Definido em `AuthController::withJwtCookie()` | `app/Http/Controllers/AuthController.php:227-240` |
| **CSRF** | Login/signup exigem header `X-CSRF-TOKEN` (meta tag `csrf-token` nas views) | `public/js/login.js:148`, `painel_cliente.blade.php:9` |
| **`auth()->user()` retorna** | Instância de `Perfil` (o model autenticável) | `DashboardController.php:11-20` |

---

## C) Rotas e endpoints (tabela)

| Método | Rota | Ficheiro | Middleware | Controller/Closure | Tipo de resposta |
|--------|------|----------|------------|---------------------|------------------|
| GET | `/` | `routes/web.php:18` | — | `view('home.inicio')` | View (Blade) |
| GET | `/login` | `routes/web.php:23` | — | `view('registar.tela_login')` | View |
| GET | `/registar/cliente` | `routes/web.php:26` | — | `view('registar.cliente')` | View |
| GET | `/registar/freelancer` | `routes/web.php:29` | — | `view('registar.freela')` | View |
| POST | `/registar` | `routes/web.php:67` | — | `AuthController@registar` | JSON 201 `{status, message, role, redirect, user}` |
| POST | `/login` | `routes/web.php:68` | — | `AuthController@login` | JSON 200 `{status, message, redirect, user}` |
| POST | `/logout` | `routes/web.php:70` | — | `AuthController@logout` | Redirect → `/login` |
| POST | `/logout-api` | `routes/web.php:71` | — | `AuthController@logoutApi` | JSON 200 |
| GET | `/check-auth` | `routes/web.php:73` | — | `AuthController@checkAuth` | JSON `{authenticated, user?}` |
| POST | `/refresh-token` | `routes/web.php:74` | — | `AuthController@refresh` | JSON 200 `{status, message, user}` |
| GET | `/painel/cliente` | `routes/web.php:84` | `jwt.cookie`, `role:cliente` | `DashboardController@cliente` | View `painel.painel_cliente` |
| GET | `/api/cliente/dashboard` | `routes/web.php:87` | `jwt.cookie`, `role:cliente` | `DashboardController@clienteData` | JSON `{user, metrics}` |
| GET | `/painel/freelancer` | `routes/web.php:103` | `jwt.cookie`, `role:freelancer` | `DashboardController@freelancer` | View `painel.painel_freelancer` |
| GET | `/api/freelancer/dashboard` | `routes/web.php:106` | `jwt.cookie`, `role:freelancer` | `DashboardController@freelancerData` | JSON `{user, metrics}` |

---

## D) Payloads reais (exemplos)

### Login (`POST /login`) — Sucesso 200
```json
{
  "status": 200,
  "message": "Login realizado com sucesso!",
  "redirect": "/painel/cliente",
  "user": {
    "id": "uuid-do-perfil",
    "nome": "João Silva",
    "email": "joao@exemplo.com",
    "funcao": "cliente",
    "nome_usuario": "joao.silva"
  }
}
```
*Origem:* `AuthController::userPayload()` (linhas 247-256) → `login()` (linhas 111-116).

### Signup (`POST /registar`) — Sucesso 201
```json
{
  "status": 201,
  "message": "Conta criada com sucesso!",
  "role": "cliente",
  "redirect": "/painel/cliente",
  "user": {
    "id": "uuid-do-perfil",
    "nome": "João Silva",
    "email": "joao@exemplo.com",
    "funcao": "cliente",
    "nome_usuario": "joao.silva"
  }
}
```
*Origem:* `AuthController::userPayload()` (linhas 247-256) → `registar()` (linhas 69-75).

### `/api/cliente/dashboard` (ou `/api/freelancer/dashboard`) — Sucesso 200
```json
{
  "user": {
    "id": "uuid",
    "primeiro_nome": "João",
    "sobrenome": "Silva",
    "email": "joao@exemplo.com",
    "funcao": "cliente",
    "nome_usuario": "joao.silva",
    "url_avatar": "/img/foto_perfil_exemplar.png"
  },
  "metrics": []
}
```
*Origem:* `DashboardController::userPayload()` (linhas 43-54) → `clienteData()` / `freelancerData()`.

### `/check-auth` — Sucesso 200
```json
{
  "authenticated": true,
  "user": { ...mesmo shape de userPayload... }
}
```
*Origem:* `AuthController::checkAuth()` (linhas 133-136).

---

## E) Modelos e relações (Perfil vs User)

- **Não existe model `User` separado.** O único model autenticável é **`Perfil`** (`app/Models/Perfil.php`).
- Tabela: `perfis` (PK `id` UUID via `HasUuids`).
- Campos de nome:
  - `primeiro_nome` (string)
  - `sobrenome` (string)
  - `nome_usuario` (string, único, gerado em `Perfil::generateUniqueUsername()`)
  - Accessor `nome_completo` → `"{$this->primeiro_nome} {$this->sobrenome}"` (linha 148-151).
- Relações principais (linhas 78-121):
  - `provincia()` → `BelongsTo(Provincia)`
  - `carteira()` → `HasOne(Wallet)`
  - `trabalhosAtivos()`, `propostas()`, `propostasRecebidas()`, `jobsConcluidos()`, `trabalhos()`, `notificacoes()` → `HasMany`
- **Caminho correto para obter o nome:**
  - `auth()->user()->primeiro_nome` (direto no model `Perfil`)
  - `auth()->user()->nome_completo` (accessor)
  - `auth()->user()->nome_usuario` (username único)

---

## F) Diagnóstico do frontend

| Ponto | Situação atual | Arquivo/Linha |
|-------|----------------|---------------|
| **Login/Signup** | Feito via `fetch` em `public/js/login.js` (linhas 126-181). Envia `FormData` para `/login` ou `/registar`, lê `data.redirect` e faz `window.location.href = data.redirect` após 1.2s. | `public/js/login.js` |
| **SPA Dashboard** | `painel_cliente.blade.php` é uma SPA: carrega template `App.templates.inicio` no `#spa-view` via `render('inicio')`. | `painel_cliente.blade.php:476-648`, `render()` (linha 4333) |
| **Greeting placeholder** | Template `inicio` tem `<h2 id="greeting-user-name">Bom dia, [Nome] 👋</h2>` (linha 484-485). **Nenhum JS popula esse elemento.** | `painel_cliente.blade.php:484-485` |
| **Estado global de user** | Não há `App.state.user` nem localStorage com dados do utilizador. O payload `user` vem na resposta do login/signup mas **não é persistido** no frontend. | — |
| **Endpoint `/api/cliente/dashboard`** | Retorna `user` com `primeiro_nome`, `sobrenome`, `nome_usuario`, etc. Mas **não é chamado** ao renderizar `inicio`. | `DashboardController.php:33-41` |
| **Risco de “flash”** | Sim: o template mostra “Bom dia, [Nome]” até que JS substitua. Mitigação: popular no `initRouteScripts` quando `route === 'inicio'` **antes** de fazer `spaView.innerHTML = ...` ou imediatamente após. | — |

---

## G) Recomendações objetivas (3 opções)

### Opção 1 — Popular o greeting no render da rota `inicio` (baixa complexidade)
**Mudanças:**
- Em `painel_cliente.blade.php`, dentro de `initRouteScripts(route)` no bloco `if (route === 'inicio')` (linha ~4682), buscar o nome do utilizador e popular `#greeting-user-name`.
- Fonte do nome: preferir `App.state.user` (criar esse estado no login) ou chamar `/api/cliente/dashboard` uma vez.

**Impacto:** Imediato, sem alterar backend.  
**Complexidade:** **Baixa** — apenas JS no frontend.

**Exemplo de implementação:**
```js
// No login.js, após login bem-sucedido:
const user = data.user; // { nome, primeiro_nome, nome_usuario, ... }
window.App = window.App || {};
window.App.state = window.App.state || {};
window.App.state.user = user;

// Em painel_cliente.blade.php, initRouteScripts:
if (route === 'inicio') {
    const u = App.state?.user;
    const nome = u?.primeiro_nome || u?.nome?.split(' ')[0] || u?.nome_usuario || 'Utilizador';
    const el = spaView.querySelector('#greeting-user-name');
    if (el) el.textContent = `Bom dia, ${nome} 👋`;
    // ...restante binds
}
```

---

### Opção 2 — Criar endpoint `/api/me` e buscar no boot da SPA (média complexidade)
**Mudanças:**
- Nova rota em `routes/web.php`: `Route::get('/api/me', [AuthController::class, 'me'])->middleware('jwt.cookie');`
- Controller `AuthController@me` retorna `userPayload(auth()->user())`.
- No `DOMContentLoaded` da SPA (`painel_cliente.blade.php:4712-4715`), fazer `fetch('/api/me')` → popular `App.state.user` → render inicial.

**Impacto:** Centraliza obtenção de user; funciona mesmo se reload da página.  
**Complexidade:** **Média** — requer rota + controller + ajustes no boot da SPA.

---

### Opção 3 — Renderizar nome server-side na view Blade (baixa complexidade, mas quebra SPA puro)
**Mudanças:**
- Em `DashboardController@cliente` (linha 16-20), passar `$user` para a view.
- No `painel_cliente.blade.php`, injetar `<meta name="user-nome" content="{{ $user->primeiro_nome }}">` ou script inline `window.__USER__ = @json($user->only(['primeiro_nome','nome_usuario','nome_completo']));`.
- No JS da SPA, ler `window.__USER__` ao iniciar.

**Impacto:** Elimina flash; mas acopla Blade ao dado do user (menos “SPA puro”).  
**Complexidade:** **Baixa** — apenas view + controller.

---

## Conclusão recomendada

**Opção 1** é a mais rápida e alinhada à arquitetura atual (SPA + JSON). O payload do login já traz `user.nome` (nome completo) e `user.primeiro_nome` está disponível em `/api/cliente/dashboard`. Basta persistir `App.state.user` no login e usar no render de `inicio`. Evita nova request e mantém separação frontend/backend.

---
*Fim da auditoria.*