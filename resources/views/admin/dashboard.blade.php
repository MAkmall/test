@extends('layouts.app')

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