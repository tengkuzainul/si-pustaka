<?php

namespace App\Http\Controllers;

use App\Models\KategoriBuku;
use Illuminate\Http\Request;

class KategoriBukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bookCategories = KategoriBuku::all();

        $title = 'Delete Kategori Buku!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);

        return view('admin.kategori.index', compact('bookCategories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|min:1|max:50|string',
        ]);

        KategoriBuku::create([
            'nama_kategori' => $request->input('nama_kategori'),
        ]);

        return redirect()->back()
            ->with('success', 'The book category data has been successfully added.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category = KategoriBuku::findOrFail($id);

        $request->validate([
            'nama_kategori' => 'sometimes|min:1|max:50|string',
        ]);

        $category->update([
            'nama_kategori' => $request->input('nama_kategori') ?? $category->nama_kategori,
        ]);


        return redirect()->back()
            ->with('success', 'The book category data has been successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        KategoriBuku::findOrFail($id)
            ->delete();

        return redirect()->back()
            ->with('success', 'The book category data has been successfully deleted.');
    }
}
