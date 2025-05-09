@extends('layouts.app')

@section('title', 'Data Kelas')

@section('content')
<div class="container">
    <h1 class="mb-4">Data Kelas</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('admin.kelas.create') }}" class="btn btn-primary mb-3">+ Tambah Kelas</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama Kelas</th>
                <th>Jurusan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($kelas as $k)
            <tr>
                <td>{{ $k->nama_kelas }}</td>
                <td>{{ $k->jurusan ?? '-' }}</td>
                <td>
                    <a href="{{ route('admin.kelas.edit', $k->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('admin.kelas.destroy', $k->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus kelas ini?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary mt-3">← Kembali ke Dashboard</a>
</div>
@endsection
