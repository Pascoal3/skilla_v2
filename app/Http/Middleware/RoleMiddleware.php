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
            return redirect('/login');
        }

        if ($user->funcao !== $role) {
            abort(403, 'Acesso negado.');
        }

        return $next($request);
    }
}