@extends('layouts.app')

@section('title', 'Daftar Akun | Doyan Makan')

@section('content')

<div class="container py-5">
    <div class="row justify-content-center align-items-center"
         style="min-height: 65vh;">

        <div class="col-md-8 col-lg-5">

            <div class="card border-0 shadow rounded-4 overflow-hidden">

                <!-- Header -->
                <div class="text-center p-4"
                     style="background-color: #ead8c0;">

                    <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                         style="width: 75px; height: 75px; background-color: #fffaf2;">
                        <i class="bi bi-person-plus fs-1"
                           style="color: #795548;"></i>
                    </div>

                    <h3 class="fw-bold mb-1" style="color: #493123;">
                        Buat Akun Baru
                    </h3>

                    <p class="mb-0" style="color: #6f4e37;">
                        Bergabung dan pesan menu favoritmu!
                    </p>
                </div>

                <!-- Form registrasi -->
                <div class="card-body p-4 p-md-5">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0 ps-3">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ url('/register') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label fw-semibold">
                                Nama Lengkap
                            </label>

                            <div class="input-group">
                                <span class="input-group-text bg-light">
                                    <i class="bi bi-person"></i>
                                </span>

                                <input type="text"
                                       class="form-control"
                                       id="name"
                                       name="name"
                                       value="{{ old('name') }}"
                                       placeholder="Masukkan nama lengkap"
                                       autocomplete="name"
                                       maxlength="255"
                                       required>
                            </div>
                        </div>

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
                                       required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label fw-semibold">
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
                                       placeholder="Minimal 8 karakter"
                                       autocomplete="new-password"
                                       minlength="8"
                                       required>

                                <button class="btn btn-outline-secondary"
                                        type="button"
                                        onclick="togglePassword('password', 'ikonPassword')"
                                        aria-label="Tampilkan atau sembunyikan password">
                                    <i class="bi bi-eye" id="ikonPassword"></i>
                                </button>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="password_confirmation"
                                   class="form-label fw-semibold">
                                Konfirmasi Password
                            </label>

                            <div class="input-group">
                                <span class="input-group-text bg-light">
                                    <i class="bi bi-shield-lock"></i>
                                </span>

                                <input type="password"
                                       class="form-control"
                                       id="password_confirmation"
                                       name="password_confirmation"
                                       placeholder="Ulangi password"
                                       autocomplete="new-password"
                                       minlength="8"
                                       required>

                                <button class="btn btn-outline-secondary"
                                        type="button"
                                        onclick="togglePassword('password_confirmation', 'ikonKonfirmasi')"
                                        aria-label="Tampilkan atau sembunyikan konfirmasi password">
                                    <i class="bi bi-eye" id="ikonKonfirmasi"></i>
                                </button>
                            </div>
                        </div>

                        <button type="submit"
                                class="btn btn-cokelat w-100 py-2 fw-semibold">
                            <i class="bi bi-person-check me-1"></i>
                            Daftar Sekarang
                        </button>
                    </form>

                    <div class="text-center mt-4">
                        <span class="text-secondary">
                            Sudah punya akun?
                        </span>

                        <a href="{{ url('/login') }}"
                           class="fw-semibold text-decoration-none"
                           style="color: #795548;">
                            Masuk
                        </a>
                    </div>

                    <div class="text-center mt-3">
                        <a href="{{ url('/') }}"
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
    function togglePassword(inputId, iconId) {
        const input = document.getElementById(inputId);
        const icon = document.getElementById(iconId);

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
