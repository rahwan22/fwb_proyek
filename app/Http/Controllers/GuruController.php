<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class GuruController extends Controller
{
    public function index()
    {
        $gurus = Guru::with('user')->get();
        return view('admin.guru.index', compact('gurus'));
    }
    

    public function create()
    {
        return view('admin.guru.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_guru' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'nip' => 'required|string|max:20',
            'alamat' => 'required|string',
        ]);

        // Create User
        $user = User::create([
            'name' => $request->nama_guru,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'guru',
        ]);

        // Create Guru
        Guru::create([
            'user_id' => $user->id,
            'nama_guru' => $request->nama_guru,
            'nip' => $request->nip,
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('admin.guru.index')->with('success', 'Guru berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $guru = Guru::with('user')->findOrFail($id);
        return view('admin.guru.edit', compact('guru'));
    }

    public function update(Request $request, $id)
    {
        $guru = Guru::with('user')->findOrFail($id);

        $request->validate([
            'nama_guru' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $guru->user->id,
            'nip' => 'required|string|max:20',
            'alamat' => 'required|string',
        ]);

        // Update user
        $guru->user->update([
            'name' => $request->nama_guru,
            'email' => $request->email,
        ]);

        // Update guru
        $guru->update([
            'nama_guru' => $request->nama_guru,
            'nip' => $request->nip,
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('admin.guru.index')->with('success', 'Guru berhasil diupdate.');
    }

    public function destroy($id)
    {
        $guru = Guru::findOrFail($id);

        // Hapus user terkait
        $guru->user()->delete();
        $guru->delete();

        return redirect()->route('admin.guru.index')->with('success', 'Guru berhasil dihapus.');
    }
    
}
