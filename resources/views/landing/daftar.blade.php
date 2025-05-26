@extends('layouts.app')

@section('title', 'Form Pendaftaran Beasiswa')

@section('content')
<div style="max-width: 600px; margin: auto;">
    <h2>Form Pendaftaran Beasiswa</h2>

    @if ($errors->any())
        <div style="color: red;">
            <strong>Terjadi kesalahan:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('pendaftaran.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <label>Nama:</label>
        <input type="text" name="nama" value="{{ old('nama') }}" required><br>

        <label>Tempat & Tanggal Lahir:</label>
        <input type="date" name="tempat_tanggal_lahir" value="{{ old('tempat_tanggal_lahir') }}" required><br>

        <label>Alamat:</label>
        <textarea name="alamat" required>{{ old('alamat') }}</textarea><br>

        <label>Semester:</label>
        <input type="text" name="semester" value="{{ old('semester') }}" required><br>

        <label>Jumlah Tanggungan Keluarga:</label>
        <input type="text" name="tanggungan" value="{{ old('tanggungan') }}" required><br>

        <label>Penghasilan Orang Tua (Rp):</label>
        <input type="number" name="penghasilan_orang_tua" value="{{ old('penghasilan_orang_tua') }}" required><br>

        <label>IPK:</label>
        <input type="number" step="0.01" name="ipk" value="{{ old('ipk') }}" min="0" max="4" required><br>

        <label>Foto Transkrip Nilai:</label>
        <input type="file" name="transkrip" accept="image/*" required><br>

        <label>Foto Prestasi (Opsional):</label>
        <input type="file" name="prestasi" accept="image/*"><br>

        <label>Foto Surat Aktif Kuliah:</label>
        <input type="file" name="surat_aktif_kuliah" accept="image/*" required><br>

        <button type="submit" style="margin-top: 15px;">Kirim</button>
    </form>
</div>

<style>
    form label {
        display: block;
        margin-top: 10px;
    }

    input, textarea {
        width: 100%;
        padding: 8px;
        box-sizing: border-box;
    }

    button {
        padding: 10px 20px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 5px;
    }

    button:hover {
        background-color: #0056b3;
    }
</style>
@endsection
