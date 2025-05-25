<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Menampilkan halaman login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Proses login
    public function login(Request $request)
    {
        // Validasi input
        $credentials = $request->only('email', 'password');

        // Mencoba login
        if (Auth::attempt($credentials)) {
            // Regenerasi session setelah login sukses
        if(auth()->user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->route('peserta.dashboard');
        }

        }

        // Jika gagal login, kirimkan kembali dengan error
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('login');
    }
}
