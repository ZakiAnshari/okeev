<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class DetectMobileRedirect
{
    public function handle(Request $request, Closure $next)
    {
        $userAgent = $request->header('User-Agent');
        // Deteksi mobile sederhana
        $isMobile = preg_match('/Mobile|Android|iPhone|iPad|iPod|BlackBerry|Opera Mini|IEMobile/', $userAgent);
        // Simpan info device di request
        $request->merge(['is_mobile' => $isMobile]);
        return $next($request);
    }
}
