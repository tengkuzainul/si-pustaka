<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\KategoriBuku;
use App\Models\Member;
use App\Models\Peminjaman;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $member = Member::latest()->get();
        $books = Buku::all();
        $kategoriBuku = KategoriBuku::all();

        $tahun = date('Y');
        $total = [];
        $bulan = [];
        $bulanIni = date('m');

        for ($i = 1; $i <= $bulanIni; $i++) {
            $totalPeminjaman = Peminjaman::whereYear('created_at', $tahun)
                ->whereMonth('created_at', $i)
                ->count();

            $bulan[] = Carbon::create()->month($i)->format('F');
            $total[] = $totalPeminjaman;
        }

        return view('dashboard', compact('member', 'books', 'kategoriBuku', 'bulan', 'total'));
    }
}
