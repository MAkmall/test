@extends('layouts.app')

@section('title', 'Tambah Beasiswa Baru')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">
                        <i class="fas fa-graduation-cap me-2"></i>
                        Tambah Beasiswa Baru
                    </h4>
                </div>
                <div class="card-body">
                    <!-- Preview Button -->
                    <div class="text-end mb-3">
                        <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#previewModal" onclick="generatePreview()">
                            <i class="fas fa-eye me-1"></i> Preview
                        </button>
                    </div>

                    <form action="{{ route('admin.beasiswa.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <!-- Debug info - remove in production -->
                        <input type="hidden" name="debug" value="testing">
                        <div class="alert alert-info mb-3">
                            <small>Debug - Action: {{ route('admin.beasiswa.store') }}</small>
                        </div>
                        
                        <!-- Informasi Dasar Beasiswa -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h5 class="text-secondary border-bottom pb-2">
                                    <i class="fas fa-info-circle me-2"></i>
                                    Informasi Dasar
                                </h5>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="nama" class="form-label">
                                    Nama Beasiswa <span class="text-danger">*</span>
                                </label>
                                <input type="text" 
                                       class="form-control @error('nama') is-invalid @enderror" 
                                       id="nama" 
                                       name="nama" 
                                       value="{{ old('nama') }}" 
                                       placeholder="Masukkan nama beasiswa"
                                       required>
                                @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="status" class="form-label">
                                    Status Beasiswa <span class="text-danger">*</span>
                                </label>
                                <select class="form-select @error('status') is-invalid @enderror" 
                                        id="status" 
                                        name="status" 
                                        required>
                                    <option value="">Pilih Status</option>
                                    <option value="aktif" {{ old('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                    <option value="non-aktif" {{ old('status') == 'non-aktif' ? 'selected' : '' }}>Non-Aktif</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-12">
                                <label for="deskripsi" class="form-label">
                                    Deskripsi Beasiswa <span class="text-danger">*</span>
                                </label>
                                <textarea class="form-control @error('deskripsi') is-invalid @enderror" 
                                          id="deskripsi" 
                                          name="deskripsi" 
                                          rows="4"
                                          placeholder="Jelaskan detail tentang beasiswa ini..."
                                          required>{{ old('deskripsi') }}</textarea>
                                @error('deskripsi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Waktu dan Pendanaan -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h5 class="text-secondary border-bottom pb-2">
                                    <i class="fas fa-calendar-alt me-2"></i>
                                    Waktu & Pendanaan
                                </h5>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="tanggal_mulai" class="form-label">
                                    Tanggal Mulai <span class="text-danger">*</span>
                                </label>
                                <input type="date" 
                                       class="form-control @error('tanggal_mulai') is-invalid @enderror" 
                                       id="tanggal_mulai" 
                                       name="tanggal_mulai" 
                                       value="{{ old('tanggal_mulai') }}"
                                       required>
                                @error('tanggal_mulai')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="tanggal_berakhir" class="form-label">
                                    Tanggal Berakhir <span class="text-danger">*</span>
                                </label>
                                <input type="date" 
                                       class="form-control @error('tanggal_berakhir') is-invalid @enderror" 
                                       id="tanggal_berakhir" 
                                       name="tanggal_berakhir" 
                                       value="{{ old('tanggal_berakhir') }}"
                                       required>
                                @error('tanggal_berakhir')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="kuota_penerima" class="form-label">
                                    Kuota Penerima <span class="text-danger">*</span>
                                </label>
                                <input type="number" 
                                       class="form-control @error('kuota_penerima') is-invalid @enderror" 
                                       id="kuota_penerima" 
                                       name="kuota_penerima" 
                                       value="{{ old('kuota_penerima') }}"
                                       min="1"
                                       placeholder="50"
                                       required>
                                @error('kuota_penerima')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="jumlah_pendanaan" class="form-label">
                                    Jumlah Pendanaan (Rp) <span class="text-danger">*</span>
                                </label>
                                <input type="text" 
                                       class="form-control @error('jumlah_pendanaan') is-invalid @enderror" 
                                       id="jumlah_pendanaan" 
                                       name="jumlah_pendanaan" 
                                       value="{{ old('jumlah_pendanaan') }}"
                                       placeholder="5000000"
                                       onkeyup="formatRupiah(this)"
                                       required>
                                <div class="form-text">Masukkan nilai dalam rupiah tanpa titik atau koma</div>
                                @error('jumlah_pendanaan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="peserta_count" class="form-label">
                                    Jumlah Peserta Saat Ini
                                </label>
                                <input type="number" 
                                       class="form-control @error('peserta_count') is-invalid @enderror" 
                                       id="peserta_count" 
                                       name="peserta_count" 
                                       value="{{ old('peserta_count', 0) }}"
                                       min="0"
                                       readonly>
                                <div class="form-text">Field ini akan otomatis terisi saat ada pendaftar</div>
                                @error('peserta_count')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Persyaratan dan Kontak -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h5 class="text-secondary border-bottom pb-2">
                                    <i class="fas fa-list-check me-2"></i>
                                    Persyaratan & Kontak
                                </h5>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="persyaratan" class="form-label">
                                    Persyaratan <span class="text-danger">*</span>
                                </label>
                                <textarea class="form-control @error('persyaratan') is-invalid @enderror" 
                                          id="persyaratan" 
                                          name="persyaratan" 
                                          rows="6"
                                          placeholder="Contoh:&#10;- Warga Negara Indonesia&#10;- Usia maksimal 25 tahun&#10;- IPK minimal 3.0&#10;- Tidak sedang menerima beasiswa lain&#10;- Melampirkan surat keterangan tidak mampu"
                                          required>{{ old('persyaratan') }}</textarea>
                                @error('persyaratan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="info_kontak" class="form-label">
                                    Informasi Kontak <span class="text-danger">*</span>
                                </label>
                                <textarea class="form-control @error('info_kontak') is-invalid @enderror" 
                                          id="info_kontak" 
                                          name="info_kontak" 
                                          rows="6"
                                          placeholder="Contoh:&#10;Email: beasiswa@universitas.ac.id&#10;Telepon: 021-1234567&#10;Website: www.beasiswa.com&#10;Alamat: Jl. Pendidikan No. 123&#10;PIC: Bapak/Ibu Admin&#10;Jam Layanan: 08:00-16:00 WIB"
                                          required>{{ old('info_kontak') }}</textarea>
                                @error('info_kontak')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Tips Section -->
                        <div class="row mb-4">
                            <div class="col-md-8">
                                <!-- Empty space for balance -->
                            </div>
                            <div class="col-md-4">
                                <div class="card bg-light">
                                    <div class="card-body">
                                        <h6 class="card-title">
                                            <i class="fas fa-lightbulb text-warning me-2"></i>
                                            Tips Pengisian
                                        </h6>
                                        <ul class="mb-0 small">
                                            <li>Pastikan tanggal mulai tidak kurang dari hari ini</li>
                                            <li>Deskripsikan beasiswa sejelas mungkin</li>
                                            <li>Cantumkan persyaratan yang detail</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Tombol Aksi -->
                        <div class="row">
                            <div class="col-12">
                                <div class="d-flex justify-content-between align-items-center">
                                    <a href="{{ route('landing.daftar') }}" class="btn btn-secondary">
                                        <i class="fas fa-arrow-left me-2"></i>
                                        Kembali
                                    </a>
                                    <div class="d-flex gap-2">
                                        <button type="reset" class="btn btn-outline-warning">
                                            <i class="fas fa-undo me-2"></i>
                                            Reset Form
                                        </button>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-save me-2"></i>
                                            Simpan Beasiswa
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Preview Modal -->
<div class="modal fade" id="previewModal" tabindex="-1" aria-labelledby="previewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="previewModalLabel">
                    <i class="fas fa-eye me-2"></i>
                    Preview Beasiswa
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="previewContent">
                    <!-- Preview content will be loaded here -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- Success Alert (jika ada session success) -->
@if(session('success'))
<div class="position-fixed top-0 end-0 p-3" style="z-index: 1055;">
    <div class="toast show align-items-center text-white bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">
                <i class="fas fa-check-circle me-2"></i>
                {{ session('success') }}
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
</div>
@endif
@endsection

@push('scripts')
<script>
// Format input rupiah
function formatRupiah(input) {
    let value = input.value.replace(/[^\d]/g, '');
    let originalValue = value;
    value = value.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
    input.value = value;
    input.setAttribute('data-original', originalValue);
}

// Validasi tanggal
document.getElementById('tanggal_mulai').addEventListener('change', function() {
    const startDate = new Date(this.value);
    const endDateInput = document.getElementById('tanggal_berakhir');
    const today = new Date();
    today.setHours(0, 0, 0, 0);
    
    if (startDate < today) {
        alert('Tanggal mulai tidak boleh kurang dari hari ini');
        this.value = '';
        return;
    }
    
    // Set minimum end date
    endDateInput.min = this.value;
});

document.getElementById('tanggal_berakhir').addEventListener('change', function() {
    const startDate = new Date(document.getElementById('tanggal_mulai').value);
    const endDate = new Date(this.value);
    
    if (endDate <= startDate) {
        alert('Tanggal berakhir harus lebih besar dari tanggal mulai');
        this.value = '';
    }
});

// Auto-resize textarea
document.querySelectorAll('textarea').forEach(textarea => {
    textarea.addEventListener('input', function() {
        this.style.height = 'auto';
        this.style.height = this.scrollHeight + 'px';
    });
});

// Preview functionality
function generatePreview() {
    const form = document.querySelector('form');
    const formData = new FormData(form);
    
    let previewHtml = '<div class="card border-0 shadow-sm">';
    previewHtml += '<div class="card-header bg-primary text-white">';
    previewHtml += '<h5 class="mb-0"><i class="fas fa-graduation-cap me-2"></i>' + (formData.get('nama') || 'Nama Beasiswa Belum Diisi') + '</h5>';
    previewHtml += '</div>';
    previewHtml += '<div class="card-body">';
    
    // Status Badge
    const status = formData.get('status');
    const statusBadge = status === 'aktif' ? 'success' : 'secondary';
    previewHtml += '<div class="mb-3"><span class="badge bg-' + statusBadge + '">' + (status || 'Status belum dipilih') + '</span></div>';
    
    // Basic Info
    previewHtml += '<div class="row mb-3">';
    previewHtml += '<div class="col-md-6"><strong>Deskripsi:</strong><br>' + (formData.get('deskripsi') || 'Belum diisi') + '</div>';
    previewHtml += '<div class="col-md-6"><strong>Kuota Penerima:</strong><br>' + (formData.get('kuota_penerima') || 'Belum diisi') + ' orang</div>';
    previewHtml += '</div>';
    
    // Dates
    previewHtml += '<div class="row mb-3">';
    previewHtml += '<div class="col-md-4"><strong>Tanggal Mulai:</strong><br>' + (formData.get('tanggal_mulai') || 'Belum diisi') + '</div>';
    previewHtml += '<div class="col-md-4"><strong>Tanggal Berakhir:</strong><br>' + (formData.get('tanggal_berakhir') || 'Belum diisi') + '</div>';
    previewHtml += '</div>';
    
    // Funding
    const pendanaan = formData.get('jumlah_pendanaan');
    previewHtml += '<div class="mb-3"><strong>Jumlah Pendanaan:</strong><br>Rp ' + (pendanaan || '0') + '</div>';
    
    // Requirements
    previewHtml += '<div class="mb-3"><strong>Persyaratan:</strong><br><pre class="bg-light p-2 rounded">' + (formData.get('persyaratan') || 'Belum diisi') + '</pre></div>';
    
    // Contact
    previewHtml += '<div class="mb-3"><strong>Informasi Kontak:</strong><br><pre class="bg-light p-2 rounded">' + (formData.get('info_kontak') || 'Belum diisi') + '</pre></div>';
    
    previewHtml += '</div></div>';
    
    document.getElementById('previewContent').innerHTML = previewHtml;
}

// Form validation before submit
document.querySelector('form').addEventListener('submit', function(e) {
    const requiredFields = this.querySelectorAll('[required]');
    let isValid = true;
    let errorMessages = [];
    
    requiredFields.forEach(field => {
        if (!field.value.trim()) {
            field.classList.add('is-invalid');
            isValid = false;
            const label = this.querySelector(`label[for="${field.id}"]`);
            if (label) {
                errorMessages.push('- ' + label.textContent.replace('*', '').trim());
            }
        } else {
            field.classList.remove('is-invalid');
        }
    });
    
    // Convert formatted rupiah back to number
    const rupiahInput = document.getElementById('jumlah_pendanaan');
    if (rupiahInput.value) {
        rupiahInput.value = rupiahInput.value.replace(/\./g, '');
    }
    
    if (!isValid) {
        e.preventDefault();
        alert('Mohon lengkapi field berikut:\n' + errorMessages.join('\n'));
        // Scroll to first invalid field
        const firstInvalid = this.querySelector('.is-invalid');
        if (firstInvalid) {
            firstInvalid.scrollIntoView({ behavior: 'smooth', block: 'center' });
            firstInvalid.focus();
        }
    }
});

// Reset form confirmation
document.querySelector('button[type="reset"]').addEventListener('click', function(e) {
    if (!confirm('Apakah Anda yakin ingin mengosongkan semua field?')) {
        e.preventDefault();
    }
});

// Auto-hide success toast
document.addEventListener('DOMContentLoaded', function() {
    const toast = document.querySelector('.toast');
    if (toast) {
        setTimeout(() => {
            const bootstrapToast = new bootstrap.Toast(toast);
            bootstrapToast.hide();
        }, 5000);
    }
});

// Character counter for textareas
document.querySelectorAll('textarea').forEach(textarea => {
    const maxLength = 1000;
    
    // Create counter element
    const counter = document.createElement('div');
    counter.className = 'form-text text-end';
    counter.style.fontSize = '0.75em';
    textarea.parentNode.appendChild(counter);
    
    function updateCounter() {
        const remaining = maxLength - textarea.value.length;
        counter.textContent = `${textarea.value.length}/${maxLength} karakter`;
        counter.className = remaining < 50 ? 'form-text text-end text-warning' : 'form-text text-end text-muted';
    }
    
    textarea.addEventListener('input', updateCounter);
    updateCounter();
});
</script>
@endpush

@push('styles')
<style>
.card {
    border: none;
    box-shadow: 0 0 20px rgba(0,0,0,0.1);
}

.form-label {
    font-weight: 600;
    color: #555;
    margin-bottom: 0.5rem;
}

.form-control, .form-select {
    border-radius: 0.5rem;
    border: 1px solid #e0e6ed;
    padding: 0.75rem 1rem;
}

.form-control:focus, .form-select:focus {
    border-color: #007bff;
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
}

.text-danger {
    font-weight: bold;
}

.border-bottom {
    border-bottom: 2px solid #e9ecef !important;
    margin-bottom: 1rem;
}

.btn-primary {
    background: linear-gradient(45deg, #007bff, #0056b3);
    border: none;
    border-radius: 0.5rem;
    padding: 0.75rem 1.5rem;
    font-weight: 600;
}

.btn-primary:hover {
    background: linear-gradient(45deg, #0056b3, #004085);
    transform: translateY(-1px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.2);
}

.btn-secondary, .btn-outline-warning {
    border-radius: 0.5rem;
    padding: 0.75rem 1.5rem;
    font-weight: 600;
}

.invalid-feedback {
    font-size: 0.875em;
    margin-top: 0.25rem;
}

textarea {
    resize: vertical;
    min-height: 120px;
}

.form-text {
    font-size: 0.8em;
    color: #6c757d;
    margin-top: 0.25rem;
}

.card.bg-light {
    background-color: #f8f9fa !important;
    border: 1px solid #e9ecef;
}

.toast {
    min-width: 300px;
}

pre {
    font-family: inherit;
    font-size: inherit;
    white-space: pre-wrap;
    word-wrap: break-word;
    margin: 0;
}

.modal-header {
    border-bottom: 1px solid #dee2e6;
    background-color: #f8f9fa;
}

.modal-footer {
    border-top: 1px solid #dee2e6;
    background-color: #f8f9fa;
}

.d-flex.gap-2 > * {
    margin-left: 0.5rem;
}

.d-flex.gap-2 > *:first-child {
    margin-left: 0;
}

@media (max-width: 768px) {
    .card-body {
        padding: 1rem;
    }
    
    .d-flex.justify-content-between {
        flex-direction: column;
        gap: 1rem;
    }
    
    .d-flex.gap-2 {
        display: flex;
        gap: 0.5rem;
        justify-content: center;
    }
    
    .btn {
        font-size: 0.875rem;
        padding: 0.5rem 1rem;
    }
}

.position-fixed {
    z-index: 1055;
}

.alert-info {
    background-color: #d1ecf1;
    border-color: #bee5eb;
    color: #0c5460;
}
</style>
@endpush