@extends('layouts.app')

@section('title', 'Tambah Beasiswa Baru')

@section('content')
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
    <form action="{{ route('beasiswa.store') }}" method="POST">
        @csrf

        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Tambah Beasiswa Baru</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <!-- Kolom kiri form -->
                    <div class="col-md-6">
                        <!-- Informasi Dasar Beasiswa -->
                        <div class="form-group mb-3">
                            <label for="name" class="form-label">Nama Beasiswa*</label>
                            <input type="text" class="form-control" id="name" name="nama" required>
                        </div>
                        
                        <div class="form-group mb-3">
                            <label for="description" class="form-label">Deskripsi Beasiswa*</label>
                            <textarea class="form-control" id="description" name="deskripsi" rows="3" required></textarea>
                        </div>
                        
                        <!-- Informasi Pendanaan -->
                        <div class="form-group mb-3">
                            <label for="funding_amount" class="form-label">Jumlah Pendanaan (per penerima)</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" class="form-control" id="funding_amount" name="jumlah_pendanaan">
                            </div>
                        </div>
                        
                        <div class="form-group mb-3">
                            <label for="quota" class="form-label">Kuota Penerima</label>
                            <input type="number" class="form-control" id="quota" name="kouta_penerima">
                        </div>
                    </div>
                    
                    <!-- Kolom kanan form -->
                    <div class="col-md-6">
                        <!-- Periode Beasiswa -->
                        <div class="form-group mb-3">
                            <label class="form-label">Periode Beasiswa*</label>
                            <div class="row g-2">
                                <div class="col-md-6">
                                    <label for="start_date" class="form-label">Tanggal Mulai</label>
                                    <input type="date" class="form-control" id="start_date" name="tanggal_mulai" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="end_date" class="form-label">Tanggal Berakhir</label>
                                    <input type="date" class="form-control" id="end_date" name="tanggal_berakhir" required>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Status dan Persyaratan -->
                        <div class="form-group mb-3">
                            <label for="status" class="form-label">Status*</label>
                            <select class="form-select" id="status" name="status" required>
                                <option value="Aktif">Aktif</option>
                                <option value="Nonaktif">Nonaktif</option>
                                <option value="Draft">Draft</option>
                            </select>
                        </div>
                        
                        <div class="form-group mb-3">
                            <label for="requirements" class="form-label">Persyaratan</label>
                            <textarea class="form-control" id="requirements" name="persyaratan" rows="3"></textarea>
                            <small class="text-muted">
                                Gunakan format bullet point (contoh: - IPK minimal 3.0)
                            </small>
                        </div>
                        
                        <!-- Kontak dan Informasi Tambahan -->
                        <div class="form-group mb-3">
                            <label for="contact_info" class="form-label">Informasi Kontak</label>
                            <input type="text" class="form-control" id="contact_info" name="info_kontak" placeholder="Email/nomor HP/alamat kontak">
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-light">
                <div class="d-flex justify-content-between">
                    <a href="{{ route('beasiswa.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Tambah Beasiswa
                    </button>
                </div>
            </div>
        </div>
    </form>
</main>
@endsection

@section('styles')
<style>
    .sidebar {
        position: fixed;
        top: 0;
        bottom: 0;
        left: 0;
        width: 250px;
        z-index: 100;
        padding: 48px 0 0;
        box-shadow: inset -1px 0 0 rgba(0, 0, 0, .1);
    }

    .main-content {
        margin-left: 250px;
        padding: 20px;
    }

    @media (max-width: 767.98px) {
        .sidebar {
            width: 100%;
            position: relative;
        }

        .main-content {
            margin-left: 0;
        }
    }

    .form-label {
        font-weight: 500;
    }

    .card {
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .card-header {
        border-radius: 10px 10px 0 0 !important;
    }
</style>
@endsection