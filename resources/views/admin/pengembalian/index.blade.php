@extends('layouts.dashboard.app', ['title' => 'Return Books'])

@section('content')
    <div class="container-fluid">

        <!-- start page title -->
        <div class="page-title-box">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h6 class="page-title">Return Books</h6>
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('pengembalian') }}">Return Books</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Data</li>
                    </ol>
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
                                        <th>Early Return Date</th>
                                        <th>Return Date</th>
                                        <th>Delay Return</th>
                                        <th>Charge</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>


                                <tbody>
                                    @foreach ($returns as $key => $return)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <span
                                                    class="badge px-3 py-2 bg-{{ $key % 2 == 0 ? 'primary' : 'secondary text-dark' }}">{{ $return->peminjaman->number }}</span>
                                            </td>
                                            <td>
                                                <span
                                                    class="badge px-3 py-2 bg-{{ $key % 2 == 0 ? 'primary' : 'secondary text-dark' }}">{{ $return->peminjaman->member->nama_member }}</span>
                                            </td>
                                            <td>{{ date('d F Y', strtotime($return->peminjaman->return_date)) }}</td>
                                            <td>{{ date('d F Y', strtotime($return->tanggal_pengembalian)) }}</td>
                                            <td>
                                                <span class="delayreturn"
                                                    data-return-date="{{ $return->peminjaman->return_date }}"
                                                    data-tanggal-pengembalian="{{ $return->tanggal_pengembalian }}"></span>
                                                Days
                                            </td>
                                            <td>Rp. {{ number_format($return->denda ?? 0) }}</td>
                                            <td>
                                                <div class="d-flex justify-content-center align-items-center gap-2">
                                                    <a href="javascript:void(0);" class="btn btn-primary"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#modalDetailReturn-{{ $return->id }}">
                                                        <i class="mdi mdi-eye"></i>
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
                                                                {{ $return->peminjaman->member->nama_member }}
                                                            </h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>

                                                        <div class="modal-body">
                                                            <div class="row align-items-center">
                                                                <div class="col-md-12">
                                                                    <div class="d-flex justify-content-start gap-3">
                                                                        <div class="mx-1">
                                                                            <p class="text-body fw-medium">Member Name
                                                                            </p>
                                                                            <p class="text-body fw-medium">Early Return Date
                                                                            </p>
                                                                            </p>
                                                                            <p class="text-body fw-medium">Return Date
                                                                            </p>
                                                                            <p class="text-body fw-medium">Delay Return</p>
                                                                            <p class="text-body fw-medium">Book
                                                                                Borrowing</p>
                                                                        </div>
                                                                        <div class="mx-1">
                                                                            <p class="text-body fw-medium">
                                                                                <span
                                                                                    class="me-2">:</span>{{ $return->peminjaman->member->nama_member }}
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
                                                                                <span class="me-2">:</span><span
                                                                                    class="delayreturn"
                                                                                    data-return-date="{{ $return->peminjaman->return_date }}"
                                                                                    data-tanggal-pengembalian="{{ $return->tanggal_pengembalian }}"></span>
                                                                                Days
                                                                            </p>

                                                                            <ul>
                                                                                @foreach ($return->peminjaman->itemLend as $item)
                                                                                    <li class="mb-2">
                                                                                        <div class="d-flex flex-column g-1">
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
@endsection
