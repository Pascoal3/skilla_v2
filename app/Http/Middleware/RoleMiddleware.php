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
