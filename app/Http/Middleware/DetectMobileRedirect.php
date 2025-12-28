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

        // Jika mobile & bukan route /m
        if ($isMobile && ! $request->is('m*')) {
            return redirect()->to('/m');
        }

        return $next($request);
    }
}
