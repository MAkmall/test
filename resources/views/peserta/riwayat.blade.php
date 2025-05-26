<!DOCTYPE html>
<html>
<head>
    <title>Riwayat Penilaian</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <h1>Riwayat Penilaian</h1>
    @if ($peserta && $peserta->penilaian->isNotEmpty())
        <p>Nama: {{ $peserta->nama }}</p>
        <table>
            <tr>
                <th>Kriteria</th>
                <th>Nilai</th>
            </tr>
            @foreach ($peserta->penilaian as $penilaian)
                <tr>
                    <td>{{ $penilaian->kriteria->nama }}</td>
                    <td>{{ $penilaian->nilai }}</td>
                </tr>
            @endforeach
            <tr>
                <td><strong>Nilai Akhir</strong></td>
                <td><strong>{{ $peserta->penilaian->first()->nilai_akhir ?? 'Belum dinilai' }}</strong></td>
            </tr>
            <tr>
                <td><strong>Status</strong></td>
                <td><strong>{{ $peserta->status ?? 'Pending' }}</strong></td>
            </tr>
        </table>
    @else
        <p>Belum ada data penilaian.</p>
    @endif
    <a href="{{ route('peserta.dashboard') }}">Kembali ke Dashboard</a>
</body>
</html>
