@extends('layouts.app')
@section('title', 'Edit Siswa')

@section('content')
<div class="container">
    <h1>Edit Siswa</h1>

    <form action="{{ route('admin.siswa.update', $siswa->id) }}" method="POST">
        @csrf @method('PUT')
        <div class="mb-3">
            <label>Nama Siswa</label>
            <input type="text" name="nama_siswa" class="form-control" value="{{ $siswa->nama_siswa }}" required>
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{ $siswa->user->email }}" required>
        </div>
        <div class="mb-3">
            <label>NISN</label>
            <input type="text" name="nisn" class="form-control" value="{{ $siswa->nisn }}" required>
        </div>
        <div class="mb-3">
            <label>Kelas ID</label>
            <input type="text" name="kelas_id" class="form-control" value="{{ $siswa->kelas_id }}" required>
        </div>
        <div class="mb-3">
            <label>Alamat</label>
            <textarea name="alamat" class="form-control">{{ $siswa->alamat }}</textarea>
        </div>
        <button class="btn btn-success">Update</button>
    </form>
</div>
@endsection
