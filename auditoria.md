# Auditoria e correcao do sistema JWT

## 1. Diagnostico completo do 401

O problema nao estava no facto de o login criar ou nao o cookie. O login emitia `jwt_token`, mas o fluxo protegido tinha uma quebra entre middleware e controller:

1. O middleware autenticava o JWT, mas o contexto autenticado nao estava totalmente consolidado para o resto da request.
2. O `RoleMiddleware` antigo revalidava o JWT novamente, criando uma segunda oportunidade para falhar depois de uma autenticacao valida.
3. O `DashboardController` ainda chamava `JWTAuth::setToken(...)->authenticate()` manualmente nas rotas de API, mesmo depois de a rota ja passar por `jwt.auth`.
4. Quando uma chamada interna nao recebia o token da forma esperada, surgia `Token not provided`.
5. As respostas de erro nao distinguiam token ausente, expirado e invalido, dificultando o debug.

Causa raiz: o sistema misturava autenticacao por cookie JWT no middleware com reautenticacoes manuais no role/controller. O fluxo correto e autenticar uma vez no `JwtMiddleware`, injetar o user no request e usar apenas `$request->user()` dali em diante.

## 2. Fluxo real corrigido

1. `public/js/login.js` faz `fetch('/login')` com `credentials: 'include'`.
2. `AuthController@login` valida credenciais e chama `JWTAuth::attempt($validated)`.
3. O token e enviado no cookie `jwt_token`.
4. O browser navega para `/painel/cliente` ou `/painel/freelancer`.
5. A rota protegida executa `jwt.auth`.
6. `JwtMiddleware` le `$request->cookie('jwt_token')`.
7. `JwtMiddleware` chama `JWTAuth::setToken($token)->authenticate()`.
8. O user e injetado com `$request->setUserResolver(fn () => $user)` e `Auth::setUser($user)`.
9. `RoleMiddleware` usa apenas `$request->user()` e compara `funcao`.
10. `DashboardController` usa apenas `$request->user()`, sem chamar JWTAuth de novo.
11. As views `/painel/*` renderizam e as rotas `/api/*/dashboard` respondem JSON usando o user ja autenticado.

## 3. Erros encontrados

1. `DashboardController` ainda reautenticava manualmente o token nas APIs.

   Antes:

   ```php
   $token = $request->cookie('jwt_token');
   $user = \Tymon\JWTAuth\Facades\JWTAuth::setToken($token)->authenticate();
   ```

   Isto foi removido. Agora o controller usa `$request->user()`.

2. `RoleMiddleware` nao devia validar JWT outra vez.

   Foi ajustado para depender apenas do user injetado pelo `JwtMiddleware`.

3. `JwtMiddleware` precisava expor melhor o erro real.

   Foi ajustado para separar:

   - `jwt_token_missing`
   - `jwt_token_expired`
   - `jwt_token_invalid`
   - `jwt_auth_failed`
   - `jwt_user_not_found`

4. O contexto global `Auth` podia ficar vazio para codigo legado.

   Foi adicionado `Auth::setUser($user)` no middleware, alem de `setUserResolver`. Isto ajuda controllers existentes que ainda usam `Auth::id()` ou `Auth::user()`.

5. `AuthController` tinha rotas declaradas para metodos inexistentes.

   Foram implementados:

   - `logoutApi()`
   - `refresh()`

6. `checkAuth()` usava `Auth::check()` de sessao web, nao o cookie JWT.

   Foi refeito para validar `jwt_token`.

7. `config/jwt.php` tinha dois `return`.

   Foi limpo para uma unica configuracao ativa.

8. `config/auth.php` nao tinha guard `api` JWT.

   Foi adicionado:

   ```php
   'api' => [
       'driver' => 'jwt',
       'provider' => 'users',
   ],
   ```

9. `public/js/login.js` tentava ler o body duas vezes em caso de erro.

   Foi corrigido para usar `response.json().catch(() => ({}))` e mostrar a mensagem recebida.

## 4. Codigo corrigido

### JwtMiddleware

Ficheiro: `app/Http/Middleware/JwtMiddleware.php`

```php
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;

class JwtMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $token = $request->cookie('jwt_token');

        if (!$token) {
            return $this->unauthorized($request, 'Token not provided', 'jwt_token_missing');
        }

        try {
            $user = JWTAuth::setToken($token)->authenticate();

            if (!$user) {
                return $this->unauthorized($request, 'User not found for token', 'jwt_user_not_found');
            }

            $request->setUserResolver(fn () => $user);
            Auth::setUser($user);
        } catch (TokenExpiredException $e) {
            Log::warning('JWT expired', ['path' => $request->path()]);

            return $this->unauthorized($request, 'Token expired', 'jwt_token_expired');
        } catch (TokenInvalidException $e) {
            Log::warning('JWT invalid', ['path' => $request->path()]);

            return $this->unauthorized($request, 'Token invalid', 'jwt_token_invalid');
        } catch (JWTException $e) {
            Log::warning('JWT authentication error', [
                'path' => $request->path(),
                'message' => $e->getMessage(),
            ]);

            return $this->unauthorized($request, 'JWT authentication failed', 'jwt_auth_failed');
        }

        return $next($request);
    }

    private function unauthorized(Request $request, string $message, string $code)
    {
        if ($request->expectsJson() || $request->is('api/*')) {
            return response()->json([
                'message' => $message,
                'code' => $code,
            ], 401);
        }

        return redirect('/login')->with('error', $message);
    }
}
```

### RoleMiddleware

Ficheiro: `app/Http/Middleware/RoleMiddleware.php`

