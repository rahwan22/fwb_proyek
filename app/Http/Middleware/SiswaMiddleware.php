<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiswaMiddleware
{
    public function handle($request, Closure $next)
    {
        if (auth()->check() && auth()->user()->role === 'siswas') {
            return $next($request);
        }

        // Jika bukan siswa, tolak akses atau redirect
        return redirect('/login')->with('error', 'Akses hanya untuk siswa.');
    }
}
