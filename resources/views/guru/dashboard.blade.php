@extends('layouts.app')

@section('title', 'Dashboard Guru')

@section('content')
<div class="container">
    <div class="text-center mb-5">
        <h1 class="display-5 fw-bold">Selamat Datang di Dashboard Guru</h1>
        
    </div>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-body text-center">
                    <i class="bi bi-journal-text fs-1 text-primary mb-3"></i>
                    <h4 class="card-title mb-3">Kelola Nilai Siswa</h4>
                    <p class="card-text text-muted">Lihat, tambah, ubah, atau hapus nilai siswa.</p>
                    <a href="{{ route('guru.nilai.index') }}" class="btn btn-outline-primary rounded-pill px-4">
                        Buka Halaman Nilai
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
