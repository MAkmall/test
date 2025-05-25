saya mempunyai 2 code dashboard:"@extends('layouts.app')

@section('title', 'Dashboard')

@push('styles')
<!-- Additional CSS for dashboard -->
<style>
        /* Menghapus margin dan padding pada content-wrapper */
    .content-wrapper {
        margin: 0;
        padding: 0;
    }

    /* Menghapus margin pada container-fluid */
    .container-fluid {
        margin: 0;
        padding: 0;
    }

    /* Mengatur agar sidebar tetap rapat */
    .sidebar {
        padding-top: 0;
        margin-top: 0;
        height: 100vh;
        position: fixed; /* Membuat sidebar tetap di kiri */
        z-index: 99;
    }

    /* Membuat main content lebih rapat dengan sidebar */
    .main-content {
        margin-left: 250px; /* Menyesuaikan dengan lebar sidebar */
    }

    /* Menjaga agar layout tidak terlalu padat */
    .row {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin: 0;
    }

    /* Kolom akan lebih responsif */
    .col-lg-3, .col-sm-6 {
        flex: 1 1 23%;
        margin-bottom: 20px;
    }

    /* Info box styling */
    .info-box {
        cursor: pointer;
        transition: transform 0.2s;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    .info-box:hover {
        transform: translateY(-5px);
    }

    /* Menjaga card lebih rapi dan tidak terpotong */
    .card {
        margin-bottom: 20px;
    }

    /* Membuat layout responsif */
    @media (max-width: 992px) {
        .sidebar {
            width: 200px;
        }

        .main-content {
            margin-left: 0;
        }

        .col-lg-3 {
            flex: 1 1 48%;
        }
    }

    @media (max-width: 768px) {
        .col-lg-3 {
            flex: 1 1 100%;
        }
    }

    .chart-container {
    display: flex;
    justify-content: center;  /* Memusatkan secara horizontal */
    align-items: center;      /* Memusatkan secara vertikal */
    height: 400px;            /* Menentukan tinggi chart agar pas */
}
    /* Kolom mengisi seluruh lebar pada perangkat sangat kecil */

    </style>
@endpush

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i> Home</a></li>
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
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $totalBeasiswa ?? 1 }}</h3>
                            <p>Total Beasiswa</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <a href="{{ route('admin.beasiswa.create') }}" class="small-box-footer">More info<i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                @if(auth()->check() && auth()->user()->role == 'admin')
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{ $totalKriteria ?? 0 }}</h3>
                            <p>Kriteria Perhitungan</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-list-ol"></i>
                        </div>
                        <a href="{{ route('admin.kriteria.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>

            <!-- Statistik Beasiswa -->
            
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header border-0">
                            <h3 class="card-title">
                                <i class="fas fa-chart-pie mr-1"></i> Statistik Beasiswa
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="chart-container">
                                <canvas id="statistikBeasiswa"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Beasiswa Aktif -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-clipboard-list mr-1"></i> Beasiswa Aktif
                            </h3>
                        </div>
                        <div class="card-body p-0">
                            @if(isset($daftarBeasiswaAktif) && count($daftarBeasiswaAktif) > 0)
                                <div class="table-responsive">
                                    <table class="table table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th width="5%">#</th>
                                                <th>Nama Beasiswa</th>
                                                <th width="20%">Batas Pendaftaran</th>
                                                <th width="15%">Status</th>
                                                <th width="10%">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($daftarBeasiswaAktif as $beasiswa)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $beasiswa->nama ?? 'N/A' }}</td>
                                                <td>{{ $beasiswa->batas_pendaftaran ? \Carbon\Carbon::parse($beasiswa->batas_pendaftaran)->format('d M Y') : 'N/A' }}</td>
                                                <td>
                                                    @if($beasiswa->status == 'aktif')
                                                        <span class="badge badge-success">Aktif</span>
                                                    @else
                                                        <span class="badge badge-secondary">Non-Aktif</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('admin.beasiswa.edit', $beasiswa->id) }}" class="btn btn-sm btn-info" title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a href="{{ route('admin.beasiswa.show', $beasiswa->id) }}" class="btn btn-sm btn-primary" title="Detail">
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
                                    <i class="fas fa-graduation-cap fa-3x text-muted mb-3"></i>
                                    <p class="text-muted">1 Beasiswa Aktif</p>
                                </div>
                            @endif
                        </div>
                        <div class="card-footer clearfix">
                            <a href="{{ route('admin.beasiswa.create') }}" class="btn btn-primary float-right">
                                <i class="fas fa-plus"></i> Tambah Beasiswa Baru
                            </a>
                        </div>
                    </div>
                </div>
                @else
                
            @endif
            </div>
        </div>
    </section>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-knob@1.2.11/dist/jquery.knob.min.js"></script>

<script>
$(function () {
    var ctx = document.getElementById('statistikBeasiswa').getContext('2d');
    var chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
            datasets: [{
                label: 'Pendaftar',
                backgroundColor: '#007bff',
                data: [12, 19, 3, 5, 2, 3, 15, 8, 7, 10, 6, 9]
            }, {
                label: 'Penerima',
                backgroundColor: '#28a745',
                data: [5, 8, 1, 2, 1, 1, 6, 3, 3, 4, 2, 4]
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                tooltip: {
                    mode: 'index',
                    intersect: false,
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
});
</script>
@endpush 