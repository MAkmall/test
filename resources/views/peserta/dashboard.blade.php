@extends('layouts.app')
<head>
    <title>Dashboard Peserta</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <h1>Dashboard Peserta</h1>

    <p>Selamat datang, {{ Auth::user()->name }}!</p>
    <p>Waktu saat ini: {{ date('H:i A, l, d F Y') }} WITA</p> <!-- Menampilkan waktu lokal WITA -->

    <h2>Informasi Pendaftaran</h2>
    <p>Total Pendaftaran: {{ $totalPendaftaran }}</p>
    <p>Total Lolos: {{ $totalLulus }}</p>

    <h2>Daftar Pendaftaran</h2>
    @if ($daftarPendaftaran->isNotEmpty())
        <table>
            <tr>
                <th>Nama</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
            @foreach ($daftarPendaftaran as $pendaftaran)
                <tr>
                    <td>{{ $pendaftaran->nama }}</td>
                    <td>{{ $pendaftaran->status ?? 'Pending' }}</td>
                    <td>
                        <a href="{{ route('peserta.edit', $pendaftaran->id) }}">Edit</a>
                        <form action="{{ route('peserta.destroy', $pendaftaran->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    @else
        <p>Belum ada pendaftaran.</p>
    @endif

    <h2>Aksi</h2>
    <a href="{{ route('pendaftaran') }}" class="btn btn-primary">Daftar Beasiswa</a>
    <a href="{{ route('peserta.status') }}">Lihat Status</a>
    <a href="{{ route('peserta.riwayat') }}">Lihat Riwayat Penilaian</a>
    <a href="{{ route('logout') }}">Logout</a>

    <style>
        .btn {
            display: inline-block;
            padding: 10px 20px;
            margin: 5px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</body>