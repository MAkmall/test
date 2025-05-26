<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\PenilaianPesertaController;

class Peserta extends Model
{
    protected $table = 'pesertas';
    protected $fillable = [
        'user_id',
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
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function penilaian()
    {
        return $this->hasMany(PenilaianPeserta::class);
    }
}
