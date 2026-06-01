<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

class AuthenticateWithJWT
{
    public function handle(Request $request, Closure $next)
    {
        try {
            // Tenta autenticar pelo token no cookie
            $token = $request->cookie('jwt_token');
            
            if (!$token) {
                return redirect()->route('login')->with('error', 'Faça login para continuar.');
            }

            // Valida e autentica o usuário
            $user = JWTAuth::setToken($token)->authenticate();
            
            if (!$user) {
                return redirect()->route('login')->with('error', 'Sessão expirada. Faça login novamente.');
            }

            // Passa o usuário para a requisição
            $request->merge(['authenticated_user' => $user]);
            
            return $next($request);
            
        } catch (TokenExpiredException $e) {
            return redirect()->route('login')->with('error', 'Sessão expirada. Faça login novamente.');
        } catch (TokenInvalidException $e) {
            return redirect()->route('login')->with('error', 'Token inválido. Faça login novamente.');
        } catch (JWTException $e) {
            return redirect()->route('login')->with('error', 'Erro de autenticação.');
        }
    }
}