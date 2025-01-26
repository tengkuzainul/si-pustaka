<?php

namespace App\Http\Controllers;

use App\Models\SiswaData;
use App\Models\User;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $siswas = User::with('siswaData')->where('role', 'Siswa')->get();

        $title = 'Delete Siswa!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);

        return view('admin.siswa.index', compact('siswas'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.siswa.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|max:100',
            'email' => 'required|email|unique:users,email',
            'username' => 'required|unique:users,username|integer',
            'kelas' => 'required|string|max:50',
            'gender' => 'required|in:L,P',
            'password' => 'required|min:8',
        ]);

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'username' => $request->input('username'),
            'password' => bcrypt($request->input('password')),
            'role' => 'Siswa',
        ]);

        SiswaData::create([
            'class' => $request->input('kelas'),
            'gender' => $request->input('gender'),
            'user_id' => $user->id,
        ]);

        return redirect()->route('siswa')
            ->with('success', 'The Member data has been successfully added.');
    }


    // /**
    //  * Show the form for editing the specified resource.
    //  */
    public function edit(string $id)
    {
        $siswa = User::with('siswaData')->findOrFail($id);

        return view('admin.siswa.edit', compact('siswa'));
    }

    // /**
    //  * Update the specified resource in storage.
    //  */
    public function update(Request $request, string $id)
    {
        $siswa = User::with('siswaData')->findOrFail($id);

        $request->validate([
            'name' => 'sometimes|min:3|max:100',
            'email' => 'sometimes|email|unique:users,email,' . $siswa->id,
            'username' => 'sometimes|integer|unique:users,username,' . $siswa->id,
            'class' => 'sometimes|string|max:50',
            'gender' => 'sometimes|in:L,P',
            'password' => 'sometimes|nullable|min:8',
        ]);

        $siswa->update([
            'name' => $request->input('name', $siswa->name),
            'email' => $request->input('email', $siswa->email),
            'username' => $request->input('username', $siswa->username),
            'password' => $request->filled('password') ? bcrypt($request->input('password')) : $siswa->password,
        ]);

        if ($request->filled(['class', 'gender'])) {
            $siswa->siswaData->update([
                'class' => $request->input('class', $siswa->siswaData->class),
                'gender' => $request->input('gender', $siswa->siswaData->gender),
            ]);
        }

        return redirect()->route('siswa')->with('success', 'Data siswa berhasil diperbarui.');
    }


    // /**
    //  * Remove the specified resource from storage.
    //  */
    public function destroy(string $id)
    {
        User::with('siswaData')->findOrFail($id)
            ->delete();

        return redirect()->back()
            ->with('success', 'The Member data has been successfully deleted.');
    }
}
