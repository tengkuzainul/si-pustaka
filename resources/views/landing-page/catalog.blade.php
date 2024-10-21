@extends('layouts.landing-page.app', ['title' => 'Books Catalog'])

@section('content')
    <div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="colored">
                        <h1 class="page-title">Book Catalog</h1>
                        <div class="breadcum-items">
                            <span class="item"><a href="{{ url('/') }}">Home /</a></span>
                            <span class="item colored">Catalog</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!--site-banner-->

    <section class="padding-medium">
        <div class="container">
            <div class="row">

                @forelse ($books as $book)
                    <div class="col-md-3">
                        <div class="product-item">
                            <figure class="product-style">
                                <img src="{{ Storage::url($book->gambar_buku) }}" alt="Books" class="product-item">
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

            <div class="row">

                <div class="pagination justify-content-center">
                    {{ $books->links('pagination::bootstrap-4') }}
                </div>
            </div>

        </div>
    </section>
@endsection
