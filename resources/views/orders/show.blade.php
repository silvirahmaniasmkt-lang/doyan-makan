@extends('layouts.app')

@section('title', 'Detail Pesanan | Doyan Makan')

@section('content')

<style>
    .order-page {
        background: #fffaf2;
        min-height: 80vh;
    }

    .order-card {
        border: 1px solid #f0e6da;
        border-radius: 18px;
        background: #fff;
        overflow: hidden;
    }

    .order-heading {
        color: #493123;
    }

    .order-icon {
        width: 90px;
        height: 90px;
        background: #ead8c0;
        color: #795548;
    }

    .order-product-image {
        width: 90px;
        height: 90px;
        object-fit: cover;
        border-radius: 12px;
        background: #ead8c0;
        flex-shrink: 0;
    }

    .order-price {
        color: #795548;
    }

    .order-promo {
        background: #f3e6d5;
        color: #493123;
        border-radius: 14px;
    }

    .btn-cokelat {
        background: #795548;
        border: 1px solid #795548;
        color: #fff;
        border-radius: 10px;
    }

    .btn-cokelat:hover {
        background: #493123;
        border-color: #493123;
        color: #fff;
    }

    .btn-outline-cokelat {
        color: #795548;
        border: 1px solid #795548;
        border-radius: 10px;
    }

    .btn-outline-cokelat:hover {
        background: #795548;
        color: #fff;
    }

    .order-address {
        overflow-wrap: anywhere;
        white-space: pre-line;
    }

    @media (max-width: 576px) {
        .order-product-image {
            width: 72px;
            height: 72px;
        }

        .order-card .card-body {
            padding: 18px !important;
        }

        .order-icon {
            width: 72px;
            height: 72px;
        }
    }
</style>

