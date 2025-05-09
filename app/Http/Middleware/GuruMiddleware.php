<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuruMiddleware
{
    public function handle($request, Closure $next)
    {
        if (auth()->check() && auth()->user()->role === 'guru') {
            return $next($request);
        }
        

        
        return redirect('/login')->with('error', 'Akses hanya untuk guru.');
    }
}
