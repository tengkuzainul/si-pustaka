@extends('layouts.landing-page.app', ['title' => 'Beranda'])

@section('content')
    <section id="billboard">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <button class="prev slick-arrow">
                        <i class="icon icon-arrow-left"></i>
                    </button>
                    <div class="main-slider pattern-overlay">
                        @forelse ($carouselsBooks as $item)
                            <div class="slider-item">
                                <div class="banner-content">
                                    <h2 class="banner-title">{{ $item->nama_buku }}</h2>
                                    <p>{!! $item->sinopsis !!}</p>
                                    <div class="btn-wrap">
                                        <a href="{{ route('book.catalog') }}"
                                            class="btn btn-outline-accent btn-accent-arrow">Read More<i
                                                class="icon icon-ns-arrow-right"></i></a>
                                    </div>
                                </div><!--banner-content-->
                                <img src="{{ Storage::url($item->gambar_buku) }}" alt="banner" class="banner-image">
                            </div><!--slider-item-->
                        @empty
                            <div class="slider-item">
                                <div class="banner-content">
                                    <h2 class="banner-title">Buku Belum Tersedia</h2>
                                    <p>Harap Menuggu Pihak Sistem Informasi Perpustakaan Untuk Melakukan Proses Input Buku
                                        Yang Anda Cari 🙏🏻.</p>
                                    <div class="btn-wrap">
                                        <a href="{{ url('/') }}" class="btn btn-outline-accent btn-accent-arrow">Read
                                            More<i class="icon icon-ns-arrow-right"></i></a>
                                    </div>
                                </div><!--banner-content-->
                                <img src="{{ asset('assets/no-image.png') }}" alt="banner" class="banner-image w-25">
                            </div><!--slider-item-->
                        @endforelse
                    </div><!--slider-->
                    <button class="next slick-arrow">
                        <i class="icon icon-arrow-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </section>

    <section id="featured-books" class="py-5 my-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-header align-center">
                        <div class="title">
                            <span>Buku Yang Kami Sediakan</span>
                        </div>
                        <h2 class="section-title">Buku Terbaik</h2>
                    </div>
                    <div class="product-list" data-aos="fade-up">
                        <div class="row">
                            @forelse ($books as $book)
                                <div class="col-md-3">
                                    <div class="product-item">
                                        <figure class="product-style">
                                            <img src="{{ Storage::url($book->gambar_buku) }}" alt="{{ $book->gambar_buku }}"
                                                class="product-item">
                                            <button type="button" class="add-to-cart"
                                                onclick="window.location.href='{{ route('book.detail', $book->id) }}'">Book
                                                Detail</button>
                                        </figure>
                                        <figcaption>
                                            <h3>{{ $book->nama_buku }}</h3>
                                            <span>{{ $book->kategoriBuku->nama_kategori }}</span>
                                            <div class="item-price">
                                                {{ $book->stok_buku === 0 ? 'Buku Habis.' : number_format($book->stok_buku) . ' Pcs' }}
                                                &mdash; {{ $book->stok_buku > 0 ? 'Bisa Dipinjam' : 'Habis' }}
                                            </div>
                                        </figcaption>
                                    </div>
                                </div>
                            @empty
                                <div class="col-md-12">
                                    <div class="product-item">
                                        <div class="border border-dark">
                                            <div class="h1 text-center">
                                                <h1 class="text-center text-body">Buku Belum Tersedia.</h1>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforelse
                        </div><!--ft-books-slider-->
                    </div><!--grid-->

                    <div class="row">
                        <div class="col-md-12">
                            <div class="btn-wrap align-right">
                                <a href="{{ route('book.catalog') }}" class="btn-accent-arrow">Liat Semua Buku <i
                                        class="icon icon-ns-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="popular-books" class="bookshelf py-5 my-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-header align-center">
                        <div class="title">
                            <span>Buku Yang Kami Sedaiakan</span>
                        </div>
                        <h2 class="section-title">Buku Yang Paling Populer</h2>
                    </div>
                    <ul class="tabs">
                        @foreach ($bookCategories as $category)
                            <li data-tab-target="#{{ Str::slug($category->nama_kategori) }}"
                                class="tab @if ($loop->first) active @endif"
                                style="text-transform: uppercase">
                                {{ $category->nama_kategori }}
                            </li>
                        @endforeach
                    </ul>
                    <div class="tab-content">
                        @foreach ($bookCategories as $category)
                            <div id="{{ Str::slug($category->nama_kategori) }}" data-tab-content
                                class="@if ($loop->first) active @endif">
                                <div class="row">
                                    @forelse ($category->buku as $book)
                                        <div class="col-md-3">
                                            <div class="product-item">
                                                <figure class="product-style">
                                                    <img src="{{ Storage::url($book->gambar_buku) }}" alt="Book"
                                                        class="product-item">
                                                    <button type="button"
                                                        onclick="window.location.href='{{ route('book.detail', $book->id) }}'"
                                                        class="add-to-cart">Book Detail</button>
                                                </figure>
                                                <figcaption>
                                                    <h3>{{ $book->nama_buku }}</h3>
                                                    <span>{{ $book->kategoriBuku->nama_kategori }}</span>
                                                    <div class="item-price">
                                                        {{ $book->stok_buku == 0 ? 'Buku Habis.' : number_format($book->stok_buku) . ' Pcs' }}
                                                        &mdash; {{ $book->stok_buku == 0 ? 'Habis' : 'Bisa Dipinjam' }}
                                                    </div>
                                                </figcaption>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="col-md-12">
                                            <div class="product-item">
                                                <div class="border border-dark">
                                                    <div class="h1 text-center">
                                                        <h1 class="text-center text-body">Buku Belum Tersedia.</h1>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div><!--inner-tabs-->
            </div>
        </div>
    </section>

    <section id="quotation" class="align-center pb-5 mb-5">
        <div class="inner-content">
            <h2 class="section-title divider">Kutipan Dari Seseorang</h2>
            <blockquote data-aos="fade-up">
                <q>“Semakin banyak Anda membaca, semakin banyak hal yang Anda ketahui. Semakin banyak Anda belajar, semakin
                    banyak tempat yang akan Anda kunjungi.”</q>
                <div class="author-name">Dr. Seuss</div>
            </blockquote>
        </div>
    </section>

    <section id="subscribe">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="title-element">
                                <h2 class="section-title divider">Berlangganan buletin kami</h2>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="subscribe-content" data-aos="fade-up">
                                <p>Dapatkan berita terbaru, tips eksklusif, dan penawaran spesial langsung di kotak masuk
                                    Anda. Jangan lewatkan informasi menarik setiap minggunya!</p>
                                <form id="form">
                                    <input type="text" name="email" placeholder="Masukkan email Anda...">
                                    <button class="btn-subscribe">
                                        <span>kirim</span>
                                        <i class="icon icon-send"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