```php
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string $role)
    {
        $user = $request->user();

        if (!$user) {
            if ($request->expectsJson() || $request->is('api/*')) {
                return response()->json([
                    'message' => 'Authenticated user not found',
                    'code' => 'role_user_missing',
                ], 401);
            }

            return redirect('/login');
        }

        if ($user->funcao !== $role) {
            if ($request->expectsJson() || $request->is('api/*')) {
                return response()->json([
                    'message' => 'Acesso negado.',
                    'code' => 'role_forbidden',
                    'required_role' => $role,
                    'user_role' => $user->funcao,
                ], 403);
            }

            abort(403, 'Acesso negado.');
        }

        return $next($request);
    }
}
```

### DashboardController

Ficheiro: `app/Http/Controllers/DashboardController.php`

```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function freelancer(Request $request)
    {
        return view('painel.painel_freelancer', [
            'user' => $request->user(),
        ]);
    }

    public function cliente(Request $request)
    {
        return view('painel.painel_cliente', [
            'user' => $request->user(),
        ]);
    }

    public function freelancerData(Request $request)
    {
        $user = $request->user();

        return response()->json([
            'user' => $this->userPayload($user),
            'metrics' => [],
        ]);
    }

    public function clienteData(Request $request)
    {
        $user = $request->user();

        return response()->json([
            'user' => $this->userPayload($user),
            'metrics' => [],
        ]);
    }
}
```

### AuthController

Ficheiro: `app/Http/Controllers/AuthController.php`

Alteracoes principais:

- `login()` usa `JWTAuth::attempt()`.
- Cookie `jwt_token` e sempre `HttpOnly`, path `/`, SameSite `Lax`.
- `checkAuth()` valida o cookie JWT, nao a sessao Laravel.
- `refresh()` gera novo token e atualiza o cookie.
- `logout()` e `logoutApi()` invalidam o token e removem o cookie.

Cookie aplicado:

```php
return $response->cookie(
    'jwt_token',
    $token,
    (int) config('jwt.ttl', 1440),
    '/',
    null,
    (bool) config('session.secure', false),
    true,
    false,
    'Lax'
);
```

## 5. Rotas corrigidas/validadas

As rotas protegidas continuam com o formato certo:

```php
Route::middleware(['jwt.auth', 'role:cliente'])->group(function () {
    Route::get('/painel/cliente', [DashboardController::class, 'cliente']);
    Route::get('/api/cliente/dashboard', [DashboardController::class, 'clienteData']);
});

Route::middleware(['jwt.auth', 'role:freelancer'])->group(function () {
    Route::get('/painel/freelancer', [DashboardController::class, 'freelancer']);
    Route::get('/api/freelancer/dashboard', [DashboardController::class, 'freelancerData']);
});
```

Foi executado `php artisan route:list` e as rotas carregaram corretamente. As rotas de painel e API aparecem registadas.

## 6. Explicacao clara da causa raiz

O JWTAuth nao le cookies automaticamente neste fluxo. Ele so valida o token quando alguem chama:

```php
JWTAuth::setToken($token)->authenticate();
```

Por isso, o lugar certo para fazer isso e apenas o `JwtMiddleware`. Depois disso, o resto da aplicacao deve usar `$request->user()`.

O 401 inesperado acontecia porque havia chamadas manuais adicionais ao JWTAuth depois da autenticacao inicial. Quando essas chamadas nao encontravam o token no contexto esperado, o erro virava `Token not provided`. A correcao foi transformar o middleware no ponto unico de autenticacao e remover revalidacoes no role/controller.

## 7. Checklist de testes

1. Limpar cookies do navegador para o dominio local.
2. Fazer login com utilizador `cliente`.
3. Confirmar no DevTools que a resposta de `POST /login` tem `Set-Cookie: jwt_token=...`.
4. Confirmar que o cookie tem:

   - `HttpOnly`
   - `Path=/`
   - `SameSite=Lax`

5. Abrir `/painel/cliente`.

   Resultado esperado: pagina abre sem 401.

6. Com o mesmo cliente, abrir `/api/cliente/dashboard`.

   Resultado esperado: JSON com `user.funcao = cliente`.

7. Com o mesmo cliente, abrir `/painel/freelancer`.

   Resultado esperado: 403, porque o role nao corresponde.

8. Fazer logout.

   Resultado esperado: cookie `jwt_token` removido.

9. Abrir `/api/cliente/dashboard` sem cookie.

   Resultado esperado: JSON 401 com:

   ```json
   {
     "message": "Token not provided",
     "code": "jwt_token_missing"
   }
   ```

10. Repetir login com utilizador `freelancer`.

    Resultado esperado:

    - `/painel/freelancer` abre sem 401
    - `/api/freelancer/dashboard` retorna JSON
    - `/painel/cliente` retorna 403

## 8. Validacao executada

Comandos executados com sucesso:

```text
php -l app\Http\Middleware\JwtMiddleware.php
php -l app\Http\Middleware\RoleMiddleware.php
php -l app\Http\Controllers\DashboardController.php
php -l app\Http\Controllers\AuthController.php
php -l config\jwt.php
php artisan route:list
php artisan config:clear
php artisan test
```

Resultado: sem erros de sintaxe, rotas carregadas, cache de configuracao limpa e testes do projeto aprovados (`2 passed`).

## 9. Estado final

O fluxo estabilizado agora e:

```text
cookie jwt_token -> JwtMiddleware -> request user -> RoleMiddleware -> DashboardController
```

O painel deixa de depender de chamadas manuais a `JWTAuth` dentro do controller. Isso remove a causa mais provavel do 401 e do erro `Token not provided` depois do login.
