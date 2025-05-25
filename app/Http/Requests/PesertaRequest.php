<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PesertaRequest extends FormRequest
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
            'email' => 'required|email|unique:pesertas,email,' . $this->route('peserta'),
            'telepon' => 'required|string|max:15',
            'dokumen' => 'required|file|mimes:pdf,docx|max:2048', // Batas ukuran file 2MB
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
            'nama.required' => 'Nama peserta harus diisi.',
            'email.required' => 'Email peserta harus diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'telepon.required' => 'Nomor telepon harus diisi.',
            'dokumen.required' => 'Dokumen persyaratan harus diupload.',
            'dokumen.mimes' => 'Dokumen harus berformat PDF atau DOCX.',
            'dokumen.max' => 'Ukuran dokumen tidak boleh lebih dari 2MB.',
        ];
    }
}

