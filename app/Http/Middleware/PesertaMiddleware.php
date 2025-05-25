<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PesertaMiddleware
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
        // Cek apakah pengguna login dan apakah role-nya adalah peserta
        if (Auth::check() && Auth::user()->role == 'peserta') {
            return $next($request);
        }

        // Jika bukan peserta, arahkan ke halaman login
        return redirect()->route('login');
    }
}
