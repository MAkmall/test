```blade
@extends('layouts.app')

@section('title', 'Daftar Peserta Beasiswa')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        @include('templates.left-sidebar')

        <!-- Main Content -->
        <div class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Daftar Peserta Beasiswa</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <!-- Add buttons or toolbar items here if needed -->
                </div>
            </div>

            <!-- Tabel Daftar Beasiswa -->
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Daftar Beasiswa</h5>
                </div>
                <div class="card-body">
                    @if($beasiswas->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th width="5%">No</th>
                                        <th width="25%">Nama Beasiswa</th>
                                        <th width="15%">Batas Pendaftaran</th>
                                        <th width="15%">Jumlah Pendaftar</th>
                                        <th width="15%">Status</th>
                                        <th width="15%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($beasiswas as $index => $beasiswa)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>
                                                <strong>{{ $beasiswa->nama }}</strong><br>
                                                <small class="text-muted">{{ $beasiswa->deskripsi }}</small>
                                            </td>
                                            <td>
                                                @if($beasiswa->batas_pendaftaran)
                                                    {{ $beasiswa->batas_pendaftaran->format('d M Y') }}<br>
                                                    <small class="text-muted">{{ $beasiswa->batas_pendaftaran->diffForHumans() }}</small>
                                                @else
                                                    <span class="text-muted">Belum ditentukan</span>
                                                @endif
                                            </td>
                                            <td>
                                                {{ $beasiswa->jumlah_pendaftar ?? '0' }}
                                            </td>
                                            <td>
                                                @if($beasiswa->batas_pendaftaran)
                                                    @if($beasiswa->batas_pendaftaran->isPast())
                                                        <span class="badge bg-danger">Tutup</span>
                                                    @else
                                                        <span class="badge bg-success">Buka</span>
                                                    @endif
                                                @else
                                                    <span class="badge bg-secondary">Belum ditentukan</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if(!$beasiswa->batas_pendaftaran || !$beasiswa->batas_pendaftaran->isPast())
                                                    <a href="{{ route('beasiswa.pendaftaran', ['beasiswa_id' => $beasiswa->id]) }}" class="btn btn-sm btn-primary">
                                                        <i class="fas fa-user-plus me-1"></i>Daftar
                                                    </a>
                                                @else
                                                    <span class="text-muted">Pendaftaran Ditutup</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="alert alert-info" role="alert">
                            Tidak ada data beasiswa tersedia.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
    <style>
        .table th {
            vertical-align: middle;
        }
        .badge {
            font-size: 0.85em;
            padding: 5px 10px;
        }
        .table-responsive {
            border-radius: 5px;
            overflow: hidden;
            box-shadow: 0 0 10px rgba(0,0,0,0.05);
        }
        .btn-sm {
            font-size: 0.85rem;
        }
    </style>
@endpush

@push('scripts')
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
@endpush
```