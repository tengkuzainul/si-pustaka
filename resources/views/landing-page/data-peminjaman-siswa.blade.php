@extends('layouts.landing-page.app', ['title' => 'Data Peminjamanku'])

@section('content')
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

    <section class="padding-medium">
        <div class="container">
            <div class="col-12 table-responsive">
                <table class="table table-striped table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th class="ps-3">No</th>
                            <th>Kode Peminjaman</th>
                            <th>Data Siswa</th>
                            <th>Tanggal Peminjaman</th>
                            <th>Tanggal Pengembalian</th>
                            <th class="pe-3">Status</th>
                            <th>Aksi</th>
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
                                    <div class="d-flex flex-column gap-1">
                                        <span class="badge bg-info text-dark">{{ $borrowing->siswa->name }}</span>
                                        <span class="badge bg-secondary text-dark">{{ $borrowing->siswa->username }}</span>
                                        <span
                                            class="badge bg-success text-white">{{ $borrowing->siswa->siswaData->class ?? 'N/A' }}</span>
                                    </div>
                                </td>
                                <td>{{ date('d F Y', strtotime($borrowing->lend_date)) }}</td>
                                <td>{{ date('d F Y', strtotime($borrowing->return_date)) }}</td>
                                <td>
                                    @if (!$borrowing->pengembalian()->exists())
                                        <span class="badge bg-warning text-dark">Belum Dikembalikan</span>
                                    @else
                                        <span class="badge bg-success">Sudah Dikembalikan</span>
                                    @endif
                                </td>
                                <td class="pe-3">
                                    @if (!$borrowing->pengembalian()->exists())
                                        <div class="btn-wrap">
                                            <button type="button" class="btn btn-outline-accent btn-accent-arrow"
                                                title="Lakukan Pengembalian" data-bs-toggle="modal"
                                                data-bs-target="#modalLakukanPengembalian-{{ $borrowing->id }}">
                                                <i class="fa fa-reply"></i> Kembalikan Buku
                                            </button>
                                        </div>
                                    @endif
                                </td>
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

    <!-- MODAL PENGEMBALIAN -->
    @foreach ($data as $borrowing)
        <div class="modal fade" id="modalLakukanPengembalian-{{ $borrowing->id }}" data-bs-backdrop="static"
            data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalUpdatedLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Konfirmasi Pengembalian | {{ $borrowing->siswa->name }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('pengembalian.store', $borrowing->id) }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <p><strong>Siswa :</strong> {{ $borrowing->siswa->name }} |
                                    {{ $borrowing->siswa->username }} | {{ $borrowing->siswa->siswaData->class }}</p>
                                <p><strong>Tanggal Pengembalian :</strong>
                                    {{ date('d F Y', strtotime($borrowing->lend_date)) }}
                                </p>
                                <p><strong>Tanggal Pengembalian:</strong>
                                    {{ date('d F Y', strtotime($borrowing->return_date)) }}
                                </p>
                                <p><strong>Daftar Buku Yang Dipinjam :</strong></p>
                                <ul>
                                    @foreach ($borrowing->itemLend as $item)
                                        <li>{{ $item->buku->nama_buku }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="mb-3">
                                <label for="tanggal_pengembalian" class="form-label">Tanggal Pengembalian</label>
                                <input type="date" name="tanggal_pengembalian"
                                    class="form-control @error('tanggal_pengembalian') is-invalid @enderror"
                                    value="{{ old('borrowing_date', now()->format('Y-m-d')) }}" id="tanggal_pengembalian">
                                @error('tanggal_pengembalian')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="reset" class="btn btn-secondary">Reset</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
@endsection
