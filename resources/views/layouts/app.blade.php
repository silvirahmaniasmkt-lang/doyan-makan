<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Doyan Makan')</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        :root {
            --cokelat: #795548;
            --cokelat-tua: #493123;
            --cream: #fffaf2;
            --beige: #ead8c0;
        }

        * {
            box-sizing: border-box;
        }

        html {
            width: 100%;
            scroll-behavior: smooth;
        }

        body {
            margin: 0;
            width: 100%;
            min-height: 100vh;
            background-color: var(--cream);
            color: var(--cokelat-tua);
            display: flex;
            flex-direction: column;
            overflow-x: hidden;
        }

        img {
            max-width: 100%;
            height: auto;
        }

        main {
            flex: 1;
            min-width: 0;
        }

        /* NAVBAR */
        .navbar-doyan {
            background-color: var(--cokelat-tua);
            padding: 12px 0;
        }

        .navbar-brand {
            color: var(--cream);
            font-weight: 700;
            letter-spacing: 1px;
            font-size: 1.2rem;
            white-space: nowrap;
        }

        .navbar-brand:hover {
            color: var(--beige);
        }

        .navbar-doyan .nav-link {
            color: var(--cream);
            padding: 9px 12px;
            border-radius: 8px;
            transition: background-color 0.2s;
        }

        .navbar-doyan .nav-link:hover {
            color: var(--beige);
            background-color: rgba(255, 255, 255, 0.08);
        }

        .navbar-toggler {
            border: 1px solid var(--beige);
        }

        .navbar-toggler:focus {
            box-shadow: none;
        }

        .navbar-toggler-icon {
            width: 1.25em;
            height: 1.25em;
        }

        /* TOMBOL */
        .btn-cokelat {
            background-color: var(--cokelat);
            color: white;
            border: 1px solid var(--cokelat);
        }

        .btn-cokelat:hover {
            background-color: var(--cokelat-tua);
            color: white;
        }

        .btn-daftar {
            background-color: var(--cream);
            color: var(--cokelat-tua);
            border: 1px solid var(--cream);
        }

        .btn-daftar:hover {
            background-color: var(--beige);
            color: var(--cokelat-tua);
        }

        .btn-masuk {
            color: var(--cream);
            border: 1px solid var(--cream);
        }

        .btn-masuk:hover {
            background-color: var(--cream);
            color: var(--cokelat-tua);
        }

        /* FORM */
        .form-control,
        .form-select {
            max-width: 100%;
            border-color: #dfcbb5;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--cokelat);
            box-shadow: 0 0 0 0.2rem rgba(121, 85, 72, 0.15);
        }

        /* GAMBAR DAN KARTU */
        .card {
            max-width: 100%;
        }

        .card img {
            object-fit: cover;
        }

        /* TABEL */
        .table-responsive {
            width: 100%;
            overflow-x: auto;
        }

        /* FOOTER */
        .footer-doyan {
            background-color: var(--cokelat-tua);
            color: var(--cream);
        }

        /* RESPONSIVE HP */
        @media (max-width: 991.98px) {
            .navbar-collapse {
                padding-top: 12px;
            }

            .navbar-doyan .navbar-nav {
                align-items: stretch !important;
                gap: 4px;
            }

            .navbar-doyan .nav-link {
                padding: 10px 12px;
            }

            .navbar-doyan .btn {
                margin: 4px 0;
                padding: 9px 14px;
            }

            .navbar-doyan form {
                display: block !important;
            }

            .navbar-doyan form button {
                width: 100%;
                text-align: left;
            }
        }

        @media (max-width: 576px) {
            .container {
                padding-left: 16px;
                padding-right: 16px;
            }

            h1 {
                font-size: 1.8rem;
            }

            h2 {
                font-size: 1.5rem;
            }

            h3 {
                font-size: 1.25rem;
            }

            .card-body {
                overflow-wrap: anywhere;
            }

            .btn {
                max-width: 100%;
            }

            .footer-doyan {
                font-size: 0.9rem;
            }
        }
    </style>

    @stack('styles')
</head>

<body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-doyan">
        <div class="container">

            <a class="navbar-brand" href="{{ route('home') }}">
                <i class="bi bi-cup-hot-fill"></i>
                Doyan Makan
            </a>

            <button
                class="navbar-toggler bg-light"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarDoyan"
                aria-controls="navbarDoyan"
                aria-expanded="false"
                aria-label="Buka navigasi">

                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarDoyan">
                <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-2">

                    @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('home') }}">
                                <i class="bi bi-house-door"></i>
                                Beranda
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('home') }}#menu">
                                <i class="bi bi-grid"></i>
                                Menu
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('cart.index') }}">
                                <i class="bi bi-cart3"></i>
                                Keranjang
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('orders.index') }}">
                                <i class="bi bi-receipt"></i>
                                Riwayat Pesanan
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('profile.index') }}">
                                <i class="bi bi-person-circle"></i>
                                Profil
                            </a>
                        </li>

                        <li class="nav-item">
                            <form action="{{ route('logout') }}"
                                  method="POST"
                                  class="d-inline">
                                @csrf

                                <button type="submit"
                                        class="btn btn-daftar btn-sm ms-lg-2">
                                    <i class="bi bi-box-arrow-right"></i>
                                    Logout
                                </button>
                            </form>
                        </li>

                    @else
                        <li class="nav-item">
                            <a class="btn btn-daftar btn-sm"
                               href="{{ route('register') }}">
                                <i class="bi bi-person-plus"></i>
                                Daftar
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="btn btn-masuk btn-sm"
                               href="{{ route('login') }}">
                                <i class="bi bi-box-arrow-in-right"></i>
                                Masuk
                            </a>
                        </li>
                    @endauth

                </ul>
            </div>
        </div>
    </nav>

    <!-- KONTEN HALAMAN -->
    <main>
        @if (session('success'))
            <div class="container mt-3">
                <div class="alert alert-success alert-dismissible fade show rounded-3"
                     role="alert">

                    {{ session('success') }}

                    <button type="button"
                            class="btn-close"
                            data-bs-dismiss="alert"
                            aria-label="Tutup">
                    </button>
                </div>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- FOOTER -->
    <footer class="footer-doyan mt-5 py-4">
        <div class="container text-center">
            <h5 class="fw-bold">
                <i class="bi bi-cup-hot-fill"></i>
                Doyan Makan
            </h5>

            <p class="mb-1">
                Temukan makanan dan minuman favoritmu.
            </p>

            <small>
                &copy; {{ date('Y') }} Doyan Makan.
                Semua hak dilindungi.
            </small>
        </div>
    </footer>

    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts')

</body>
</html>
