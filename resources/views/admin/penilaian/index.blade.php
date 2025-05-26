@extends('layouts.app')

@section('title', 'Penilaian')

@section('content')
<body>
    <h1>Daftar Penilaian Peserta</h1>
    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif
    <table>
        <tr>
            <th>Nama Peserta</th>
            <th>Nilai Akhir</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
        @foreach ($pesertas as $peserta)
            <tr>
                <td>{{ $peserta->nama }}</td>
                <td>{{ $results[$peserta->id]['nilai_akhir'] ?? 'Belum dinilai' }}</td>
                <td>{{ $peserta->status ?? 'Pending' }}</td>
                <td>
                    <a href="{{ route('admin.penilaian.create', $peserta->id) }}">Nilai</a>
                    <a href="{{ route('admin.penilaian.show', $peserta->id) }}">Lihat</a>
                    @if ($peserta->penilaian->isNotEmpty())
                        <a href="{{ route('admin.penilaian.edit', $peserta->id) }}">Edit</a>
                        <form action="{{ route('admin.penilaian.destroy', $peserta->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Yakin ingin menghapus penilaian?')">Hapus</button>
                        </form>
                    @endif
                </td>
            </tr>
        @endforeach
    </table>
    <a href="{{ route('peserta.dashboard') }}">Kembali ke Dashboard</a>
</body>
</html>

@endsection