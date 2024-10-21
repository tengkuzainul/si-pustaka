<?php

namespace App\Http\Controllers;

use App\Models\Denda;
use Illuminate\Http\Request;

class DendaController extends Controller
{
    public function index()
    {
        $denda = Denda::find(1) ?? null;

        return view('admin.denda.setting', compact('denda'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'jumlah_denda' => 'sometimes|numeric|integer',
        ]);

        Denda::updateOrCreate(
            ['id' => 1],
            ['jumlah_denda' => $request->jumlah_denda]
        );

        return redirect()->back()->with('success', 'Charge updated successfully');
    }
}
