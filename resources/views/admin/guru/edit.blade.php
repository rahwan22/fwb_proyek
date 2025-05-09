@extends('layouts.app')

@section('title', 'Edit Guru')

@section('content')
<div class="container">
    <h1>Edit Guru</h1>

    <form action="{{ route('admin.guru.update', $guru->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nama Guru</label>
            <input type="text" name="nama_guru" class="form-control" value="{{ $guru->nama_guru }}" required>
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{ $guru->user->email }}" required>
        </div>

        <div class="mb-3">
            <label>NIP</label>
            <input type="text" name="nip" class="form-control" value="{{ $guru->nip }}" required>
        </div>

        <div class="mb-3">
            <label>Alamat</label>
            <textarea name="alamat" class="form-control" required>{{ $guru->alamat }}</textarea>
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('admin.guru.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
