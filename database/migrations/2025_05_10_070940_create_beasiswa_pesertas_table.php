<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('beasiswa_pesertas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('peserta_id'); // Relasi ke peserta
            $table->unsignedBigInteger('beasiswa_id'); // Relasi ke beasiswa
            $table->decimal('nilai', 5, 2); // Nilai yang diberikan untuk peserta
            $table->string('status'); // Status kelulusan (Lulus/Tidak Lulus)
            $table->decimal('nilai_akhir', 5, 2); // Nilai akhir
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('beasiswa_pesertas');
    }
};