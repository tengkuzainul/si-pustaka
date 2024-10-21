<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $members = Member::latest()->get();

        $title = 'Delete Member!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);

        return view('admin.member.index', compact('members'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.member.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_member' => 'required|min:3|max:100',
            'email' => 'required|email|unique:members,email',
            'no_hp' => 'required|unique:members,no_hp',
            'gender' => 'required|in:L,P',
            'alamat' => 'required|string|min:1|max:120',
        ]);

        Member::create([
            'nama_member' => $request->input('nama_member'),
            'email' => $request->input('email'),
            'no_hp' => $request->input('no_hp'),
            'gender' => $request->input('gender'),
            'alamat' => $request->input('alamat'),
        ]);

        return redirect()->route('member')
            ->with('success', 'The Member data has been successfully added.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Member::with('lends')->findOrFail($id);

        return view('admin.member.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $member = Member::findOrFail($id);

        return view('admin.member.edit', compact('member'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $member = Member::findOrFail($id);

        $request->validate([
            'nama_member' => 'sometimes|min:3|max:100',
            'email' => 'sometimes|email|unique:members,email,' . $member->id,
            'no_hp' => 'sometimes|unique:members,no_hp,' . $member->id,
            'gender' => 'sometimes|in:L,P',
            'alamat' => 'sometimes|string|min:1|max:120',
        ]);

        $member->update([
            'nama_member' => $request->input('nama_member') ?? $member->nama_member,
            'email' => $request->input('email') ?? $member->email,
            'no_hp' => $request->input('no_hp') ?? $member->no_hp,
            'gender' => $request->input('gender') ?? $member->gender,
            'alamat' => $request->input('alamat') ?? $member->alamat,
        ]);

        return redirect()->route('member')
            ->with('success', 'The Member data has been successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Member::findOrFail($id)
            ->delete();

        return redirect()->back()
            ->with('success', 'The Member data has been successfully deleted.');
    }
}
