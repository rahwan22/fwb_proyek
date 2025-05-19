@extends('layouts.auth')
<div class="card shadow-sm" style="background-image: url('{{ asset('asset/ikn1.jpg') }}'); background-size: cover; background-position: center;">
@section('content')
    <div class="card shadow-sm">
        <div class="card-body">
            <h3 class="text-center mb-4">Login</h3>

            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            <form action="{{ route('login.process') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" required autofocus>
                </div>
                <div class="mb-3">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <button class="btn btn-success w-100" type="submit">Login</button>
            </form>
        </div>
    </div>
@endsection
