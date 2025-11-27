<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Jika belum login → redirect ke login
        if (!auth()->check()) {
            return redirect('/login');
        }

        // Jika role bukan user (role_id 2)
        if (auth()->user()->role_id != 2) {
            abort(403, 'Anda tidak memiliki akses.');
        }

        return $next($request);
    }
}
