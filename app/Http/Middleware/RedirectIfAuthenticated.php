<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
     public function handle(Request $request, Closure $next)
    {
        // Jika sudah login → larang akses login/register
        if (auth()->check()) {

            // Arahkan sesuai role
            if (auth()->user()->role_id == 1) {
                return redirect('/dashboard');
            }

            if (auth()->user()->role_id == 2) {
                return redirect('/home');
            }
        }

        return $next($request);
    }
}
