# Auditoria completa do sistema de autenticacao JWT

## Resumo Executivo

O login esta a funcionar ate ao ponto de gerar um JWT e enviar o cookie `jwt_token`. O problema aparece no acesso ao painel porque o fluxo protegido tem inconsistencias criticas depois do redirect:

1. `DashboardController` chama `$this->middleware('auth.jwt')`, mas o alias registado em `bootstrap/app.php` e usado nas rotas e `jwt.auth`, nao `auth.jwt`.
2. Em Laravel moderno, o `Controller` base deste projeto nao disponibiliza `$this->middleware()`, portanto esse construtor pode quebrar a rota do painel.
3. As rotas tambem apontam para classes e metodos inexistentes (`Freelancer\JobController`, `Freelancer\ProposalController`, `logoutApi()`, `refresh()`), e `php artisan route:list` ja falha por causa disso.
4. Os middlewares JWT capturam qualquer excecao e redirecionam para `/login`, sem registar a causa real. Assim, token expirado, invalido, ausente, usuario inexistente, blacklist ou erro de provider ficam invisiveis.

Conclusao curta: o cookie e criado, mas o pedido ao painel passa por um pipeline inconsistente. A alteracao unica que mais provavelmente desbloqueia `/painel/cliente` e `/painel/freelancer` e remover o construtor de `DashboardController` ou corrigir/reimplementar esse middleware com o alias certo (`jwt.auth`).

## Problemas Criticos

1. Alias errado no `DashboardController`.

   Evidencia: `app/Http/Controllers/DashboardController.php:10-13`

   ```php
   public function __construct()
   {
       $this->middleware('auth.jwt');
   }
   ```

   O alias registado e `jwt.auth`, nao `auth.jwt`.

   Evidencia: `bootstrap/app.php:18-22`

   ```php
   $middleware->alias([
       'role' => \App\Http\Middleware\RoleMiddleware::class,
       'jwt.auth' => \App\Http\Middleware\JwtMiddleware::class,
   ]);
   ```

   Alem disso, `app/Http/Controllers/Controller.php` e uma classe abstrata vazia. Nao ha metodo `middleware()` herdado.

2. O painel ja esta protegido nas rotas, mas o controller tenta aplicar outro middleware incorreto.

   Evidencia: `routes/web.php:60-64` e `routes/web.php:80-84`

   ```php
   Route::middleware(['jwt.auth', 'role:cliente'])
   Route::middleware(['jwt.auth', 'role:freelancer'])
   ```

   Depois disso, o controller ainda tenta aplicar `auth.jwt`. Isto duplica a autenticacao e usa o nome errado.

3. `routes/web.php` referencia controllers inexistentes.

   Evidencia: `routes/web.php:9-10`

   ```php
   use App\Http\Controllers\Freelancer\JobController;
   use App\Http\Controllers\Freelancer\ProposalController;
   ```

   No projeto existem `app/Http/Controllers/JobController.php` e `app/Http/Controllers/ProposalController.php`, mas nao existem ficheiros em `app/Http/Controllers/Freelancer/`.

   Confirmacao: `php artisan route:list` falhou com:

   ```text
   ReflectionException: Class "App\Http\Controllers\Freelancer\JobController" does not exist
   ```

4. Rotas apontam para metodos inexistentes no `AuthController`.

   Evidencia: `routes/web.php:45-52`

   ```php
   Route::post('/logout-api', [AuthController::class, 'logoutApi']);
   Route::post('/refresh-token', [AuthController::class, 'refresh']);
   ```

   Em `app/Http/Controllers/AuthController.php` existem `registar()`, `checkAuth()`, `login()` e `logout()`. Nao existem `logoutApi()` nem `refresh()`.

5. O middleware JWT esconde todas as excecoes.

   Evidencia: `app/Http/Middleware/JwtMiddleware.php:15-25`

   ```php
   $token = $request->cookie('jwt_token');
   JWTAuth::setToken($token)->authenticate();
   ...
   catch (\Exception $e) {
       return redirect('/login');
   }
   ```

   Excecoes possiveis neste ponto:

   - `Tymon\JWTAuth\Exceptions\TokenExpiredException`: token expirado.
   - `Tymon\JWTAuth\Exceptions\TokenInvalidException`: assinatura, formato, claims ou blacklist invalidos.
   - `Tymon\JWTAuth\Exceptions\JWTException`: token ausente, erro generico de parsing/autenticacao.
   - `Illuminate\Database\Eloquent\ModelNotFoundException` ou retorno `null`: `sub` do token nao encontra um `Perfil`.
   - `Exception` geral: erro de configuracao, provider, secret, cache/config desatualizada.

   Como tudo vira redirect para `/login`, o sistema nao mostra a causa real.

