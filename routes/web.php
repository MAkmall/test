<?php

use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BeasiswaController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\PesertaController;
use App\use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\LaporanController;
use FontLib\Table\Type\name;
use Illuminate\Auth\Events\Registered;

// Halaman utama 
Route::get('/',[LandingController::class, "index"]);
Route::post('/logout', [DashboardController::class, 'logout'])->name('logout');
Route::get('/login', [LoginController::class, 'index'])->middleware('guest');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'register'])->name('register');



Route::group(['middleware' => ['auth', 'role:admin']], function () {
    Route::get('/admin', [DashboardController::class, 'index'])->name ('admin.dashboard');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    // Admin Routes
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('beasiswa', BeasiswaController::class);
        Route::get('beasiswa/daftar', [BeasiswaController::class, 'daftar'])->name('landing.daftar');
        Route::resource('kriteria', KriteriaController::class);
        Route::get('penilaian', [PenilaianController::class, 'index'])->name('penilaian.index');
       Route::get('laporan', [LaporanController::class, 'index'])->name('laporan.index');
    });
});


Route::middleware(['auth', 'role:peserta'])->group(function () {
    Route::prefix('peserta')->group(function () {
        Route::get('dashboard', [PesertaController::class, 'index'])->name('landing.dashboard');
        Route::get('landing.daftar', [BeasiswaController::class, 'daftar'])->name('landing.daftar');
        Route::get('landing.pendaftaran', [BeasiswaController::class, 'mendaftar'])->name('landing.pendaftaran');
        Route::get('/beasiswa/daftar', [PesertaController::class, 'daftar'])->name('beasiswa.daftar'); // Alihkan ke PesertaController
        Route::post('/beasiswa/register/{beasiswa}', [PesertaController::class, 'submitDaftar'])->name('beasiswa.register');
        Route::get('riwayat', [PesertaController::class, 'riwayat'])->name('peserta.riwayat');
        Route::get('hasil/{peserta_id}', [PesertaController::class, 'hasil'])->name('peserta.hasil');
    });
});
