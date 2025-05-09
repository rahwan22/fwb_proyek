<?php

namespace App\Http\Controllers;

use App\Models\MataPelajaran;
use App\Models\Guru;
use Illuminate\Http\Request;

class MapelController extends Controller
{
    public function index()
    {
        $mapels = MataPelajaran::with('guru')->get();
        return view('admin.mapel.index', compact('mapels'));
    }
    

    public function create()
    {
        $gurus = Guru::all();
        return view('admin.mapel.create', compact('gurus'));
    }
    

    public function store(Request $request)
    {
        $request->validate([
            'nama_mapel' => 'required|string|max:255',
            'guru_id' => 'required|exists:guru,id',
        ]);

        MataPelajaran::create($request->all());

        return redirect()->route('admin.mapel.index')->with('success', 'Mata Pelajaran berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $mapel = MataPelajaran::findOrFail($id);
        $gurus = Guru::all();
        return view('admin.mapel.edit', compact('mapel', 'gurus'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_mapel' => 'required|string|max:255',
            'guru_id' => 'required|exists:guru,id',
        ]);

        $mapel = MataPelajaran::findOrFail($id);
        $mapel->update($request->all());

        return redirect()->route('admin.mapel.index')->with('success', 'Mata Pelajaran berhasil diupdate.');
    }

    public function destroy($id)
    {
        MataPelajaran::findOrFail($id)->delete();
        return redirect()->route('admin.mapel.index')->with('success', 'Mata Pelajaran berhasil dihapus.');
    }
}
