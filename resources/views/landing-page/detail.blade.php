@extends('layouts.landing-page.app', ['title' => 'Detail Buku'])

@section('content')
    <section class="bg-sand padding-medium">
        <div class="container">
            <div class="row">

                <div class="col-md-5">
                    <a href="#" class="product-image"><img src="{{ Storage::url($detail->gambar_buku) }}"></a>
                </div>

                <div class="col-md-7 pl-5">
                    <div class="product-detail">
                        <span>{{ $detail->kategoriBuku->nama_kategori }}</span>
                        <h1>{{ $detail->nama_buku }}</h1>

                        <ul>
                            <li>Nomor ISBN : &nbsp;<span
                                    style="font-weight: bold; text-transform: capitalize">{{ $detail->isbn }}</span></li>
                            <li>Stok Buku : &nbsp;<span
                                    style="font-weight: bold; text-transform: capitalize">{{ $detail->stok_buku != 0 ? number_format($detail->stok_buku) : 'Buku Habis.' }}</span>
                            </li>
                            <li>Status : &nbsp;<span
                                    style="font-weight: bold; text-transform: capitalize">{{ $detail->stok_buku === 0 ? 'Tidak Bisa Dipinjam.' : 'Bisa Dipinjam.' }}</span>
                            </li>
                        </ul>

                        <div class="d-flex gap-3">
                            @guest
                                <button type="button" class="button m-0 rounded"
                                    onclick="window.location.href='{{ route('login') }}'">
                                    <i class="fa fa-paper-plane"></i>&nbsp; Ajukan Peminjaman Buku
                                </button>
                            @endguest
                            @auth
                                <button type="button" class="button m-0 rounded" data-bs-toggle="modal"
                                    data-bs-target="#modalPeminjaman">
                                    <i class="fa fa-paper-plane"></i>&nbsp; Ajukan Peminjaman Buku
                                </button>

                                <div class="modal fade" id="modalPeminjaman" tabindex="-1" aria-labelledby="exampleModalLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-lg modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-3" id="exampleModalLabel">Form Peminjaman Buku</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary rounded"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary rounded">Save changes</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endauth
                        </div>


                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="product-tabs mt-5">
        <div class="container">
            <div class="row">
                <div class="tabs-listing">
                    <nav>
                        <div class="nav nav-tabs d-flex justify-content-start" id="nav-tab" role="tablist">
                            <button class="nav-link active text-uppercase px-5 py-3" id="nav-home-tab" data-bs-toggle="tab"
                                data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home"
                                aria-selected="true">Sinopsis</button>
                        </div>
                    </nav>
                    <div class="tab-content py-5" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-home" role="tabpanel"
                            aria-labelledby="nav-home-tab">
                            <h5 style="text-transform: capitalize">{{ $detail->nama_buku }}</h5>
                            <p>{!! $detail->sinopsis !!}
                            <ul>
                                <li>Nomor ISBN : &nbsp;<span
                                        style="font-weight: bold; text-transform: capitalize">{{ $detail->isbn }}</span>
                                </li>
                                <li>Stok Buku : &nbsp;<span
                                        style="font-weight: bold; text-transform: capitalize">{{ $detail->stok_buku != 0 ? number_format($detail->stok_buku) : 'Buku Habis.' }}</span>
                                </li>
                                <li>Penerbit : &nbsp;<span
                                        style="font-weight: bold; text-transform: capitalize">{{ $detail->penerbit }}</span>
                                </li>
                                <li>Tahun Terbit : &nbsp;<span
                                        style="font-weight: bold; text-transform: capitalize">{{ $detail->tahun_terbit }}</span>
                                </li>
                            </ul>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
