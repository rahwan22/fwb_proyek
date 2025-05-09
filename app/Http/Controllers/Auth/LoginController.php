<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

            return $this->redirectToDashboard(Auth::user()->role);
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
