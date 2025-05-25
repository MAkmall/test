<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KriteriaRequest extends FormRequest
{
    /**
     * Tentukan apakah pengguna dapat mengakses permintaan ini.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // Pastikan untuk mengganti sesuai dengan kebutuhan otorisasi
    }

    /**
     * Dapatkan aturan validasi untuk permintaan ini.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'bobot' => 'required|numeric|min:1|max:10', // Bobot antara 1 hingga 10
        ];
    }

    /**
     * Pesan kustom untuk validasi
     *
     * @return array
     */
    public function messages()
    {
        return [
            'nama.required' => 'Nama kriteria harus diisi.',
            'deskripsi.required' => 'Deskripsi kriteria harus diisi.',
            'bobot.required' => 'Bobot kriteria harus diisi.',
            'bobot.numeric' => 'Bobot kriteria harus berupa angka.',
            'bobot.min' => 'Bobot kriteria harus lebih besar atau sama dengan 1.',
            'bobot.max' => 'Bobot kriteria harus kurang dari atau sama dengan 10.',
        ];
    }
}

