@extends('layouts.app')

@section('title', 'Pendaftaran Beasiswa')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        @include('templates.left-sidebar')

        <!-- Main Content -->
        <div class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Formulir Pendaftaran Beasiswa</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <a href="{{ route('beasiswa.daftar') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Kembali ke Daftar
                    </a>
                </div>
            </div>

            <!-- Formulir Pendaftaran -->
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Pendaftaran Beasiswa</h5>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form action="{{ route('beasiswa.register') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama') }}" maxlength="255" required>
                            @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="tempat_tanggal_lahir" class="form-label">Tempat, Tanggal Lahir</label>
                            <input type="text" class="form-control @error('tempat_tanggal_lahir') is-invalid @enderror" id="tempat_tanggal_lahir" name="tempat_tanggal_lahir" value="{{ old('tempat_tanggal_lahir') }}" maxlength="255" required>
                            <small class="text-muted">Contoh: Jakarta, 15 Mei 2000</small>
                            @error('tempat_tanggal_lahir')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" rows="3" required>{{ old('alamat') }}</textarea>
                            @error('alamat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="semester" class="form-label">Semester</label>
                            <select class="form-select @error('semester') is-invalid @enderror" id="semester" name="semester" required>
                                <option value="">-- Pilih Semester --</option>
                                @for($i = 1; $i <= 8; $i++)
                                    <option value="{{ $i }}" {{ old('semester') == $i ? 'selected' : '' }}>{{ $i }}</option>
                                @endfor
                            </select>
                            @error('semester')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="tanggungan" class="form-label">Jumlah Tanggungan Keluarga</label>
                            <input type="number" min="0" class="form-control @error('tanggungan') is-invalid @enderror" id="tanggungan" name="tanggungan" value="{{ old('tanggungan') }}" required>
                            <small class="text-muted">Masukkan jumlah anggota keluarga yang menjadi tanggungan (contoh: 3)</small>
                            @error('tanggungan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="penghasilan_orangtua" class="form-label">Penghasilan Orang Tua (Rp)</label>
                            <input type="number" min="0" step="1000" class="form-control @error('penghasilan_orangtua') is-invalid @enderror" id="penghasilan_orangtua" name="penghasilan_orangtua" value="{{ old('penghasilan_orangtua') }}" required>
                            <small class="text-muted">Masukkan jumlah penghasilan bulanan dalam rupiah (contoh: 5000000)</small>
                            @error('penghasilan_orangtua')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="ipk" class="form-label">IPK</label>
                            <input type="number" step="0.01" min="0" max="4" class="form-control @error('ipk') is-invalid @enderror" id="ipk" name="ipk" value="{{ old('ipk') }}" required>
                            <small class="text-muted">Masukkan IPK antara 0 sampai 4 (contoh: 3.75)</small>
                            @error('ipk')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="beasiswa_id" class="form-label">Pilih Beasiswa</label>
                            <select class="form-select @error('beasiswa_id') is-invalid @enderror" id="beasiswa_id" name="beasiswa_id" required>
                                <option value="">-- Pilih Beasiswa --</option>
                                @foreach($beasiswas as $beasiswa)
                                    @if(!$beasiswa->batas_pendaftaran || \Carbon\Carbon::parse($beasiswa->batas_pendaftaran)->isFuture())
                                        <option value="{{ $beasiswa->id }}" {{ old('beasiswa_id', request('beasiswa_id')) == $beasiswa->id ? 'selected' : '' }}>
                                            {{ $beasiswa->nama }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                            @error('beasiswa_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="transkrip" class="form-label">Transkrip Nilai (PDF/JPG/PNG, maks 2MB)</label>
                            <input type="file" class="form-control @error('transkrip') is-invalid @enderror" id="transkrip" name="transkrip" accept=".pdf,.jpg,.jpeg,.png" required>
                            @error('transkrip')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="prestasi" class="form-label">Bukti Prestasi (PDF/JPG/PNG, maks 2MB)</label>
                            <input type="file" class="form-control @error('prestasi') is-invalid @enderror" id="prestasi" name="prestasi" accept=".pdf,.jpg,.jpeg,.png" required>
                            @error('prestasi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="surat_aktif_kuliah" class="form-label">Surat Keterangan Aktif Kuliah (PDF/JPG/PNG, maks 2MB)</label>
                            <input type="file" class="form-control @error('surat_aktif_kuliah') is-invalid @enderror" id="surat_aktif_kuliah" name="surat_aktif_kuliah" accept=".pdf,.jpg,.jpeg,.png" required>
                            @error('surat_aktif_kuliah')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Daftar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
    <style>
        .form-label {
            font-weight: 500;
        }
        .form-control, .form-select, .form-control-file {
            border-radius: 5px;
        }
        .card-body {
            background-color: #f8f9fa;
        }
        .btn-primary {
            font-size: 0.9rem;
        }
    </style>
@endpush

@push('scripts')
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
@endpush