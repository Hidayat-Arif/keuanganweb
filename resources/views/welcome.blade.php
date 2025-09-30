<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Keuangan App</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- AOS CSS -->
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">

</head>
<body class="bg-light d-flex flex-column min-vh-100">

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ url('/') }}">💰 KeuanganApp</a>
            <div>
                @if (Route::has('login'))
                    <div class="d-flex">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="btn btn-light me-2">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-outline-light me-2">Login</a>
                            <a href="{{ route('register') }}" class="btn btn-light">Register</a>
                        @endauth
                    </div>
                @endif
            </div>
        </div>
    </nav>

<main class="flex-fill d-flex align-items-center">
    <div class="container text-center">
        <h1 class="display-4 fw-bold text-primary" data-aos="fade-up">
            Selamat Datang di KeuanganApp
        </h1>
        <p class="lead text-muted" data-aos="fade-up" data-aos-delay="200">
            Catat pemasukan dan pengeluaranmu dengan mudah.<br>
            Kelola keuangan lebih rapi, praktis, dan aman.
        </p>
        @guest
            <div data-aos="zoom-in" data-aos-delay="400">
                <a href="{{ route('register') }}" class="btn btn-primary btn-lg me-2">Daftar Sekarang</a>
                <a href="{{ route('login') }}" class="btn btn-outline-primary btn-lg">Login</a>
            </div>
        @else
            <a href="{{ url('/dashboard') }}" class="btn btn-success btn-lg" data-aos="zoom-in">Pergi ke Dashboard</a>
        @endguest
    </div>
</main>


    <footer class="bg-white text-center py-3 border-top mt-auto">
        <p class="mb-0 text-muted">&copy; {{ date('Y') }} KeuanganApp - Dibuat dengan ❤️ pakai Laravel</p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- AOS JS -->
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script>
    AOS.init({
        duration: 1000, // lama animasi (ms)
        once: true      // animasi hanya sekali muncul
    });
    </script>

</body>
</html>
