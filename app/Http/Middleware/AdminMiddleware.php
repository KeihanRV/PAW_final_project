<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Cek apakah user sudah login
        // 2. Cek apakah user memiliki role 'admin'
        if (!auth()->check() || auth()->user()->role !== 'admin') {
            
            // Jika tidak memenuhi syarat, tolak akses dan arahkan ke dashboard
            return redirect('/dashboard')->with('error', 'Akses Ditolak. Anda bukan Administrator.');
        }

        return $next($request);
    }
}
