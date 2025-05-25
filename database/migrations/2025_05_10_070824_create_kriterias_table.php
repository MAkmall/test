<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('kriterias', function (Blueprint $table) {
            $table->id();
            $table->string('nama');  // Nama kriteria
            $table->string('jenis');  // Jenis kriteria (misalnya: akademik, non-akademik)
            $table->decimal('bobot', 5, 2);  // Bobot kriteria
            $table->text('deskripsi');  // Deskripsi kriteria
            $table->timestamps();  // Kolom created_at dan updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('kriterias');
    }
};