6. `RoleMiddleware` autentica de novo o mesmo token.

   Evidencia: `app/Http/Middleware/RoleMiddleware.php:16-29`

   ```php
   $token = $request->cookie('jwt_token');
   $user = JWTAuth::setToken($token)->authenticate();
   if ($user->funcao !== $role) abort(403);
   ```

   Isto funciona, mas duplica a chamada feita por `JwtMiddleware`. Se a primeira autentica e a segunda falha, o utilizador volta para login. O ideal e o middleware JWT anexar o user ao request ou definir o guard, e o role apenas verificar esse user.

## Problemas Secundarios

1. `config/jwt.php` tem dois `return`.

   Evidencia: `config/jwt.php:11-43` termina o ficheiro logico com um `return`; outro `return` com a configuracao longa comeca em `config/jwt.php:45`. Tudo depois da linha 43 esta morto e nunca e executado.

2. O projeto afirma Laravel 11, mas `composer.json` exige Laravel `^13.8`.

   Isto importa porque a forma de middleware em controllers mudou. O `Controller` base esta vazio e nao suporta o padrao antigo `$this->middleware()`.

3. `checkAuth()` usa `Auth::check()` e `Auth::user()`, nao JWT.

   Evidencia: `app/Http/Controllers/AuthController.php:132-137`

   ```php
   'authenticated' => Auth::check(),
   'user' => Auth::user()
   ```

   Como a autenticacao principal e JWT em cookie, `checkAuth()` pode responder `false` mesmo com `jwt_token` valido, dependendo da sessao.

4. `registar()` e `login()` usam SameSite diferente.

   Evidencia: `registar()` usa `Strict` em `AuthController.php:94-105`; `login()` usa `Lax` em `AuthController.php:173-183`.

   Para redirect same-origin ambos funcionam, mas a inconsistencia dificulta debug. O cookie do login e:

   - nome: `jwt_token`
   - path: `/`
   - domain: `null` no codigo, ou seja, host atual
   - secure: `false`
   - httpOnly: `true`
   - sameSite: `Lax`

5. `EncryptCookies.php` exclui `jwt_token`, mas nao ha evidencia de que esse middleware customizado esteja registado.

   Evidencia: `app/Http/Middleware/EncryptCookies.php:7-14`

   ```php
   protected $except = ['jwt_token'];
   ```

   Em Laravel 11/13, a configuracao normalmente deve ser feita em `bootstrap/app.php` com a API de middleware. Como o log mostra `Illuminate\Cookie\Middleware\EncryptCookies`, e nao `App\Http\Middleware\EncryptCookies`, esta exclusao pode nao estar ativa. Isto nao e necessariamente fatal se Laravel encriptar e desencriptar o cookie no ciclo web, mas deve ser limpo para evitar ambiguidade.

6. Sessao Laravel e JWT estao misturados.

   `config/auth.php:12-16` usa guard `web` com driver `session`, mas o fluxo desejado e JWT. `JWTAuth::attempt()` pode interagir com o provider/guard default.

   Log encontrado: houve erro ao gravar sessao em banco porque `sessions.user_id` era inteiro e o `Perfil.id` e UUID:

   ```text
   SQLSTATE[01000]: Warning: 1265 Data truncated for column 'user_id'
   ```

   O `.env` atual esta com `SESSION_DRIVER=file`, entao a tabela `sessions` nao e necessaria neste momento. Se voltar para `database`, a coluna `sessions.user_id` precisa ser UUID/string ou ficar nula.

7. `SESSION_DOMAIN=null` no `.env` deve ser revisto.

   O cookie JWT nao usa essa configuracao porque o dominio e passado explicitamente como `null` no codigo. Mas para cookies de sessao, `SESSION_DOMAIN=null` pode ser interpretado de forma indesejada se nao for convertido para `null` real. Melhor deixar vazio ou remover.

8. O frontend esta correto no ponto principal, mas tem fragilidades.

   Evidencia: `public/js/login.js:143-150`

   ```js
   fetch('/login', {
       method: 'POST',
       body: formData,
       credentials: 'include',
       headers: {
           'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
           'Accept': 'application/json',
           'X-Requested-With': 'XMLHttpRequest'
       }
   })
   ```

   `credentials: 'include'` esta certo e permite receber/enviar cookies. Fragilidades:

   - Se a meta `csrf-token` nao existir, o JS quebra antes do fetch.
   - `response.json()` assume que toda resposta e JSON. Um redirect ou HTML de erro quebra o fluxo.
   - O redirect usa `window.location.href = data.redirect`, correto para o painel.

## Evidencias Por Area

### AuthController

