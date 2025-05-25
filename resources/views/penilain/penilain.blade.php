@extends('layouts.admin')

@section('content')
<div class="row">
  <div class="col-md-8">
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Penilaian Beasiswa</h3>
      </div>

      <form action="{{ route('admin.penilaian.store') }}" method="POST">
        @csrf
        <div class="card-body">
          
          <div class="form-group">
            <label for="peserta_id">Peserta <span class="text-danger">*</span></label>
            <select class="form-control @error('peserta_id') is-invalid @enderror" id="peserta_id" name="peserta_id" required>
              <option value="">-- Pilih Peserta --</option>
              @foreach($pesertas as $peserta)
                <option value="{{ $peserta->id }}" {{ old('peserta_id') == $peserta->id ? 'selected' : '' }}>
                  {{ $peserta->nama }}
                </option>
              @endforeach
            </select>
            @error('peserta_id')
              <span class="invalid-feedback">{{ $message }}</span>
            @enderror
          </div>

          @foreach($kriterias as $kriteria)
            <div class="form-group">
              <label for="kriteria_{{ $kriteria->id }}">{{ $kriteria->nama }} <span class="text-danger">*</span></label>
              <input type="number" 
                     class="form-control @error('kriteria_' . $kriteria->id) is-invalid @enderror" 
                     id="kriteria_{{ $kriteria->id }}" 
                     name="kriteria[{{ $kriteria->id }}]" 
                     value="{{ old('kriteria.' . $kriteria->id) }}" 
                     step="0.01" 
                     min="0" 
                     max="100" 
                     placeholder="Masukkan nilai untuk {{ $kriteria->nama }}"
                     required>
              @error('kriteria.' . $kriteria->id)
                <span class="invalid-feedback">{{ $message }}</span>
              @enderror
            </div>
          @endforeach

        </div>

        <div class="card-footer">
          <div class="row">
            <div class="col-sm-6">
              <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Simpan Penilaian
              </button>
            </div>
            <div class="col-sm-6 text-right">
              <a href="{{ route('admin.penilaian.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
              </a>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>

  <div class="col-md-4">
    <!-- Info Penilaian -->
    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title">Informasi Penilaian</h3>
      </div>
      <div class="card-body">
        <p class="text-muted">
          Pada halaman ini, Anda dapat memberikan penilaian berdasarkan kriteria yang sudah ditentukan sebelumnya.
        </p>
        <p class="text-muted">
          Setiap peserta akan dinilai berdasarkan beberapa kriteria dan bobot yang telah ditentukan.
        </p>
      </div>
    </div>

    <!-- Penjelasan Jenis Kriteria -->
    <div class="card card-success">
      <div class="card-header">
        <h3 class="card-title">Penjelasan Jenis Kriteria</h3>
      </div>
      <div class="card-body">
        <div class="mb-3">
          <h6><span class="badge badge-success">Benefit</span></h6>
          <p class="text-sm mb-2">Semakin tinggi nilainya semakin baik</p>
          <small class="text-muted">Contoh: IPK, Prestasi, Nilai Ujian</small>
        </div>
        
        <div>
          <h6><span class="badge badge-warning">Cost</span></h6>
          <p class="text-sm mb-2">Semakin rendah nilainya semakin baik</p>
          <small class="text-muted">Contoh: Penghasilan Orang Tua, Jarak Tempuh</small>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
