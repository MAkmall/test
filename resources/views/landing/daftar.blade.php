@extends('layouts.app')

@section('title', 'Daftar Beasiswa')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">
                <i class="fas fa-graduation-cap me-2"></i>Daftar Beasiswa Tersedia
            </h4>
        </div>
        
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Nama Beasiswa</th>
                            <th>Batas Pendaftaran</th>
                            <th>Pendaftar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($beasiswas as $index => $beasiswa)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                <strong>{{ $beasiswa->nama }}</strong>
                                <p class="text-muted small mb-0">{{ Str::limit($beasiswa->deskripsi, 50) }}</p>
                            </td>
                            <td>
                                @if($beasiswa->batas_pendaftaran)
                                    {{ \Carbon\Carbon::parse($beasiswa->batas_pendaftaran)->format('d M Y') }}
                                    <br>
                                    <small class="text-muted">
                                        {{ \Carbon\Carbon::parse($beasiswa->batas_pendaftaran)->isPast() ? 'Sudah ditutup' : 'Masih dibuka' }}
                                    </small>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>{{ $beasiswa->peserta_count ?? 0 }} orang</td>
                            <td>
                                @if(!$beasiswa->batas_pendaftaran || !\Carbon\Carbon::parse($beasiswa->batas_pendaftaran)->isPast())
                                    <a href="{{ route('beasiswa.pendaftaran', $beasiswa->id) }}" class="btn btn-sm btn-primary">
                                        <i class="fas fa-file-alt me-1"></i>Daftar
                                    </a>
                                @else
                                    <button class="btn btn-sm btn-secondary" disabled>
                                        <i class="fas fa-file-alt me-1"></i>Ditutup
                                    </button>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-4">
                                <i class="fas fa-info-circle fa-2x text-muted mb-3"></i>
                                <h5 class="text-muted">Tidak ada beasiswa tersedia saat ini</h5>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection