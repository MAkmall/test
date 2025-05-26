<?php

namespace App\Services;

use App\Models\PenilaianPeserta;
use App\Models\Kriteria;
use App\Models\Peserta;

class SAWService
{
    public function hitung()
    {
        $pesertas = Peserta::with('penilaian')->get();
        $kriterias = Kriteria::all();
        $results = [];
        $maxValues = [];
        $minValues = [];

        // Ambil nilai maksimum dan minimum untuk normalisasi
        foreach ($kriterias as $kriteria) {
            $values = PenilaianPeserta::where('kriteria_id', $kriteria->id)->pluck('nilai');
            $maxValues[$kriteria->id] = $values->max() ?: 1;
            $minValues[$kriteria->id] = $values->min() ?: 1;
        }

        // Hitung nilai akhir dan tentukan status
        foreach ($pesertas as $peserta) {
            $totalNilai = 0;
            foreach ($peserta->penilaian as $penilaian) {
                $kriteria = $penilaian->kriteria;
                $normalized = $kriteria->is_benefit
                    ? $penilaian->nilai / $maxValues[$kriteria->id]
                    : $minValues[$kriteria->id] / $penilaian->nilai;
                $totalNilai += $normalized * $kriteria->bobot;
            }

            // Tentukan status berdasarkan nilai akhir
            $status = $totalNilai >= 0.8 ? 'lolos' : 'tidak_lolos';

            // Simpan nilai akhir dan status
            PenilaianPeserta::where('peserta_id', $peserta->id)->update(['nilai_akhir' => $totalNilai]);
            Peserta::where('id', $peserta->id)->update(['status' => $status]);

            $results[$peserta->id] = [
                'peserta' => $peserta,
                'nilai_akhir' => $totalNilai,
                'status' => $status,
            ];
        }

        return $results;
    }
}
