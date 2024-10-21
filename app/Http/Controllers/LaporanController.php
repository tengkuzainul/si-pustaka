<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function formCetak()
    {
        return view('admin.laporan.form');
    }

    public function cetak(Request $request)
    {
        $request->validate([
            'tglAwal' => 'required|date',
            'tglAkhir' => 'required|date',
        ]);

        $tglAwal = $request->input('tglAwal');
        $tglAkhir = $request->input('tglAkhir');

        $data = Peminjaman::with('itemLend', 'pengembalian')
            ->whereBetween('created_at', [$tglAwal, $tglAkhir])
            ->get();

        $pdf = PDF::loadView('admin.laporan.pdf', ['data' => $data])
            ->setPaper('legal', 'landscape');

        return $pdf->download('Laporan_' . $tglAwal . '_' . $tglAkhir . '.pdf');
    }
}
