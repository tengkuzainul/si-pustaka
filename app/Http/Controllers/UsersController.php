<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::all();

        $title = 'Delete User!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);

        return view('admin.users.index', compact('users'));
    }

    /**
     * Controller Add Users Admin
     */
    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:1|max:100',
            'email' => 'required|email|unique:users,email',
            'username' => 'required|unique:users,username',
            'password' => 'required|min:8|confirmed',
            'role' => 'required|in:Superadmin,Admin',
            'image_profile' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $avatarPath = null;

        if ($request->hasFile('image_profile')) {
            $imageName = time() . '_profile_image_' . $request->name . '.' . $request->file('image_profile')->getClientOriginalExtension();

            $avatarPath = Storage::disk('public')->putFileAs('image-profile', $request->file('image_profile'), $imageName);
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'username' => $request->username,
            'role' => $request->role,
            'image_profile' => $avatarPath,
        ]);

        return redirect()->route('users')->with('success', 'The user has been successfully added.');
    }

    /**
     * Controllers Add Member
     */

    /**
     * Functions Edit Users
     */
    public function edit($id)
    {
        $user = User::find($id);

        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'sometimes|string|min:1|max:100',
            'email' => 'sometimes|email|unique:users,email,' . $user->id,
            'username' => 'sometimes|unique:users,username,' . $user->id,
            'password' => 'nullable|min:8|confirmed',
            'role' => 'sometimes|in:Superadmin,Admin',
            'image_profile' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $avatarPath = $user->image_profile;

        if ($request->hasFile('image_profile')) {
            if ($user->image_profile) {
                Storage::disk('public')->delete($user->image_profile);
            }

            $imageName = time() . '_profile_image_' . $request->name . '.' . $request->file('image_profile')->getClientOriginalExtension();
            $avatarPath = Storage::disk('public')->putFileAs('image-profile', $request->file('image_profile'), $imageName);
        }

        $user->update([
            'name' => $request->name ?? $user->name,
            'email' => $request->email ?? $user->email,
            'username' => $request->username ?? $user->username,
            'password' => $request->filled('password') ? Hash::make($request->password) : $user->password,
            'role' => $request->role ?? $user->role,
            'image_profile' => $avatarPath,
        ]);

        return redirect()->route('users')->with('success', 'The user has been successfully updated.');
    }

    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        if ($user->image_profile) {
            Storage::disk('public')->delete($user->image_profile);
        }

        $user->delete();

        return redirect()->route('users')->with('success', 'The user data has been successfully deleted.');
    }
}
