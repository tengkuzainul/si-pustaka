@extends('layouts.dashboard.app', ['title' => 'Books'])

@section('content')
    <div class="container-fluid">

        <!-- start page title -->
        <div class="page-title-box">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h6 class="page-title">Books</h6>
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('buku') }}">Books Management</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit</li>
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

        <form class="needs-validation" novalidate action="{{ route('buku.update', $buku->id) }}" method="POST"
            enctype="multipart/form-data" id="form-create-books">
            @csrf
            <div class="row">
                <div class="col-9">
                    <div class="card">


                        <div class="card-body">
                            <h4 class="card-title">Form Edit Books</h4>
                            <div class="row align-items-center g-3 mt-3">

                                <div class="col-md-6">
                                    <label for="nama_buku" class="form-label">Book Name</label>
                                    <input type="text" name="nama_buku"
                                        class="form-control @error('nama_buku') is-invalid @enderror"
                                        value="{{ old('nama_buku', $buku->nama_buku) }}" id="nama_buku"
                                        placeholder="Book Name">

                                    @error('nama_buku')
                                        <div class="valid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="tahun_terbit" class="form-label">Publish Date</label>
                                    <div class="input-group" id="datepicker2">
                                        <input type="text" name="tahun_terbit"
                                            class="form-control @error('tahun_terbit') is-invalid @enderror"
                                            placeholder="dd M, yyyy" data-date-format="yyyy-mm-dd"
                                            value="{{ old('tahun_terbit', $buku->tahun_terbit) }}"
                                            data-date-container='#datepicker2' data-provide="datepicker"
                                            data-date-autoclose="true">

                                        <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                    </div>

                                    @error('tahun_terbit')
                                        <div class="valid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="isbn" class="form-label">ISBN</label>
                                    <input type="text" name="isbn"
                                        class="form-control @error('isbn') is-invalid @enderror"
                                        value="{{ old('isbn', $buku->isbn) }}" id="isbn" placeholder="ISBN">

                                    @error('isbn')
                                        <div class="valid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="penerbit" class="form-label">Publisher</label>
                                    <input type="text" name="penerbit"
                                        class="form-control @error('penerbit') is-invalid @enderror"
                                        value="{{ old('penerbit', $buku->penerbit) }}" id="penerbit"
                                        placeholder="Publisher">

                                    @error('penerbit')
                                        <div class="valid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="stok_buku" class="form-label">Book Stock</label>
                                    <input type="number" name="stok_buku"
                                        class="form-control @error('stok_buku') is-invalid @enderror"
                                        value="{{ old('stok_buku', $buku->stok_buku) }}" id="stok_buku"
                                        placeholder="Book Stock">

                                    @error('stok_buku')
                                        <div class="valid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label" for="kategori_buku_id">Select Book Category</label>
                                    <select
                                        class="form-control @error('kategori_buku_id') is-invalid @enderror text-dark select2"
                                        name="kategori_buku_id">
                                        <option disabled selected>Select</option>
                                        <optgroup label="Book Category">
                                            @foreach ($kategori as $kat)
                                                <option value="{{ $kat->id }}" class="text-dark"
                                                    {{ old('kategori_buku_id', $buku->kategori_buku_id) == $kat->id ? 'selected' : '' }}>
                                                    {{ $kat->nama_kategori }}
                                                </option>
                                            @endforeach
                                        </optgroup>
                                    </select>

                                    @error('kategori_buku_id')
                                        <div class="valid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-md-12">
                                    <label for="sinopsis" class="form-label">Sinopsis</label>
                                    <textarea id="elm1" name="sinopsis">{{ $buku->sinopsis }}</textarea>

                                    @error('stok_buku')
                                        <div class="valid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="card-footer">
                            <div class="d-flex justify-content-between align-items-center">
                                <button type="reset" class="btn btn-primary px-3"><i
                                        class="mdi mdi-rotate-right me-2"></i>Reset</button>
                                <div class="d-flex align-items-center gap-2">
                                    <button type="submit" class="btn btn-success px-3"><i
                                            class="mdi mdi-check-circle me-2"></i>Save Data</button>

                                    <button type="submit" class="btn btn-outline-success px-3"
                                        name="updateRedirectBack"><i class="mdi mdi-image me-2"></i>Update Image</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- end col -->

                <div class="col-3">
                    <div class="card">


                        <div class="card-body">
                            <h4 class="card-title">Cover Books Old</h4>
                            <div class="d-flex justify-content-center my-3">
                                <a class="image-popup-vertical-fit" href="{{ Storage::url($buku->gambar_buku) }}"
                                    title="Book Cover {{ $buku->nama_buku }}">
                                    <img class="img-fluid" alt="" src="{{ Storage::url($buku->gambar_buku) }}"
                                        width="145">
                                </a>
                            </div>
                            <div class="row my-3">
                                <div class="col-md-12">
                                    <label class="form-label" for="gambar_buku">Book Cover Update</label>
                                    <input type="file" name="gambar_buku" id="gambar_buku"
                                        class="filestyle @error('gambar_buku') is-invalid @enderror"
                                        data-buttonname="btn-secondary">

                                    @error('gambar_buku')
                                        <div class="valid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>

    </div>
@endsection
