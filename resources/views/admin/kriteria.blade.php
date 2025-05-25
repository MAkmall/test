@extends('layouts.app')

@section('title', 'Data Kriteria')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Main Content Area with adjusted margin -->
        <div class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-3">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center bg-primary text-white">
                    <h3 class="card-title mb-0">Data Kriteria SAW</h3>
                </div>
                
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if($kriterias->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th width="5%">No</th>
                                        <th width="25%">Nama Kriteria</th>
                                        <th width="15%">Jenis</th>
                                        <th width="25%">Deskripsi</th>
                                        <th width="10%">Bobot</th>
                                        <th width="20%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($kriterias as $index => $kriteria)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>
                                                <strong>{{ $kriteria->nama }}</strong>
                                            </td>
                                            <td>
                                                @if($kriteria->jenis == 'benefit')
                                                    <span class="badge bg-success">
                                                        <i class="fas fa-arrow-up"></i> Benefit
                                                    </span>
                                                @else
                                                    <span class="badge bg-warning text-dark">
                                                        <i class="fas fa-arrow-down"></i> Cost
                                                    </span>
                                                @endif
                                            </td>
                                            <td>
                                                <small class="text-muted">{{ $kriteria->deskripsi ?? 'Tidak ada deskripsi' }}</small>
                                            </td>
                                            <td>{{ $kriteria->bobot }}</td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('admin.kriteria.edit', $kriteria->id) }}" 
                                                       class="btn btn-sm btn-warning" 
                                                       title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('admin.kriteria.destroy', $kriteria->id) }}" 
                                                          method="POST" 
                                                          class="d-inline"
                                                          onsubmit="return confirm('Yakin ingin menghapus kriteria {{ $kriteria->nama }}?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" 
                                                                class="btn btn-sm btn-danger" 
                                                                title="Hapus">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Info Box tentang SAW -->
                        <div class="row mt-4">
                            <div class="col-md-6">
                                <div class="card border-info">
                                    <div class="card-header bg-info text-white">
                                        <h5 class="mb-0"><i class="fas fa-info-circle"></i> Tentang Kriteria SAW</h5>
                                    </div>
                                    <div class="card-body">
                                        <p><strong>Benefit:</strong> Kriteria dimana nilai yang lebih tinggi lebih diinginkan (seperti IPK, Prestasi)</p>
                                        <p><strong>Cost:</strong> Kriteria dimana nilai yang lebih rendah lebih diinginkan (seperti Penghasilan Orang Tua, Tanggungan)</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card border-secondary">
                                    <div class="card-header bg-secondary text-white">
                                        <h5 class="mb-0"><i class="fas fa-chart-bar"></i> Statistik Kriteria</h5>
                                    </div>
                                    <div class="card-body">
                                        <p>Total Kriteria: <strong>{{ $kriterias->count() }}</strong></p>
                                        <p>Kriteria Benefit: <strong>{{ $kriterias->where('jenis', 'benefit')->count() }}</strong></p>
                                        <p>Kriteria Cost: <strong>{{ $kriterias->where('jenis', 'cost')->count() }}</strong></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-folder-open fa-5x text-muted mb-3"></i>
                            <h4 class="text-muted">Belum Ada Data Kriteria</h4>
                            <p class="text-muted">Silakan tambah kriteria terlebih dahulu untuk memulai perhitungan SAW</p>
                            <a href="{{ route('kriteria.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Tambah Kriteria Pertama
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    /* Adjust main content margin */
    .main-content {
        margin-left: 250px;
        transition: all 0.3s;
    }
    
    /* Table styling */
    .table th {
        border-top: none;
        background-color: #000000;
    }
    
    .table-responsive {
        border-radius: 5px;
        overflow: hidden;
        box-shadow: 0 0 10px rgba(0,0,0,0.05);
    }
    
    /* Card header styling */
    .card-header {
        border-radius: 5px 5px 0 0 !important;
    }
    
    /* Badge styling */
    .badge {
        font-size: 0.85em;
        padding: 5px 10px;
    }
    
    /* Responsive adjustments */
    @media (max-width: 768px) {
        .main-content {
            margin-left: 0;
        }
        
        .table-responsive {
            overflow-x: auto;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    // Auto hide alert after 5 seconds
    $(document).ready(function() {
        setTimeout(function() {
            $('.alert').fadeOut('slow');
        }, 5000);
    });
</script>
@endpush
@endsection