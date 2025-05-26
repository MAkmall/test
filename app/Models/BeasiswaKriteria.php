<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BeasiswaKriteria extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika tidak mengikuti konvensi Laravel (tabel ini adalah tabel pivot)
    protected $table = 'beasiswa_kriterias';

    // Tentukan kolom yang bisa diisi secara mass-assignment
    protected $fillable = [
        'kriteria_id',
        'bobot',
    ];

    // Relasi dengan Kriteria
    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class);
    }
}
