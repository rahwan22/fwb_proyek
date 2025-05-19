@extends('layouts.app')

@section('title', 'Tambah Nilai')

@section('content')
<style>
    label {
        color: white;
    }
</style>
<div class="container">
    <h1 class="mb-4">Tambah Nilai Siswa</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.nilai.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="siswa_id" class="form-label">Siswa</label>
            <select name="siswa_id" class="form-control" required>
                <option value="">-- Pilih Siswa --</option>
                @foreach($siswas as $siswa)
                    <option value="{{ $siswa->id }}">{{ $siswa->nama_siswa }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="kelas_id" class="form-label">Kelas</label>
            <select name="kelas_id" class="form-control" required>
                <option value="">-- Pilih Kelas --</option>
                @foreach($kelas as $k)
                    <option value="{{ $k->id }}">{{ $k->nama_kelas }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="mata_pelajaran_id" class="form-label">Mata Pelajaran</label>
            <select name="mata_pelajaran_id" class="form-control" required>
                <option value="">-- Pilih Mapel --</option>
                @foreach($mapels as $m)
                    <option value="{{ $m->id }}">{{ $m->nama_mapel }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="guru_id" class="form-label">Guru</label>
            <select name="guru_id" class="form-control" required>
                <option value="">-- Pilih Guru --</option>
                @foreach($guru as $g)
                    <option value="{{ $g->id }}">{{ $g->nama_guru }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="nilai" class="form-label">Nilai</label>
            <input type="number" name="nilai" class="form-control" min="0" max="100" required>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('admin.nilai.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
