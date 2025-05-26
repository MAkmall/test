<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusToPesertasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pesertas', function (Blueprint $table) {
            $table->string('status')->nullable()->after('saw_score');
        });
    }

    public function down()
    {
        Schema::table('pesertas', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
}
