@extends('layouts.app')

@section('title', 'Login | Doyan Makan')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center align-items-center"
         style="min-height: 65vh;">
        <div class="col-12 col-md-8 col-lg-5">

            <div class="card border-0 shadow rounded-4 overflow-hidden">

                <div class="text-center p-4"
                     style="background-color: #ead8c0;">
                    <div class="rounded-circle d-inline-flex align-items-center
                                justify-content-center mb-3"
                         style="width: 75px; height: 75px;
                                background-color: #fffaf2;">
                        <i class="bi bi-person-circle fs-1"
                           style="color: #795548;"></i>
                    </div>

                    <h3 class="fw-bold mb-1" style="color: #493123;">
                        Selamat Datang!
                    </h3>

                    <p class="mb-0" style="color: #6f4e37;">
                        Masuk untuk menikmati menu favoritmu.
                    </p>
                </div>

                <div class="card-body p-4 p-md-5">

                    @if (session('success'))
                        <div class="alert alert-success rounded-3">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger rounded-3">
                            @foreach ($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                        </div>
                    @endif

                    <form action="{{ route('login.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold">
                                Email
                            </label>

                            <div class="input-group">
                                <span class="input-group-text bg-light">
                                    <i class="bi bi-envelope"></i>
                                </span>

                                <input type="email"
                                       class="form-control"
                                       id="email"
                                       name="email"
                                       value="{{ old('email') }}"
                                       placeholder="nama@email.com"
                                       autocomplete="email"
                                       required
                                       autofocus>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="password"
                                   class="form-label fw-semibold">
                                Password
                            </label>

                            <div class="input-group">
                                <span class="input-group-text bg-light">
                                    <i class="bi bi-lock"></i>
                                </span>

                                <input type="password"
                                       class="form-control"
                                       id="password"
                                       name="password"
                                       placeholder="Masukkan password"
                                       autocomplete="current-password"
                                       required>

                                <button class="btn btn-outline-secondary"
                                        type="button"
                                        onclick="togglePassword()"
                                        aria-label="Tampilkan atau sembunyikan password">
                                    <i class="bi bi-eye" id="ikonPassword"></i>
                                </button>
                            </div>
                        </div>

                        <div class="form-check mb-4">
                            <input class="form-check-input"
                                   type="checkbox"
                                   value="1"
                                   id="remember"
                                   name="remember">

                            <label class="form-check-label text-secondary"
                                   for="remember">
                                Ingat saya
                            </label>
                        </div>

                        <button type="submit"
                                class="btn btn-cokelat w-100 py-2 fw-semibold">
                            <i class="bi bi-box-arrow-in-right me-1"></i>
                            Masuk
                        </button>
                    </form>

                    <div class="text-center mt-4">
                        <span class="text-secondary">
                            Belum punya akun?
                        </span>

                        <a href="{{ route('register') }}"
                           class="fw-semibold text-decoration-none"
                           style="color: #795548;">
                            Daftar sekarang
                        </a>
                    </div>

                    <div class="text-center mt-3">
                        <a href="{{ route('home') }}"
                           class="text-secondary small text-decoration-none">
                            <i class="bi bi-arrow-left me-1"></i>
                            Kembali ke Beranda
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function togglePassword() {
        const input = document.getElementById('password');
        const icon = document.getElementById('ikonPassword');

        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.replace('bi-eye', 'bi-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.replace('bi-eye-slash', 'bi-eye');
        }
    }
</script>
@endsection
