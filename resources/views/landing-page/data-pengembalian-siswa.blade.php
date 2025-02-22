@extends('layouts.landing-page.app', ['title' => 'Data PengembalianKu'])

@section('content')
    <div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="colored">
                        <h1 class="page-title">Pengembalian &mdash; KU</h1>
                        <div class="breadcum-items">
                            <span class="item"><a href="{{ url('/') }}">Beranda /</a></span>
                            <span class="item colored">List Pengembalian {{ Auth::user()->name }} &mdash;
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
                            <th>Kode Peminjaman</th>
                            <th>Data Siswa</th>
                            <th>Tanggal Peminjaman Awal</th>
                            <th>Tanggal Peminjaman Awal</th>
                            <th>Keterlambatan</th>
                            <th>Denda</th>
                            <th>Status</th>
                            <th class="pe-3">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($returns as $key => $return)
                            <tr>
                                <td class="ps-3">{{ $loop->iteration }}</td>
                                <td>
                                    <span
                                        class="badge px-3 py-2 bg-{{ $key % 2 == 0 ? 'primary' : 'secondary text-dark' }}">
                                        {{ $return->peminjaman->number }}
                                    </span>
                                </td>
                                <td>
                                    @if ($return->peminjaman->siswa)
                                        <span
                                            class="badge px-3 py-2 bg-{{ $key % 2 == 0 ? 'primary' : 'secondary text-dark' }}">
                                            {{ $return->peminjaman->siswa->name }}
                                        </span>
                                    @else
                                        <span class="badge bg-danger">No Member</span>
                                    @endif
                                </td>
                                <td>{{ date('d F Y', strtotime($return->peminjaman->return_date)) }}</td>
                                <td>{{ date('d F Y', strtotime($return->tanggal_pengembalian)) }}</td>
                                <td>
                                    <span class="delayreturn" data-return-date="{{ $return->peminjaman->return_date }}"
                                        data-tanggal-pengembalian="{{ $return->tanggal_pengembalian }}"></span>
                                    Hari
                                </td>
                                <td>Rp. {{ number_format($return->denda ?? 0) }}</td>

                                <td>
                                    <span
                                        class="badge px-3 py-2 bg-{{ $return->konfirmasi_pengembalian === 'Menunggu' ? 'warning text-dark' : 'success' }}">
                                        {{ $return->konfirmasi_pengembalian }}
                                    </span>
                                </td>

                                <td class="pe-3">
                                    <div class="d-flex justify-content-center align-items-center gap-2">
                                        <a href="javascript:void(0);" class="btn btn-primary mt-0 rounded-pill"
                                            data-bs-toggle="modal" data-bs-target="#modalDetailReturn-{{ $return->id }}">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                    </div>
                                </td>

                                <!-- Modal Update Book Category -->
                                <div class="modal fade" id="modalDetailReturn-{{ $return->id }}"
                                    data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                    aria-labelledby="modalUpdatedLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg modal-dialog-center">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalUpdatedLabel">
                                                    Detail Borrowing |
                                                    {{ $return->peminjaman->siswa->name }}
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>

                                            <div class="modal-body">
                                                <div class="row align-items-center">
                                                    <div class="col-md-12">
                                                        <div class="d-flex justify-content-start gap-3">
                                                            <div class="mx-1">
                                                                <p class="text-body fw-medium">Siswa Data</p>
                                                                <p class="text-body fw-medium">Pengembalian Awal</p>
                                                                <p class="text-body fw-medium">Tanggal Pengembalian Buku</p>
                                                                <p class="text-body fw-medium">Waktu Keterlambatan</p>
                                                                <p class="text-body fw-medium">Buku Dipinjam</p>
                                                            </div>
                                                            <div class="mx-1">
                                                                <p class="text-body fw-medium">
                                                                    <span
                                                                        class="me-2">:</span>{{ $return->peminjaman->siswa->name }}
                                                                    | {{ $return->peminjaman->siswa->siswaData->class }} |
                                                                    {{ $return->peminjaman->siswa->username }}
                                                                </p>
                                                                <p class="text-body fw-medium">
                                                                    <span
                                                                        class="me-2">:</span>{{ date('d F Y', strtotime($return->peminjaman->return_date)) }}
                                                                </p>
                                                                <p class="text-body fw-medium">
                                                                    <span
                                                                        class="me-2">:</span>{{ date('d F Y', strtotime($return->tanggal_pengembalian)) }}
                                                                </p>

                                                                <p class="text-body fw-medium">
                                                                    <span class="me-2">:</span><span class="delayreturn"
                                                                        data-return-date="{{ $return->peminjaman->return_date }}"
                                                                        data-tanggal-pengembalian="{{ $return->tanggal_pengembalian }}"></span>
                                                                    Days
                                                                </p>

                                                                <ul>
                                                                    @foreach ($return->peminjaman->itemLend as $item)
                                                                        <li class="d-flex flex-column">
                                                                            <p class="text-body mb-1">
                                                                                - {{ $item->buku->nama_buku }}
                                                                            </p>
                                                                            <p class="text-body">
                                                                                - {{ 'Qty : ' . $item->qty }}
                                                                            </p>
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="reset" class="btn btn-danger rounded"
                                                    data-bs-dismiss="modal">
                                                    <i class="mdi mdi-close-circle me-2"></i>Close
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.modal -->
                            </tr>

                            <script>
                                const delayReturnElements = document.querySelectorAll('.delayreturn');

                                delayReturnElements.forEach(function(element) {
                                    const returnDate = new Date(element.getAttribute('data-return-date'));
                                    const tanggalPengembalian = new Date(element.getAttribute('data-tanggal-pengembalian'));

                                    const timeDiff = tanggalPengembalian - returnDate;

                                    let delayDays = 0;
                                    if (timeDiff > 0) {
                                        delayDays = Math.ceil(timeDiff / (1000 * 60 * 60 * 24));
                                    }

                                    element.innerText = delayDays;
                                });
                            </script>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </section>
@endsection
