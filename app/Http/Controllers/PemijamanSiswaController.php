<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\ItemLends;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PemijamanSiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::id();

        $data = Peminjaman::with('siswa', 'itemLend', 'pengembalian')
            ->where('siswa_id', $user)
            ->latest()
            ->get();

        return view('landing-page.data-peminjaman-siswa', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'borrowing_date' => 'required|date',
            'return_date' => 'required|date|after_or_equal:borrowing_date',
            'buku_id' => 'required|uuid|exists:bukus,id',
            'qty' => 'required|integer|min:1',
        ]);

        $user = Auth::id();
        $bukuID = Buku::findOrFail($data['buku_id']);

        if ($bukuID->stok_buku < $data['qty']) {
            return redirect()->back()->withErrors("Stok buku '{$bukuID->nama_buku}' tidak mencukupi untuk jumlah {$data['qty']}");
        }

        DB::beginTransaction();

        try {
            $peminjaman = Peminjaman::create([
                'number' => $this->generateNumberLend(),
                'lend_date' => $data['borrowing_date'],
                'return_date' => $data['return_date'],
                'siswa_id' => $user,
            ]);

            $bukuID->stok_buku -= $data['qty'];
            $bukuID->save();

            ItemLends::create([
                'qty' => $data['qty'],
                'lends_id' => $peminjaman->id,
                'buku_id' => $bukuID->id,
                'status' => 'Belum',
            ]);

            DB::commit();
            return redirect()->route('siswa.peminjaman')->with('success', 'Data peminjaman buku berhasil ditambahkan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function generateNumberLend()
    {
        $randomNo = mt_rand(100000, 999999);

        $lendNumber = now()->format('Y') . $randomNo;

        return $lendNumber;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
