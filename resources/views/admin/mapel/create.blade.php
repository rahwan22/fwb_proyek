@extends('layouts.app')

@section('title', 'Tambah Mata Pelajaran')

@section('content')
<style>
    label {
        color: white;
    }
</style>
<div class="container">
    <h1>Tambah Mata Pelajaran</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.mapel.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="nama_mapel">Nama Mata Pelajaran</label>
            <input type="text" name="nama_mapel" class="form-control" value="{{ old('nama_mapel') }}" required>
        </div>

        <div class="mb-3">
            <label for="guru_id">Guru Pengajar</label>
            <select name="guru_id" class="form-control" required>
                <option value="">-- Pilih Guru --</option>
                @foreach($gurus as $guru)
                    <option value="{{ $guru->id }}">{{ $guru->nama_guru }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('admin.mapel.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
