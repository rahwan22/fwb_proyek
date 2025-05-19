@extends('layouts.app')

@section('title', 'Data Nilai')

@section('content')
<div class="container">
    <h1 class="mb-4">Nilai Siswa</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Tombol tambah nilai hanya untuk admin dan guru -->
    @if(auth()->user()->role == 'admin' || auth()->user()->role == 'guru')
        <a href="{{ route('admin.nilai.create') }}" class="btn btn-primary mb-3">+ Tambah Nilai</a>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama Siswa</th>
                <th>Kelas</th>
                <th>Mata Pelajaran</th>
                <th>Guru</th>
                <th>Nilai</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($nilai as $item)
                <tr>
                    <td>{{ $item->siswa->nama_siswa }}</td>
                    <td>{{ $item->kelas->nama_kelas }}</td>
                    <td>{{ $item->mataPelajaran->nama_mapel }}</td>
                    <td>{{ $item->guru->nama_guru }}</td>
                    <td>{{ $item->nilai }}</td>
                    <td>
                        <!-- Edit dan Hapus hanya untuk admin dan guru -->
                        @if(auth()->user()->role == 'admin' || auth()->user()->role == 'guru')
                            <a href="{{ route('admin.nilai.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('admin.nilai.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus nilai ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        @else
                            <!-- Untuk siswa, tampilkan status lulus/tidak lulus -->
                            @if($item->nilai >= 50)
                                <span class="text-success">Lulus</span>
                            @else
                                <span class="text-danger">Tidak Lulus</span>
                            @endif
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @if(auth()->user()->role == 'siswas')
    <a href="{{ route('siswa.dashboard') }}" class="btn btn-secondary mt-3">← Kembali</a>
    @endif

    @if(auth()->user()->role == 'admin')
    <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary mt-3">← Kembali</a>

    @elseif(auth()->user()->role == 'guru')
        <a href="{{ route('guru.dashboard') }}" class="btn btn-secondary mt-3">← Kembali</a>
    @endif
</div>
@endsection
