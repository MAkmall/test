@extends('layouts.app')

@section('title', 'Penilaian')

@section('content')
<div class="container mt-4">
    <h2>Hasil Penilaian Beasiswa {{ $beasiswa->nama ?? '' }}</h2>
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>Nama Peserta</th>
                <th>Skor Akhir</th>
            </tr>
        </thead>
        <tbody>
            @forelse($results as $result)
                <tr>
                    <td>{{ $result['peserta'] }}</td>
                    <td>{{ $result['score'] }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="2">Belum ada data penilaian.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection