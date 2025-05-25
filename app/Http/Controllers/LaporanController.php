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
    public function index()
    {
        // Mengambil data hasil seleksi dari peserta
        $hasilSeleksi = Peserta::with('beasiswaPeserta')->get();
        return view('admin.laporan.index', compact('hasilSeleksi'));
    }

    // Menampilkan hasil seleksi untuk peserta
    public function show($id)
    {
        // Mengambil data peserta berdasarkan id
        $peserta = Peserta::with('beasiswaPeserta')->findOrFail($id);
        return view('admin.laporan.show', compact('peserta'));
    }

    // Menghasilkan laporan hasil seleksi dalam bentuk PDF
    public function generatePDF($id)
    {
        $peserta = Peserta::with('beasiswaPeserta')->findOrFail($id);

        // Menggunakan package dompdf untuk membuat file PDF
        $pdf = PDF::loadView('admin.laporan.pdf', compact('peserta'));
        return $pdf->download('hasil_seleksi_' . $peserta->nama . '.pdf');
    }

    // Menghasilkan laporan hasil seleksi dalam bentuk Excel
    public function generateExcel()
    {
        return Excel::download(new HasilSeleksiExport, 'hasil_seleksi.xlsx');
    }
}
