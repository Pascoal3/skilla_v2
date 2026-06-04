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