<div class="order-page">
    <div class="container py-4 py-md-5">

        {{-- HEADER --}}
        <div class="text-center mb-5">
            <div class="order-icon rounded-circle d-inline-flex
                        align-items-center justify-content-center mb-3">
                <i class="bi bi-bag-check-fill fs-1"></i>
            </div>

            <h2 class="fw-bold order-heading">
                Detail Pesanan
            </h2>

            <p class="text-secondary">
                Terima kasih telah memilih Doyan Makan.
                Semoga makanan favoritmu membuat harimu lebih menyenangkan!
            </p>
        </div>

        <div class="row justify-content-center">
            <div class="col-12 col-lg-8">

                {{-- INFORMASI PESANAN --}}
                <div class="card order-card shadow-sm mb-4">
                    <div class="card-body p-3 p-md-4">

                        <div class="d-flex justify-content-between
                                    align-items-center flex-wrap gap-3 mb-3">

                            <div>
                                <small class="text-secondary">
                                    Nomor Pesanan
                                </small>

                                <h5 class="fw-bold mb-0">
                                    {{ $order->order_code }}
                                </h5>
                            </div>

                            @php
                                $status = strtolower($order->status ?? 'menunggu');
                            @endphp

                            <span class="badge rounded-pill px-3 py-2
                                {{ $status === 'selesai' ? 'bg-success' :
                                    ($status === 'dibatalkan' ? 'bg-danger' : 'bg-warning text-dark') }}">

                                @if ($status === 'selesai')
                                    <i class="bi bi-check-circle me-1"></i>
                                @elseif ($status === 'dibatalkan')
                                    <i class="bi bi-x-circle me-1"></i>
                                @else
                                    <i class="bi bi-clock me-1"></i>
                                @endif

                                {{ $order->status }}
                            </span>
                        </div>

                        <hr>

                        <div class="row g-3">
                            <div class="col-12 col-sm-6">
                                <small class="text-secondary">
                                    Tanggal Pesanan
                                </small>

                                <p class="fw-semibold mb-0">
                                    {{ $order->created_at
                                        ? $order->created_at->format('d-m-Y H:i')
                                        : '-' }}
                                </p>
                            </div>

                            <div class="col-12 col-sm-6">
                                <small class="text-secondary">
                                    Nama Pembeli
                                </small>

                                <p class="fw-semibold mb-0">
                                    {{ $order->customer_name }}
                                </p>
                            </div>
                        </div>

                    </div>
                </div>

                {{-- PRODUK PESANAN --}}
                <div class="card order-card shadow-sm mb-4">
                    <div class="card-body p-3 p-md-4">

                        <h5 class="fw-bold order-heading mb-4">
                            <i class="bi bi-basket2 me-2"></i>
                            Produk Pesanan
                        </h5>

                        @foreach ($order->items as $item)
                            <div class="d-flex align-items-center gap-3 mb-3">

                                @php
                                    $gambar = $item->product?->image;
                                    $gambarUrl = null;

                                    if ($gambar) {
                                        if (filter_var($gambar, FILTER_VALIDATE_URL)) {
                                            $gambarUrl = $gambar;
                                        } elseif (
                                            str_starts_with($gambar, 'storage/') ||
                                            str_starts_with($gambar, 'images/')
                                        ) {
                                            $gambarUrl = asset($gambar);
                                        } else {
                                            $gambarUrl = asset('images/' . $gambar);
                                        }
                                    }
                                @endphp

                                @if ($gambarUrl)
                                    <img
                                        src="{{ $gambarUrl }}"
                                        alt="{{ $item->product_name }}"
                                        class="order-product-image"
                                        onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">

                                    <div
                                        class="order-product-image align-items-center justify-content-center"
                                        style="display:none;">
                                        <i class="bi bi-cup-hot fs-2"
                                           style="color:#795548;"></i>
                                    </div>
                                @else
                                    <div class="order-product-image d-flex
                                                align-items-center justify-content-center">
                                        <i class="bi bi-cup-hot fs-2"
                                           style="color:#795548;"></i>
                                    </div>
                                @endif

                                <div class="flex-grow-1" style="min-width: 0;">
                                    <h6 class="fw-bold mb-1 text-break">
                                        {{ $item->product_name }}
                                    </h6>

                                    <p class="text-secondary small mb-0">
                                        {{ $item->quantity }} produk ×
                                        Rp{{ number_format($item->price, 0, ',', '.') }}
                                    </p>
                                </div>

                                <span class="fw-bold order-price text-nowrap">
                                    Rp{{ number_format($item->subtotal, 0, ',', '.') }}
                                </span>

                            </div>
                        @endforeach

                        <hr class="my-4">

                        <div class="d-flex justify-content-between gap-3 mb-2">
                            <span class="text-secondary">Subtotal</span>

                            <span class="text-nowrap">
                                Rp{{ number_format(
                                    $order->items->sum('subtotal'),
                                    0, ',', '.'
                                ) }}
                            </span>
                        </div>

                        <div class="d-flex justify-content-between gap-3 mb-3">
                            <span class="text-secondary">Ongkos Kirim</span>
                            <span>Rp0</span>
                        </div>

                        <hr>

                        <div class="d-flex justify-content-between
                                    align-items-center gap-3">

                            <span class="fw-bold">
                                Total Pembayaran
                            </span>

                            <h5 class="fw-bold order-price mb-0 text-nowrap">
                                Rp{{ number_format($order->total_price, 0, ',', '.') }}
                            </h5>
                        </div>

                    </div>
                </div>

                {{-- ALAMAT PENGIRIMAN --}}
                <div class="card order-card shadow-sm mb-4">
                    <div class="card-body p-3 p-md-4">

                        <h5 class="fw-bold order-heading mb-3">
                            <i class="bi bi-geo-alt me-2"></i>
                            Alamat Pengiriman
                        </h5>

                        <p class="fw-semibold mb-1">
                            {{ $order->customer_name }}
                        </p>

                        <p class="text-secondary mb-2">
                            <i class="bi bi-telephone me-1"></i>
                            {{ $order->phone }}
                        </p>

                        <p class="text-secondary order-address mb-0">
                            <i class="bi bi-geo-alt me-1"></i>
                            {{ $order->address }}
                        </p>

                        @if ($order->notes)
                            <hr>

                            <p class="fw-semibold mb-1">
                                <i class="bi bi-chat-left-text me-1"></i>
                                Catatan Pesanan
                            </p>

                            <p class="text-secondary mb-0 order-address">
                                {{ $order->notes }}
                            </p>
                        @endif

                    </div>
                </div>

                {{-- UCAPAN --}}
                <div class="order-promo p-3 p-md-4 mb-4">
                    <div class="d-flex gap-3 align-items-start">
                        <i class="bi bi-heart-fill fs-3"
                           style="color: #795548;"></i>

                        <div>
                            <h5 class="fw-bold mb-2">
                                Terima Kasih Sudah Memesan!
                            </h5>

                            <p class="mb-0">
                                Nikmati pilihan bakery, dessert, dan
                                minuman favoritmu dari Doyan Makan.
                                Jangan lupa mampir lagi untuk mencoba
                                menu lezat lainnya!
                            </p>
                        </div>
                    </div>
                </div>

                {{-- TOMBOL NAVIGASI --}}
                <div class="d-flex flex-column flex-sm-row gap-2
                            justify-content-center">

                    <a href="{{ route('home') }}"
                       class="btn btn-cokelat px-4 py-2">
                        <i class="bi bi-house me-1"></i>
                        Kembali ke Beranda
                    </a>

                    <a href="{{ route('cart.index') }}"
                       class="btn btn-outline-cokelat px-4 py-2">
                        <i class="bi bi-cart3 me-1"></i>
                        Lihat Keranjang
                    </a>

                </div>

            </div>
        </div>
    </div>
</div>

@endsection
