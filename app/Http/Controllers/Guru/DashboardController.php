<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $guru = Auth::user()->guru;

        if (!$guru) {
            return redirect()->route('login')->with('error', 'Data guru tidak ditemukan.');
        }

        $mataPelajaran = $guru->mataPelajaran; // pastikan relasi ini ada

        return view('guru.dashboard', compact('guru', 'mataPelajaran'));
    }
}
