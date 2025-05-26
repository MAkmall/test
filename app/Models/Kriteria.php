<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    protected $table = 'kriterias';
    protected $fillable = ['nama', 'jenis','bobot', 'deskripsi'];

    public function penilaian()
    {
        return $this->hasMany(PenilaianPeserta::class);
    }
}