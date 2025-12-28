<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class DetectMobileRedirect
{
    public function handle(Request $request, Closure $next)
    {
        $userAgent = $request->header('User-Agent');

        $isMobile = preg_match(
            '/Mobile|Android|iPhone|iPad|iPod|BlackBerry|Opera Mini|IEMobile/i',
            $userAgent
        );

        // 1️⃣ MOBILE tapi akses NON /m → redirect ke /m
        if ($isMobile && ! $request->is('m*')) {
            return redirect('/m');
        }

        // 2️⃣ DESKTOP tapi akses /m → hapus prefix /m
        if (! $isMobile && $request->is('m*')) {
            $path = preg_replace('#^m/?#', '', $request->path());
            return redirect('/' . $path);
        }

        return $next($request);
    }
}
