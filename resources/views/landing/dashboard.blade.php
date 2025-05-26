@extends('layouts.app')

@section('title', 'Dashboard Peserta')

@section('content')
<div style="text-align: center; margin-top: 100px;">
    <h1>Selamat Datang di Dashboard Peserta</h1>
    <p>Halo, {{ Auth::user()->name }}!</p>

    <a href="{{ route('pendaftaran') }}" class="btn">Daftar Beasiswa</a>
</div>

<style>
    .btn {
        display: inline-block;
        padding: 12px 24px;
        margin-top: 20px;
        background-color: #28a745;
        color: white;
        text-decoration: none;
        font-size: 16px;
        border-radius: 8px;
    }

    .btn:hover {
        background-color: #218838;
    }
</style>
@endsection
