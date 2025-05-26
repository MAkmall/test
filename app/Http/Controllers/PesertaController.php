<?php

namespace App\Http\Controllers;

use App\Models\Peserta;
use App\Models\PenilaianPeserta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PesertaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard()
    {
        $totalPendaftaran = Peserta::where('user_id', Auth::id())->count();
        $totalLulus = Peserta::where('user_id', Auth::id())->where('status', 'lolos')->count();
        $daftarPendaftaran = Peserta::where('user_id', Auth::id())->get();

        return view('peserta.dashboard', compact('totalPendaftaran', 'totalLulus', 'daftarPendaftaran'));
    }

    public function index()
    {
        if (Auth::user()->is_admin) {
        $peserta = Peserta::all(); // admin lihat semua
        } else {
        $peserta = Peserta::where('user_id', Auth::id())->get(); // user hanya lihat datanya
        }
        return view('admin.peserta', compact('peserta'));
    }

    public function create()
    {
        return view('landing.dashboard');
    }

    public function daftar()
    {
        return view('landing.daftar');
    }

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
            'transkrip' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'prestasi' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'surat_aktif_kuliah' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $transkripPath = $request->file('transkrip')->store('transkrip', 'public');
        $prestasiPath = $request->file('prestasi')?->store('prestasi', 'public');
        $suratAktifKuliahPath = $request->file('surat_aktif_kuliah')->store('surat_aktif', 'public');

        Peserta::create([
            'user_id' => Auth::id(),
            'nama' => $request->nama,
            'tempat_tanggal_lahir' => $request->tempat_tanggal_lahir,
            'alamat' => $request->alamat,
            'semester' => $request->semester,
            'tanggungan' => $request->tanggungan,
            'penghasilan_orang_tua' => $request->penghasilan_orang_tua,
            'ipk' => $request->ipk,
            'transkrip' => $transkripPath,
            'prestasi' => $prestasiPath,
            'surat_aktif_kuliah' => $suratAktifKuliahPath,
            'status' => 'pending',
        ]);


        return redirect()->route('landing.daftar')->with('success', 'Pendaftaran berhasil.');
    }

    public function edit($id)
    {
        $peserta = Peserta::where('user_id', Auth::id())->findOrFail($id);
        return view('peserta.edit', compact('peserta'));
    }

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
        ]);

        $peserta = Peserta::where('user_id', Auth::id())->findOrFail($id);
        $peserta->update($request->only([
            'nama',
            'tempat_tanggal_lahir',
            'alamat',
            'semester',
            'tanggungan',
            'penghasilan_orang_tua',
            'ipk',
            'transkrip',
            'prestasi',
            'surat_aktif_kuliah',
        ]));

        return redirect()->route('peserta.index')->with('success', 'Data peserta berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $peserta = Peserta::where('user_id', Auth::id())->findOrFail($id);
        $peserta->delete();
        return redirect()->route('peserta.index')->with('success', 'Peserta berhasil dihapus.');
    }

    public function status()
    {
        $peserta = Peserta::where('user_id', Auth::id())->first();

        return view('landing.status', [
            'status' => $peserta->status,
            'nilai_akhir' => $peserta->penilaian->first()->nilai_akhir ?? 'Belum dinilai',
        ]);
    }

    public function riwayat()
    {
        $peserta = Peserta::where('user_id', Auth::id())->with('penilaian.kriteria')->first();
        return view('peserta.riwayat', compact('peserta'));
    }
}
