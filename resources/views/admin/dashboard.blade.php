@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<div class="container">
    <div class="d-flex justify-content-center">
        <h1 class="mb-4">Dashboard Admin</h1>
    </div>

    <div class="row">
        <div class="col-md-4 mb-4">
            <a href="{{ route('admin.siswa.index') }}" class="text-decoration-none">
                <div class="card shadow-sm h-100">
                    <div class="card-body text-center">
                        <h5 class="card-title">Kelola Siswa</h5>
                        <p class="card-text text-muted">Tambah, edit, dan hapus data siswa.</p>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-4 mb-4">
            <a href="{{ route('admin.guru.index') }}" class="text-decoration-none">
                <div class="card shadow-sm h-100">
                    <div class="card-body text-center">
                        <h5 class="card-title">Kelola Guru</h5>
                        <p class="card-text text-muted">Kelola data guru pengajar.</p>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-4 mb-4">
            <a href="{{ route('admin.mapel.index') }}" class="text-decoration-none">
                <div class="card shadow-sm h-100">
                    <div class="card-body text-center">
                        <h5 class="card-title">Kelola Mapel</h5>
                        <p class="card-text text-muted">Manajemen mata pelajaran.</p>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-4 mb-4">
            <a href="{{ route('admin.kelas.index') }}" class="text-decoration-none">
                <div class="card shadow-sm h-100">
                    <div class="card-body text-center">
                        <h5 class="card-title">Kelola Kelas</h5>
                        <p class="card-text text-muted">Atur pembagian kelas dan jurusan.</p>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-4 mb-4">
            <a href="{{ route('admin.nilai.index') }}" class="text-decoration-none">
                <div class="card shadow-sm h-100">
                    <div class="card-body text-center">
                        <h5 class="card-title">Kelola Nilai</h5>
                        <p class="card-text text-muted">Input dan pantau nilai siswa.</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
@endsection
