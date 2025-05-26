<?php

namespace App\Http\Controllers;

use App\Models\Beasiswa;
use App\Models\Peserta;
use App\Models\Kriteria;
use App\Services\SAWService;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Menampilkan halaman dashboard admin
    public function dashboard()
    {
        return view('dashboard');
    }

    // Menampilkan halaman pengelolaan peserta
    public function indexPeserta()
    {
        $pesertas = Peserta::all();
        return view('admin.peserta.index', compact('pesertas'));
    }

    // Menambahkan peserta baru
    public function createPeserta()
    {
        return view('admin.peserta.create');
    }

    // Mengelola seleksi menggunakan metode SAW
    public function prosesSeleksi(SAWService $sawService)
    {
        $pesertas = Peserta::all();
        foreach ($pesertas as $peserta) {
            $nilai = $sawService->hitung($peserta->id);
            // Simpan hasil seleksi pada tabel BeasiswaPeserta
            $peserta->beasiswaPeserta()->updateOrCreate([
                'peserta_id' => $peserta->id
            ], [
                'nilai' => $nilai,
                'status' => $nilai >= 70 ? 'Lulus' : 'Tidak Lulus',
            ]);
        }
        
        return redirect()->route('admin.laporan.index');
    }

    // Menampilkan laporan hasil seleksi
    public function laporan()
    {
        $hasil = Peserta::with('beasiswaPeserta')->get();
        return view('admin.laporan.index', compact('hasil'));
    }
}
