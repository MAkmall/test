@extends('layouts.app')
@section('title', 'Penilaian Peserta')
<body>
    <h1>Penilaian Peserta: {{ $peserta->nama }}</h1>
    <form action="{{ route('admin.penilaian.store', $peserta->id) }}" method="POST">
        @csrf
        @foreach ($kriterias as $kriteria)
            <div>
                <label>{{ $kriteria->nama }}</label>
                <input type="number" step="0.01" name="nilai[{{ $kriteria->id }}]" required>
                @error("nilai.{$kriteria->id}") <span style="color: red;">{{ $message }}</span> @enderror
            </div>
        @endforeach
        <button type="submit">Simpan Penilaian</button>
    </form>
    <a href="{{ route('admin.penilaian.index') }}">Kembali</a>
</body>
</html>
@endsection