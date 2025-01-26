<?php

namespace App\Http\Controllers;

use App\Events\NotificationEvent;
use App\Models\Buku;
use App\Models\ItemLends;
use App\Models\Member;
use App\Models\Peminjaman;
use App\Models\User;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Peminjaman::with('siswa', 'itemLend', 'pengembalian')
            ->latest()
            ->get();

        $title = 'Delete Borrowing!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);

        return view('admin.peminjaman.index', compact('data'));
    }

    public function create()
    {
        $siswas = User::with('dataSiswa')->where('role', 'Siswa')->get();
        $books = Buku::all();

        return view('admin.peminjaman.create', compact('siswas', 'books'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'borrowing_date' => 'required|date',
            'return_date' => 'required|date|after_or_equal:borrowing_date',
            'buku_id' => 'required|array',
            'buku_id.*' => 'required|exists:bukus,id',
            'qty' => 'required|array',
            'qty.*' => 'required|integer|min:1',
        ]);

        DB::beginTransaction();

        try {
            $peminjaman = Peminjaman::create([
                'number' => $this->generateNumberLend(),
                'lend_date' => $data['borrowing_date'],
                'return_date' => $data['return_date'],
                'siswa_id' => $data['user_id'],
            ]);

            foreach ($data['buku_id'] as $index => $buku_id) {
                $qty = $data['qty'][$index];

                $buku = Buku::findOrFail($buku_id);

                if ($buku->stok_buku < $qty) {
                    throw new \Exception("Stok buku '{$buku->nama_buku}' tidak mencukupi untuk jumlah {$qty}");
                }

                $buku->stok_buku -= $qty;
                $buku->save();

                ItemLends::create([
                    'qty' => $qty,
                    'lends_id' => $peminjaman->id,
                    'buku_id' => $buku_id,
                    'status' => 'Belum',
                ]);
            }

            DB::commit();
            return redirect()->route('peminjaman')->with('success', 'Data peminjaman buku berhasil ditambahkan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('peminjaman')->withErrors($e->getMessage());
        }
    }

    public function generateNumberLend()
    {
        $randomNo = mt_rand(100000, 999999);

        $lendNumber = now()->format('Y') . $randomNo;

        return $lendNumber;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        $items = ItemLends::where('lends_id', $id)->get();

        foreach ($items as $item) {
            $book = $item->buku;
            $book->stok_buku += $item->qty;
            $book->save();
        }

        $peminjaman->delete();

        return redirect()->back()->with('success', 'The Borrowing Book data has been successfully deleted.');
    }
}
