@extends('layouts.peserta')

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Hasil Seleksi Beasiswa</h3>
      </div>

      <div class="card-body">
        <!-- Informasi Peserta -->
        <div class="row">
          <div class="col-md-6">
            <h5><strong>Nama Peserta:</strong> {{ $hasilSeleksi->peserta->nama }}</h5>
            <p><strong>Nomor Induk Mahasiswa (NIM):</strong> {{ $hasilSeleksi->peserta->nim }}</p>
            <p><strong>Beasiswa:</strong> {{ $hasilSeleksi->beasiswa->nama }}</p>
            <p><strong>Status Seleksi:</strong> {{ $hasilSeleksi->status }}</p>
            <p><strong>Nilai Akhir Seleksi:</strong> {{ number_format($hasilSeleksi->nilai_akhir, 2) }}</p>
          </div>

          <!-- Tabel Penilaian per Kriteria -->
          <div class="col-md-6">
            <h4>Penilaian per Kriteria</h4>
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>Kriteria</th>
                  <th>Nilai</th>
                </tr>
              </thead>
              <tbody>
                @foreach($hasilSeleksi->penilaians as $penilaian)
                  <tr>
                    <td>{{ $penilaian->kriteria->nama }}</td>
                    <td>{{ number_format($penilaian->nilai, 2) }}</td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>

        <!-- Button Kembali -->
        <div class="card-footer">
          <div class="row">
            <div class="col-sm-6">
              <a href="{{ route('peserta.daftar-beasiswa') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali ke Daftar Beasiswa
              </a>
            </div>
            <div class="col-sm-6 text-right">
              <a href="{{ route('peserta.cetak-hasil', $hasilSeleksi->id) }}" class="btn btn-success">
                <i class="fas fa-download"></i> Unduh PDF
              </a>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>
@endsection
