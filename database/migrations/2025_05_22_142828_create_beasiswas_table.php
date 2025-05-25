<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('beasiswas', function (Blueprint $table) {
            $table->id();
            $table->string('nama');  // Nama beasiswa
            $table->text('deskripsi');  // Deskripsi beasiswa
            $table->date('batas_pendaftaran');  // Batas pendaftaran
            $table->integer('peserta_count')->default(0);  // Jumlah peserta, default 0
            $table->enum('status', ['aktif', 'non-aktif']);  // Status beasiswa
            $table->decimal('jumlah_pendanaan', 15, 2);  // Jumlah pendanaan
            $table->integer('kuota_penerima');  // Kuota penerima
            $table->date('tanggal_mulai');  // Tanggal mulai
            $table->date('tanggal_berakhir');  // Tanggal berakhir
            $table->text('persyaratan');  // Persyaratan beasiswa
            $table->string('info_kontak');  // Info kontak
            $table->timestamps();  // Created at, Updated at
        });
    }

    public function down()
    {
        Schema::dropIfExists('beasiswas');
    }
};
