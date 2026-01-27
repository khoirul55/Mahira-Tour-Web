<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;

class AdminProfileController extends Controller
{
    /**
     * Display the admin profile page.
     */
    public function index()
    {
        return view('admin.profile.index', [
            'user' => Auth::guard('admin')->user()
        ]);
    }

    /**
     * Update the admin profile information.
     */
    public function update(Request $request)
    {
        $user = Auth::guard('admin')->user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:admins,email,' . $user->id],
            'avatar' => ['nullable', 'image', 'max:2048'], // Max 2MB
        ]);

        if ($request->hasFile('avatar')) {
            // Delete old avatar if exists
            if ($user->avatar) {
                Storage::delete($user->avatar);
            }

            // Store new avatar in public/avatars folder
            $path = $request->file('avatar')->store('public/avatars');
            $validated['avatar'] = $path;
        }

        $user->update($validated);

        return back()->with('success', 'Profil berhasil diperbarui.');
    }

    /**
     * Update the admin password.
     */
    public function updatePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => ['required', 'current_password:admin'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        Auth::guard('admin')->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        return back()->with('success', 'Password berhasil diperbarui.');
    }
}
