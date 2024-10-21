@extends('layouts.dashboard.app', ['title' => 'Borrowing Books'])

@section('content')
    <div class="container-fluid">

        <!-- start page title -->
        <div class="page-title-box">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h6 class="page-title">Borrowing Books</h6>
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('peminjaman') }}">Borrowing Books</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Data</li>
                    </ol>
                </div>

                <div class="col-md-4">
                    <div class="float-end d-none d-md-block">
                        <div class="dropdown">
                            <button class="btn btn-primary  dropdown-toggle" type="button" id="dropdownMenuButton"
                                onclick="window.location.href='{{ route('peminjaman.create') }}'">
                                <i class="mdi
                                mdi-account-multiple-plus me-2"></i> Create
                                Borrowings
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

                        <h4 class="card-title">All Users</h4>
                        <div class="table-responsive mb-3 fixed-solution mt-4">
                            <table id="datatable" class="table table-bordered dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Borrowing Code</th>
                                        <th>Member Name</th>
                                        <th>Borrowing Date</th>
                                        <th>Return Date</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>


                                <tbody>
                                    @foreach ($data as $key => $borrowing)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <span
                                                    class="badge px-3 py-2 bg-{{ $key % 2 == 0 ? 'primary' : 'secondary text-dark' }}">{{ $borrowing->number }}</span>
                                            </td>
                                            <td>
                                                <span
                                                    class="badge px-3 py-2 bg-{{ $key % 2 == 0 ? 'primary' : 'secondary text-dark' }}">{{ $borrowing->member->nama_member }}</span>
                                            </td>
                                            <td>{{ date('d F Y', strtotime($borrowing->lend_date)) }}</td>
                                            <td>{{ date('d F Y', strtotime($borrowing->return_date)) }}</td>
                                            <td>
                                                @if ($borrowing->pengembalian()->exists())
                                                    <span class="badge bg-success w-100">Sudah Dikembalikan</span>
                                                @else
                                                    <span class="badge bg-warning w-100">Belum Dikembalikan</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-center align-items-center gap-2">
                                                    <a href="javascript:void(0);" class="btn btn-primary"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#modalDetailBorrowing-{{ $borrowing->id }}">
                                                        <i class="mdi mdi-eye"></i>
                                                    </a>
                                                    @if (!$borrowing->pengembalian()->exists())
                                                        <a href="javascript:void(0);" class="btn btn-success"
                                                            title="Pengembalian" data-bs-toggle="modal"
                                                            data-bs-target="#modalCreatePengembalian-{{ $borrowing->id }}">
                                                            <i class="fa fa-reply"></i>
                                                        </a>
                                                    @endif


                                                    <a href="{{ route('peminjaman.destroy', $borrowing->id) }}"
                                                        class="btn btn-danger" data-confirm-delete="true">
                                                        <i class="mdi mdi-delete"></i>
                                                    </a>
                                                </div>
                                            </td>

                                            <!-- Modal Update Book Category -->
                                            <div class="modal fade" id="modalCreatePengembalian-{{ $borrowing->id }}"
                                                data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                                aria-labelledby="modalUpdatedLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg modal-dialog-center">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="modalUpdatedLabel">
                                                                Modal Create Return Member |
                                                                {{ $borrowing->member->nama_member }}
                                                            </h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <form action="{{ route('pengembalian.store', $borrowing->id) }}"
                                                            method="POST" enctype="multipart/form-data">
                                                            @csrf

                                                            <div class="modal-body">
                                                                <div class="row align-items-center">
                                                                    <div class="col-md-12">
                                                                        <div class="d-flex justify-content-start gap-3">
                                                                            <div class="mx-1">
                                                                                <p class="text-body fw-medium">Member Name
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
                                                                                        class="me-2">:</span>{{ $borrowing->member->nama_member }}
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
                                                                        <label for="tanggal_pengembalian"
                                                                            class="form-label">Return Date Now</label>
                                                                        <input type="date" name="tanggal_pengembalian"
                                                                            class="form-control @error('tanggal_pengembalian') is-invalid @enderror"
                                                                            value="{{ old('tanggal_pengembalian') }}"
                                                                            id="tanggal_pengembalian"
                                                                            placeholder="Book Category Name" autofocus>
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

                                            <!-- Modal Update Book Category -->
                                            <div class="modal fade" id="modalDetailBorrowing-{{ $borrowing->id }}"
                                                data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                                aria-labelledby="modalUpdatedLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg modal-dialog-center">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="modalUpdatedLabel">
                                                                Detail Borrowing |
                                                                {{ $borrowing->member->nama_member }}
                                                            </h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <form action="{{ route('pengembalian.store', $borrowing->id) }}"
                                                            method="POST" enctype="multipart/form-data">
                                                            @csrf

                                                            <div class="modal-body">
                                                                <div class="row align-items-center">
                                                                    <div class="col-md-12">
                                                                        <div class="d-flex justify-content-start gap-3">
                                                                            <div class="mx-1">
                                                                                <p class="text-body fw-medium">Member Name
                                                                                </p>
                                                                                <p class="text-body fw-medium">Borrowing
                                                                                    Date</p>
                                                                                <p class="text-body fw-medium">Return Date
                                                                                </p>
                                                                                <p class="text-body fw-medium">Due Return
                                                                                    Date
                                                                                </p>
                                                                                <p class="text-body fw-medium">Book
                                                                                    Borrowing</p>
                                                                            </div>
                                                                            <div class="mx-1">
                                                                                <p class="text-body fw-medium">
                                                                                    <span
                                                                                        class="me-2">:</span>{{ $borrowing->member->nama_member }}
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
                                                                                    <span id="daysDue"></span> More Days
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
                                                                                                    {{ 'Qty : ' . $item->qty }}
                                                                                                </p>
                                                                                            </div>
                                                                                        </li>
                                                                                    @endforeach
                                                                                </ul>
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="reset" class="btn btn-danger"
                                                                    data-bs-dismiss="modal">
                                                                    <i class="mdi mdi-close-circle me-2"></i>Close
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /.modal -->
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div> <!-- end col -->
        </div>
    </div>

    <script>
        const lendDate = new Date('{{ $borrowing->lend_date }}');
        const returnDate = new Date('{{ $borrowing->return_date }}');

        const timeDiff = returnDate - lendDate;

        const daysDue = Math.ceil(timeDiff / (1000 * 60 * 60 * 24));

        document.getElementById('daysDue').innerText = daysDue;
    </script>
@endsection
