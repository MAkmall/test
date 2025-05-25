<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BeasiswaRequest extends FormRequest
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
            'nama.required' => 'Nama beasiswa harus diisi.',
            'deskripsi.required' => 'Deskripsi beasiswa harus diisi.',
        ];
    }
}

