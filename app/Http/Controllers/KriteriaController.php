<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use Illuminate\Http\Request;

class KriteriaController extends Controller
{
    // Menampilkan semua data kriteria
    public function index()
    {
        $kriterias = Kriteria::all();
        return view('admin.kriteria', compact('kriterias'));
    }

    // Menampilkan form untuk membuat kriteria baru
    public function create()
    {
        return view('kriterias.create');
    }

    // Menyimpan kriteria baru
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jenis' => 'required|string|max:100',
            'bobot' => 'required|numeric|between:0,1',
            'deskripsi' => 'nullable|string',
        ]);

        Kriteria::create($request->all());

        return redirect()->route('kriterias.index')->with('success', 'Kriteria berhasil ditambahkan.');
    }

    // Menampilkan form untuk mengedit kriteria
    public function edit($id)
    {
        $kriteria = Kriteria::findOrFail($id);
        return view('kriterias.edit', compact('kriteria'));
    }

    // Memperbarui data kriteria
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jenis' => 'required|string|max:100',
            'bobot' => 'required|numeric|between:0,1',
            'deskripsi' => 'nullable|string',
        ]);

        $kriteria = Kriteria::findOrFail($id);
        $kriteria->update($request->all());

        return redirect()->route('kriterias.index')->with('success', 'Kriteria berhasil diperbarui.');
    }

    // Menghapus kriteria
    public function destroy($id)
    {
        $kriteria = Kriteria::findOrFail($id);
        $kriteria->delete();

        return redirect()->route('kriterias.index')->with('success', 'Kriteria berhasil dihapus.');
    }
}
