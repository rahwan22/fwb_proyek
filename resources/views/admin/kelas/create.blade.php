@extends('layouts.app')

@section('title', 'Tambah Kelas')

@section('content')
<style>
    label {
        color: white;
    }
</style>
<div class="container">
    <h1 class="mb-4">Tambah Kelas</h1>

    <form action="{{ route('admin.kelas.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="nama_kelas" class="form-label">Nama Kelas</label>
            <input type="text" class="form-control" id="nama_kelas" name="nama_kelas" required>
        </div>

        <div class="mb-3">
            <label for="jurusan" class="form-label">Jurusan</label>
            <input type="text" class="form-control" id="jurusan" name="jurusan">
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('admin.kelas.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
