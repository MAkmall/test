<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Cek apakah pengguna login dan apakah role-nya adalah admin
        if (Auth::check() && Auth::user()->role == 'admin') {
            return $next($request);
        }

        // Jika bukan admin, arahkan ke halaman login
        return redirect()->route('login');
    }
    
}
