@extends('layouts.landing-page.app', ['title' => 'Books Detail'])

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
                                    style="font-weight: bold; text-transform: capitalize">{{ $detail->stok_buku != 0 ? 'Tidak Bisa Dipinjam.' : 'Bisa Dipinjam.' }}</span>
                            </li>
                        </ul>

                        <div class="d-flex gap-3">
                            <button type="submit" class="button m-0">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-whatsapp" viewBox="0 0 16 16">
                                    <path
                                        d="M13.601 2.326A7.85 7.85 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.9 7.9 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.9 7.9 0 0 0 13.6 2.326zM7.994 14.521a6.6 6.6 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.56 6.56 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592m3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.73.73 0 0 0-.529.247c-.182.198-.691.677-.691 1.654s.71 1.916.81 2.049c.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232" />
                                </svg>&nbsp; Info More
                            </button>
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
