<?php

namespace App\Http\Controllers;

use App\Models\Perfil;
use App\Models\Provincia;
use App\Models\Carteira;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Facades\JWTAuth; // ← ADICIONADO para JWT

class AuthController extends Controller
{
    /**
     * Registro de novo usuário (Cliente ou Freelancer)
     */
    public function registar(Request $request)
    {
        try {
            Log::info('Tentativa de registro:', $request->all());

            $validated = $request->validate([
                'primeiro_nome' => 'required|string|max:255',
                'sobrenome'     => 'required|string|max:255',
                'email'         => 'required|email|unique:perfis,email',
                'password'      => 'required|string|min:8',
                'provincia_id'  => 'required|string',
                'funcao'        => 'required|in:cliente,freelancer',
            ]);

            // Buscar província pelo slug
            $nomeProvinciaSlug = $validated['provincia_id'];
            $nomeProvincia = str_replace('-', ' ', $nomeProvinciaSlug);

            $provincia = Provincia::whereRaw('LOWER(nome) LIKE ?', ['%' . strtolower($nomeProvincia) . '%'])->first();

            if (!$provincia) {
                return response()->json([
                    'errors' => ['provincia_id' => ['Província não encontrada']]
                ], 422);
            }

            // Gerar username único
            $username = Perfil::generateUniqueUsername(
                $validated['primeiro_nome'], 
                $validated['sobrenome']
            );

            // Criar usuário dentro de transação
            $user = DB::transaction(function () use ($validated, $provincia, $username) {
                // Criar Perfil
                $perfil = Perfil::create([
                    'primeiro_nome'      => $validated['primeiro_nome'],
                    'sobrenome'          => $validated['sobrenome'],
                    'email'              => $validated['email'],
                    'password'           => Hash::make($validated['password']),
                    'nome_usuario'       => $username,
                    'provincia_id'       => $provincia->id,
                    'funcao'             => $validated['funcao'],
                    'email_verified_at'  => now(),
                    'esta_ativo'         => true,
                ]);

                // Criar Carteira com saldo inicial (opcional, conforme sua regra de negócio)
                Carteira::create([
                    'perfil_id' => $perfil->id,
                    'saldo'     => 10.00, // Saldo de boas-vindas
                ]);

                return $perfil;
            });

            // Gerar Token JWT
            $token = JWTAuth::fromUser($user);

            // Preparar resposta JSON
            $response = response()->json([
                'status'   => 201,
                'message'  => 'Conta criada com sucesso!',
                'role'     => $user->funcao,
                'redirect' => $user->funcao === 'cliente' ? '/painel/cliente' : '/painel/freelancer',
                'user'     => [
                    'id'             => $user->id,
                    'nome'           => $user->nome_completo,
                    'email'          => $user->email,
                    'funcao'         => $user->funcao,
                    'nome_usuario'   => $user->nome_usuario,
                ]
            ], 201);

            // Enviar token em cookie HttpOnly (seguro)
            $response->withCookie(cookie(
                'jwt_token',           // Nome do cookie
                $token,                // Valor (token JWT)
                1440,                  // Duração em minutos (24 horas)
                '/',                   // Path
                null,                  // Domain (null = atual)
                false,                 // Secure (true apenas em HTTPS)
                true,                  // HttpOnly (não acessível via JS)
                false,                 // Raw
                'Strict'               // SameSite
            ));

            Log::info('Usuário registrado com sucesso:', ['user_id' => $user->id, 'email' => $user->email]);

            return $response;

        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::warning('Validação falhou no registro:', $e->errors());
            
            return response()->json([
                'errors' => $e->errors()
            ], 422);
            
        } catch (\Exception $e) {
            Log::error('Erro no registro: ' . $e->getMessage(), [
                'exception' => get_class($e),
                'line'      => $e->getLine(),
                'file'      => $e->getFile()
            ]);
            
            return response()->json([
                'status'  => 500,
                'message' => 'Erro interno ao criar conta. Tente novamente.',
            ], 500);
        }
    }

    /**
     * Login de usuário existente
     */
    public function login(Request $request)
    {
        try {
            Log::info('Tentativa de login:', ['email' => $request->email]);

            $validated = $request->validate([
                'email'    => 'required|email',
                'password' => 'required|string',
            ]);

            // Tentar autenticar com JWT
            if (!$token = JWTAuth::attempt($validated)) {
                Log::warning('Falha no login - credenciais inválidas', ['email' => $request->email]);
                
                return response()->json([
                    'status'  => 401,
                    'message' => 'Email ou senha inválidos.',
                    'errors'  => ['email' => ['Credenciais inválidas']]
                ], 401);
            }

            $user = auth()->user();

            // Verificar se usuário está ativo
            if (!$user->esta_ativo) {
                JWTAuth::invalidate($token);
                
                return response()->json([
                    'status'  => 403,
                    'message' => 'Conta desativada. Contacte o suporte.',
                ], 403);
            }

            // Preparar resposta
            $response = response()->json([
                'status'   => 200,
                'message'  => 'Login realizado com sucesso!',
                'role'     => $user->funcao,
                'redirect' => $user->funcao === 'cliente' ? '/painel/cliente' : '/painel/freelancer',
                'user'     => [
                    'id'           => $user->id,
                    'nome'         => $user->nome_completo,
                    'email'        => $user->email,
                    'funcao'       => $user->funcao,
                    'nome_usuario' => $user->nome_usuario,
                ]
            ]);

            // Enviar token em cookie HttpOnly
            $response->withCookie(cookie(
                'jwt_token',
                $token,
                1440,    // 24 horas
                '/',
                null,
                false,   // Secure (mude para true em produção com HTTPS)
                true,    // HttpOnly
                false,
                'Strict'
            ));

            Log::info('Login realizado com sucesso:', ['user_id' => $user->id, 'email' => $user->email]);

            return $response;

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'errors' => $e->errors()
            ], 422);
            
        } catch (\Exception $e) {
            Log::error('Erro no login: ' . $e->getMessage());
            
            return response()->json([
                'status'  => 500,
                'message' => 'Erro interno ao fazer login. Tente novamente.',
            ], 500);
        }
    }

    /**
     * Logout de usuário
     */
    public function logout(Request $request)
    {
        try {
            $token = $request->cookie('jwt_token');
            
            if ($token) {
                // Invalidar token (adiciona à blacklist)
                JWTAuth::setToken($token)->invalidate();
                
                Log::info('Logout realizado', ['token_invalidated' => true]);
            }

            // Redirecionar para login
            $response = redirect()->route('login');
            
            // Remover cookie
            $response->withCookie(cookie()->forget('jwt_token'));

            return $response;

        } catch (\Exception $e) {
            Log::error('Erro no logout: ' . $e->getMessage());
            
            return redirect()->route('login')->with('error', 'Erro ao fazer logout.');
        }
    }

    /**
     * Logout via API (para AJAX)
     */
    public function logoutApi(Request $request)
    {
        try {
            $token = $request->cookie('jwt_token');
            
            if ($token) {
                JWTAuth::setToken($token)->invalidate();
            }

            $response = response()->json([
                'status'  => 200,
                'message' => 'Logout realizado com sucesso.',
                'redirect' => '/login'
            ]);

            $response->withCookie(cookie()->forget('jwt_token'));

            return $response;

        } catch (\Exception $e) {
            return response()->json([
                'status'  => 500,
                'message' => 'Erro ao fazer logout.',
            ], 500);
        }
    }

    /**
     * Verificar se usuário está autenticado (para AJAX)
     */
    public function checkAuth(Request $request)
    {
        try {
            $token = $request->cookie('jwt_token');
            
            if (!$token) {
                return response()->json([
                    'authenticated' => false,
                    'message'       => 'Nenhum token encontrado.'
                ], 401);
            }
            
            $user = JWTAuth::setToken($token)->authenticate();
            
            if (!$user) {
                return response()->json([
                    'authenticated' => false,
                    'message'       => 'Token inválido ou expirado.'
                ], 401);
            }
            
            return response()->json([
                'authenticated' => true,
                'user' => [
                    'id'           => $user->id,
                    'nome'         => $user->nome_completo,
                    'email'        => $user->email,
                    'funcao'       => $user->funcao,
                    'nome_usuario' => $user->nome_usuario,
                    'avatar'       => $user->url_avatar,
                ]
            ]);
            
        } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            return response()->json([
                'authenticated' => false,
                'message'       => 'Token expirado.'
            ], 401);
            
        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response()->json([
                'authenticated' => false,
                'message'       => 'Token inválido.'
            ], 401);
            
        } catch (\Exception $e) {
            return response()->json([
                'authenticated' => false,
                'message'       => 'Erro ao verificar autenticação.'
            ], 500);
        }
    }

    /**
     * Refresh de token (estender sessão)
     */
    public function refresh()
    {
        try {
            $newToken = JWTAuth::refresh();

            $response = response()->json([
                'status'  => 200,
                'message' => 'Token atualizado com sucesso.',
            ]);

            $response->withCookie(cookie(
                'jwt_token',
                $newToken,
                1440,
                '/',
                null,
                false,
                true,
                false,
                'Strict'
            ));

            return $response;

        } catch (\Exception $e) {
            return response()->json([
                'status'  => 401,
                'message' => 'Não foi possível atualizar o token.',
            ], 401);
        }
    }
}