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
                                        class="badge px-3 py-2 bg-{{ $key % 2 == 0 ? 'primary' : 'secondary text-dark' }}">{{ $borrowing->number }}</span>
                                </td>
                                <td class="d-flex flex-column gap-2">
                                    <span
                                        class="badge px-3 py-2 bg-{{ $key % 2 == 0 ? 'primary' : 'secondary text-dark' }}">{{ $borrowing->siswa->name }}</span>
                                    <span
                                        class="badge px-3 py-2 bg-{{ $key % 2 == 0 ? 'primary' : 'secondary text-dark' }}">{{ $borrowing->siswa->username }}</span>
                                    <span
                                        class="badge px-3 py-2 bg-{{ $key % 2 == 0 ? 'primary' : 'secondary text-dark' }}">{{ $borrowing->siswa->siswaData->class ?? 'N/A' }}</span>
                                </td>
                                <td>{{ date('d F Y', strtotime($borrowing->lend_date)) }}</td>
                                <td>{{ date('d F Y', strtotime($borrowing->return_date)) }}</td>
                                <td class="pe-3">
                                    @if (!$borrowing->pengembalian()->exists())
                                        <span class="badge bg-warning w-100">Belum Dikembalikan</span>
                                    @else
                                        <span class="badge bg-success w-100">Sudah Dikembalikan</span>
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
@endsection
