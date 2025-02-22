<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\KategoriBuku;
use Illuminate\Http\Request;
use Mews\Purifier\Facades\Purifier as Prifier;


class LandingPageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $carouselsBooks = Buku::take(5)->get();

        $books = Buku::inRandomOrder()->get();

        $bookCategories = KategoriBuku::with(['buku' => function ($query) {
            $query->inRandomOrder()->take(8);
        }])->take(5)->get();

        return view('landing-page.home', compact('books', 'bookCategories', "carouselsBooks"));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function bookDetail(string $id)
    {
        $detail = Buku::with('kategoriBuku')->findOrFail($id);

        $sinopsis = Prifier::clean($detail->sinopsis);

        return view('landing-page.detail', compact('detail'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function catalog()
    {
        $books = Buku::with('kategoriBuku')->latest()->paginate(8);

        return view('landing-page.catalog', compact('books'));
    }
}
