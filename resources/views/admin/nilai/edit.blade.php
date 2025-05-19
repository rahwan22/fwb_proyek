@extends('layouts.app')

@section('title', 'Edit Nilai')

@section('content')
<style>
    label {
        color: white;
    }
</style>
<div class="container">
    <h1>Edit Nilai</h1>

    <form action="{{ route('admin.nilai.update', $nilai->id) }}" method="POST">
        @csrf @method('PUT')

        <div class="mb-3">
            <label for="siswa_id">Siswa</label>
            <select name="siswa_id" class="form-control" required>
                @foreach($siswas as $siswa)
                    <option value="{{ $siswa->id }}" {{ $nilai->siswa_id == $siswa->id ? 'selected' : '' }}>
                        {{ $siswa->nama_siswa }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="kelas_id">Kelas</label>
            <select name="kelas_id" class="form-control" required>
                @foreach($kelas as $k)
                    <option value="{{ $k->id }}" {{ $nilai->kelas_id == $k->id ? 'selected' : '' }}>
                        {{ $k->nama_kelas }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="mata_pelajaran_id">Mata Pelajaran</label>
            <select name="mata_pelajaran_id" class="form-control" required>
                @foreach($mapels as $m)
                    <option value="{{ $m->id }}" {{ $nilai->mata_pelajaran_id == $m->id ? 'selected' : '' }}>
                        {{ $m->nama_mapel }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="guru_id">Guru Pengampu</label>
            <select name="guru_id" class="form-control" required>
                @foreach($guru as $g)
                    <option value="{{ $g->id }}" {{ $nilai->guru_id == $g->id ? 'selected' : '' }}>
                        {{ $g->nama_guru }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="nilai">Nilai</label>
            <input type="number" name="nilai" class="form-control" min="0" max="100" value="{{ $nilai->nilai }}" required>
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('admin.nilai.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
