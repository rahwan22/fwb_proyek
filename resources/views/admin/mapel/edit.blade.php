@extends('layouts.app')

@section('title', 'Edit Mata Pelajaran')

@section('content')
<style>
    label {
        color: white;
    }
</style>
<div class="container">
    <h1>Edit Mata Pelajaran</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.mapel.update', $mapel->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nama_mapel">Nama Mata Pelajaran</label>
            <input type="text" name="nama_mapel" class="form-control" value="{{ old('nama_mapel', $mapel->nama_mapel) }}" required>
        </div>

        <div class="mb-3">
            <label for="guru_id">Guru Pengajar</label>
            <select name="guru_id" class="form-control" required>
                <option value="">-- Pilih Guru --</option>
                @foreach($gurus as $guru)
                    <option value="{{ $guru->id }}" {{ $mapel->guru_id == $guru->id ? 'selected' : '' }}>
                        {{ $guru->nama_guru }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('admin.mapel.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
