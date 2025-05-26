<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePesertaTable extends Migration
{
    public function up()
    {
        Schema::create('pesertas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('nama');
            $table->date('tempat_tanggal_lahir');
            $table->string('alamat');
            $table->string('semester');
            $table->string('tanggungan');
            $table->decimal('penghasilan_orang_tua', 15, 2);
            $table->decimal('ipk', 3, 2);
            $table->string('transkrip');
            $table->string('prestasi')->nullable();
            $table->string('surat_aktif_kuliah');
            $table->string('status')->nullable()->default('pending');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pesertas');
    }
}
