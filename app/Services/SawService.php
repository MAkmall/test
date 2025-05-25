<?php

namespace App\Services;

use App\Models\Beasiswa;
use App\Models\BeasiswaKriteria;
use App\Models\BeasiswaPeserta;

class SAWService
{
    /**
     * Menghitung ranking peserta berdasarkan metode SAW
     */
    public function hitung($beasiswaId)
    {
        // Ambil semua peserta dari beasiswa terkait
        $pesertas = BeasiswaPeserta::where('beasiswa_id', $beasiswaId)->get();
        if ($pesertas->isEmpty()) {
            return []; // Jika tidak ada peserta, kembalikan array kosong
        }

        // Ambil semua kriteria dan bobotnya
        $kriterias = BeasiswaKriteria::with('kriteria')
            ->where('beasiswa_id', $beasiswaId)
            ->get();

        if ($kriterias->isEmpty()) {
            return []; // Jika tidak ada kriteria, kembalikan array kosong
        }

        $weights = $kriterias->pluck('bobot')->toArray();
        $types = $kriterias->pluck('kriteria.jenis')->toArray();
        $kriteriaIds = $kriterias->pluck('kriteria_id')->toArray();

        // Susun matriks keputusan
        $matrix = [];
        foreach ($pesertas as $peserta) {
            $row = [];
            foreach ($kriteriaIds as $kriteriaId) {
                $key = "kriteria_{$kriteriaId}";

                // Memeriksa apakah kunci tersedia pada peserta
                if (isset($peserta->$key)) {
                    $row[] = $peserta->$key;
                } else {
                    $row[] = 0; // Jika kunci tidak ada, set nilai default
                }
            }
            $matrix[] = $row;
        }

        // Normalisasi
        $normalized = [];
        for ($j = 0; $j < count($weights); $j++) {
            $col = array_column($matrix, $j);
            $max = max($col);
            $min = min($col);
            foreach ($matrix as $i => $row) {
                $normalized[$i][$j] = $types[$j] === 'benefit'
                    ? $row[$j] / $max
                    : $min / $row[$j];
            }
        }

        // Hitung skor akhir tiap peserta
        $results = [];
        foreach ($normalized as $i => $row) {
            $score = 0;
            foreach ($row as $j => $value) {
                $score += $value * $weights[$j];
            }
            $results[] = [
                'peserta' => optional($pesertas[$i]->peserta)->nama,  // Menggunakan optional untuk menghindari error jika tidak ada relasi
                'score' => round($score, 4),
            ];
        }

        // Urutkan dari tertinggi ke terendah
        usort($results, function($a, $b) {
            return $b['score'] <=> $a['score'];
        });

        return $results;
    }
}

