@extends('layouts.app')

@section('title', 'Dashboard Siswa')

@section('content')
<div class="container">
    <div class="d-flex justify-content-center">
        <h1 class="mb-4">Dashboard Siswa</h1>
    </div>

    <div class="text-center">
        <h5>Halo, {{ $siswa->nama_siswa }}</h5>
        <p>Selamat datang, Di sini kamu bisa melihat nilai kamu.</p>

        <a href="{{ route('siswa.nilai.index') }}" class="btn btn-primary mt-3">
            Lihat Nilai
        </a>
    </div>
</div>
@endsection

