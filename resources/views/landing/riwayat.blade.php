@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Riwayat Beasiswa</h3>
    <table class="table">
        <thead>
            <tr>
                <th>Nama Beasiswa</th>
                <th>Status</th>
                <th>Tanggal Pendaftaran</th>
            </tr>
        </thead>
        <tbody>
            @foreach($riwayatBeasiswa as $riwayat)
            <tr>
                <td>{{ $riwayat->beasiswa->nama }}</td>
                <td>{{ $riwayat->status }}</td>
                <td>{{ \Carbon\Carbon::parse($riwayat->tanggal_pendaftaran)->format('d M Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
