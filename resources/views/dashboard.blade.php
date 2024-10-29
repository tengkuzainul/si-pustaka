@extends('layouts.dashboard.app', ['title' => 'Home'])

@section('content')
    <div class="container-fluid">

        <!-- start page title -->
        <div class="page-title-box">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h6 class="page-title">Dashboard</h6>
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">Welcome to Sistem Informasi Perpustakaan Dashboard</li>
                    </ol>
                </div>

                <div class="col-md-4">
                    <div class="float-end d-none d-md-block">
                        <div class="dropdown">
                            <button class="btn btn-primary  dropdown-toggle" type="button" id="dropdownMenuButton"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="mdi mdi-cog me-2"></i> Settings
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <a class="dropdown-item" href="#">Something else here</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Separated link</a>
                            </div>
                        </div>
                    </div>
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
                            <h5 class="font-size-16 text-uppercase text-white-50">Members</h5>
                            <h4 class="fw-medium font-size-24">{{ $member ? count($member) : 0 }}</h4>
                        </div>
                        <div class="pt-2">
                            <div class="float-end">
                                <a href="#" class="text-white-50"><i
                                        class="mdi mdi-arrow-right h5 text-white-50"></i></a>
                            </div>

                            <p class="text-white-50 mb-0 mt-1">See Details</p>
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
                            <h5 class="font-size-16 text-uppercase text-white-50">Books</h5>
                            <h4 class="fw-medium font-size-24">{{ $books ? count($books) : 0 }}</h4>
                        </div>
                        <div class="pt-2">
                            <div class="float-end">
                                <a href="#" class="text-white-50"><i
                                        class="mdi mdi-arrow-right h5 text-white-50"></i></a>
                            </div>

                            <p class="text-white-50 mb-0 mt-1">See Details</p>
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
                            <h5 class="font-size-16 text-uppercase text-white-50">Books Category</h5>
                            <h4 class="fw-medium font-size-24">{{ $kategoriBuku ? count($kategoriBuku) : 0 }}</h4>
                        </div>
                        <div class="pt-2">
                            <div class="float-end">
                                <a href="#" class="text-white-50"><i
                                        class="mdi mdi-arrow-right h5 text-white-50"></i></a>
                            </div>

                            <p class="text-white-50 mb-0 mt-1">See Details</p>
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
                        <h4 class="card-title mb-4">Total Borrowing this Year</h4>
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
