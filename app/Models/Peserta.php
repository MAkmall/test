<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peserta extends Model
{
    use HasFactory;

    // Menentukan kolom yang bisa diisi
    protected $fillable = [
        'nama',
        'tempat_tanggal_lahir',
        'alamat',
        'semester',
        'tanggungan',
        'penghasilan_orang_tua',
        'ipk',
        'transkrip',
        'prestasi',
        'surat_aktif_kuliah',
        'beasiswa_id',
        'user_id',
    ];

    // Relasi ke tabel beasiswas (beasiswa)
    public function beasiswa()
    {
        return $this->belongsTo(Beasiswa::class, 'beasiswa_id');
    }

    // Relasi ke tabel users (user)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
