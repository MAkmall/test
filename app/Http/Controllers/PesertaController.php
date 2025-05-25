<?php

namespace App\Http\Controllers;

use App\Models\Peserta;
use App\Models\Beasiswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PesertaController extends Controller
{
    // Menampilkan semua data peserta yang terdaftar oleh user yang login
    public function index()
    {
        // Mengambil data peserta yang terkait dengan user yang sedang login
        $pesertas = Peserta::where('user_id', Auth::id())->get();

        return view('admin.peserta', compact('pesertas'));
    }

    // Menampilkan form untuk membuat peserta baru
    public function create()
    {
        $beasiswas = Beasiswa::all();  // Menampilkan daftar beasiswa
        return view('landing.daftar', compact('beasiswas'));
    }

        public function daftar()
    {
        return view('landing.daftar');
    }

    // Menyimpan peserta baru
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'tempat_tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
            'semester' => 'required|string',
            'tanggungan' => 'required|string',
            'penghasilan_orang_tua' => 'required|numeric',
            'ipk' => 'required|numeric|between:0,4',
            'transkrip' => 'required|string',
            'prestasi' => 'nullable|string',
            'surat_aktif_kuliah' => 'required|string',
            'beasiswa_id' => 'required|exists:beasiswas,id',
        ]);

        // Menyimpan data peserta yang terhubung dengan user yang sedang login
        Peserta::create([
            'user_id' => Auth::id(),
            'nama' => $request->nama,
            'tempat_tanggal_lahir' => $request->tempat_tanggal_lahir,
            'alamat' => $request->alamat,
            'semester' => $request->semester,
            'tanggungan' => $request->tanggungan,
            'penghasilan_orang_tua' => $request->penghasilan_orang_tua,
            'ipk' => $request->ipk,
            'transkrip' => $request->transkrip,
            'prestasi' => $request->prestasi,
            'surat_aktif_kuliah' => $request->surat_aktif_kuliah,
            'beasiswa_id' => $request->beasiswa_id,
        ]);

        return redirect()->route('pesertas.index')->with('success', 'Peserta berhasil ditambahkan.');
    }

    // Menampilkan form untuk mengedit peserta
    public function edit($id)
    {
        $peserta = Peserta::findOrFail($id);
        $beasiswas = Beasiswa::all();
        return view('pesertas.edit', compact('peserta', 'beasiswas'));
    }

    // Memperbarui data peserta
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'tempat_tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
            'semester' => 'required|string',
            'tanggungan' => 'required|string',
            'penghasilan_orang_tua' => 'required|numeric',
            'ipk' => 'required|numeric|between:0,4',
            'transkrip' => 'required|string',
            'prestasi' => 'nullable|string',
            'surat_aktif_kuliah' => 'required|string',
            'beasiswa_id' => 'required|exists:beasiswas,id',
        ]);

        $peserta = Peserta::findOrFail($id);
        $peserta->update($request->all());

        return redirect()->route('pesertas.index')->with('success', 'Peserta berhasil diperbarui.');
    }

    // Menghapus peserta
    public function destroy($id)
    {
        $peserta = Peserta::findOrFail($id);
        $peserta->delete();

        return redirect()->route('pesertas.index')->with('success', 'Peserta berhasil dihapus.');
    }
}
