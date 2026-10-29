@extends('layouts.app')

@section('title', 'Checkout | Doyan Makan')

@section('content')
<div class="container py-4 py-md-5">

    <div class="mb-4">
        <h2 class="fw-bold" style="color: #493123;">
            <i class="bi bi-bag-check me-2"></i>Checkout
        </h2>
        <p class="text-secondary mb-0">
            Lengkapi data pengiriman untuk menyelesaikan pesananmu.
        </p>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <div class="fw-semibold mb-1">Periksa kembali data kamu:</div>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('orders.store') }}" method="POST" id="formCheckout">
        @csrf

        <div class="row g-4">

            {{-- DATA PEMBELI --}}
            <div class="col-12 col-lg-8">
                <div class="card border-0 shadow-sm rounded-4 mb-4">
                    <div class="card-body p-3 p-md-4">

                        <h5 class="fw-bold mb-4" style="color: #493123;">
                            <i class="bi bi-person-lines-fill me-2"></i>
                            Data Pembeli
                        </h5>

                        <div class="mb-3">
                            <label for="customer_name" class="form-label">
                                Nama Lengkap
                            </label>
                            <input
                                type="text"
                                class="form-control"
                                id="customer_name"
                                name="customer_name"
                                value="{{ old('customer_name', auth()->user()->name ?? '') }}"
                                maxlength="100"
                                placeholder="Masukkan nama lengkap"
                                required>
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label">
                                Nomor Telepon
                            </label>
                            <input
                                type="tel"
                                class="form-control"
                                id="phone"
                                name="phone"
                                value="{{ old('phone') }}"
                                maxlength="25"
                                placeholder="08xxxxxxxxxx"
                                required>
                        </div>

                        <div class="mb-3">
                            <label for="alamat" class="form-label">
                                Alamat Jalan
                            </label>
                            <textarea
                                class="form-control"
                                id="alamat"
                                rows="3"
                                maxlength="1000"
                                placeholder="Nama jalan, nomor rumah, RT/RW, kelurahan, dan kecamatan"
                                required>{{ old('alamat_detail') }}</textarea>
                        </div>

                        <div class="row g-3">
                            <div class="col-12 col-md-6">
                                <label for="kota" class="form-label">
                                    Kota/Kabupaten
                                </label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="kota"
                                    value="{{ old('kota') }}"
                                    placeholder="Masukkan kota/kabupaten"
                                    required>
                            </div>

                            <div class="col-12 col-md-6">
                                <label for="kode_pos" class="form-label">
                                    Kode Pos
                                </label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="kode_pos"
                                    value="{{ old('kode_pos') }}"
                                    maxlength="5"
                                    inputmode="numeric"
                                    pattern="[0-9]{5}"
                                    placeholder="Contoh: 50123"
                                    required>
                            </div>
                        </div>

                        <input
                            type="hidden"
                            name="address"
                            id="addressFinal"
                            value="{{ old('address') }}">

                        <div class="mt-3">
                            <label for="notes" class="form-label">
                                Catatan Pesanan (opsional)
                            </label>
                            <textarea
                                class="form-control"
                                id="notes"
                                name="notes"
                                rows="2"
                                maxlength="1000"
                                placeholder="Contoh: Mohon dikemas dengan rapi">{{ old('notes') }}</textarea>
                        </div>
                    </div>
                </div>

                {{-- METODE PEMBAYARAN --}}
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body p-3 p-md-4">

                        <h5 class="fw-bold mb-3" style="color: #493123;">
                            <i class="bi bi-credit-card me-2"></i>
                            Metode Pembayaran
                        </h5>

                        <div class="form-check border rounded-3 p-3 ps-5">
                            <input
                                class="form-check-input"
                                type="radio"
                                name="pembayaran"
                                id="cod"
                                value="COD"
                                {{ old('pembayaran', 'COD') === 'COD' ? 'checked' : '' }}
                                required>

                            <label class="form-check-label w-100" for="cod">
                                <span class="fw-semibold">
                                    <i class="bi bi-cash me-2"></i>
                                    Bayar di Tempat (COD)
                                </span>

                                <div class="small text-secondary mt-1">
                                    Bayar ketika pesanan diterima.
                                </div>
                            </label>
                        </div>

                    </div>
                </div>
            </div>

            {{-- RINGKASAN PESANAN --}}
            <div class="col-12 col-lg-4">
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body p-3 p-md-4">

                        <h5 class="fw-bold mb-4" style="color: #493123;">
                            Ringkasan Pesanan
                        </h5>

                        @foreach ($cart as $item)
                            <div class="d-flex align-items-center gap-3 mb-3">

                                @php
                                    $gambar = $item['image'] ?? null;
                                    $gambarUrl = null;

                                    if ($gambar) {
                                        if (filter_var($gambar, FILTER_VALIDATE_URL)) {
                                            $gambarUrl = $gambar;
                                        } elseif (
                                            str_starts_with($gambar, 'storage/') ||
                                            str_starts_with($gambar, 'images/')
                                        ) {
                                            $gambarUrl = asset($gambar);
                                        } elseif (str_starts_with($gambar, '/')) {
                                            $gambarUrl = asset(ltrim($gambar, '/'));
                                        } else {
                                            $gambarUrl = asset('images/' . $gambar);
                                        }
                                    }
                                @endphp

                                @if ($gambarUrl)
                                    <img
                                        src="{{ $gambarUrl }}"
                                        alt="{{ $item['name'] }}"
                                        class="rounded-3 flex-shrink-0"
                                        style="width:64px;height:64px;object-fit:cover;background:#f5ece5;"
                                        onerror="this.style.display='none';this.nextElementSibling.style.display='flex';">

                                    <div
                                        class="rounded-3 flex-shrink-0 align-items-center justify-content-center"
                                        style="display:none;width:64px;height:64px;background:#f5ece5;">
                                        <i class="bi bi-cup-hot fs-3" style="color:#795548;"></i>
                                    </div>
                                @else
                                    <div
                                        class="rounded-3 d-flex align-items-center justify-content-center flex-shrink-0"
                                        style="width:64px;height:64px;background:#f5ece5;">
                                        <i class="bi bi-cup-hot fs-3" style="color:#795548;"></i>
                                    </div>
                                @endif

                                <div class="flex-grow-1" style="min-width:0;">
                                    <div class="fw-semibold text-break">
                                        {{ $item['name'] }}
                                    </div>

                                    <small class="text-secondary">
                                        {{ $item['quantity'] }} produk ×
                                        Rp{{ number_format($item['price'], 0, ',', '.') }}
                                    </small>
                                </div>

                                <span class="fw-semibold text-nowrap">
                                    Rp{{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}
                                </span>
                            </div>
                        @endforeach

                        <hr>

                        <div class="d-flex justify-content-between gap-3 mb-3">
                            <span class="text-secondary">Subtotal</span>
                            <span class="fw-semibold text-nowrap">
                                Rp{{ number_format($total, 0, ',', '.') }}
                            </span>
                        </div>

                        <div class="d-flex justify-content-between gap-3 mb-3">
                            <span class="text-secondary">Ongkos kirim</span>
                            <span>Rp0</span>
                        </div>

                        <hr>

                        <div class="d-flex justify-content-between align-items-start gap-3 mb-4">
                            <span class="fw-bold">Total Pembayaran</span>
                            <span class="fw-bold text-nowrap" style="color:#795548;">
                                Rp{{ number_format($total, 0, ',', '.') }}
                            </span>
                        </div>

                        <button type="submit" class="btn btn-cokelat w-100 py-2">
                            Buat Pesanan
                            <i class="bi bi-arrow-right ms-1"></i>
                        </button>

                        <a
                            href="{{ route('cart.index') }}"
                            class="btn btn-outline-secondary w-100 mt-2">
                            <i class="bi bi-arrow-left me-1"></i>
                            Kembali ke Keranjang
                        </a>

                        <p class="small text-secondary mt-3 mb-0">
                            <i class="bi bi-shield-check me-1"></i>
                            Periksa kembali alamat dan jumlah pesanan sebelum melanjutkan.
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </form>
</div>

<script>
    document.getElementById('formCheckout').addEventListener('submit', function (event) {
        const alamat = document.getElementById('alamat').value.trim();
        const kota = document.getElementById('kota').value.trim();
        const kodePos = document.getElementById('kode_pos').value.trim();
        const addressFinal = document.getElementById('addressFinal');

        if (!alamat || !kota || !/^[0-9]{5}$/.test(kodePos)) {
            event.preventDefault();
            return;
        }

        addressFinal.value = `${alamat}, ${kota}, Kode Pos ${kodePos}`;
    });
</script>
@endsection
