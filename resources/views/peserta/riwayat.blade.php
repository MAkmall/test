{{-- filepath: c:\xampp\htdocs\spk-beasiswa\spk-beasiswa\test\test\resources\views\peserta\riwayat.blade.php --}}
@extends('layouts.app')

@section('title', 'Riwayat Pendaftaran')

@push('styles')
<style>
    .content-wrapper { margin: 0; padding: 0; }
    .container-fluid { margin: 0; padding: 0; }
    .card { margin-bottom: 20px; }
    .table-responsive { margin-top: 20px; }
</style>
@endpush

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Riwayat Pendaftaran</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('peserta.dashboard') }}"><i class="fas fa-home"></i> Home</a></li>
                        <li class="breadcrumb-item active">Riwayat Pendaftaran</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-history mr-1"></i> Riwayat Pendaftaran Saya
                    </h3>
                </div>
                <div class="card-body">
                    @if(isset($riwayatPendaftaran) && count($riwayatPendaftaran) > 0)
                        <div class="table-responsive">
                            <table class="table table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Beasiswa</th>
                                        <th>Status</th>
                                        <th>Nilai Akhir</th>
                                        <th>Tanggal Pendaftaran</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($riwayatPendaftaran as $pendaftaran)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $pendaftaran->beasiswa->nama ?? 'N/A' }}</td>
                                        <td>
                                            @if($pendaftaran->status == 'Lulus')
                                                <span class="badge badge-success">Lulus</span>
                                            @elseif($pendaftaran->status == 'Tidak Lulus')
                                                <span class="badge badge-danger">Tidak Lulus</span>
                                            @else
                                                <span class="badge badge-secondary">{{ $pendaftaran->status ?? '-' }}</span>
                                            @endif
                                        </td>
                                        <td>{{ $pendaftaran->nilai_akhir ?? '-' }}</td>
                                        <td>{{ $pendaftaran->created_at->format('d M Y') }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-file-alt fa-3x text-muted mb-3"></i>
                            <p class="text-muted">Belum ada riwayat pendaftaran.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
</div>
@endsection