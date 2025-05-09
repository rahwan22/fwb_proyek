@extends('layouts.app')

@section('title', 'Edit Kelas')

@section('content')
<div class="container">
    <h1 class="mb-4">Edit Kelas</h1>

    <form action="{{ route('admin.kelas.update', $kelas->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nama_kelas" class="form-label">Nama Kelas</label>
            <input type="text" class="form-control" id="nama_kelas" name="nama_kelas" value="{{ $kelas->nama_kelas }}" required>
        </div>

        <div class="mb-3">
            <label for="jurusan" class="form-label">Jurusan</label>
            <input type="text" class="form-control" id="jurusan" name="jurusan" value="{{ $kelas->jurusan }}">
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('admin.kelas.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
