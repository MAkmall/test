<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Beasiswa extends Model
{
    protected $fillable = [
        'nama',
        'deskripsi',
        'batas_pendaftaran',
        'peserta_count',
        'status',
        'jumlah_pendanaan',
        'kuota_penerima',
        'tanggal_mulai',
        'tanggal_berakhir',
        'persyaratan',
        'info_kontak',
    ];




        public function pendaftaran()
    {
        return $this->hasMany(Peserta::class);
    }
    // Relasi dengan model Peserta
    public function peserta()
    {
        return $this->belongsToMany(Peserta::class, 'beasiswa_pesertas');
    }
}
