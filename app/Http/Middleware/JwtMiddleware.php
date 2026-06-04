<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class JwtMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        try {

            $token = $request->cookie('jwt_token');

            if (!$token) {
                return redirect('/login');
            }

            JWTAuth::setToken($token)->authenticate();

        } catch (\Exception $e) {

            return redirect('/login');
        }

        return $next($request);
    }
}