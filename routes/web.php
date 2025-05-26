<?php

use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BeasiswaController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\PesertaController;
use App\Http\Controllers\PenilaianController;
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

Route::group(['middleware' => ['auth', 'role:peserta']], function () {
    Route::get('/peserta', [PesertaController::class, 'create'])->name ('admin.dashboard');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    // Admin Routes
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('kriteria', KriteriaController::class);
        Route::resource('peserta', PesertaController::class);
        Route::resource('penilaian', PenilaianController::class);
        Route::get('/penilaian', [PenilaianController::class, 'index'])->name('penilaian.index');
        Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
        Route::get('admin/laporan/export/excel', [LaporanController::class, 'generateExcel'])->name('laporan.export.excel');
    });
});


Route::middleware(['auth', 'role:peserta'])->group(function () {
    Route::prefix('peserta')->group(function () {
        Route::get('peserta', [PesertaController::class, 'create'])->name('landing.dashboard');
        Route::get('peserta/status', [PesertaController::class, 'status'])->name('landing.status');
        Route::get('/pendaftaran', [PesertaController::class, 'daftar'])->name('pendaftaran');
        Route::post('/pendaftaran', [PesertaController::class, 'store'])->name('pendaftaran.store');
    });
});
