@extends('layouts.dashboard.app', ['title' => 'Peminjaman Buku'])

@section('content')
    <div class="container-fluid">

        <!-- start page title -->
        <div class="page-title-box">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h6 class="page-title">Peminjaman Buku</h6>
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Beranda</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('peminjaman') }}">Peminjaman Buku</a></li>
                        <li class="breadcrumb-item active" aria-current="page">List Data</li>
                    </ol>
                </div>

                <div class="col-md-4">
                    <div class="float-end d-none d-md-block">
                        <div class="dropdown">
                            <button class="btn btn-primary  dropdown-toggle" type="button" id="dropdownMenuButton"
                                onclick="window.location.href='{{ route('peminjaman.create') }}'">
                                <i class="mdi
                                mdi-account-multiple-plus me-2"></i> Tambah
                                Peminjaman Baru
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title">Daftar Peminjaman</h4>
                        <div class="table-responsive mb-3 fixed-solution mt-4">
                            <table id="datatable" class="table table-bordered dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode Peminjaman</th>
                                        <th>Data Peminjaman</th>
                                        <th>Tanggal Peminjaman</th>
                                        <th>Tanggal Pengembalian</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>


                                <tbody>
                                    @foreach ($data as $key => $borrowing)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <span
                                                    class="badge px-3 py-2 bg-{{ $key % 2 == 0 ? 'primary' : 'secondary text-dark' }}">
                                                    {{ $borrowing->number }}
                                                </span>
                                            </td>
                                            <td class="d-flex flex-column gap-2">
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
                                            </td>
                                            <td>{{ date('d F Y', strtotime($borrowing->lend_date)) }}</td>
                                            <td>{{ date('d F Y', strtotime($borrowing->return_date)) }}</td>
                                            <td>
                                                @if (!$borrowing->pengembalian()->exists())
                                                    <span class="badge bg-warning w-100">Belum Dikembalikan</span>
                                                @else
                                                    <span class="badge bg-success w-100">Sudah Dikembalikan</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-center align-items-center gap-2">
                                                    <a href="javascript:void(0);" class="btn btn-primary"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#modalDetailBorrowing-{{ $borrowing->id }}">
                                                        <i class="mdi mdi-eye"></i> Detail
                                                    </a>
                                                    @if (!$borrowing->pengembalian()->exists())
                                                        <a href="javascript:void(0);" class="btn btn-success"
                                                            title="Pengembalian" data-bs-toggle="modal"
                                                            data-bs-target="#modalCreatePengembalian-{{ $borrowing->id }}">
                                                            <i class="fa fa-reply"></i> Buat Pengembalian
                                                        </a>
                                                    @endif
                                                    <a href="{{ route('peminjaman.destroy', $borrowing->id) }}"
                                                        class="btn btn-danger" data-confirm-delete="true">
                                                        <i class="mdi mdi-delete"></i> Hapus
                                                    </a>
                                                </div>
                                            </td>
                                            <!-- Modal Konfirmasi Pengembalian Buku -->
                                            <div class="modal fade" id="modalCreatePengembalian-{{ $borrowing->id }}"
                                                data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                                aria-labelledby="modalUpdatedLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg modal-dialog-center">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="modalUpdatedLabel">
                                                                Konfirmasi Pengembalian Buku |
                                                                {{ $borrowing->siswa->name }}
                                                            </h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Tutup"></button>
                                                        </div>
                                                        <form action="{{ route('pengembalian.store', $borrowing->id) }}"
                                                            method="POST" enctype="multipart/form-data">
                                                            @csrf

                                                            <div class="modal-body">
                                                                <div class="row align-items-center">
                                                                    <div class="col-md-12">
                                                                        <div class="d-flex justify-content-start gap-3">
                                                                            <div class="mx-1">
                                                                                <p class="text-body fw-medium">Data Siswa
                                                                                    Yang Meminjam
                                                                                </p>
                                                                                <p class="text-body fw-medium">Tanggal
                                                                                    Peminjaman</p>
                                                                                <p class="text-body fw-medium">Tanggal
                                                                                    Pengembalian</p>
                                                                                <p class="text-body fw-medium">Buku yang
                                                                                    Dipinjam</p>
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
                                                                                        <li>{{ $item->buku->nama_buku }}
                                                                                        </li>
                                                                                    @endforeach
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-12">
                                                                        <label for="tanggal_pengembalian"
                                                                            class="form-label">Tanggal Pengembalian
                                                                            Sekarang</label>
                                                                        <input type="date" name="tanggal_pengembalian"
                                                                            class="form-control @error('tanggal_pengembalian') is-invalid @enderror"
                                                                            value="{{ old('tanggal_pengembalian') }}"
                                                                            id="tanggal_pengembalian"
                                                                            placeholder="Pilih Tanggal Pengembalian"
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
                                                                    <i class="mdi mdi-check-circle me-2"></i>Simpan Data
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /.modal -->

                                            <!-- Modal Detail Peminjaman -->
                                            <div class="modal fade" id="modalDetailBorrowing-{{ $borrowing->id }}"
                                                data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                                aria-labelledby="modalUpdatedLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg modal-dialog-center">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="modalUpdatedLabel">
                                                                Detail Peminjaman | {{ $borrowing->siswa->name }}
                                                            </h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Tutup"></button>
                                                        </div>
                                                        <form action="{{ route('pengembalian.store', $borrowing->id) }}"
                                                            method="POST" enctype="multipart/form-data">
                                                            @csrf

                                                            <div class="modal-body">
                                                                <div class="row align-items-center">
                                                                    <div class="col-md-12">
                                                                        <div class="d-flex justify-content-start gap-3">
                                                                            <div class="mx-1">
                                                                                <p class="text-body fw-medium">Data Siswa
                                                                                    Yang Meminjam
                                                                                </p>
                                                                                <p class="text-body fw-medium">Tanggal
                                                                                    Peminjaman</p>
                                                                                <p class="text-body fw-medium">Tanggal
                                                                                    Pengembalian</p>
                                                                                <p class="text-body fw-medium">Batas
                                                                                    Pengembalian</p>
                                                                                <p class="text-body fw-medium">Buku yang
                                                                                    Dipinjam</p>
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

                                                                                <p class="text-body fw-medium"
                                                                                    id="dueReturnDate">
                                                                                    <span class="me-2">:</span>
                                                                                    <span id="daysDue"></span> Hari Lagi
                                                                                </p>

                                                                                <ul>
                                                                                    @foreach ($borrowing->itemLend as $item)
                                                                                        <li class="mb-2">
                                                                                            <div
                                                                                                class="d-flex flex-column g-1">
                                                                                                <p class="text-body">
                                                                                                    {{ $item->buku->nama_buku }}
                                                                                                </p>
                                                                                                <p class="text-body">
                                                                                                    {{ 'Jumlah : ' . $item->qty }}
                                                                                                </p>
                                                                                            </div>
                                                                                        </li>
                                                                                    @endforeach
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="reset" class="btn btn-danger"
                                                                    data-bs-dismiss="modal">
                                                                    <i class="mdi mdi-close-circle me-2"></i>Tutup
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /.modal -->

                                        </tr>

                                        <script>
                                            const lendDate = new Date('{{ $borrowing->lend_date }}') ?? '';
                                            const returnDate = new Date('{{ $borrowing->return_date }}') ?? '';

                                            const timeDiff = returnDate - lendDate;

                                            const daysDue = Math.ceil(timeDiff / (1000 * 60 * 60 * 24));

                                            document.getElementById('daysDue').innerText = daysDue;
                                        </script>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div> <!-- end col -->
        </div>
    </div>
@endsection
