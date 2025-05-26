<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PenilaianPeserta extends Model
{
    protected $table = 'penilaian_pesertas';
    protected $fillable = ['peserta_id', 'kriteria_id', 'nilai', 'nilai_akhir'];

    public function peserta()
    {
        return $this->belongsTo(Peserta::class);
    }

    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class);
    }
}
