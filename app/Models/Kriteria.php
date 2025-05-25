<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    use HasFactory;

    // Menentukan kolom yang bisa diisi
    protected $fillable = [
        'nama', 'jenis', 'bobot', 'deskripsi'
    ];
}