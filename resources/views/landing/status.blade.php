<!DOCTYPE html>
<html>
<head>
    <title>Status Pendaftaran</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <h1>Status Pendaftaran Anda</h1>
    @if ($status === 'pending')
        <p>{{ $message }}</p>
    @else
        <p>Status: <strong>{{ $status === 'lolos' ? 'Lolos' : 'Tidak Lolos' }}</strong></p>
        <p>Nilai Akhir: <strong>{{ $nilai_akhir }}</strong></p>
    @endif
    <a href="{{ route('landing.dashboard') }}">Kembali ke Dashboard</a>
</body>
</html>