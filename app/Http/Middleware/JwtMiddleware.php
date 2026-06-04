<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

class JwtMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $token = $request->cookie('jwt_token');

        if (!$token) {
            return redirect('/login');
        }

        try {
            $user = JWTAuth::setToken($token)->authenticate();

            if (!$user) {
                return redirect('/login');
            }

            // 🔥 importante: injeta o user no request
            $request->setUserResolver(fn () => $user);

        } catch (TokenExpiredException $e) {
            return redirect('/login')->with('error', 'Sessão expirada');

        } catch (TokenInvalidException $e) {
            return redirect('/login')->with('error', 'Token inválido');

        } catch (JWTException $e) {
            return redirect('/login')->with('error', 'Token ausente ou inválido');
        }

        return $next($request);
    }
}