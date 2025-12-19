<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{

    public function handle(Request $request, Closure $next): Response
    {
        // Jika belum login → redirect ke login
        if (!auth()->check()) {
            return redirect('/login');
        }

        // Jika role bukan admin
        if (auth()->user()->role_id != 1) {
            abort(403, 'Anda tidak memiliki akses.');
        }

        return $next($request);
    }
}
