<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function index(): View
        {
            return view ('landing.login');
        }

    public function login(Request $request)
    {

        $data = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);

        $email = $data['email'];
        $password = $data['password'];

        if (Auth::attempt(array('email' => $email, 'password' => $password, 'role' => 'admin'))) {
            $request->session()->regenerate();
            return redirect('/admin');
        } else if (Auth::attempt(array('email' => $email, 'password' => $password, 'role' => 'peserta'))) {
            $request->session()->regenerate();
            return redirect('/peserta/dashboard');
        }

        return redirect('/login')->with('salah', 'Email atau kata sandi Anda salah!');
    }
}