- `registar()` valida dados, cria `Perfil`, gera token com `JWTAuth::fromUser($user)` e envia cookie `jwt_token`: `AuthController.php:21-109`.
- `login()` valida email/password, usa `JWTAuth::attempt($validated)`, pega user com `JWTAuth::user()` e envia cookie `jwt_token`: `AuthController.php:144-184`.
- `logout()` le o cookie, invalida com `JWTAuth::setToken($token)->invalidate()` e remove o cookie: `AuthController.php:189-214`.
- `logoutApi()` nao existe apesar da rota.
- `refresh()` nao existe apesar da rota.
- `checkAuth()` usa sessao Laravel, nao JWT: `AuthController.php:132-137`.

### Middleware JWT

- Leitura do token: `JwtMiddleware.php:15`.
- Se nao houver cookie: redirect `/login`: `JwtMiddleware.php:17-19`.
- Autenticacao: `JwtMiddleware.php:21`.
- Qualquer excecao vira redirect `/login`: `JwtMiddleware.php:23-25`.

### Middleware de Funcao

- Le novamente `jwt_token`: `RoleMiddleware.php:16`.
- Autentica novamente: `RoleMiddleware.php:22`.
- Compara `funcao` com o parametro da rota: `RoleMiddleware.php:28-29`.
- Qualquer excecao vira redirect para rota `login`: `RoleMiddleware.php:34-36`.

### bootstrap/app.php

- `role` e `jwt.auth` estao registados: `bootstrap/app.php:18-22`.
- `auth.jwt` nao esta registado.
- Existe um `withMiddleware` vazio antes do real: `bootstrap/app.php:14-16`. Nao e a causa principal, mas e ruido.

### Rotas

- Publicas: `/`, `/escolher-funcao`, `/login`, `/registar/cliente`, `/registar/freelancer`: `routes/web.php:18-31`.
- Auth: `/registar`, `/login`, `/logout`, `/logout-api`, `/check-auth`, `/refresh-token`: `routes/web.php:39-52`.
- Painel cliente protegido: `jwt.auth` + `role:cliente`: `routes/web.php:60-71`.
- Painel freelancer protegido: `jwt.auth` + `role:freelancer`: `routes/web.php:80-156`.
- Problemas: imports inexistentes em `routes/web.php:9-10`; metodos inexistentes em `routes/web.php:45-52`; rotas `profiles` estao publicas em `routes/web.php:164-170`.

### Configuracao JWT

- `JWT_SECRET` existe no `.env` (valor omitido por seguranca).
- `JWT_TTL=1440`.
- `JWT_REFRESH_TTL=20160`.
- `JWT_BLACKLIST_ENABLED=true`.
- `config/jwt.php` ativo e apenas o primeiro `return`: `config/jwt.php:11-43`.
- Blacklist ativada: `config/jwt.php:35`.
- `decrypt_cookies=false`: `config/jwt.php:37`.

### Configuracao Auth

- Guard default `web`: `config/auth.php:7-9`.
- Guard `web` usa driver `session`: `config/auth.php:12-16`.
- Provider `users` usa `App\Models\Perfil`: `config/auth.php:19-23`.
- O model correto para JWTAuth esta apontado, mas o guard e de sessao.

### Model Perfil

- Extende `Authenticatable`: `Perfil.php:5` e `Perfil.php:15`.
- Implementa `JWTSubject`: `Perfil.php:12` e `Perfil.php:15`.
- Usa tabela `perfis`: `Perfil.php:19`.
- `getJWTIdentifier()` retorna a primary key: `Perfil.php:64-67`.
- `getJWTCustomClaims()` retorna array vazio: `Perfil.php:69-72`.

Compatibilidade JWT: boa. O model esta essencialmente correto para JWTAuth.

### Cookies e Headers

No login AJAX, o browser envia:

- `X-CSRF-TOKEN`, se a meta tag existir.
- `Accept: application/json`.
- `X-Requested-With: XMLHttpRequest`.
- Cookies ja existentes, porque `credentials: 'include'` esta ativo.

Na resposta do login, Laravel envia `Set-Cookie: jwt_token=...` com HttpOnly. Como o cookie e HttpOnly, JS nao consegue le-lo, mas o navegador envia automaticamente no request seguinte para `/painel/...`.

No request protegido ao painel, espera-se:

- `Cookie: jwt_token=...`
- cookie de sessao Laravel, se existir
- `XSRF-TOKEN`, se criado pela stack web

Para GET do painel, o essencial e `jwt_token`; `XSRF-TOKEN` nao e necessario para autenticar.

## Fluxo Completo

1. Login: `public/js/login.js` faz `fetch('/login')` com `credentials: 'include'`.
2. Validacao: `AuthController@login` valida email e password.
3. Token: `JWTAuth::attempt($validated)` gera JWT.
4. Cookie: resposta HTTP 200 recebe `jwt_token` HttpOnly.
5. Redirect: frontend navega para `/painel/cliente` ou `/painel/freelancer`.
6. Middleware JWT: rota executa `jwt.auth`, le `jwt_token` e chama `JWTAuth::setToken($token)->authenticate()`.
7. Middleware role: rota executa `role:cliente` ou `role:freelancer`, autentica de novo e compara `$user->funcao`.
8. Controller: `DashboardController` e instanciado.
9. Falha provavel: o construtor chama `$this->middleware('auth.jwt')`, mas o alias nao existe e o controller base nao tem esse metodo.
10. Resultado: o login parece correto, mas a renderizacao do painel nao chega limpa ao `return view(...)`.

## Correcoes Recomendadas

1. Corrigir primeiro o `DashboardController`.

   Remover o construtor inteiro:

   ```php
   public function __construct()
   {
       $this->middleware('auth.jwt');
   }
   ```

   As rotas ja aplicam `jwt.auth` e `role`.

2. Corrigir imports de controllers em `routes/web.php`.

   Trocar:

   ```php
   use App\Http\Controllers\Freelancer\JobController;
   use App\Http\Controllers\Freelancer\ProposalController;
   ```

   por:

   ```php
   use App\Http\Controllers\JobController;
   use App\Http\Controllers\ProposalController;
   ```

   Ou criar os controllers no namespace `App\Http\Controllers\Freelancer`.

3. Remover ou implementar as rotas quebradas:

   - implementar `AuthController::logoutApi()`;
   - implementar `AuthController::refresh()`;
   - ou remover `/logout-api` e `/refresh-token` ate existirem.

4. Melhorar `JwtMiddleware` para logar excecoes especificas.

   Capturar `TokenExpiredException`, `TokenInvalidException` e `JWTException` separadamente. Para requests JSON/API, retornar JSON 401; para paginas, redirecionar.

5. Evitar autenticar duas vezes.

   `JwtMiddleware` deve anexar o usuario ao request:

   ```php
   $user = JWTAuth::setToken($token)->authenticate();
   $request->setUserResolver(fn () => $user);
   ```

   Depois `RoleMiddleware` pode usar `$request->user()` em vez de chamar JWTAuth de novo.

6. Ajustar `checkAuth()` para JWT.

   Ler `jwt_token` e autenticar via `JWTAuth::setToken($token)->authenticate()`.

7. Limpar `config/jwt.php`.

   Manter apenas um `return`. Isto reduz confusao e evita falsas alteracoes em configuracao morta.

8. Rever cookies.

   Padronizar SameSite (`Lax` e suficiente para redirect same-origin), manter `HttpOnly=true`, `Path=/`, `Secure=false` em ambiente local e `Secure=true` em HTTPS.

9. Rever sessao.

   Se usar `SESSION_DRIVER=file`, nao precisa da tabela `sessions`.
   Se usar `SESSION_DRIVER=database`, alterar `sessions.user_id` para suportar UUID/string ou nao associar user_id de sessao.

10. Corrigir frontend defensivo.

   Verificar se a meta CSRF existe antes de acessar `.content` e tratar respostas HTML/redirect antes de chamar `response.json()`.

## Correcao Prioritaria

Alteracao unica mais provavel para resolver o bloqueio do painel:

```php
// app/Http/Controllers/DashboardController.php
// Remover completamente:
public function __construct()
{
    $this->middleware('auth.jwt');
}
```

Motivo: as rotas ja usam `jwt.auth` e `role`. O construtor aplica um alias errado (`auth.jwt`) e, neste projeto, o controller base nao tem suporte ao metodo `$this->middleware()`.

## Conclusao Final

O login funciona porque `AuthController@login` valida as credenciais, gera o JWT e devolve HTTP 200 com o cookie `jwt_token`. O redirect tambem funciona porque o frontend usa `window.location.href`.

O acesso ao painel falha porque o pedido seguinte entra num pipeline protegido com configuracao inconsistente. O JWT pode ate estar presente e valido, mas antes da pagina ser renderizada o sistema passa por middlewares duplicados e por um `DashboardController` que tenta usar `auth.jwt`, um middleware que nao foi registado. Alem disso, as rotas contem referencias inexistentes que ja impedem ate `php artisan route:list`.

Portanto, o problema principal nao esta no armazenamento do cookie pelo navegador. Esta na configuracao do pipeline apos o redirect: alias errado no controller, rotas quebradas e tratamento de excecoes que transforma causas diferentes em "nao autorizado" ou redirect para login.
