<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BeasiswaPeserta extends Model
{
    use HasFactory;

    protected $fillable = [
        'peserta_id',
        'beasiswa_id',
        'nilai',
        'status',
        'nilai_akhir',
    ];

    // Relasi dengan model Peserta
    public function peserta()
    {
        return $this->belongsTo(Peserta::class);
    }
}
