@extends('layouts.app')

@section('title', 'Dashboard')

@push('styles')
<!-- Additional CSS for dashboard -->
<style>
        /* Menghapus margin dan padding pada content-wrapper */
    .content-wrapper {
        margin: 0;
        padding: 0;
    }

    /* Menghapus margin pada container-fluid */
    .container-fluid {
        margin: 0;
        padding: 0;
    }

    /* Mengatur agar sidebar tetap rapat */
    .sidebar {
        padding-top: 0;
        margin-top: 0;
        height: 100vh;
        position: fixed; /* Membuat sidebar tetap di kiri */
        z-index: 99;
    }

    /* Membuat main content lebih rapat dengan sidebar */
    .main-content {
        margin-left: 250px; /* Menyesuaikan dengan lebar sidebar */
    }

    /* Menjaga agar layout tidak terlalu padat */
    .row {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin: 0;
    }

    /* Kolom akan lebih responsif */
    .col-lg-3, .col-sm-6 {
        flex: 1 1 23%;
        margin-bottom: 20px;
    }

    /* Info box styling */
    .info-box {
        cursor: pointer;
        transition: transform 0.2s;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    .info-box:hover {
        transform: translateY(-5px);
    }

    /* Menjaga card lebih rapi dan tidak terpotong */
    .card {
        margin-bottom: 20px;
    }

    /* Membuat layout responsif */
    @media (max-width: 992px) {
        .sidebar {
            width: 200px;
        }

        .main-content {
            margin-left: 0;
        }

        .col-lg-3 {
            flex: 1 1 48%;
        }
    }

    @media (max-width: 768px) {
        .col-lg-3 {
            flex: 1 1 100%;
        }
    }

    .chart-container {
    display: flex;
    justify-content: center;  /* Memusatkan secara horizontal */
    align-items: center;      /* Memusatkan secara vertikal */
    height: 400px;            /* Menentukan tinggi chart agar pas */
}
    /* Kolom mengisi seluruh lebar pada perangkat sangat kecil */

    </style>
@endpush
@section('content')
    <div class="container">
        <h1>Daftar Beasiswa</h1>
        <a href="{{ route('admin.beasiswa.create') }}" class="btn btn-primary mb-3">Buat Beasiswa Baru</a>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama Beasiswa</th>
                    <th>Deskripsi</th>
                    <th>Status</th>
                    <th>Jumlah Pendanaan</th>
                    <th>Kuota Penerima</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($beasiswas as $beasiswa)
                    <tr>
                        <td>{{ $beasiswa->nama }}</td>
                        <td>{{ $beasiswa->deskripsi }}</td>
                        <td>{{ ucfirst($beasiswa->status) }}</td>
                        <td>{{ number_format($beasiswa->jumlah_pendanaan, 2, ',', '.') }}</td>
                        <td>{{ $beasiswa->kuota_penerima }}</td>
                        <td>
                            <a href="{{ route('admin.beasiswa.index', $beasiswa->id) }}" class="btn btn-info btn-sm">Lihat</a>
                            <a href="{{ route('admin.beasiswa.edit', $beasiswa->id) }}" class="btn btn-warning btn-sm">Edit</a>

                            <form action="{{ route('admin.beasiswa.destroy', $beasiswa->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus beasiswa ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
