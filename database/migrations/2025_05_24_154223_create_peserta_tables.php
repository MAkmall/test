<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pesertas', function (Blueprint $table) {
            $table->id();
            $table->string('nama');  // Nama peserta
            $table->date('tempat_tanggal_lahir');  // Tempat dan tanggal lahir
            $table->text('alamat');  // Alamat peserta
            $table->string('semester');  // Semester peserta
            $table->string('tanggungan');  // Jumlah tanggungan keluarga
            $table->decimal('penghasilan_orang_tua', 15, 2);  // Penghasilan orang tua
            $table->decimal('ipk', 3, 2);  // IPK peserta
            $table->string('transkrip');  // Transkrip nilai
            $table->text('prestasi');  // Prestasi yang dimiliki
            $table->string('surat_aktif_kuliah');  // Surat aktif kuliah
            $table->foreignId('beasiswa_id')->constrained('beasiswas')->onDelete('cascade');  // Foreign key ke beasiswa
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');  // Foreign key ke user
            $table->decimal('saw_score', 5, 2);  // Nilai SAW peserta
            $table->timestamps();  // Created at, Updated at
        });
    }

    public function down()
    {
        Schema::dropIfExists('pesertas');
    }
};
