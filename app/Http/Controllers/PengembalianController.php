<?php

namespace App\Http\Controllers;

use App\Models\Denda;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use App\Models\Notification;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        // Validasi input
        $data = $request->validate([
            'tanggal_pengembalian' => 'required|date',
        ]);

        // Ambil data peminjaman berdasarkan ID
        $peminjaman = Peminjaman::findOrFail($id);

        // Validasi tanggal pengembalian tidak boleh sebelum tanggal pinjam
        if (Carbon::parse($data['tanggal_pengembalian'])->lt(Carbon::parse($peminjaman->return_date))) {
            return redirect()->back()->withErrors('Tanggal pengembalian tidak boleh lebih awal dari tanggal yang ditentukan.');
        }

        // Hitung keterlambatan
        $tglKembali = Carbon::parse($peminjaman->return_date);
        $tglPengembalian = Carbon::parse($data['tanggal_pengembalian']);
        $keterlambatan = $tglKembali->lt($tglPengembalian) ? $tglKembali->diffInDays($tglPengembalian) : 0;

        // Ambil data denda per hari
        $dendaPerHari = Denda::find(1);
        if (!$dendaPerHari) {
            return redirect()->back()->withErrors('Data denda tidak ditemukan.');
        }

        // Hitung total denda
        $totalDenda = $keterlambatan > 0 ? $keterlambatan * $dendaPerHari->jumlah_denda : 0;

        // Buat data pengembalian
        Pengembalian::create([
            'no_peminjaman' => $peminjaman->number,
            'tanggal_pengembalian' => $data['tanggal_pengembalian'],
            'peminjaman_id' => $peminjaman->id,
            'denda' => $totalDenda,
            'konfirmasi_pengembalian' => Auth::user()->role === 'Superadmin' || Auth::user()->role === 'Admin' ? 'Diterima' : 'Menunggu'
        ]);

        // Update status peminjaman
        $peminjaman->status = 'Kembali';
        $peminjaman->save();

        // Buat notifikasi
        Notification::create([
            'title' => 'Pengembalian Buku',
            'message' => 'Pengembalian buku dengan nomor peminjaman ' . $peminjaman->number . ' telah dikembalikan.',
            'type' => 'success',
            'status' => '0',
        ]);

        // Redirect sesuai dengan role pengguna
        if (Auth::user()->role === 'Superadmin' || Auth::user()->role === 'Admin') {
            return redirect()->route('pengembalian')
                ->with('success', 'Data pengembalian buku berhasil ditambahkan.');
        } else {
            return redirect()->route('siswa.pengembalian')
                ->with('success', 'Data pengembalian buku berhasil ditambahkan.');
        }
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
     * Update the specified resource in storage.
     */
    public function updateKonfirmasiStatus(string $id)
    {
        // Cari data berdasarkan ID
        $return = Pengembalian::findOrFail($id);

        // Periksa status konfirmasi
        if ($return->konfirmasi_pengembalian === 'Menunggu') {
            $return->konfirmasi_pengembalian = 'Diterima';
            $return->save(); // Simpan perubahan
            return redirect()->back()->withSuccess('Data pengembalian berhasil dikonfirmasi sebagai Diterima.');
        } elseif ($return->konfirmasi_pengembalian === 'Diterima') {
            return redirect()->back()->withErrors('Data pengembalian sudah dikonfirmasi sebelumnya.');
        } else {
            return redirect()->back()->withErrors('Data pengembalian tidak valid atau tidak ditemukan.');
        }
    }
}
