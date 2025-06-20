@extends('layouts.app')
@section('title', 'Data Siswa')

@section('content')
<div class="container">
    <h1>Data Siswa</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('admin.siswa.create') }}" class="btn btn-primary mb-3">+ Tambah Siswa</a>

    <table class="table">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>NISN</th>
                <th>Nama Kelas</th>
                <th>Alamat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($siswas as $siswa)
            <tr>
                <td>{{ $siswa->nama_siswa }}</td>
                <td>{{ $siswa->user->email }}</td>
                <td>{{ $siswa->nisn }}</td>
                <td>{{ $siswa->kelas->nama_kelas ?? '-' }}</td>
                <td>{{ $siswa->alamat }}</td>
                <td>
                    <a href="{{ route('admin.siswa.edit', $siswa->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('admin.siswa.destroy', $siswa->id) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary mt-3">← Kembali </a>
</div>
@endsection
