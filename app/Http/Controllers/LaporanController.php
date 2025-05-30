<?php

namespace App\Http\Controllers;

use App\Models\Peserta;
use App\Exports\HasilSeleksiExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;

class LaporanController extends Controller
{
    // Menampilkan halaman laporan hasil seleksi
    public function index(Request $request)
    {
        $query = \App\Models\Peserta::with('peserta');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $hasilSeleksi = $query->paginate(10);

        return view('laporan.index', compact('hasilSeleksi'));
    }

    // Menampilkan hasil seleksi untuk peserta
    public function show($id)
    {
        // Mengambil data peserta berdasarkan id
        $peserta = Peserta::with('beasiswaPeserta')->findOrFail($id);
        return view('admin.laporan.show', compact('peserta'));
    }


    // Menghasilkan laporan hasil seleksi dalam bentuk Excel
    public function generateExcel()
    {
        return Excel::download(new HasilSeleksiExport, 'hasil_seleksi.xlsx');
    }
}
