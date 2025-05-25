<?php

namespace App\Http\Controllers;

use App\Models\Beasiswa;
use App\Models\BeasiswaKriteria;
use Illuminate\Http\Request;

class BeasiswaController extends Controller
{
    // Menampilkan semua data beasiswa
    public function index()
    {
        $beasiswas = Beasiswa::all();
        return view('admin.beasiswa', compact('beasiswas'));
    }

    // Menampilkan form untuk membuat beasiswa baru
    public function Pendaftaran()
    {
        $beasiswas = Beasiswa::all(); // Ambil semua beasiswa
        return view('landing.daftar', compact('beasiswas'));
    }

    public function Mendaftar()
    {
        $beasiswas = Beasiswa::all(); // Ambil semua beasiswa
        return view('landing.pendaftaran', compact('beasiswas'));
    }



        public function create()
    {
        return view('admin.beasiswa.create');
    }
    
    // Menyimpan beasiswa baru
    public function store(Request $request)
    {
        logger()->info('Store Method Reached!', $request->all());

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'peserta_count' => 'nullable|integer', // Opsional, karena readonly
            'status' => 'required|in:aktif,non-aktif', // Sesuai opsi di form
            'jumlah_pendanaan' => 'required|numeric|min:0',
            'kuota_penerima' => 'required|integer|min:1',
            'tanggal_mulai' => 'required|date',
            'tanggal_berakhir' => 'required|date|after:tanggal_mulai',
            'persyaratan' => 'required|string',
            'info_kontak' => 'required|string',
        ]);

        // Set default untuk peserta_count
        $validated['peserta_count'] = 0; // Selalu 0 saat pembuatan

        try {
            $beasiswa = Beasiswa::create($validated);
            logger()->info('Beasiswa Created!', $beasiswa->toArray());
        } catch (\Exception $e) {
            logger()->error('Error creating beasiswa: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Gagal menyimpan beasiswa: ' . $e->getMessage()]);
        }

        return redirect()->route('admin.beasiswa.index')->with('success', 'Beasiswa berhasil dibuat.');
    }

    // Menampilkan detail beasiswa tertentu
        public function show($id)
    {
        $beasiswa = Beasiswa::findOrFail($id);
        return view('admin.beasiswa.index', compact('beasiswa'));
    }

        // Menampilkan form untuk mengedit beasiswapublic function edit($id)
    public function edit($id)
    {
        $beasiswa = Beasiswa::findOrFail($id);
        return view('admin.beasiswa.edit', compact('beasiswa'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'batas_pendaftaran' => 'required|date',
            'jumlah_pendanaan' => 'required|numeric',
            'kuota_penerima' => 'required|integer',
            'tanggal_mulai' => 'required|date',
            'tanggal_berakhir' => 'required|date',
            'persyaratan' => 'required|string',
            'info_kontak' => 'required|string',
        ]);

        $beasiswa = Beasiswa::findOrFail($id);
        $beasiswa->update($request->all());

        return redirect()->route('admin.beasiswas.index')->with('success', 'Beasiswa berhasil diperbarui.');
    }

    // Menghapus beasiswa
    public function destroy($id)
    {
        $beasiswa = Beasiswa::findOrFail($id);
        $beasiswa->delete();

        return redirect()->route('admin.beasiswas.index')->with('success', 'Beasiswa berhasil dihapus.');
    }
}
