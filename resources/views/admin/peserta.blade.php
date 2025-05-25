@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Daftar Peserta Beasiswa</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama Peserta</th>
                    <th>Tempat Tanggal Lahir</th>
                    <th>Alamat</th>
                    <th>Beasiswa</th>
                    <th>IPK</th>
                    <th>Semester</th>
                    <th>Penghasilan Orang Tua</th>
                    <th>Transkrip</th>
                    <th>Prestasi</th>
                    <th>Surat Aktif Kuliah</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pesertas as $peserta)
                    <tr>
                        <td>{{ $peserta->nama }}</td>
                        <td>{{ $peserta->tempat_tanggal_lahir }}</td>
                        <td>{{ $peserta->alamat }}</td>
                        <td>{{ $peserta->beasiswa->nama }}</td>  <!-- Menampilkan nama beasiswa -->
                        <td>{{ $peserta->ipk }}</td>
                        <td>{{ $peserta->semester }}</td>
                        <td>{{ number_format($peserta->penghasilan_orang_tua, 2, ',', '.') }}</td>

                        <!-- Menampilkan file transkrip jika ada -->
                        <td>
                            @if($peserta->transkrip)
                                <a href="{{ asset('storage/' . $peserta->transkrip) }}" target="_blank">
                                    Lihat Transkrip
                                </a>
                            @else
                                Tidak ada
                            @endif
                        </td>

                        <!-- Menampilkan file prestasi jika ada -->
                        <td>
                            @if($peserta->prestasi)
                                <a href="{{ asset('storage/' . $peserta->prestasi) }}" target="_blank">
                                    Lihat Prestasi
                                </a>
                            @else
                                Tidak ada
                            @endif
                        </td>

                        <!-- Menampilkan file surat aktif kuliah jika ada -->
                        <td>
                            @if($peserta->surat_aktif_kuliah)
                                <a href="{{ asset('storage/' . $peserta->surat_aktif_kuliah) }}" target="_blank">
                                    Lihat Surat Aktif Kuliah
                                </a>
                            @else
                                Tidak ada
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
