<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRoleNotOne
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Jika user login dan role_id = 1, redirect ke dashboard
        if (Auth::check() && Auth::user()->role_id == 1) {
            return redirect('/dashboard');
        }

        // Jika role lain atau belum login, lanjutkan request
        return $next($request);
    }
}
