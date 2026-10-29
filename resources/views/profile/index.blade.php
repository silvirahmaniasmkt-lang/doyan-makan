@extends('layouts.app')

@section('title', 'Profil Saya | Doyan Makan')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">

            <div class="mb-4">
                <h2 class="fw-bold">Profil Saya</h2>
                <p class="text-muted">
                    Kelola informasi akun Doyan Makan kamu di sini.
                </p>
            </div>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4 p-md-5">

                    <div class="text-center mb-4">
                        <div class="rounded-circle d-inline-flex align-items-center justify-content-center"
                             style="width: 75px; height: 75px; background: #ead8c0; color: #493123; font-size: 30px; font-weight: bold;">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>

                        <h4 class="mt-3 mb-1">{{ $user->name }}</h4>
                        <p class="text-muted">{{ $user->email }}</p>
                    </div>

                    <form action="{{ route('profile.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="name" class="form-label fw-semibold">
                                Nama Lengkap
                            </label>
                            <input
                                type="text"
                                class="form-control"
                                id="name"
                                name="name"
                                value="{{ old('name', $user->name) }}"
                                required
                            >
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold">
                                Email
                            </label>
                            <input
                                type="email"
                                class="form-control"
                                id="email"
                                name="email"
                                value="{{ old('email', $user->email) }}"
                                required
                            >
                        </div>

                        <hr class="my-4">

                        <h5 class="fw-bold mb-1">Ganti Password</h5>
                        <p class="text-muted small">
                            Kosongkan jika tidak ingin mengganti password.
                        </p>

                        <div class="mb-3">
                            <label for="password" class="form-label fw-semibold">
                                Password Baru
                            </label>
                            <input
                                type="password"
                                class="form-control"
                                id="password"
                                name="password"
                                autocomplete="new-password"
                            >
                        </div>

                        <div class="mb-4">
                            <label for="password_confirmation" class="form-label fw-semibold">
                                Konfirmasi Password Baru
                            </label>
                            <input
                                type="password"
                                class="form-control"
                                id="password_confirmation"
                                name="password_confirmation"
                                autocomplete="new-password"
                            >
                        </div>

                        <div class="d-flex flex-wrap gap-2">
                            <button type="submit"
                                    class="btn text-white px-4"
                                    style="background: #795548;">
                                Simpan Perubahan
                            </button>

                            <a href="{{ route('orders.index') }}"
                               class="btn btn-outline-secondary px-4">
                                Riwayat Pesanan
                            </a>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection