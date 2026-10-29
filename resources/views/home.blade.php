@extends('layouts.app')

@section('title', 'Beranda | Doyan Makan')

@section('content')

<style>
    .home-page {
        background: #fffaf2;
        color: #493123;
    }

    .home-banner {
        background: #ead8c0;
        border-radius: 22px;
        padding: 48px;
    }

    .home-heading {
        color: #493123;
    }

    .btn-cokelat {
        background: #795548;
        border: 1px solid #795548;
        color: white;
    }

    .btn-cokelat:hover {
        background: #493123;
        border-color: #493123;
        color: white;
    }

    .btn-filter {
        border-radius: 30px;
        padding: 8px 20px;
    }

    .feature-card {
        background: white;
        border: 1px solid #f0e6da;
        border-radius: 16px;
        padding: 22px;
        height: 100%;
    }

    .feature-icon {
        color: #795548;
        font-size: 32px;
    }

    .menu-card {
        background: white;
        border: 1px solid #f0e6da;
        border-radius: 18px;
        height: 100%;
        overflow: hidden;
        transition: transform .2s ease, box-shadow .2s ease;
    }

    .menu-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 28px rgba(73, 49, 35, .12);
    }

    .menu-photo {
        display: block;
        width: 100%;
        height: 205px;
        object-fit: cover;
        background: #ead8c0;
    }

    .menu-category {
        display: inline-block;
        background: #ead8c0;
        color: #493123;
        border-radius: 7px;
        padding: 5px 10px;
        font-size: 12px;
        font-weight: 600;
    }

    .menu-name {
        color: #30251e;
        font-size: 19px;
        font-weight: 700;
    }

    .menu-description {
        color: #777;
        font-size: 14px;
        min-height: 42px;
    }

    .menu-price {
        color: #795548;
        font-size: 17px;
        font-weight: 700;
    }

    .menu-search {
        max-width: 460px;
        margin: 0 auto;
    }

    .menu-cta {
        background: #493123;
        color: white;
        border-radius: 20px;
    }

    @media (max-width: 576px) {
        .home-banner {
            padding: 28px 20px;
        }

        .menu-photo {
            height: 160px;
        }

        .menu-name {
            font-size: 16px;
        }

        .menu-description {
            font-size: 12px;
            min-height: 48px;
        }

        .menu-price {
            font-size: 15px;
        }

        .feature-card {
            padding: 18px;
        }
    }
</style>

<div class="home-page">
    <div class="container py-4 py-md-5">

        {{-- BANNER UTAMA --}}
        <section class="home-banner mb-5">
            <div class="row align-items-center g-4">

                <div class="col-12 col-lg-8">
                    <span class="badge rounded-pill px-3 py-2"
                          style="background:#795548;">
                        <i class="bi bi-cup-hot me-1"></i>
                        WELCOME TO DOYAN MAKAN
                    </span>

                    <h1 class="display-5 fw-bold home-heading mt-3">
                        Camilan Favorit,<br>
                        Teman Setiap Hari.
                    </h1>

                    <p class="fs-5 text-secondary mt-3">
                        Nikmati bakery, dessert, dan minuman favoritmu
                        dengan pilihan menu yang beragam.
                    </p>

                    <a href="#menu"
                       class="btn btn-cokelat rounded-pill px-4 py-2 mt-2">
                        <i class="bi bi-bag-heart me-2"></i>
                        Jelajahi Menu
                    </a>
                </div>

                <div class="col-12 col-lg-4 text-center">
                    <div class="bg-white rounded-4 p-4 shadow-sm">
                        <i class="bi bi-cake2-fill"
                           style="font-size:100px;color:#795548;"></i>

                        <h4 class="fw-bold mt-3">Doyan Makan</h4>

                        <p class="text-secondary mb-0">
                            Teman santai untuk setiap harimu.
                        </p>
                    </div>
                </div>

            </div>
        </section>

        {{-- KEUNGGULAN --}}
        <section class="row g-3 mb-5">

            <div class="col-12 col-md-4">
                <div class="feature-card">
                    <i class="bi bi-cake2 feature-icon"></i>
                    <h5 class="fw-bold mt-3">Menu Beragam</h5>
                    <p class="text-secondary mb-0">
                        Pilihan bakery, dessert, dan minuman favorit.
                    </p>
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="feature-card">
                    <i class="bi bi-heart feature-icon"></i>
                    <h5 class="fw-bold mt-3">Pilihan Spesial</h5>
                    <p class="text-secondary mb-0">
                        Temukan camilan untuk menemani waktu santaimu.
                    </p>
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="feature-card">
                    <i class="bi bi-cart-check feature-icon"></i>
                    <h5 class="fw-bold mt-3">Mudah Dipesan</h5>
                    <p class="text-secondary mb-0">
                        Pilih menu favorit dan siapkan pesananmu.
                    </p>
                </div>
            </div>

        </section>

        {{-- MENU DARI DATABASE --}}
        <section id="menu" class="py-3">

            <div class="text-center mb-4">
                <span class="text-uppercase"
                      style="letter-spacing:3px;color:#795548;">
                    Pilihan Favorit
                </span>

                <h2 class="fw-bold home-heading mt-2">
                    Menu Doyan Makan
                </h2>

                <p class="text-secondary">
                    Ada yang manis, gurih, sampai minuman segar.
                </p>
            </div>

            {{-- PENCARIAN --}}
            <div class="menu-search mb-4">
                <div class="input-group">
                    <span class="input-group-text bg-white">
                        <i class="bi bi-search" style="color:#795548;"></i>
                    </span>

                    <input type="text"
                           id="cariMenu"
                           class="form-control"
                           placeholder="Cari makanan atau minuman...">
                </div>
            </div>

            {{-- FILTER KATEGORI --}}
            <div class="d-flex flex-wrap justify-content-center gap-2 mb-4">

                <button type="button"
                        class="btn btn-cokelat btn-filter filter-menu"
                        data-kategori="Semua">
                    Semua
                </button>

                <button type="button"
                        class="btn btn-outline-secondary btn-filter filter-menu"
                        data-kategori="Bakery">
                    Bakery
                </button>

                <button type="button"
                        class="btn btn-outline-secondary btn-filter filter-menu"
                        data-kategori="Dessert">
                    Dessert
                </button>

                <button type="button"
                        class="btn btn-outline-secondary btn-filter filter-menu"
                        data-kategori="Minuman">
                    Minuman
                </button>

            </div>

            {{-- KARTU PRODUK --}}
            <div class="row g-3 g-md-4" id="daftarMenu">

                @forelse ($menus as $menu)

                    @php
                        $kategori = $menu->category ?? 'Menu';

                        $namaGambar = $menu->image
                            ? basename($menu->image)
                            : null;

                        $pathGambar = $namaGambar
                            ? (str_contains($menu->image, '/')
                                ? $menu->image
                                : 'images/' . $namaGambar)
                            : null;
                    @endphp

                    <div class="col-6 col-md-4 col-lg-3 item-menu"
                         data-nama="{{ strtolower($menu->name) }}"
                         data-kategori="{{ $kategori }}">

                        <div class="menu-card d-flex flex-column">

                            @if ($pathGambar)
                                <img
                                    src="{{ asset($pathGambar) }}"
                                    alt="{{ $menu->name }}"
                                    class="menu-photo"
                                    loading="lazy"
                                    onerror="this.onerror=null;this.src='https://placehold.co/400x300/f3e8d8/795548?text=Foto+Produk';">
                            @else
                                <div class="menu-photo d-flex align-items-center justify-content-center">
                                    <i class="bi bi-cup-hot"
                                       style="font-size:55px;color:#795548;"></i>
                                </div>
                            @endif

                            <div class="p-3 d-flex flex-column flex-grow-1">

                                <span class="menu-category align-self-start mb-2">
                                    {{ $kategori }}
                                </span>

                                <h3 class="menu-name mb-2">
                                    {{ $menu->name }}
                                </h3>

                                <p class="menu-description mb-3">
                                    {{ $menu->description ?: 'Menu favorit Doyan Makan.' }}
                                </p>

                                {{-- HARGA DARI DATABASE --}}
                                <div class="menu-price mb-3">
                                    Rp{{ number_format($menu->price, 0, ',', '.') }}
                                </div>

                                {{-- MENGGUNAKAN ID PRODUK YANG BENAR --}}
                                <a href="{{ route('products.show', $menu->id) }}"
                                   class="btn btn-cokelat rounded-pill w-100 mt-auto">
                                    <i class="bi bi-bag-plus me-1"></i>
                                    Pesan
                                </a>

                            </div>
                        </div>
                    </div>

                @empty
                    <div class="col-12">
                        <div class="text-center bg-white rounded-4 p-5">
                            <i class="bi bi-basket2"
                               style="font-size:50px;color:#795548;"></i>

                            <h5 class="fw-bold mt-3">
                                Belum Ada Menu
                            </h5>

                            <p class="text-secondary mb-0">
                                Produk belum tersedia di database.
                            </p>
                        </div>
                    </div>
                @endforelse

            </div>

            <div id="menuTidakDitemukan"
                 class="text-center text-secondary py-5"
                 style="display:none;">
                <i class="bi bi-search fs-1"></i>
                <p class="mt-2">
                    Menu yang kamu cari tidak ditemukan.
                </p>
            </div>

        </section>

        {{-- AJAKAN MEMESAN --}}
        <section class="menu-cta text-center p-4 p-md-5 mt-5">
            <i class="bi bi-cup-hot-fill fs-1"></i>

            <h2 class="fw-bold mt-3">
                Sudah Menemukan Favoritmu?
            </h2>

            <p class="mb-4">
                Yuk, pilih menu kesukaanmu di Doyan Makan!
            </p>

            <a href="#menu"
               class="btn btn-light rounded-pill px-4"
               style="color:#493123;">
                Lihat Semua Menu
            </a>
        </section>

    </div>
