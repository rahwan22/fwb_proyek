<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\User;
use App\Models\kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SiswaController extends Controller
{

        public function index()
    {
        // $siswas = auth()->user()->siswas;

        $siswas = Siswa::with('user')->get(); // Ambil data siswa beserta relasi user-nya
        return view('admin.siswa.index', compact('siswas')); // Kirim ke view
    }

    
        public function create()
    {
        $kelas = Kelas::all(); // panggil semua kelas
        return view('admin.siswa.create', compact('kelas'));
    }


        public function store(Request $request)
    {
    $request->validate([
        'nama_siswa' => 'required',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6',
        'nisn' => 'required|unique:siswas,nisn',
        'kelas_id' => 'required|exists:kelas,id',
        'alamat' => 'required',
    ]);

    $user = User::create([
        'name' => $request->nama_siswa,
        'email' => $request->email,
        'password' => bcrypt($request->password),
        'role' => 'siswas'
    ]);

    Siswa::create([
        'user_id' => $user->id,
        'nama_siswa' => $request->nama_siswa,
        'nisn' => $request->nisn,
        'kelas_id' => $request->kelas_id,
        'alamat' => $request->alamat
    ]);

    return redirect()->route('admin.siswa.index')->with('success', 'Data siswa berhasil ditambahkan!');
}

    public function edit($id)
    {
        $siswa = Siswa::with('user')->findOrFail($id);
        return view('admin.siswa.edit', compact('siswa'));
    }

    public function update(Request $request, $id)
    {
        $siswa = Siswa::with('user')->findOrFail($id);

        $request->validate([
            'nama_siswa' => 'required',
            'email' => 'required|email|unique:users,email,' . $siswa->user->id,
            'nisn' => 'required|unique:siswas,nisn,' . $siswa->id,
            'kelas_id' => 'required|integer',
            'alamat' => 'nullable'
        ]);

        $siswa->user->update([
            'name' => $request->nama_siswa,
            'email' => $request->email
        ]);

        $siswa->update([
            'nama_siswa' => $request->nama_siswa,
            'nisn' => $request->nisn,
            'kelas_id' => $request->kelas_id,
            'alamat' => $request->alamat
        ]);

        return redirect()->route('admin.siswa.index')->with('success', 'Data siswa berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $siswa = Siswa::findOrFail($id);
        $siswa->user()->delete();
        $siswa->delete();

        return redirect()->route('admin.siswa.index')->with('success', 'Data siswa berhasil dihapus.');
    }
}
