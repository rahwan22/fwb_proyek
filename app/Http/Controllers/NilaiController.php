<?php

namespace App\Http\Controllers;

use App\Models\Nilai;
use App\Models\Siswa;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\MataPelajaran;
use Illuminate\Http\Request;

class NilaiController extends Controller
{
    public function index()
    {
        $nilai = Nilai::with(['siswa', 'kelas', 'mataPelajaran', 'guru'])->get();
        return view('admin.nilai.index', compact('nilai'));
    }

    public function create()
    {
        // 🔒 Cek akses
        if (!in_array(auth()->user()->role, ['admin', 'guru'])) {
            abort(403, 'Akses ditolak.');
        }

        $siswas = Siswa::all();
        $kelas = Kelas::all();
        $mapels = MataPelajaran::all();
        $guru = Guru::all();

        return view('admin.nilai.create', compact('siswas', 'kelas', 'mapels', 'guru'));
    }

    public function store(Request $request)
    {
        // 🔒 Cek akses
        if (!in_array(auth()->user()->role, ['admin', 'guru'])) {
            abort(403, 'Akses ditolak.');
        }

        $request->validate([
            'siswa_id' => 'required|exists:siswas,id',
            'kelas_id' => 'required|exists:kelas,id',
            'mata_pelajaran_id' => 'required|exists:mata_pelajarans,id',
            'guru_id' => 'required|exists:guru,id',
            'nilai' => 'required|numeric|min:0|max:100',
        ]);

        Nilai::create([
            'siswa_id' => $request->siswa_id,
            'kelas_id' => $request->kelas_id,
            'mata_pelajaran_id' => $request->mata_pelajaran_id,
            'guru_id' => $request->guru_id,
            'nilai' => $request->nilai,
        ]);

        return redirect()->route('admin.nilai.index')->with('success', 'Nilai berhasil ditambahkan.');
    }

    public function edit($id)
    {
        // 🔒 Cek akses
        if (!in_array(auth()->user()->role, ['admin', 'guru'])) {
            abort(403, 'Akses ditolak.');
        }

        $nilai = Nilai::findOrFail($id);
        $siswas = Siswa::all();
        $kelas = Kelas::all();
        $mapels = MataPelajaran::all();
        $guru = Guru::all();

        return view('admin.nilai.edit', compact('nilai', 'siswas', 'kelas', 'mapels', 'guru'));
    }

    public function update(Request $request, $id)
    {
        // 🔒 Cek akses
        if (!in_array(auth()->user()->role, ['admin', 'guru'])) {
            abort(403, 'Akses ditolak.');
        }

        $request->validate([
            'siswa_id' => 'required|exists:siswas,id',
            'kelas_id' => 'required|exists:kelas,id',
            'mata_pelajaran_id' => 'required|exists:mata_pelajarans,id',
            'guru_id' => 'required|exists:guru,id',
            'nilai' => 'required|numeric|min:0|max:100',
        ]);

        $nilai = Nilai::findOrFail($id);
        $nilai->update([
            'siswa_id' => $request->siswa_id,
            'kelas_id' => $request->kelas_id,
            'mata_pelajaran_id' => $request->mata_pelajaran_id,
            'guru_id' => $request->guru_id,
            'nilai' => $request->nilai,
        ]);

        return redirect()->route('admin.nilai.index')->with('success', 'Nilai berhasil diperbarui.');
    }

    public function destroy($id)
    {
        // 🔒 Cek akses
        if (!in_array(auth()->user()->role, ['admin', 'guru'])) {
            abort(403, 'Akses ditolak.');
        }

        $nilai = Nilai::findOrFail($id);
        $nilai->delete();

        return redirect()->route('admin.nilai.index')->with('success', 'Nilai berhasil dihapus.');
    }
}
