@extends('layouts.admin')

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Laporan Hasil Seleksi Beasiswa</h3>
      </div>

      <div class="card-body">
        <!-- Filter atau opsi pencarian -->
        <form action="{{ route('admin.laporan.index') }}" method="GET" class="mb-3">
          <div class="row">
            <div class="col-md-3">
              <label for="beasiswa_id">Beasiswa</label>
              <select name="beasiswa_id" id="beasiswa_id" class="form-control">
                <option value="">-- Pilih Beasiswa --</option>
                @foreach($beasiswas as $beasiswa)
                  <option value="{{ $beasiswa->id }}" {{ request('beasiswa_id') == $beasiswa->id ? 'selected' : '' }}>
                    {{ $beasiswa->nama }}
                  </option>
                @endforeach
              </select>
            </div>

            <div class="col-md-3">
              <label for="status">Status</label>
              <select name="status" id="status" class="form-control">
                <option value="">-- Pilih Status --</option>
                <option value="Lulus" {{ request('status') == 'Lulus' ? 'selected' : '' }}>Lulus</option>
                <option value="Tidak Lulus" {{ request('status') == 'Tidak Lulus' ? 'selected' : '' }}>Tidak Lulus</option>
              </select>
            </div>

            <div class="col-md-3">
              <button type="submit" class="btn btn-primary mt-4">
                <i class="fas fa-filter"></i> Filter
              </button>
            </div>
          </div>
        </form>

        <!-- Tabel Hasil Seleksi -->
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>Nama Peserta</th>
              <th>Beasiswa</th>
              <th>Status</th>
              <th>Nilai Akhir</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach($hasilSeleksi as $hasil)
              <tr>
                <td>{{ $hasil->peserta->nama }}</td>
                <td>{{ $hasil->beasiswa->nama }}</td>
                <td>{{ $hasil->status }}</td>
                <td>{{ $hasil->nilai_akhir }}</td>
                <td>
                  <a href="{{ route('admin.laporan.show', $hasil->id) }}" class="btn btn-info btn-sm">Lihat</a>
                  <a href="{{ route('admin.laporan.download', $hasil->id) }}" class="btn btn-success btn-sm">Download</a>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
        
        <!-- Pagination -->
        <div class="mt-3">
          {{ $hasilSeleksi->links() }}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
