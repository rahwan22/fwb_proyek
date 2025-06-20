<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\User;
use App\Models\kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB; // Import Facade DB

class SiswaController extends Controller
{

    public function index()
    {
        $siswas = Siswa::with('user')->get();
        return view('admin.siswa.index', compact('siswas'));
    }

    public function create()
    {
        $kelas = Kelas::all();
        return view('admin.siswa.create', compact('kelas'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_siswa' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'nisn' => 'required|unique:siswas,nisn',
            'kelas_id' => 'required|exists:kelas,id',
            'alamat' => 'required',
        ]);

        // Mulai transaksi database
        DB::beginTransaction();

        try {
            // Buat user baru
            $user = User::create([
                'name' => $request->nama_siswa,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'role' => 'siswas'
            ]);

            // Buat siswa baru dan kaitkan dengan user
            Siswa::create([
                'user_id' => $user->id,
                'nama_siswa' => $request->nama_siswa,
                'nisn' => $request->nisn,
                'kelas_id' => $request->kelas_id,
                'alamat' => $request->alamat
            ]);

            // Commit transaksi jika semua operasi berhasil
            DB::commit();

            return redirect()->route('admin.siswa.index')->with('success', 'Data siswa berhasil ditambahkan!');

        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi error
            DB::rollBack();
            // Anda bisa log error-nya atau menampilkan pesan yang lebih spesifik
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menambahkan data siswa. ' . $e->getMessage())->withInput();
        }
    }

    public function edit($id)
    {
        $siswa = Siswa::with('user')->findOrFail($id);
        $kelas = Kelas::all(); // Tambahkan ini jika Anda membutuhkan daftar kelas di halaman edit
        return view('admin.siswa.edit', compact('siswa', 'kelas'));
    }

    public function update(Request $request, $id)
    {
        $siswa = Siswa::with('user')->findOrFail($id);

        // Validasi input
        $request->validate([
            'nama_siswa' => 'required',
            'email' => 'required|email|unique:users,email,' . $siswa->user->id,
            // 'password' => 'nullable|min:6', // opsional jika ingin user bisa update password
            'nisn' => 'required|unique:siswas,nisn,' . $siswa->id,
            'kelas_id' => 'required|exists:kelas,id', // Ganti integer menjadi exists
            'alamat' => 'nullable'
        ]);

        // Mulai transaksi database
        DB::beginTransaction();

        try {
            // Update data user
            $siswa->user->update([
                'name' => $request->nama_siswa,
                'email' => $request->email,
                // 'password' => $request->filled('password') ? bcrypt($request->password) : $siswa->user->password, // Update password jika diisi
            ]);

            // Update data siswa
            $siswa->update([
                'nama_siswa' => $request->nama_siswa,
                'nisn' => $request->nisn,
                'kelas_id' => $request->kelas_id,
                'alamat' => $request->alamat
            ]);

            // Commit transaksi jika semua operasi berhasil
            DB::commit();

            return redirect()->route('admin.siswa.index')->with('success', 'Data siswa berhasil diperbarui.');

        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi error
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui data siswa. ' . $e->getMessage())->withInput();
        }
    }

    public function destroy($id)
    {
        // Mulai transaksi database
        DB::beginTransaction();

        try {
            $siswa = Siswa::findOrFail($id);
            // Hapus user terkait (jika relasinya CASCADE ON DELETE di database, ini akan otomatis menghapus siswa)
            // Jika tidak, pastikan untuk menghapus siswa terlebih dahulu atau atur onDelete('cascade') di migrasi
            $siswa->user->delete();
            $siswa->delete(); // Pastikan siswa juga terhapus jika tidak CASCADE

            // Commit transaksi jika semua operasi berhasil
            DB::commit();

            return redirect()->route('admin.siswa.index')->with('success', 'Data siswa berhasil dihapus.');

        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi error
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus data siswa. ' . $e->getMessage());
        }
    }
}