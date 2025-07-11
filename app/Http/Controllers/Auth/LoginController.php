<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Guru; // Pastikan model ini ada

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            // Tambahan validasi untuk guru
            if ($user->role === 'guru') {
                $guruExists = Guru::where('user_id', $user->id)->exists();

                if (! $guruExists) {
                    Auth::logout();
                    return back()->with('error', 'Akun guru tidak ditemukan di data guru.');
                }
            }

            return $this->redirectToDashboard($user->role);
        }

        return back()->with('error', 'Email atau password salah!');
    }

    protected function redirectToDashboard($role)
    {
        return match ($role) {
            'admin' => redirect()->route('admin.dashboard'),
            'guru' => redirect()->route('guru.dashboard'),
            'siswas' => redirect()->route('siswa.dashboard'),
            default => redirect('/'),
        };
    }

    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/login');
    }
}
