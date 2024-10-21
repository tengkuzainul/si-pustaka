@extends('layouts.dashboard.app', ['title' => 'Books'])

@section('content')
    <div class="container-fluid">

        <!-- start page title -->
        <div class="page-title-box">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h6 class="page-title">Show Book</h6>
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('users') }}">Books Management</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Show</li>
                    </ol>
                </div>

                <div class="col-md-4">
                    <div class="float-end d-none d-md-block">
                        <div class="dropdown">
                            <button class="btn btn-primary  dropdown-toggle" type="button" id="dropdownMenuButton"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="mdi mdi-book-variant me-2"></i> Create Books
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="{{ route('buku.create') }}">Add New Data</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Cover Book Image</h4>
                        <div class="d-flex justify-content-center my-3">
                            <a class="image-popup-vertical-fit" href="{{ Storage::url($buku->gambar_buku) }}"
                                title="Book Cover {{ $buku->nama_buku }}">
                                <img class="img-fluid" alt="" src="{{ Storage::url($buku->gambar_buku) }}"
                                    width="350">
                            </a>
                        </div>
                    </div>
                </div>
            </div> <!-- end col -->

            <div class="col-7">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Book Information</h4>
                        <div class="d-flex flex-column my-3">
                            <div class="row align-items-center">
                                <div class="col-xl-3">
                                    <p class="text-body fw-medium">Book Name</p>
                                    <p class="text-body fw-medium">Book Category</p>
                                    <p class="text-body fw-medium">ISBN</p>
                                    <p class="text-body fw-medium">Publisher</p>
                                    <p class="text-body fw-medium">Publish Date</p>
                                    <p class="text-body fw-medium">Book Stock</p>
                                    <p class="text-body fw-medium">Status</p>
                                    <p class="text-body fw-medium">Sinopsis</p>
                                </div>
                                <div class="col-xl-9">
                                    <p class="text-body fw-medium"><span class="me-2">:</span> {{ $buku->nama_buku }}</p>
                                    <p class="text-body fw-medium"><span class="me-2">:</span>
                                        {{ $buku->kategoriBuku->nama_kategori }}</p>
                                    <p class="text-body fw-medium"><span class="me-2">:</span> {{ $buku->isbn }}</p>
                                    <p class="text-body fw-medium"><span class="me-2">:</span> {{ $buku->penerbit }}</p>
                                    <p class="text-body fw-medium"><span class="me-2">:</span> {{ $buku->tahun_terbit }}
                                    </p>
                                    <p class="text-body fw-medium"><span class="me-2">:</span> {{ $buku->stok_buku }}</p>
                                    <p class="text-body fw-medium"><span class="me-2">:</span>
                                        {{ $buku->stok_buku != 0 ? 'Ready' : 'Not Ready' }}</p>
                                </div>
                                <div class="col-xl-12 mt-3">
                                    {!! $sinopsis !!}
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- end col -->
        </div>
    </div>
@endsection
