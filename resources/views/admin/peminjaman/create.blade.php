@extends('layouts.dashboard.app', ['title' => 'Peminjaman Buku'])

@section('content')
    <div class="container-fluid">
        <!-- Judul Halaman -->
        <div class="page-title-box">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h6 class="page-title">Peminjaman Buku</h6>
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Beranda</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('peminjaman') }}">Peminjaman Buku</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Tambah</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="row">
            <form class="needs-validation" novalidate action="{{ route('peminjaman.store') }}" method="POST"
                enctype="multipart/form-data" id="form-create-books">
                @csrf

                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Formulir Tambah Peminjaman</h4>
                            <div class="row align-items-center g-4 mt-3">
                                <div class="col-md-6">
                                    <label for="borrowing_date" class="form-label">Tanggal Peminjaman</label>
                                    <div class="input-group" id="datepicker2">
                                        <input type="text" name="borrowing_date"
                                            class="form-control @error('borrowing_date') is-invalid @enderror"
                                            placeholder="yyyy-mm-dd" data-date-format="yyyy-mm-dd"
                                            value="{{ old('borrowing_date') }}" data-date-container='#datepicker2'
                                            data-provide="datepicker" data-date-autoclose="true">
                                        <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                    </div>
                                    @error('borrowing_date')
                                        <div class="valid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="return_date" class="form-label">Tanggal Pengembalian</label>
                                    <div class="input-group" id="datepicker2">
                                        <input type="text" name="return_date"
                                            class="form-control @error('return_date') is-invalid @enderror"
                                            placeholder="yyyy-mm-dd" data-date-format="yyyy-mm-dd"
                                            value="{{ old('return_date') }}" data-date-container='#datepicker2'
                                            data-provide="datepicker" data-date-autoclose="true">
                                        <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                    </div>
                                    @error('return_date')
                                        <div class="valid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-md-12">
                                    <label class="form-label" for="user_id">Pilih Nama Siswa</label>
                                    <select class="form-control @error('user_id') is-invalid @enderror text-dark select2"
                                        name="user_id">
                                        <option disabled selected>Pilih</option>
                                        <optgroup label="Nama Anggota">
                                            @foreach ($siswas as $siswa)
                                                <option value="{{ $siswa->id }}" class="text-dark"
                                                    {{ old('user_id') == $siswa->id ? 'selected' : '' }}>
                                                    {{ $siswa->name }} | {{ $siswa->username }} |
                                                    {{ $siswa->siswaData->class }}
                                                </option>
                                            @endforeach
                                        </optgroup>
                                    </select>
                                    @error('user_id')
                                        <div class="valid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <div id="book-items">
                                        <div class="row mb-2 book-item">
                                            <div class="col-md-10 mb-2 mt-3">
                                                <label for="inputState" class="form-label">Buku</label>
                                                <select class="bukuSelect form-select form-control" name="buku_id[]"
                                                    required>
                                                    <option value="" selected disabled>Pilih Buku Yang Dipinjam
                                                    </option>
                                                    @foreach ($books as $book)
                                                        <option value="{{ $book->id }}">
                                                            {{ $book->nama_buku }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-2 mb-2 mt-3">
                                                <label for="inputEmail5" class="form-label">Jumlah</label>
                                                <input type="number" class="form-control" name="qty[]" min="1"
                                                    value="1" required>
                                            </div>
                                            <div class="col-md-12 text-end mt-2">
                                                <button type="button" class="btn btn-danger btn-sm remove-book-item-btn">
                                                    <i class="mdi mdi-delete"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        <button type="button" class="btn btn-success btn-sm mt-3" id="add-book-item-btn">
                                            <i class="mdi mdi-plus-box me-2"></i> Tambah Buku
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="d-flex justify-content-between align-items-center">
                                <button type="reset" class="btn btn-primary px-3"><i
                                        class="mdi mdi-rotate-right me-2"></i>Reset</button>
                                <button type="submit" class="btn btn-success px-3"><i
                                        class="mdi mdi-check-circle me-2"></i>Simpan Data</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const addBookItemBtn = document.getElementById('add-book-item-btn');
            const bookItemsContainer = document.getElementById('book-items');

            addBookItemBtn.addEventListener('click', function() {
                const bookItemTemplate = document.createElement('div');
                bookItemTemplate.classList.add('row', 'mb-2', 'book-item');
                bookItemTemplate.innerHTML = `
            <div class="col-md-10 mb-2 mt-3">
                <label for="inputState" class="form-label">Buku</label>
                <select class="bukuSelect form-select form-control" name="buku_id[]" required>
                    ${Array.from(document.querySelectorAll('.bukuSelect option'))
                        .map(option => `<option value="${option.value}">${option.textContent}</option>`)
                        .join('')}
                </select>
            </div>
            <div class="col-md-2 mb-2 mt-3">
                <label for="inputEmail5" class="form-label">Qty</label>
                <input type="number" class="form-control" name="qty[]" min="1" value="1" required>
            </div>
            <div class="col-md-12 text-end mt-2">
                <button type="button" class="btn btn-danger btn-sm remove-book-item-btn">
                    <i class="mdi mdi-delete"></i>
                </button>
            </div>
        `;

                bookItemsContainer.appendChild(bookItemTemplate);
            });

            // Menggunakan event delegation untuk tombol hapus
            bookItemsContainer.addEventListener('click', function(e) {
                if (e.target.closest('.remove-book-item-btn')) {
                    e.target.closest('.book-item').remove();
                }
            });
        });
    </script>
@endsection
