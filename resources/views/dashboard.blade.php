@extends('layouts.dashboard.app', ['title' => 'Home'])

@section('content')
    <div class="container-fluid">

        <!-- start page title -->
        <div class="page-title-box">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h6 class="page-title">Dashboard</h6>
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">Hi {{ Auth::user()->name }}, Selamat Datang Di Dashboard Sistem
                            Informasi Perpustakaan
                        </li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-xl-4 col-md-6">
                <div class="card mini-stat bg-primary text-white">
                    <div class="card-body">
                        <div class="mb-4">
                            <div class="float-start mini-stat-img me-4">
                                <img src="{{ asset('assets/dashboard/images/services-icon/01.png') }}" alt="">
                            </div>
                            <h5 class="font-size-16 text-uppercase text-white-50">Jumlah Siswa</h5>
                            <h4 class="fw-medium font-size-24">{{ $siswa ? count($siswa) : 0 }}</h4>
                        </div>
                        <div class="pt-2">
                            <div class="float-end">
                                <a href="{{ route('siswa') }}" class="text-white-50"><i
                                        class="mdi mdi-arrow-right h5 text-white-50"></i></a>
                            </div>

                            <p class="text-white-50 mb-0 mt-1">Lihat Lebih Lengkap</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-md-6">
                <div class="card mini-stat bg-primary text-white">
                    <div class="card-body">
                        <div class="mb-4">
                            <div class="float-start mini-stat-img me-4">
                                <img src="{{ asset('assets/dashboard/images/services-icon/02.png') }}" alt="">
                            </div>
                            <h5 class="font-size-16 text-uppercase text-white-50">Jumlah Buku</h5>
                            <h4 class="fw-medium font-size-24">{{ $books ? count($books) : 0 }}</h4>
                        </div>
                        <div class="pt-2">
                            <div class="float-end">
                                <a href="{{ route('buku') }}" class="text-white-50"><i
                                        class="mdi mdi-arrow-right h5 text-white-50"></i></a>
                            </div>

                            <p class="text-white-50 mb-0 mt-1">Lihat Lebih Lengkap</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-md-6">
                <div class="card mini-stat bg-primary text-white">
                    <div class="card-body">
                        <div class="mb-4">
                            <div class="float-start mini-stat-img me-4">
                                <img src="{{ asset('assets/dashboard/images/services-icon/02.png') }}" alt="">
                            </div>
                            <h5 class="font-size-16 text-uppercase text-white-50">Jumlah Kategori Buku</h5>
                            <h4 class="fw-medium font-size-24">{{ $kategoriBuku ? count($kategoriBuku) : 0 }}</h4>
                        </div>
                        <div class="pt-2">
                            <div class="float-end">
                                <a href="{{ route('kategori') }}" class="text-white-50"><i
                                        class="mdi mdi-arrow-right h5 text-white-50"></i></a>
                            </div>

                            <p class="text-white-50 mb-0 mt-1">Lihat Lebih Lengkap</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->

        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Total Peminjaman Yang DIlakukan Dalam Tahun Ini &mdash;
                            {{ now()->format('Y') }}</h4>
                        <!-- end row -->
                        <div>
                            <div id="chart-dashboard" class="ct-chart earning ct-golden-section">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end card -->
            </div>
        </div>
        <!-- end row -->
    </div>

    <script>
        const bulanArray = @json($bulan);
        const totalPeminjaman = @json($total);

        new Chartist.Line(
            "#chart-dashboard", {
                labels: bulanArray,
                series: [
                    totalPeminjaman
                ]
            }, {
                low: 0,
                showArea: true
            }
        );
    </script>
@endsection
