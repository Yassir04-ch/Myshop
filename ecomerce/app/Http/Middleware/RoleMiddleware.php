<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string $role): mixed
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        if (Auth::user()->role->name !== $role) {
            abort(403, 'Accès refusé');
        }

        return $next($request);
    }
}