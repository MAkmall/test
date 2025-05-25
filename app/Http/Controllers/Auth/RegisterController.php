<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use App\Models\Peserta;

class RegisterController extends Controller
{
    /*
    |----------------------------------------------------------------------
    | Register Controller
    |----------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        // Menampilkan halaman form registrasi
        return view('page.auth.register');
    }

    public function register(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'jenkel' => 'required|string|max:20',
            'no_hp' => 'required|string|max:20',
            'email' => 'required|email|unique:peserta,email',
            'password' => 'required|string|min:8|confirmed',
            'dokumen' => 'required|mimes:pdf,doc,docx|max:2048',
        ]);

        // Simpan file dokumen
        $dokumenPath = $request->file('dokumen')->store('dokumen', 'public');

        // Simpan data peserta
        Peserta::create([
            'nama' => $validated['name'],
            'jenkel' => $validated['jenkel'],
            'no_hp' => $validated['no_hp'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'dokumen' => $dokumenPath,
        ]);

        return redirect('/')->with('success', 'Registrasi berhasil!');
    }

    /**
     * Show the registration form.
     *
     * @return \Illuminate\View\View
     */
    public function showRegisterForm()
    {
        return view('page.auth.register');
    }

    /**
     * Handle the registration of a new user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validasi data yang diterima
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|min:5|unique:mahasiswa,nim',  // Validasi NIM
            'email' => 'required|email|unique:mahasiswa,email',  // Validasi email
            'password' => 'required|string|min:8|confirmed',  // Validasi password
            'dokumen' => 'required|mimes:pdf,doc,docx|max:2048',  // Validasi
        ]);

        // Proses registrasi peserta
        $mahasiswa = ModelPeserta::create([
            'nama' => $request->input('name'),
            'jenkel' => $request->input('jenkel'),
            'no_hp' => $request->input('no_hp'),
            'email' => $request->input('email'),
            'pas' => Hash::make($request->input('password')),  // Enkripsi password
        ]);

        // Setelah berhasil, redirect ke halaman utama dengan pesan sukses
        return redirect('/')->with('success', 'Berhasil registrasi');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:mahasiswa'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\Peserta
     */
    protected function create(array $data)
    {
        return ModelPeserta::create([
            'nama' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'telepon' => $data['telepon'],
            'dokumen' => $data['dokumen'],
        ]);
    }
}
