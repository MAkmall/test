<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Beasiswa;
use App\Models\Kriteria;
use App\Models\Peserta;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Memanggil seeder lainnya
        $this->call([
            UserSeeder::class,
            KriteriaSeeder::class,
            // Tambahkan seeder lainnya jika diperlukan
        ]);
    }
}