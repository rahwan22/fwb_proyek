@extends('layouts.app')

@section('title', 'Data Guru')

@section('content')
<div class="container">
    <h1>Data Guru</h1>
    <a href="{{ route('admin.guru.create') }}" class="btn btn-primary mb-3">Tambah Guru</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>NIP</th>
                <th>Alamat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($gurus as $guru)
            <tr>
                <td>{{ $guru->nama_guru }}</td>
                <td>{{ $guru->user->email }}</td>
                <td>{{ $guru->nip }}</td>
                <td>{{ $guru->alamat }}</td>
                <td>
                    <a href="{{ route('admin.guru.edit', $guru->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('admin.guru.destroy', $guru->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Yakin mau hapus?')" class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary mt-3">← Kembali</a>
</div>
@endsection
