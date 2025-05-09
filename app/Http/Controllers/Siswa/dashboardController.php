<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class dashboardController extends Controller
{

    public function index()
    {
        $siswa = Auth::user()->siswa;

        if (!$siswa) {
            return redirect()->route('login')->with('error', 'Data siswa tidak ditemukan.');
        }

        return view('siswa.dashboard', compact('siswa'));
    }

}
