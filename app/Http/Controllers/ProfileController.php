<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function edit()
{
    $user = auth()->user();
    return view($user->role . '.profile', compact('user'));
}

public function update(Request $request)
{
    $user = auth()->user();

    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
    ]);

    $user->update($request->only('name', 'email'));

    return redirect()->back()->with('success', 'Profil berhasil diperbarui.');
}

public function changePassword(Request $request)
{
    $user = auth()->user();

    $request->validate([
        'current_password' => 'required',
        'password' => 'required|string|min:6|confirmed',
    ]);

    if (!Hash::check($request->current_password, $user->password)) {
        return back()->withErrors(['current_password' => 'Password lama salah.']);
    }

    $user->password = Hash::make($request->password);
    $user->save();

    return back()->with('success', 'Password berhasil diubah.');
}

}
