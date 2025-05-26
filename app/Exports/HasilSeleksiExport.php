<?php

namespace App\Exports;

use App\Models\Peserta;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class HasilSeleksiExport implements FromCollection, WithHeadings
{
    /**
     * Mengambil data peserta beserta hasil seleksi mereka.
     *
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // Mengambil data peserta dengan hasil seleksi mereka
        return Peserta::with('beasiswa')->get()->map(function ($peserta) {
            return [
                'nama' => $peserta->nama,
                'beasiswa' => $peserta->beasiswa->nama ?? '-',
                'nilai' => $peserta->nilai ?? '-',
                'status' => $peserta->status ?? '-',
                'nilai_akhir' => $peserta->nilai_akhir ?? '-',
            ];
        });
    }

    /**
     * Menentukan kolom headings untuk file Excel.
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'Nama Peserta',
            'Beasiswa',
            'Nilai',
            'Status',
            'Nilai Akhir',
        ];
    }
}
