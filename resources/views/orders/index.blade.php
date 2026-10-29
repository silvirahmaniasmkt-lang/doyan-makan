@extends('layouts.app')

@section('title', 'Riwayat Pesanan | Doyan Makan')

@section('content')
<div class="container py-5">
    <div class="mb-4">
        <h2 class="fw-bold" style="color: #493123;">
            Riwayat Pesanan
        </h2>
        <p class="text-muted">
            Semua pesanan yang pernah kamu buat ada di sini.
        </p>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($orders->isEmpty())
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body text-center py-5">
                <h5 class="fw-bold">Belum Ada Pesanan</h5>
                <p class="text-muted">
                    Kamu belum memiliki riwayat pesanan.
                </p>
                <a href="{{ route('home') }}"
                   class="btn text-white"
                   style="background-color: #795548;">
                    Lihat Menu
                </a>
            </div>
        </div>
    @else
        @foreach ($orders as $order)
            <div class="card border-0 shadow-sm rounded-4 mb-3">
                <div class="card-body p-4">
                    <div class="d-flex flex-wrap justify-content-between
                                align-items-center gap-3">
                        <div>
                            <h5 class="fw-bold mb-2">
                                Pesanan {{ $order->order_code }}
                            </h5>

                            <p class="text-muted mb-1">
                                {{ $order->created_at->format('d M Y, H:i') }}
                            </p>

                            <p class="mb-1">
                                Status:
                                <span class="badge bg-secondary">
                                    {{ $order->status }}
                                </span>
                            </p>

                            <p class="fw-bold mb-0">
                                Total:
                                Rp{{ number_format($order->total_price, 0, ',', '.') }}
                            </p>
                        </div>

                        <a href="{{ route('orders.show', $order) }}"
                           class="btn text-white"
                           style="background-color: #795548;">
                            Lihat Detail
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    @endif

    <a href="{{ route('profile.index') }}"
       class="btn btn-outline-secondary mt-3">
        Kembali ke Profil
    </a>
</div>
@endsection
