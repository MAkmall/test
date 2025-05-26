<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Peserta Beasiswa</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .no-file {
            color: #e53e3e;
            font-style: italic;
        }
        .alert-success {
            background-color: #d4edda;
            color: #155724;
            padding: 1rem;
            border-radius: 0.5rem;
            margin-bottom: 1rem;
        }
        a {
            color: #2b90d7;
            text-decoration: none;
            transition: color 0.3s ease;
        }
        a:hover {
            color: #553c9a;
            text-decoration: underline;
        }
        table th, table td {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
    </style>
</head>
<body class="bg-gray-100 font-sans">
    @extends('layouts.app')

    @section('content')
        <div class="container mx-auto p-6 max-w-7xl">
            <h1 class="text-3xl font-bold text-center text-purple-800 mb-6">Daftar Peserta Beasiswa</h1>

            @if(session('success'))
                <div class="alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white rounded-lg shadow-lg overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-gradient-to-r from-purple-600 to-purple-800 text-white">
                        <tr>
                            <th class="p-4 text-sm font-semibold">Nama Peserta</th>
                            <th class="p-4 text-sm font-semibold">Tempat Tanggal Lahir</th>
                            <th class="p-4 text-sm font-semibold">Alamat</th>
                            <th class="p-4 text-sm font-semibold">IPK</th>
                            <th class="p-4 text-sm font-semibold">Semester</th>
                            <th class="p-4 text-sm font-semibold">Penghasilan Orang Tua</th>
                            <th class="p-4 text-sm font-semibold">Transkrip</th>
                            <th class="p-4 text-sm font-semibold">Prestasi</th>
                            <th class="p-4 text-sm font-semibold">Surat Aktif Kuliah</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($peserta as $peserta)
                            <tr class="border-b hover:bg-purple-50 transition duration-200">
                                <td class="p-4 text-gray-700">{{ $peserta->nama }}</td>
                                <td class="p-4 text-gray-700">{{ $peserta->tempat_tanggal_lahir }}</td>
                                <td class="p-4 text-gray-700">{{ $peserta->alamat }}</td>
                                <td class="p-4 text-gray-700">{{ $peserta->ipk }}</td>
                                <td class="p-4 text-gray-700">{{ $peserta->semester }}</td>
                                <td class="p-4 text-gray-700">{{ number_format($peserta->penghasilan_orang_tua, 2, ',', '.') }}</td>
                                <td class="p-4">
                                    @if($peserta->transkrip)
                                        <a href="{{ asset('storage/' . $peserta->transkrip) }}" target="_blank">
                                            Lihat Transkrip
                                        </a>
                                    @else
                                        <span class="no-file">Tidak ada</span>
                                    @endif
                                </td>
                                <td class="p-4">
                                    @if($peserta->prestasi)
                                        <a href="{{ asset('storage/' . $peserta->prestasi) }}" target="_blank">
                                            Lihat Prestasi
                                        </a>
                                    @else
                                        <span class="no-file">Tidak ada</span>
                                    @endif
                                </td>
                                <td class="p-4">
                                    @if($peserta->surat_aktif_kuliah)
                                        <a href="{{ asset('storage/' . $peserta->surat_aktif_kuliah) }}" target="_blank">
                                            Lihat Surat Aktif Kuliah
                                        </a>
                                    @else
                                        <span class="no-file">Tidak ada</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endsection
</body>
</html>