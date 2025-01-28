@extends('layouts.landing-page.app', ['title' => 'Data Peminjamanku'])

@section('content')
    <div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="colored">
                        <h1 class="page-title">Peminjaman &mdash; KU</h1>
                        <div class="breadcum-items">
                            <span class="item"><a href="{{ url('/') }}">Beranda /</a></span>
                            <span class="item colored">List Peminjaman {{ Auth::user()->name }} &mdash;
                                {{ Auth::user()->siswaData->class }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!--site-banner-->

    <section class="padding-medium">
        <div class="container">
            <div class="col-12 table-responsive">
                <table class="table table-stripped">

                    <thead>
                        <tr>
                            <th class="ps-3">No</th>
                            <th>Borrowing Code</th>
                            <th>Siswa Data</th>
                            <th>Borrowing Date</th>
                            <th>Return Date</th>
                            <th class="pe-3">Status</th>
                        </tr>
                    </thead>


                    <tbody>
                        @forelse ($data as $key => $borrowing)
                            <tr>
                                <td class="ps-3">{{ $loop->iteration }}</td>
                                <td>
                                    <span
                                        class="badge px-3 py-2 bg-{{ $key % 2 == 0 ? 'primary' : 'secondary text-dark' }}">
                                        {{ $borrowing->number }}
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex flex-column gap-2">
                                        <span
                                            class="badge px-3 py-2 bg-{{ $key % 2 == 0 ? 'primary' : 'secondary text-dark' }}">
                                            {{ $borrowing->siswa->name }}
                                        </span>
                                        <span
                                            class="badge px-3 py-2 bg-{{ $key % 2 == 0 ? 'primary' : 'secondary text-dark' }}">
                                            {{ $borrowing->siswa->username }}
                                        </span>
                                        <span
                                            class="badge px-3 py-2 bg-{{ $key % 2 == 0 ? 'primary' : 'secondary text-dark' }}">
                                            {{ $borrowing->siswa->siswaData->class ?? 'N/A' }}
                                        </span>
                                    </div>
                                </td>
                                <td>{{ date('d F Y', strtotime($borrowing->lend_date)) }}</td>
                                <td>{{ date('d F Y', strtotime($borrowing->return_date)) }}</td>
                                <td class="pe-3 d-flex flex-column">
                                    @if (!$borrowing->pengembalian()->exists())
                                        <span class="badge bg-warning w-100 text-dark py-2">Belum Dikembalikan</span>
                                        @if (now() >= $borrowing->lend_date)
                                            <button type="button" class="btn btn-success rounded-pill w-100 py-1"
                                                title="Lakukan Pengembalian" data-bs-toggle="modal"
                                                data-bs-target="#modalLakukanPengembalian-{{ $borrowing->id }}">
                                                <i class="fa fa-reply"></i> Lakukan Pengembalian Buku
                                            </button>
                                        @endif
                                    @else
                                        <span class="badge bg-success w-100">Sudah Dikembalikan</span>
                                    @endif
                                </td>

                                <!-- Modal Update Book Category -->
                                <div class="modal fade" id="modalLakukanPengembalian-{{ $borrowing->id }}"
                                    data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                    aria-labelledby="modalUpdatedLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg modal-dialog-center">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalUpdatedLabel">
                                                    Modal Konfirmasi Pengembalian Buku |
                                                    {{ $borrowing->siswa->name }}
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('pengembalian.store', $borrowing->id) }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf

                                                <div class="modal-body">
                                                    <div class="row align-items-center">
                                                        <div class="col-md-12">
                                                            <div class="d-flex justify-content-start gap-3">
                                                                <div class="mx-1">
                                                                    <p class="text-body fw-medium">Siswa Data
                                                                    </p>
                                                                    <p class="text-body fw-medium">Borrowing
                                                                        Date</p>
                                                                    <p class="text-body fw-medium">Return Date
                                                                    </p>
                                                                    <p class="text-body fw-medium">Book
                                                                        Borrowing</p>
                                                                </div>
                                                                <div class="mx-1">
                                                                    <p class="text-body fw-medium">
                                                                        <span
                                                                            class="me-2">:</span>{{ $borrowing->siswa->name }}
                                                                        | {{ $borrowing->siswa->username }} |
                                                                        {{ $borrowing->siswa->siswaData->class }}
                                                                    </p>
                                                                    <p class="text-body fw-medium">
                                                                        <span
                                                                            class="me-2">:</span>{{ date('d F Y', strtotime($borrowing->lend_date)) }}
                                                                    </p>
                                                                    <p class="text-body fw-medium">
                                                                        <span
                                                                            class="me-2">:</span>{{ date('d F Y', strtotime($borrowing->return_date)) }}
                                                                    </p>
                                                                    <ul>
                                                                        @foreach ($borrowing->itemLend as $item)
                                                                            <li>
                                                                                {{ $item->buku->nama_buku }}
                                                                            </li>
                                                                        @endforeach
                                                                    </ul>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-12">
                                                            <label for="tanggal_pengembalian" class="form-label">Return Date
                                                                Now</label>
                                                            <input type="date" name="tanggal_pengembalian"
                                                                class="form-control @error('tanggal_pengembalian') is-invalid @enderror"
                                                                value="{{ old('borrowing_date', now()->format('Y-m-d')) }}"
                                                                id="tanggal_pengembalian" placeholder="Book Category Name"
                                                                autofocus>
                                                            @error('tanggal_pengembalian')
                                                                <div class="valid-feedback">
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
                                                        <i class="mdi mdi-check-circle me-2"></i>Save Data
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.modal -->
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Belum melakukan peminjaman apapun.</td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
