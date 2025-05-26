@extends('layouts.app')
@section('title', 'Detail Penilaian Peserta')
<body>
    <h1>Detail Penilaian: {{ $peserta->nama }}</h1>
    <table>
        <tr>
            <th>Kriteria</th>
            <th>Nilai</th>
        </tr>
        @foreach ($penilaian as $nilai)
            <tr>
                <td>{{ $nilai->kriteria->nama }}</td>
                <td>{{ $nilai->nilai }}</td>
            </tr>
        @endforeach
        <tr>
            <td><strong>Nilai Akhir</strong></td>
            <td><strong>{{ $penilaian->first()->nilai_akhir ?? 'Belum dihitung' }}</strong></td>
        </tr>
        <tr>
            <td><strong>Status</strong></td>
            <td><strong>{{ $peserta->status ?? 'Pending' }}</strong></td>
        </tr>
    </table>
    <a href="{{ route('admin.penilaian.index') }}">Kembali</a>
</body>
</html>
@endsection