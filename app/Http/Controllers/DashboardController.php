<?php

namespace App\Http\Controllers;

use App\Models\Peserta;
use App\Models\Beasiswa;
use App\Models\Kriteria;
use App\Models\BeasiswaPeserta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Hitung total data untuk statistik
        $pesertaCount = Peserta::count();
        $kriteriaCount = Kriteria::count();
        $laporanCount = BeasiswaPeserta::whereNotNull('nilai_akhir')->count();

        // Data aktivitas terbaru (contoh)
        $aktivitasTerbaru = [
            [
                'waktu' => '2 jam lalu',
                'deskripsi' => 'Peserta baru mendaftar beasiswa'
            ],
            [
                'waktu' => '5 jam lalu', 
                'deskripsi' => 'Proses seleksi beasiswa selesai'
            ],
            [
                'waktu' => '1 hari lalu',
                'deskripsi' => 'Kriteria baru ditambahkan'
            ]
        ];

        // Data untuk chart (contoh)
        $chartData = [
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            'pendaftar' => [10, 15, 8, 20, 12, 25],
            'lulus' => [8, 12, 6, 15, 10, 20]
        ];

        return view('admin.dashboard', compact(
            'pesertaCount', 
            'kriteriaCount', 
            'laporanCount',
            'aktivitasTerbaru',
            'chartData'
        ));
    }

    public function logout(Request $req){
        Auth::logout();
        $req->session()->invalidate();
        $req->session()->regenerateToken();
        return redirect('/');
    }

    public function peserta()
    {
        // Redirect ke halaman landing
        return view('landing.dashboard');
    }
}