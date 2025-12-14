<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
// 1. TAMBAHKAN IMPORT INI PENTING
use Symfony\Component\HttpFoundation\BinaryFileResponse; 

class PreventBackHistory
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // 2. TAMBAHKAN PENGECEKAN INI
        // Jika response-nya adalah file download, biarkan lewat tanpa diubah
        if ($response instanceof BinaryFileResponse) {
            return $response;
        }

        // Jika bukan download (halaman web biasa), baru tambahkan header anti-back
        return $response->withHeaders([
            'Cache-Control' => 'no-cache, no-store, max-age=0, must-revalidate',
            'Pragma' => 'no-cache',
            'Expires' => 'Sun, 02 Jan 1990 00:00:00 GMT',
        ]);
    }
}