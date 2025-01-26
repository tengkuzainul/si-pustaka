<?php

namespace App\Http\Controllers;

use App\Models\Denda;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use App\Models\Notification;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PengembalianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $returns = Pengembalian::with(['peminjaman', 'peminjaman.siswa', 'peminjaman.itemLend', 'peminjaman.itemLend.buku'])
            ->latest()
            ->get();

        return view('admin.pengembalian.index', compact('returns'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {
        $data = $request->validate([
            'tanggal_pengembalian' => 'required|date',
        ]);

        $peminjaman = Peminjaman::findOrFail($id);
        $tglKembali = Carbon::parse($peminjaman->return_date);
        $tglPengembalian = Carbon::parse($data['tanggal_pengembalian']);

        $keterlambatan = $tglKembali->diffInDays($tglPengembalian, true);

        $dendaPerHari = Denda::find(1);
        $totalDenda = $keterlambatan > 0 ? $keterlambatan * $dendaPerHari->jumlah_denda : 0;

        Pengembalian::create([
            'no_peminjaman' => $peminjaman->number,
            'tanggal_pengembalian' => $data['tanggal_pengembalian'],
            'peminjaman_id' => $peminjaman->id,
            'denda' => $totalDenda,
        ]);

        $peminjaman->status = 'Kembali';
        $peminjaman->save();

        Notification::create([
            'title' => 'Pengembalian Buku',
            'message' => 'Pengembalian buku dengan nomor peminjaman ' . $peminjaman->number . ' telah dikembalikan.',
            'type' => 'success',
            'status' => '0',
        ]);

        return redirect()->route('pengembalian')
            ->with('success', 'Data pengembalian buku berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Pengembalian::with('peminjaman')
            ->findOrFail($id);

        return view('admin.pengembalian.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
