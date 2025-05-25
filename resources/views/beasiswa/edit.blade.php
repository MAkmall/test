@extends('layouts.app')

@section('title', 'Edit Beasiswa')

@section('content')

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
    <form action="{{ route('beasiswa.update', $beasiswa->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Edit Beasiswa</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <!-- Kolom kiri form -->
                    <div class="col-md-6">
                        <!-- Informasi Dasar Beasiswa -->
                        <div class="form-group mb-3">
                            <label for="name" class="form-label">Nama Beasiswa*</label>
                            <input type="text" class="form-control" id="name" name="name" 
                                   value="{{ old('name', $beasiswa->name) }}" required>
                        </div>
                        
                        <div class="form-group mb-3">
                            <label for="description" class="form-label">Deskripsi Beasiswa*</label>
                            <textarea class="form-control" id="description" name="description" 
                                      rows="3" required>{{ old('description', $beasiswa->description) }}</textarea>
                        </div>
                        
                        <!-- Informasi Pendanaan -->
                        <div class="form-group mb-3">
                            <label for="funding_amount" class="form-label">Jumlah Pendanaan (per penerima)</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" class="form-control" id="funding_amount" name="funding_amount" 
                                       value="{{ old('funding_amount', $beasiswa->funding_amount) }}">
                            </div>
                        </div>
                        
                        <div class="form-group mb-3">
                            <label for="quota" class="form-label">Kuota Penerima</label>
                            <input type="number" class="form-control" id="quota" name="quota" 
                                   value="{{ old('quota', $beasiswa->quota) }}">
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
                                    <input type="date" class="form-control" id="start_date" name="start_date" 
                                           value="{{ old('start_date', $beasiswa->start_date) }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="end_date" class="form-label">Tanggal Berakhir</label>
                                    <input type="date" class="form-control" id="end_date" name="end_date" 
                                           value="{{ old('end_date', $beasiswa->end_date) }}" required>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Status dan Persyaratan -->
                        <div class="form-group mb-3">
                            <label for="status" class="form-label">Status*</label>
                            <select class="form-select" id="status" name="status" required>
                                <option value="Aktif" {{ $beasiswa->status == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="Nonaktif" {{ $beasiswa->status == 'Nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                                <option value="Draft" {{ $beasiswa->status == 'Draft' ? 'selected' : '' }}>Draft</option>
                            </select>
                        </div>
                        
                        <div class="form-group mb-3">
                            <label for="requirements" class="form-label">Persyaratan</label>
                            <textarea class="form-control" id="requirements" name="requirements" 
                                      rows="3">{{ old('requirements', $beasiswa->requirements) }}</textarea>
                            <small class="text-muted">
                                Gunakan format bullet point (contoh: - IPK minimal 3.0)
                            </small>
                        </div>
                        
                        <!-- Kontak dan Informasi Tambahan -->
                        <div class="form-group mb-3">
                            <label for="contact_info" class="form-label">Informasi Kontak</label>
                            <input type="text" class="form-control" id="contact_info" name="contact_info" 
                                   value="{{ old('contact_info', $beasiswa->contact_info) }}"
                                   placeholder="Email/nomor HP/alamat kontak">
                        </div>
                        
                        <div class="form-group mb-3">
                            <label for="website" class="form-label">Website Resmi (jika ada)</label>
                            <input type="url" class="form-control" id="website" name="website" 
                                   value="{{ old('website', $beasiswa->website) }}"
                                   placeholder="https://contoh.com">
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
                      <a href="{{ route('beasiswa.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-save"></i> Simpan Perubahan
                      </a>
                    </button>
                </div>
            </div>
        </div>
    </form>
</main>

@endsection

<!-- CSS Tambahan -->

<style>
    .sidebar {
        position: fixed;
        top: 0;
        bottom: 0;
        left: 0;
        width: 250px; /* Adjust the sidebar width */
        z-index: 100;
        padding: 48px 0 0;
        box-shadow: inset -1px 0 0 rgba(0, 0, 0, .1);
    }

    .main-content {
        margin-left: 250px; /* Adjust the left margin to accommodate sidebar */
        padding: 20px;
    }

    @media (max-width: 767.98px) {
        .sidebar {
            width: 100%;
            position: relative;
        }

        .main-content {
            margin-left: 0; /* Remove margin on smaller screens */
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
