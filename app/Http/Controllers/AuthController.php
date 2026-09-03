<?php

namespace App\Http\Controllers;

use App\Models\Perfil;
use App\Models\Provincia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function registar(Request $request)
    {
        try {
            Log::info('Tentativa de registro:', $request->except('password'));

            $validated = $request->validate([
                'primeiro_nome' => 'required|string|max:255',
                'sobrenome' => 'required|string|max:255',
                'email' => 'required|email|unique:perfis,email',
                'password' => 'required|string|min:8',
                'provincia_id' => 'required|string',
                'funcao' => 'required|in:cliente,freelancer',
            ]);

            $nomeProvincia = str_replace('-', ' ', $validated['provincia_id']);
            $provincia = Provincia::whereRaw('LOWER(nome) LIKE ?', ['%' . strtolower($nomeProvincia) . '%'])->first();

            if (!$provincia) {
                return response()->json([
                    'errors' => ['provincia_id' => ['Provincia nao encontrada']],
                ], 422);
            }

            $username = Perfil::generateUniqueUsername(
                $validated['primeiro_nome'],
                $validated['sobrenome']
            );

            $user = DB::transaction(function () use ($validated, $provincia, $username) {
                $perfil = Perfil::create([
                    'primeiro_nome' => $validated['primeiro_nome'],
                    'sobrenome' => $validated['sobrenome'],
                    'email' => $validated['email'],
                    'password' => Hash::make($validated['password']),
                    'nome_usuario' => $username,
                    'provincia_id' => $provincia->id,
                    'funcao' => $validated['funcao'],
                    'email_verified_at' => now(),
                    'esta_ativo' => true,
                ]);

                $perfil->carteira()->create([
                    'saldo' => 20,
                ]);

                return $perfil;
            });

            $token = JWTAuth::fromUser($user);

            return $this->withJwtCookie(response()->json([
                'status' => 201,
                'message' => 'Conta criada com sucesso!',
                'role' => $user->funcao,
                'redirect' => $this->redirectFor($user),
                'user' => $this->userPayload($user),
            ], 201), $token);
        } catch (ValidationException $e) {
            return response()->json([
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            Log::error('Erro no registro', [
                'message' => $e->getMessage(),
                'exception' => get_class($e),
                'line' => $e->getLine(),
                'file' => $e->getFile(),
            ]);

            return response()->json([
                'status' => 500,
                'message' => 'Erro interno ao criar conta. Tente novamente.',
            ], 500);
        }
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (!$token = JWTAuth::attempt($validated)) {
            return response()->json([
                'status' => 401,
                'message' => 'Email ou senha invalidos.',
            ], 401);
        }

        $user = JWTAuth::user();

        return $this->withJwtCookie(response()->json([
            'status' => 200,
            'message' => 'Login realizado com sucesso!',
            'redirect' => $this->redirectFor($user),
            'user' => $this->userPayload($user),
        ]), $token);
    }

    public function checkAuth(Request $request)
    {
        $token = $request->cookie('jwt_token');

        if (!$token) {
            return response()->json([
                'authenticated' => false,
                'message' => 'Token not provided',
            ], 401);
        }

        try {
            $user = JWTAuth::setToken($token)->authenticate();

            return response()->json([
                'authenticated' => (bool) $user,
                'user' => $user ? $this->userPayload($user) : null,
            ], $user ? 200 : 401);
        } catch (TokenExpiredException $e) {
            return response()->json([
                'authenticated' => false,
                'message' => 'Token expired',
            ], 401);
        } catch (TokenInvalidException $e) {
            return response()->json([
                'authenticated' => false,
                'message' => 'Token invalid',
            ], 401);
        } catch (JWTException $e) {
            return response()->json([
                'authenticated' => false,
                'message' => 'JWT authentication failed',
            ], 401);
        }
    }

    public function refresh(Request $request)
    {
        $token = $request->cookie('jwt_token');

        if (!$token) {
            return response()->json([
                'message' => 'Token not provided',
            ], 401);
        }

        try {
            $newToken = JWTAuth::setToken($token)->refresh();
            $user = JWTAuth::setToken($newToken)->authenticate();

            return $this->withJwtCookie(response()->json([
                'status' => 200,
                'message' => 'Token atualizado com sucesso.',
                'user' => $this->userPayload($user),
            ]), $newToken);
        } catch (TokenExpiredException $e) {
            return response()->json([
                'message' => 'Token expired',
            ], 401);
        } catch (TokenInvalidException $e) {
            return response()->json([
                'message' => 'Token invalid',
            ], 401);
        } catch (JWTException $e) {
            return response()->json([
                'message' => 'JWT refresh failed',
            ], 401);
        }
    }

    public function logout(Request $request)
    {
        $this->invalidateTokenFromCookie($request);

        return redirect()
            ->route('login')
            ->withCookie(cookie()->forget('jwt_token', '/'));
    }

    public function logoutApi(Request $request)
    {
        $this->invalidateTokenFromCookie($request);

        return response()
            ->json([
                'status' => 200,
                'message' => 'Logout realizado com sucesso.',
            ])
            ->withCookie(cookie()->forget('jwt_token', '/'));
    }

    private function invalidateTokenFromCookie(Request $request): void
    {
        $token = $request->cookie('jwt_token');

        if (!$token) {
            return;
        }

        try {
            JWTAuth::setToken($token)->invalidate();
        } catch (JWTException $e) {
            Log::warning('JWT logout ignored invalid token', [
                'message' => $e->getMessage(),
            ]);
        }
    }

    private function withJwtCookie($response, string $token)
    {
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
    }

    private function redirectFor(Perfil $user): string
    {
        return $user->funcao === 'cliente' ? '/painel/cliente' : '/painel/freelancer';
    }

    private function userPayload(Perfil $user): array
    {
        return [
            'id' => $user->id,
            'nome' => $user->nome_completo,
            'email' => $user->email,
            'funcao' => $user->funcao,
            'nome_usuario' => $user->nome_usuario,
        ];
    }
}
