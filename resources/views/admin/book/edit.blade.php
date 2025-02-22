@extends('layouts.dashboard.app', ['title' => 'Buku'])

@section('content')
    <div class="container-fluid">

        <!-- Judul Halaman -->
        <div class="page-title-box">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h6 class="page-title">Buku</h6>
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Beranda</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('buku') }}">Manajemen Buku</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Buku</li>
                    </ol>
                </div>

                <div class="col-md-4">
                    <div class="float-end d-none d-md-block">
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="mdi mdi-book-variant me-2"></i> Tambah Buku
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="{{ route('buku.create') }}">Tambah Data Baru</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <form class="needs-validation" novalidate action="{{ route('buku.update', $buku->id) }}" method="POST"
            enctype="multipart/form-data" id="form-edit-buku">
            @csrf
            <div class="row">
                <div class="col-9">
                    <div class="card">

                        <div class="card-body">
                            <h4 class="card-title">Formulir Edit Buku</h4>
                            <div class="row align-items-center g-3 mt-3">

                                <div class="col-md-6">
                                    <label for="nama_buku" class="form-label">Judul Buku</label>
                                    <input type="text" name="nama_buku"
                                        class="form-control @error('nama_buku') is-invalid @enderror"
                                        value="{{ old('nama_buku', $buku->nama_buku) }}" id="nama_buku"
                                        placeholder="Masukkan Judul Buku">
                                    @error('nama_buku')
                                        <div class="valid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="tahun_terbit" class="form-label">Tanggal Terbit</label>
                                    <div class="input-group" id="datepicker2">
                                        <input type="text" name="tahun_terbit"
                                            class="form-control @error('tahun_terbit') is-invalid @enderror"
                                            placeholder="yyyy-mm-dd" data-date-format="yyyy-mm-dd"
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
                                        value="{{ old('isbn', $buku->isbn) }}" id="isbn" placeholder="Masukkan ISBN">
                                    @error('isbn')
                                        <div class="valid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="penerbit" class="form-label">Penerbit</label>
                                    <input type="text" name="penerbit"
                                        class="form-control @error('penerbit') is-invalid @enderror"
                                        value="{{ old('penerbit', $buku->penerbit) }}" id="penerbit"
                                        placeholder="Masukkan Nama Penerbit">
                                    @error('penerbit')
                                        <div class="valid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="stok_buku" class="form-label">Stok Buku</label>
                                    <input type="number" name="stok_buku"
                                        class="form-control @error('stok_buku') is-invalid @enderror"
                                        value="{{ old('stok_buku', $buku->stok_buku) }}" id="stok_buku"
                                        placeholder="Masukkan Jumlah Stok">
                                    @error('stok_buku')
                                        <div class="valid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label" for="kategori_buku_id">Pilih Kategori Buku</label>
                                    <select
                                        class="form-control @error('kategori_buku_id') is-invalid @enderror text-dark select2"
                                        name="kategori_buku_id">
                                        <option disabled selected>Pilih Kategori</option>
                                        <optgroup label="Kategori Buku">
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
                                    @error('sinopsis')
                                        <div class="valid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success px-3"><i
                                    class="mdi mdi-check-circle me-2"></i>Simpan</button>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Cover Buku</h4>
                            <img class="img-fluid" src="{{ Storage::url($buku->gambar_buku) }}" width="145">
                            <input type="file" name="gambar_buku" class="form-control mt-3">
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
