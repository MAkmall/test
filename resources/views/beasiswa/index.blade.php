@extends('layouts.app')

@section('title', 'Daftar Beasiswa')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-md-8">
            <h2 class="mb-0"><i class="fas fa-graduation-cap"></i> Daftar Beasiswa</h2>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('beasiswa.create') }}" class="btn btn-primary">
                <i class="fas fa-plus-circle"></i> Tambah Beasiswa Baru
            </a>
        </div>
    </div>

    <!-- Success Alert -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th width="5%">No</th>
                            <th width="30%">Nama Beasiswa</th>
                            <th width="20%">Status</th>
                            <th width="25%">Tanggal Dibuat</th>
                            <th width="20%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($beasiswas as $beasiswa)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <strong>{{ $beasiswa->nama }}</strong>
                                @if(isset($beasiswa->deskripsi) && $beasiswa->deskripsi)
                                <p class="text-muted small mb-0">{{ Str::limit($beasiswa->deskripsi, 50) }}</p>
                                @endif
                            </td>
                            <td>
                                @php
                                $statusClass = [
                                    'aktif' => 'success',
                                    'nonaktif' => 'danger',
                                    'pending' => 'warning'
                                ][strtolower($beasiswa->status)] ?? 'secondary';
                                @endphp
                                <span class="badge bg-{{ $statusClass }}">
                                    <i class="fas fa-@if($beasiswa->status == 'aktif') check-circle @elseif($beasiswa->status == 'nonaktif') times-circle @else clock @endif me-1"></i>
                                    {{ ucfirst($beasiswa->status) }}
                                </span>
                            </td>
                            <td>
                                <small class="text-muted">
                                    {{ $beasiswa->created_at ? $beasiswa->created_at->format('d M Y') : 'Tidak diketahui' }}
                                </small>
                            </td>
                            <td>
                                <div class="btn-group btn-group-sm" role="group">

                                    <a href="{{ route('beasiswa.edit', $beasiswa->id) }}" 
                                       class="btn btn-outline-warning" 
                                       title="Edit"
                                       data-bs-toggle="tooltip">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('beasiswa.destroy', $beasiswa->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="btn btn-outline-danger" 
                                                title="Hapus"
                                                data-bs-toggle="tooltip"
                                                onclick="return confirm('Apakah Anda yakin menghapus beasiswa {{ $beasiswa->nama }}?')">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-4">
                                <i class="fas fa-graduation-cap fa-3x text-muted mb-3"></i>
                                <h5 class="text-muted">Belum Ada Data Beasiswa</h5>
                                <p class="text-muted">Mulai dengan menambahkan beasiswa pertama Anda</p>
                                <a href="{{ route('beasiswa.create') }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-plus"></i> Tambah Beasiswa
                                </a>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
        {{-- Bagian pagination dihapus karena menggunakan Collection biasa --}}
        {{-- Jika ingin menggunakan pagination, ubah controller untuk menggunakan paginate() --}}
        @if(method_exists($beasiswas, 'hasPages') && $beasiswas->hasPages())
        <div class="card-footer">
            {{ $beasiswas->links() }}
        </div>
        @endif
    </div>

    <!-- Info Card untuk Total Data -->
    @if($beasiswas->count() > 0)
    <div class="row mt-4">
        <div class="col-12">
            <div class="card bg-light">
                <div class="card-body py-2">
                    <div class="row text-center">
                        <div class="col-md-3">
                            <strong>Total Beasiswa:</strong> {{ $beasiswas->count() }}
                        </div>
                        <div class="col-md-3">
                            <strong>Aktif:</strong> {{ $beasiswas->where('status', 'aktif')->count() }}
                        </div>
                        <div class="col-md-3">
                            <strong>Pending:</strong> {{ $beasiswas->where('status', 'pending')->count() }}
                        </div>
                        <div class="col-md-3">
                            <strong>Nonaktif:</strong> {{ $beasiswas->where('status', 'nonaktif')->count() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection

@push('styles')
<style>
    .table-hover tbody tr:hover {
        background-color: rgba(0, 0, 0, 0.02);
    }
    .badge {
        font-weight: 500;
        padding: 5px 10px;
    }
    .btn-group .btn {
        border-radius: 0.25rem !important;
        margin-right: 2px;
    }
    .btn-group .btn:last-child {
        margin-right: 0;
    }
    .card {
        border: none;
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    }
    .text-end {
        text-align: right;
    }
</style>
@endpush

@push('scripts')
<script>
    // Enable tooltips
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
        
        // Auto dismiss alert after 5 seconds
        setTimeout(function() {
            var alert = document.querySelector('.alert');
            if (alert) {
                var bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            }
        }, 5000);
    });
</script>
@endpush