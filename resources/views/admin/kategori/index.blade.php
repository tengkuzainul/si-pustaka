@extends('layouts.dashboard.app', ['title' => 'Kategori Buku'])

@section('content')
    <div class="container-fluid">

        <!-- Judul Halaman -->
        <div class="page-title-box">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h6 class="page-title">Kategori Buku</h6>
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Beranda</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('kategori') }}">Manajemen Buku</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Data</li>
                    </ol>
                </div>

                <div class="col-md-4">
                    <div class="float-end d-none d-md-block">
                        <div class="dropdown">
                            <button class="btn btn-primary" type="button" id="modalCreated" data-bs-toggle="modal"
                                data-bs-target="#modalCreateCategory">
                                <i class="mdi mdi-book-variant me-2"></i> Tambah Kategori Buku
                            </button>
                        </div>
                    </div>

                    <!-- Modal Tambah Kategori Buku -->
                    <div class="modal fade" id="modalCreateCategory" data-bs-backdrop="static" data-bs-keyboard="false"
                        tabindex="-1" aria-labelledby="modalCreateCategoryLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalCreateCategoryLabel">Form Tambah Kategori Buku</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Tutup"></button>
                                </div>
                                <form action="{{ route('kategori.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="row align-items-center">
                                            <div class="col-md-12">
                                                <label for="nama_kategori" class="form-label">Nama Kategori Buku</label>
                                                <input type="text" name="nama_kategori"
                                                    class="form-control @error('nama_kategori') is-invalid @enderror"
                                                    value="{{ old('nama_kategori') }}" id="nama_kategori"
                                                    placeholder="Masukkan Nama Kategori Buku" autofocus>
                                                @error('nama_kategori')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="reset" class="btn btn-secondary">
                                            <i class="mdi mdi-rotate-right me-2"></i>Reset
                                        </button>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="mdi mdi-check-circle me-2"></i>Simpan Data
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- /.modal -->
                </div>
            </div>
        </div>
        <!-- Akhir Judul Halaman -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Daftar Semua Kategori Buku</h4>
                        <div class="table-responsive mb-3 mt-4">
                            <table id="datatable" class="table table-bordered dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Kategori Buku</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($bookCategories as $key => $category)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <span class="badge bg-{{ $key % 2 == 0 ? 'primary' : 'info' }}">
                                                    {{ $category->nama_kategori }}
                                                </span>
                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-center align-items-center gap-2">
                                                    <a href="#" class="btn btn-warning" data-bs-toggle="modal"
                                                        data-bs-target="#modalUpdated-{{ $category->id }}">
                                                        <i class="fa fa-edit"></i> Edit
                                                    </a>
                                                    <a href="{{ route('kategori.destroy', $category->id) }}"
                                                        class="btn btn-danger" data-confirm-delete="true">
                                                        <i class="fa fa-trash"></i> Hapus
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>

                                        <!-- Modal Edit Kategori Buku -->
                                        <div class="modal fade" id="modalUpdated-{{ $category->id }}"
                                            data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                            aria-labelledby="modalUpdatedLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="modalUpdatedLabel">Edit Kategori Buku
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Tutup"></button>
                                                    </div>
                                                    <form action="{{ route('kategori.update', $category->id) }}"
                                                        method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-body">
                                                            <div class="row align-items-center">
                                                                <div class="col-md-12">
                                                                    <label for="nama_kategori" class="form-label">Nama
                                                                        Kategori Buku</label>
                                                                    <input type="text" name="nama_kategori"
                                                                        class="form-control @error('nama_kategori') is-invalid @enderror"
                                                                        value="{{ old('nama_kategori', $category->nama_kategori) }}"
                                                                        id="nama_kategori"
                                                                        placeholder="Masukkan Nama Kategori Buku"
                                                                        autofocus>
                                                                    @error('nama_kategori')
                                                                        <div class="invalid-feedback">
                                                                            {{ $message }}
                                                                        </div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="reset" class="btn btn-secondary">
                                                                <i class="mdi mdi-rotate-right me-2"></i>Reset
                                                            </button>
                                                            <button type="submit" class="btn btn-primary">
                                                                <i class="mdi mdi-check-circle me-2"></i>Simpan Data
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.modal -->
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->
    </div> <!-- end container-fluid -->
@endsection
