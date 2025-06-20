@extends('layouts.app')

@section('title', 'Data Mata Pelajaran')

@section('content')
<div class="container">
    <h1>Data Mata Pelajaran</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('admin.mapel.create') }}" class="btn btn-primary mb-3">+ Tambah Mata Pelajaran</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama Mapel</th>
                <th>Guru Pengajar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($mapels as $mapel)
            <tr>
                <td>{{ $mapel->nama_mapel }}</td>
                <td>{{ $mapel->guru->nama_guru ?? '-' }}</td>
                <td>
                    <a href="{{ route('admin.mapel.edit', $mapel->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('admin.mapel.destroy', $mapel->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="3" class="text-center">Belum ada data mata pelajaran.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary mt-3">← Kembali </a>
</div>
@endsection
