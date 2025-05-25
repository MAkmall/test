<?php

namespace App\Http\Controllers;

use App\Models\Peserta;
use App\Models\Beasiswa;
use App\Models\Kriteria;
use App\Models\BeasiswaPeserta;
use App\Services\SAWService;
use Illuminate\Http\Request;

class PenilainController extends Controller
{
    // Menampilkan daftar peserta yang terdaftar pada beasiswa tertentu
    public function index($beasiswa_id)
    {
        $beasiswa = Beasiswa::findOrFail($beasiswa_id);
        $pesertas = Peserta::whereHas('beasiswaPeserta', function($query) use ($beasiswa_id) {
            $query->where('beasiswa_id', $beasiswa_id);
        })->get();
        
        return view('admin.penilaian.index', compact('beasiswa', 'pesertas'));
    }

    // Menampilkan form untuk menilai peserta
    public function create($beasiswa_id, $peserta_id)
    {
        $beasiswa = Beasiswa::findOrFail($beasiswa_id);
        $peserta = Peserta::findOrFail($peserta_id);
        $kriterias = Kriteria::all();

        return view('admin.penilaian.create', compact('beasiswa', 'peserta', 'kriterias'));
    }

    // Menyimpan penilaian peserta
    public function store(Request $request, $beasiswa_id, $peserta_id)
    {
        // Validasi data penilaian
        $request->validate([
            'nilai' => 'required|array',
            'nilai.*' => 'required|numeric',
        ]);

        // Mencari peserta dan beasiswa yang akan dinilai
        $peserta = Peserta::findOrFail($peserta_id);
        $beasiswa = Beasiswa::findOrFail($beasiswa_id);

        // Simpan nilai untuk setiap kriteria
        foreach ($request->nilai as $kriteria_id => $nilai) {
            BeasiswaPeserta::updateOrCreate(
                [
                    'peserta_id' => $peserta_id,
                    'beasiswa_id' => $beasiswa_id,
                    'kriteria_id' => $kriteria_id,
                ],
                [
                    'nilai' => $nilai,
                ]
            );
        }

        // Hitung hasil akhir berdasarkan nilai yang diberikan dan metode SAW
        $sawService = new SAWService();
        $nilaiAkhir = $sawService->hitung($peserta_id);

        // Menyimpan hasil akhir
        BeasiswaPeserta::where('peserta_id', $peserta_id)
            ->where('beasiswa_id', $beasiswa_id)
            ->update(['nilai_akhir' => $nilaiAkhir]);

        return redirect()->route('admin.penilaian.index', $beasiswa_id)
            ->with('success', 'Penilaian berhasil disimpan dan hasil dihitung');
    }

    // Menampilkan hasil penilaian untuk peserta
    public function show($beasiswa_id, $peserta_id)
    {
        $beasiswa = Beasiswa::findOrFail($beasiswa_id);
        $peserta = Peserta::findOrFail($peserta_id);
        $penilaian = BeasiswaPeserta::where('peserta_id', $peserta_id)
                                    ->where('beasiswa_id', $beasiswa_id)
                                    ->first();
        return view('admin.penilaian.show', compact('beasiswa', 'peserta', 'penilaian'));
    }
}
