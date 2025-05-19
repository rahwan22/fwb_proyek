@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<style>
    .sidebar {
        background-color: #343a40;
        color: white;
        height: 100vh;
        position: fixed;
        top: 0;
        left: 0;
        width: 240px;
        padding: 40px 20px 20px 20px; /* padding atas ditambah */
        margin-top: 56px;
    }


    .sidebar .nav-link {
        color: #fff;
    }

    .sidebar .nav-link:hover {
        text-decoration: underline;
    }

    .main-content {
        margin-left: 240px;
        padding: 40px;
    }
</style>

<div class="sidebar">

    <ul class="nav flex-column">
        <li class="nav-item mb-2">
            <a href="{{ route('admin.siswa.index') }}" class="nav-link">📄 Kelola Siswa</a>
        </li>
        <li class="nav-item mb-2">
            <a href="{{ route('admin.guru.index') }}" class="nav-link">👨‍🏫 Kelola Guru</a>
        </li>
        <li class="nav-item mb-2">
            <a href="{{ route('admin.mapel.index') }}" class="nav-link">📘 Kelola Mapel</a>
        </li>
        <li class="nav-item mb-2">
            <a href="{{ route('admin.kelas.index') }}" class="nav-link">🏫 Kelola Kelas</a>
        </li>
        <li class="nav-item mb-2">
            <a href="{{ route('admin.nilai.index') }}" class="nav-link">📊 Kelola Nilai</a>
        </li>
    </ul>
</div>

@endsection
