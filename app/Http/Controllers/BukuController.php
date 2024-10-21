<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\KategoriBuku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Mews\Purifier\Facades\Purifier as Prifier;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Buku::with('kategoriBuku')->get();

        $title = 'Delete Buku!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);

        return view('admin.book.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategori = KategoriBuku::all();

        return view('admin.book.create', compact('kategori'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'isbn' => 'required|min:5|max:30',
            'gambar_buku' => 'required|image|mimes:png,jpg,jpeg,webp|max:2080',
            'nama_buku' => 'required|string|min:5|max:150',
            'penerbit' => 'required|string',
            'tahun_terbit' => 'required|date_format:Y-m-d',
            'stok_buku' => 'required|integer|min:1',
            'kategori_buku_id' => 'required|exists:kategori_buku,id',
            'sinopsis' => 'required|string',
        ]);

        $data = [
            'isbn' => $request->isbn,
            'nama_buku' => $request->nama_buku,
            'penerbit' => $request->penerbit,
            'tahun_terbit' => $request->tahun_terbit,
            'stok_buku' => $request->stok_buku,
            'kategori_buku_id' => $request->kategori_buku_id,
            'sinopsis' => $request->sinopsis,
        ];

        if ($request->hasFile('gambar_buku')) {
            $imageName = time() . '_gambar_buku_' . $request->isbn . '.' . $request->file('gambar_buku')->getClientOriginalExtension();

            $imagePath = $request->file('gambar_buku')->storeAs('gambar/buku', $imageName, 'public');

            $data['gambar_buku'] = $imagePath;
        }

        $book = new Buku();
        $book->fill($data);
        $book->save();

        return redirect()->route('buku')
            ->with('success', 'The book data has been successfully added.');
    }



    /**
     * Display the specified resource.
     */
    public function show(Buku $buku)
    {
        $sinopsis = Prifier::clean($buku->sinopsis);

        return view('admin.book.show', compact('buku', 'sinopsis'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Buku $buku)
    {
        $kategori = KategoriBuku::all();

        return view('admin.book.edit', compact('buku', 'kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Buku $buku)
    {
        $request->validate([
            'isbn' => 'sometimes|min:5|max:30',
            'gambar_buku' => 'sometimes|image|mimes:png,jpg,jpeg,webp|max:2080',
            'nama_buku' => 'sometimes|string|min:5|max:150',
            'penerbit' => 'sometimes|string',
            'tahun_terbit' => 'sometimes|date_format:Y-m-d',
            'stok_buku' => 'sometimes|integer|min:1',
            'kategori_buku_id' => 'sometimes|exists:kategori_buku,id',
            'sinopsis' => 'sometimes|string',
        ]);

        $data = $request->only([
            'isbn',
            'nama_buku',
            'penerbit',
            'tahun_terbit',
            'stok_buku',
            'kategori_buku_id',
            'sinopsis'
        ]);

        if ($request->hasFile('gambar_buku')) {
            if ($buku->gambar_buku) {
                Storage::disk('public')->delete($buku->gambar_buku);
            }

            $imageName = time() . '_gambar_buku_' . $request->isbn . '.' . $request->file('gambar_buku')->getClientOriginalExtension();
            $imagePath = $request->file('gambar_buku')->storeAs('gambar/buku', $imageName, 'public');

            $data['gambar_buku'] = $imagePath;
        }

        $buku->update($data);

        if ($request->has('updateRedirectBack')) {
            return redirect()->back()->with('success', 'Image books updated successfully!');
        }

        return redirect()->route('buku')
            ->with('success', 'Data updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Buku $buku)
    {
        if ($buku->gambar_buku) {
            Storage::disk('public')->delete($buku->gambar_buku);
        }

        $buku->delete();

        return redirect()->route('buku')
            ->with('success', 'The book data has been successfully deleted.');
    }
}
