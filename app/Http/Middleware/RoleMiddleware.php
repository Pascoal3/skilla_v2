<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        try {

            $token = $request->cookie('jwt_token');

            if (!$token) {
                return redirect()->route('login');
            }

            $user = JWTAuth::setToken($token)->authenticate();

            if (!$user) {
                return redirect()->route('login');
            }

            if ($user->funcao !== $role) {
                abort(403, 'Acesso negado.');
            }

            return $next($request);

        } catch (\Exception $e) {

            return redirect()->route('login');
        }
    }
}