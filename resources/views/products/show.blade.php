@extends('layouts.app')

@section('title', 'Detail {{ $product->name }} | Doyan Makan')

@section('content')
<div class="container py-4 py-md-5">

    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('home') }}"
                   class="text-decoration-none"
                   style="color: #795548;">
                    Beranda
                </a>
            </li>
            <li class="breadcrumb-item active">
                {{ $product->name }}
            </li>
        </ol>
    </nav>

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

    <div class="row g-4 g-lg-5 align-items-center">

        <div class="col-12 col-md-6">
            <div class="bg-white p-3 rounded-4 shadow-sm">
                <img
                    src="{{ asset($product->image) }}"
                    alt="{{ $product->name }}"
                    class="img-fluid rounded-4 w-100"
                    style="height: clamp(250px, 40vw, 420px); object-fit: cover;"
                    onerror="this.onerror=null;this.src='https://placehold.co/800x600/f3e8d8/795548?text=Foto+Produk';">
            </div>
        </div>

        <div class="col-12 col-md-6">
            <span class="badge rounded-pill mb-3 px-3 py-2"
                  style="background-color: #ead8c0; color: #493123;">
                Doyan Makan
            </span>

            <h1 class="fw-bold mb-3"
                style="color: #493123;">
                {{ $product->name }}
            </h1>

            <h3 class="fw-bold mb-3"
                style="color: #795548;">
                Rp{{ number_format($product->price, 0, ',', '.') }}
            </h3>

            <p class="text-secondary mb-3">
                {{ $product->description }}
            </p>

            <p class="mb-4">
                @if ($product->stock > 0)
                    <span style="color: #477447;">
                        <i class="bi bi-check-circle-fill me-1"></i>
                        Stok tersedia: {{ $product->stock }}
                    </span>
                @else
                    <span class="text-danger">
                        <i class="bi bi-x-circle-fill me-1"></i>
                        Stok habis
                    </span>
                @endif
            </p>

            <hr class="my-4">

            <form action="{{ route('cart.add', $product) }}"
                  method="POST">
                @csrf

                <label for="quantity" class="form-label fw-semibold">
                    Jumlah Pesanan
                </label>

                <div class="input-group mb-4"
                     style="max-width: 180px;">
                    <button class="btn btn-outline-secondary"
                            type="button"
                            onclick="ubahJumlah(-1)">
                        <i class="bi bi-dash"></i>
                    </button>

                    <input type="number"
                           name="quantity"
                           id="quantity"
                           class="form-control text-center"
                           value="{{ old('quantity', 1) }}"
                           min="1"
                           max="{{ min(20, $product->stock) }}"
                           required
                           {{ $product->stock < 1 ? 'disabled' : '' }}>

                    <button class="btn btn-outline-secondary"
                            type="button"
                            onclick="ubahJumlah(1)">
                        <i class="bi bi-plus"></i>
                    </button>
                </div>

                <div class="d-grid gap-2 d-sm-flex">
                    <button type="submit"
                            class="btn btn-cokelat btn-lg flex-fill"
                            {{ $product->stock < 1 ? 'disabled' : '' }}>
                        <i class="bi bi-cart-plus me-1"></i>
                        Tambah ke Keranjang
                    </button>

                    <a href="{{ route('home') }}#menu"
                       class="btn btn-outline-secondary btn-lg">
                        Kembali
                    </a>
                </div>
            </form>

            <div class="mt-4 p-3 rounded-3"
                 style="background-color: #f3e8d8; color: #624536;">
                <i class="bi bi-info-circle me-2"></i>
                Pilih menu favoritmu, lalu tambahkan ke keranjang
                untuk melanjutkan pemesanan.
            </div>
        </div>
    </div>
</div>

<script>
    function ubahJumlah(perubahan) {
        const input = document.getElementById('quantity');

        if (input.disabled) return;

        const min = Number(input.min) || 1;
        const max = Number(input.max) || 20;
        let jumlah = Number(input.value) || 1;

        jumlah += perubahan;

        input.value = Math.max(min, Math.min(max, jumlah));
    }
</script>
@endsection
