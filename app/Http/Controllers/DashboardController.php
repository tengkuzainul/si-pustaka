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

        // $userL = User::where('gender', 'L')->count();
        // $userP = User::where('gender', 'P')->count();
        // $memberL = Member::where('gender', 'L')->count();
        // $memberP = Member::where('gender', 'P')->count();
        // $jumlahLakiLaki = $userL + $memberL;
        // $jumlahPerempuan = $userP + $memberP;

        // $tahun = date('Y');
        // $total = [];
        // $bulanIni = date('m');
        // for ($i = 1; $i <= $bulanIni; $i++) {
        //     $totalPeminjaman = Peminjaman::whereYear('created_at', $tahun)
        //         ->whereMonth('created_at', $i)
        //         ->get()
        //         ->count();

        //     $bulan[] = Carbon::create()->month($i)->format('F');
        //     $total[] = $totalPeminjaman;
        // }

        // return view('dashboard', compact('member', 'books', 'kategoriBuku', 'jumlahLakiLaki', 'jumlahPerempuan', 'bulan', 'total'));
        return view('dashboard', compact('member', 'books', 'kategoriBuku'));
    }
}
