<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kriteria;

class KriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Menambah kriteria untuk pemilihan beasiswa beserta bobotnya

        Kriteria::create([
            'nama' => 'Semester',
            'jenis' => 'benefit',
            'bobot' => 0.10,  // 10
            'deskripsi' => 'Kriteria berdasarkan Semester mahasiswa.',
        ]);

        Kriteria::create([
            'nama' => 'Penghasilan Orang Tua',
            'jenis' => 'cost',
            'bobot' => 0.30,  // 30%
            'deskripsi' => 'Kriteria yang menilai penghasilan orang tua untuk menentukan kebutuhan finansial mahasiswa.',
        ]);

        Kriteria::create([
            'nama' => 'Tanggungan',
            'jenis' => 'cost',
            'bobot' => 0.20,  // 20%
            'deskripsi' => 'Kriteria berdasarkan jumlah anggota keluarga yang menjadi tanggungan mahasiswa.',
        ]);

        Kriteria::create([
            'nama' => 'Prestasi',
            'jenis' => 'benefit',
            'bobot' => 0.15,  // 15%
            'deskripsi' => 'Kriteria berdasarkan prestasi yang dimiliki mahasiswa, baik di bidang olahraga, seni, maupun lainnya.',
        ]);

        Kriteria::create([
            'nama' => 'IPK',
            'jenis' => 'benefit',
            'bobot' => 0.25,  // 25
            'deskripsi' => 'Kriteria berdasarkan nilai akhir yang diperoleh mahasiswa setelah proses seleksi.',
        ]);
    }
}