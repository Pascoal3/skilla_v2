<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class JwtMiddleware
{
    public function handle($request, Closure $next)
{
    try {
        $token = $request->cookie('jwt_token');

        if (!$token) {
            return redirect('/login');
        }

        JWTAuth::setToken($token);
        $user = JWTAuth::authenticate();

        if (!$user) {
            return redirect('/login');
        }

    } catch (\Exception $e) {
        return redirect('/login');
    }

    return $next($request);
}
}