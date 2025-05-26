<?php

namespace App\Http\Controllers;

use App\Models\Peserta;
use App\Models\Kriteria;
use App\Models\PenilaianPeserta;
use App\Services\SAWService;
use Illuminate\Http\Request;

class PenilaianController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $pesertas = Peserta::with('penilaian')->get();
        $sawService = new SAWService();
        $results = $sawService->hitung();

        return view('admin.penilaian.index', compact('pesertas', 'results'));
    }

    public function create($peserta_id)
    {
        $peserta = Peserta::findOrFail($peserta_id);
        $kriterias = Kriteria::all();
        return view('admin.penilaian.create', compact('peserta', 'kriterias'));
    }

    public function store(Request $request, $peserta_id)
    {
        $request->validate([
            'nilai' => 'required|array',
            'nilai.*' => 'required|numeric|min:0',
        ]);

        $peserta = Peserta::findOrFail($peserta_id);

        foreach ($request->nilai as $kriteria_id => $nilai) {
            PenilaianPeserta::updateOrCreate(
                [
                    'peserta_id' => $peserta_id,
                    'kriteria_id' => $kriteria_id,
                ],
                [
                    'nilai' => $nilai,
                ]
            );
        }

        $sawService = new SAWService();
        $results = $sawService->hitung();
        $result = $results[$peserta_id] ?? ['nilai_akhir' => 0, 'status' => 'tidak_lolos'];

        PenilaianPeserta::where('peserta_id', $peserta_id)
            ->update(['nilai_akhir' => $result['nilai_akhir']]);
        $peserta->update(['status' => $result['status']]);

        return redirect()->route('admin.penilaian.index')
            ->with('success', 'Penilaian berhasil disimpan dan status diperbarui.');
    }

    public function show($peserta_id)
    {
        $peserta = Peserta::findOrFail($peserta_id);
        $penilaian = PenilaianPeserta::where('peserta_id', $peserta_id)
                                     ->with('kriteria')
                                     ->get();
        return view('admin.penilaian.show', compact('peserta', 'penilaian'));
    }

    public function edit($peserta_id)
    {
        $peserta = Peserta::findOrFail($peserta_id);
        $kriterias = Kriteria::all();
        $penilaian = PenilaianPeserta::where('peserta_id', $peserta_id)
                                     ->pluck('nilai', 'kriteria_id')
                                     ->toArray();
        return view('admin.penilaian.edit', compact('peserta', 'kriterias', 'penilaian'));
    }

    public function update(Request $request, $peserta_id)
    {
        $request->validate([
            'nilai' => 'required|array',
            'nilai.*' => 'required|numeric|min:0',
        ]);

        $peserta = Peserta::findOrFail($peserta_id);

        foreach ($request->nilai as $kriteria_id => $nilai) {
            PenilaianPeserta::updateOrCreate(
                [
                    'peserta_id' => $peserta_id,
                    'kriteria_id' => $kriteria_id,
                ],
                [
                    'nilai' => $nilai,
                ]
            );
        }

        $sawService = new SAWService();
        $results = $sawService->hitung();
        $result = $results[$peserta_id] ?? ['nilai_akhir' => 0, 'status' => 'tidak_lolos'];

        PenilaianPeserta::where('peserta_id', $peserta_id)
            ->update(['nilai_akhir' => $result['nilai_akhir']]);
        $peserta->update(['status' => $result['status']]);

        return redirect()->route('admin.penilaian.index')
            ->with('success', 'Penilaian berhasil diperbarui dan status diperbarui.');
    }

    public function destroy($peserta_id)
    {
        $peserta = Peserta::findOrFail($peserta_id);
        PenilaianPeserta::where('peserta_id', $peserta_id)->delete();
        $peserta->update(['status' => 'pending']);

        return redirect()->route('admin.penilaian.index')
            ->with('success', 'Penilaian peserta berhasil dihapus dan status direset.');
    }
}
