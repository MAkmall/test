<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('beasiswa_kriterias', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('beasiswa_id');
            $table->unsignedBigInteger('kriteria_id');
            $table->decimal('bobot', 5, 2);
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('beasiswa_kriterias');
    }
};
