<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;

class ProfileController extends Controller
{
    public function edit(): View
    {
        return view('profile.edit', [
            'user' => Auth::user(),
        ]);
    }

    public function updateProfile(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users,username,' . Auth::id()],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . Auth::id()],
        ]);

        $user = Auth::user();
        $user->update($request->only('name', 'username', 'email'));

        return Redirect::route('profile.edit')->with('success', 'Profile updated successfully');
    }

    public function updateProfileImage(Request $request): RedirectResponse
    {
        $request->validate([
            'image_profile' => ['required', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ]);

        $user = Auth::user();

        if ($request->hasFile('image_profile')) {
            if ($user->image_profile) {
                Storage::disk('public')->delete($user->image_profile);
            }
            $imageName = time() . '_profile_image_' . $request->name . '.' . $request->file('image_profile')->getClientOriginalExtension();
            $avatarPath = Storage::disk('public')->putFileAs('image-profile', $request->file('image_profile'), $imageName);
            $user->update(['image_profile' => $avatarPath]);
        }

        return Redirect::route('profile.edit')->with('success', 'Profile image updated successfully');
    }

    public function resetPassword(Request $request): RedirectResponse
    {
        $request->validate([
            'new_password' => ['required', 'string', 'min:8'],
            'confirmation_password' => ['required', 'same:new_password']
        ]);

        $user = Auth::user();
        $user->update([
            'password' => Hash::make($request->new_password),
        ]);

        return Redirect::route('profile.edit')->with('success', 'Password reset successfully');
    }
}