</div>

{{-- PENCARIAN DAN FILTER --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    const pencarian = document.getElementById('cariMenu');
    const itemMenu = document.querySelectorAll('.item-menu');
    const tombolFilter = document.querySelectorAll('.filter-menu');
    const pesanKosong = document.getElementById('menuTidakDitemukan');

    let kategoriAktif = 'Semua';

    function filterMenu() {
        const kataKunci = pencarian.value.toLowerCase().trim();
        let jumlahTampil = 0;

        itemMenu.forEach(function (item) {
            const nama = item.dataset.nama || '';
            const kategori = item.dataset.kategori || '';

            const cocokNama = nama.includes(kataKunci);
            const cocokKategori =
                kategoriAktif === 'Semua' ||
                kategori.toLowerCase() === kategoriAktif.toLowerCase();

            if (cocokNama && cocokKategori) {
                item.style.display = '';
                jumlahTampil++;
            } else {
                item.style.display = 'none';
            }
        });

        if (pesanKosong) {
            pesanKosong.style.display =
                itemMenu.length > 0 && jumlahTampil === 0
                    ? 'block'
                    : 'none';
        }
    }

    pencarian.addEventListener('input', filterMenu);

    tombolFilter.forEach(function (tombol) {
        tombol.addEventListener('click', function () {
            kategoriAktif = this.dataset.kategori;

            tombolFilter.forEach(function (btn) {
                btn.classList.remove('btn-cokelat');
                btn.classList.add('btn-outline-secondary');
            });

            this.classList.remove('btn-outline-secondary');
            this.classList.add('btn-cokelat');

            filterMenu();
        });
    });
});
</script>

@endsection