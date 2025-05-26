{{-- filepath: resources/views/peserta/dashboard.blade.php --}}
@extends('layouts.app')

@section('title', 'Dashboard Peserta')

@push('styles')
<style>
    .content-wrapper { margin: 0; padding: 0; }
    .container-fluid { margin: 0; padding: 0; }
    .sidebar { padding-top: 0; margin-top: 0; height: 100vh; position: fixed; z-index: 99; }
    .main-content { margin-left: 250px; }
    .row { display: flex; flex-wrap: wrap; gap: 10px; margin: 0; }
    .col-lg-3, .col-sm-6 { flex: 1 1 23%; margin-bottom: 20px; }
    .info-box { cursor: pointer; transition: transform 0.2s; box-shadow: 0 4px 8px rgba(0,0,0,0.1); }
    .info-box:hover { transform: translateY(-5px); }
    .card { margin-bottom: 20px; }
    @media (max-width: 992px) {
        .sidebar { width: 200px; }
        .main-content { margin-left: 0; }
        .col-lg-3 { flex: 1 1 48%; }
    }
    @media (max-width: 768px) {
        .col-lg-3 { flex: 1 1 100%; }
    }
    .chart-container { display: flex; justify-content: center; align-items: center; height: 400px; }
</style>
@endpush

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard Peserta</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('peserta.dashboard') }}"><i class="fas fa-home"></i> Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Info boxes -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $totalPendaftaran ?? 0 }}</h3>
                            <p>Pendaftaran Saya</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-file-alt"></i>
                        </div>
                        <a href="{{ route('peserta.riwayat') }}" class="small-box-footer">Riwayat <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $totalLulus ?? 0 }}</h3>
                            <p>Lulus Seleksi</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <a href="{{ route('peserta.hasil', ['peserta_id' => auth()->user()->peserta->id ?? 0]) }}" class="small-box-footer">Lihat Hasil <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>

            <!-- Statistik Pendaftaran -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header border-0">
                            <h3 class="card-title">
                                <i class="fas fa-chart-pie mr-1"></i> Statistik Pendaftaran Saya
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="chart-container">
                                <canvas id="statistikPendaftaran"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Daftar Pendaftaran -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-clipboard-list mr-1"></i> Daftar Pendaftaran Saya
                            </h3>
                        </div>
                        <div class="card-body p-0">
                            @if(isset($daftarPendaftaran) && count($daftarPendaftaran) > 0)
                                <div class="table-responsive">
                                    <table class="table table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th width="5%">#</th>
                                                <th>Beasiswa</th>
                                                <th>Status</th>
                                                <th>Nilai Akhir</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($daftarPendaftaran as $pendaftaran)
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
                                                <td>
                                                    <a href="{{ route('peserta.hasil', ['peserta_id' => $pendaftaran->peserta_id]) }}" class="btn btn-sm btn-info" title="Lihat Hasil">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="text-center py-4">
                                    <i class="fas fa-file-alt fa-3x text-muted mb-3"></i>
                                    <p class="text-muted">Belum ada pendaftaran beasiswa.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
$(function () {
    var ctx = document.getElementById('statistikPendaftaran').getContext('2d');
    var chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
            datasets: [{
                label: 'Pendaftaran',
                backgroundColor: '#007bff',
                data: [2, 3, 1, 0, 0, 1, 2, 1, 0, 0, 0, 0] // Contoh data, silakan sesuaikan
            }, {
                label: 'Lulus',
                backgroundColor: '#28a745',
                data: [1, 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0] // Contoh data, silakan sesuaikan
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'top' },
                tooltip: { mode: 'index', intersect: false }
            },
            scales: { y: { beginAtZero: true } }
        }
    });
});
</script>
@endpush