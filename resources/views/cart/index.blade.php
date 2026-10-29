@extends('layouts.app')

@section('title', 'Keranjang Belanja | Doyan Makan')

@section('content')
<div class="container py-4 py-md-5">

    <div class="mb-4">
        <h2 class="fw-bold" style="color: #493123;">
            <i class="bi bi-cart3 me-2"></i>Keranjang Belanja
        </h2>
        <p class="text-secondary mb-0">
            Periksa kembali menu pilihanmu sebelum melanjutkan.
        </p>
    </div>

    {{-- Notifikasi --}}
    @if (session('success'))
        <div class="alert alert-success rounded-3">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger rounded-3">
            {{ session('error') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger rounded-3">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    @if (empty($cart))
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body text-center py-5 px-3">
                <i class="bi bi-cart-x"
                   style="font-size: 4rem; color: #b89a7b;"></i>

                <h4 class="fw-bold mt-3" style="color: #493123;">
                    Keranjangmu masih kosong
                </h4>

                <p class="text-secondary">
                    Yuk, pilih menu favoritmu terlebih dahulu!
                </p>

                <a href="{{ url('/') }}#menu"
                   class="btn btn-cokelat rounded-pill px-4">
                    <i class="bi bi-shop me-1"></i>
                    Mulai Belanja
                </a>
            </div>
        </div>
    @else

        <div class="row g-4">

            {{-- Daftar produk --}}
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body p-3 p-md-4">

                        @foreach ($cart as $id => $item)
                            <div class="py-2">
                                <div class="row g-3 align-items-center">

                                    {{-- Foto --}}
                                    <div class="col-4 col-sm-3">
                                        <img
                                            src="{{ asset($item['image']) }}"
                                            alt="{{ $item['name'] }}"
                                            class="rounded-3 w-100"
                                            style="height: 110px; object-fit: cover;"
                                            onerror="this.onerror=null;this.src='https://placehold.co/300x300/f3e8d8/795548?text=Menu';">
                                    </div>

                                    {{-- Informasi produk --}}
                                    <div class="col-8 col-sm-9">
                                        <div class="d-flex justify-content-between
                                                    align-items-start gap-2">

                                            <div>
                                                <h5 class="fw-bold mb-1"
                                                    style="color: #493123;">
                                                    {{ $item['name'] }}
                                                </h5>

                                                <p class="text-secondary small mb-2">
                                                    Harga satuan:
                                                    Rp{{ number_format($item['price'], 0, ',', '.') }}
                                                </p>

                                                <p class="fw-bold mb-0"
                                                   style="color: #795548;">
                                                    Subtotal:
                                                    Rp{{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}
                                                </p>
                                            </div>

                                            {{-- Hapus produk --}}
                                            <form
                                                action="{{ route('cart.remove', $id) }}"
                                                method="POST"
                                                onsubmit="return confirm('Hapus {{ $item['name'] }} dari keranjang?')">

                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                        class="btn btn-outline-danger btn-sm"
                                                        aria-label="Hapus {{ $item['name'] }}"
                                                        title="Hapus produk">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>

                                        {{-- Ubah jumlah --}}
                                        <form
                                            action="{{ route('cart.update', $id) }}"
                                            method="POST"
                                            class="mt-3">

                                            @csrf
                                            @method('PATCH')

                                            <div class="d-flex align-items-center
                                                        justify-content-between
                                                        flex-wrap gap-2">

                                                <label for="jumlah-{{ $id }}"
                                                       class="small fw-semibold">
                                                    Jumlah
                                                </label>

                                                <div class="input-group"
                                                     style="width: 145px;">

                                                    <button
                                                        class="btn btn-outline-secondary"
                                                        type="button"
                                                        onclick="ubahJumlah('jumlah-{{ $id }}', -1)">
                                                        −
                                                    </button>

                                                    <input
                                                        type="number"
                                                        id="jumlah-{{ $id }}"
                                                        name="quantity"
                                                        class="form-control text-center"
                                                        value="{{ $item['quantity'] }}"
                                                        min="1"
                                                        max="20"
                                                        required>

                                                    <button
                                                        class="btn btn-outline-secondary"
                                                        type="button"
                                                        onclick="ubahJumlah('jumlah-{{ $id }}', 1)">
                                                        +
                                                    </button>
                                                </div>

                                                <button type="submit"
                                                        class="btn btn-sm btn-outline-secondary rounded-pill">
                                                    Perbarui
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            @if (!$loop->last)
                                <hr class="my-4">
                            @endif
                        @endforeach

                        <hr class="my-4">

                        <a href="{{ url('/') }}#menu"
                           class="btn btn-outline-secondary rounded-pill">
                            <i class="bi bi-arrow-left me-1"></i>
                            Lanjut Belanja
                        </a>
                    </div>
                </div>
            </div>

            {{-- Ringkasan pesanan --}}
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body p-3 p-md-4">

                        <h5 class="fw-bold mb-4"
                            style="color: #493123;">
                            Ringkasan Pesanan
                        </h5>

                        <div class="d-flex justify-content-between gap-3 mb-3">
                            <span class="text-secondary">Jumlah produk</span>
                            <span class="fw-semibold">
                                {{ collect($cart)->sum('quantity') }} item
                            </span>
                        </div>

                        <div class="d-flex justify-content-between gap-3 mb-3">
                            <span class="text-secondary">Subtotal</span>
                            <span>
                                Rp{{ number_format($total, 0, ',', '.') }}
                            </span>
                        </div>

                        <div class="d-flex justify-content-between gap-3 mb-3">
                            <span class="text-secondary">Ongkos kirim</span>
                            <span>Rp0</span>
                        </div>

                        <hr>

                        <div class="d-flex justify-content-between
                                    align-items-start gap-3 mb-4">
                            <span class="fw-bold">Total</span>

                            <span class="fw-bold text-end"
                                  style="color: #795548; font-size: 1.2rem;">
                                Rp{{ number_format($total, 0, ',', '.') }}
                            </span>
                        </div>

                        <a href="{{ route('orders.checkout') }}"
                           class="btn btn-cokelat w-100 py-2 rounded-pill">
                            Lanjut ke Checkout
                            <i class="bi bi-arrow-right ms-1"></i>
                        </a>

                        <p class="text-secondary small mt-3 mb-0">
                            <i class="bi bi-shield-check me-1"></i>
                            Pastikan pesananmu sudah benar.
                        </p>
                    </div>
                </div>
            </div>

        </div>
    @endif
</div>

<script>
    function ubahJumlah(id, perubahan) {
        const input = document.getElementById(id);

        if (!input) return;

        const min = Number(input.min) || 1;
        const max = Number(input.max) || 20;
        let jumlah = Number(input.value) || 1;

        jumlah += perubahan;
        input.value = Math.max(min, Math.min(max, jumlah));
    }
</script>
@endsection
