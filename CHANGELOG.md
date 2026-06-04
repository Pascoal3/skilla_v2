# CHANGELOG

## 2026-06-04 - Correcao do 401 nos paineis protegidos

### Corrigido

- Corrigido o erro `401 Unauthorized` ao abrir `/painel/cliente` e `/painel/freelancer` depois de login bem-sucedido.
- Corrigido o erro `Token not provided` causado pelo middleware errado.
- As rotas protegidas deixaram de usar o alias `jwt.auth` e passaram a usar `jwt.cookie`.
- O alias `jwt.cookie` foi registado em `bootstrap/app.php` apontando explicitamente para `App\Http\Middleware\JwtMiddleware`.
- As rotas protegidas em `routes/web.php` agora usam:

  ```php
  Route::middleware(['jwt.cookie', 'role:cliente'])
  Route::middleware(['jwt.cookie', 'role:freelancer'])
  ```

### Causa raiz

- O alias `jwt.auth` estava a ser resolvido pelo Laravel como `Tymon\JWTAuth\Http\Middleware\Authenticate`.
- Esse middleware do pacote `tymon/jwt-auth` procura token no header Authorization e nao no cookie `jwt_token`.
- Como o sistema guarda o JWT em cookie HttpOnly, o middleware do pacote nao encontrava token e retornava `401 Unauthorized`.
- A solucao foi usar um alias proprio, `jwt.cookie`, para garantir que as rotas passam pelo middleware customizado que le:

  ```php
  $request->cookie('jwt_token')
  ```

### Validado

- `php artisan route:clear`
- `php artisan config:clear`
- `php artisan route:list --path=painel -v`
- `php artisan route:list --path=api -v`
- `php -l bootstrap/app.php`
- `php -l routes/web.php`
- `php artisan test`

### Resultado esperado

- Login de cliente redireciona para `/painel/cliente` e abre o painel sem `401`.
- Login de freelancer redireciona para `/painel/freelancer` e abre o painel sem `401`.
- `/api/cliente/dashboard` e `/api/freelancer/dashboard` usam o cookie `jwt_token`.
- O `RoleMiddleware` recebe o user autenticado pelo middleware JWT por cookie.
