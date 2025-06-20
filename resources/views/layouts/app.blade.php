<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistem Nilai - Sistem Login')</title>
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Custom Styling -->
    <style>
        body {
            background-color:rgb(254, 254, 254);
        }
        .navbar-brand {
            font-weight: bold;
        }
        .logout-btn:hover {
            background-color: #dc3545;
            color: white;
        }
    </style>
    <style>
    html, body {
        height: 100%;
        margin: 0;
        padding: 0;
    }

    body {
        display: flex;
        flex-direction: column;
        min-height: 100vh;
        background-image: url('{{ asset('asset/ikn1.jpg') }}');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        color: #000; /* Supaya teks tetap terbaca di background */
    }

    .container {
        flex: 1;
    }

    .navbar-brand {
        font-weight: bold;
    }

    .logout-btn:hover {
        background-color: #dc3545;
        color: white;
    }

    footer {
        background-color: rgba(255, 255, 255, 0.8);
    }


</style>

</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="#">📘 Data Sekolah</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item me-3 text-white">
                        👋 Hai, {{ Auth::user()->name ?? 'Pengguna' }}
                    </li>
                    <li class="nav-item">
                        <a href="#" class="btn btn-outline-light logout-btn"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                           Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Konten -->
    <div class="container py-4">
        @yield('content')
    </div>

    <!-- Footer -->
    <footer class="bg-light text-center text-muted py-3 mt-auto">
        <small>© 2025 Sistem Manajemen Data Sekolah</small>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
