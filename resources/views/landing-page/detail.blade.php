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
                                            <form class="needs-validation" novalidate
                                                action="{{ route('siswa.peminjaman.store') }}" method="POST"
                                                enctype="multipart/form-data" id="form-create-books">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <div class="d-flex justify-content-start gap-4">
                                                            <div>
                                                                <img src="{{ Storage::url($detail->gambar_buku) }}"
                                                                    alt="detail" style="width: 150px">
                                                            </div>
                                                            <div class="list-group">
                                                                <span>{{ $detail->kategoriBuku->nama_kategori }}</span>
                                                                <h5>{{ $detail->nama_buku }}</h5>
                                                                <ul>
                                                                    <li>Nomor ISBN : <span
                                                                            style="font-weight: bold; text-transform: capitalize">{{ $detail->isbn }}</span>
                                                                    </li>
                                                                    <li>Stok Buku : <span
                                                                            style="font-weight: bold; text-transform: capitalize">{{ $detail->stok_buku != 0 ? number_format($detail->stok_buku) : 'Buku Habis.' }}</span>
                                                                    </li>
                                                                    <li>Status : <span
                                                                            style="font-weight: bold; text-transform: capitalize">{{ $detail->stok_buku === 0 ? 'Tidak Bisa Dipinjam.' : 'Bisa Dipinjam.' }}</span>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Add the buku_id input here -->
                                                    <input type="hidden" name="buku_id" value="{{ $detail->id }}">

                                                    <div class="row align-items-center g-4">
                                                        <div class="col-md-4">
                                                            <label for="borrowing_date" class="form-label">Tanggal
                                                                Peminjaman</label>
                                                            <input type="date" name="borrowing_date"
                                                                class="form-control @error('borrowing_date') is-invalid @enderror"
                                                                placeholder="dd M, yyyy"
                                                                value="{{ old('borrowing_date', now()->format('Y-m-d')) }}"
                                                                readonly>
                                                            @error('borrowing_date')
                                                                <div class="valid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>

                                                        <div class="col-md-4">
                                                            <label for="return_date" class="form-label">Tanggal
                                                                Pengembalian</label>
                                                            <input type="date" name="return_date"
                                                                class="form-control @error('return_date') is-invalid @enderror"
                                                                placeholder="dd M, yyyy" value="{{ old('return_date') }}">
                                                            @error('return_date')
                                                                <div class="valid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>

                                                        <div class="col-md-4">
                                                            <label for="qty" class="form-label">Jumlah Dipinjam</label>
                                                            <input type="number" name="qty"
                                                                class="form-control @error('qty') is-invalid @enderror"
                                                                placeholder="Jumlah Peminjaman" value="{{ old('qty') }}">
                                                            @error('qty')
                                                                <div class="valid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary rounded"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary rounded">Save changes</button>
                                                </div>
                                            </form>

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
