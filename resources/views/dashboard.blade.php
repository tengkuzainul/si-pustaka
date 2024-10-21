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
                        <h4 class="card-title mb-4">Monthly Earning</h4>
                        <div class="row">
                            <div class="col-lg-12">
                                <div>
                                    <div id="chart-with-area" class="ct-chart earning ct-golden-section">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->
                    </div>
                </div>
                <!-- end card -->
            </div>
        </div>
        <!-- end row -->

        <div class="row">
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Sales Report</h4>

                        <div class="cleafix">
                            <p class="float-start"><i class="mdi mdi-calendar me-1 text-primary"></i> Jan
                                01
                                - Jan 31</p>
                            <h5 class="font-18 text-end">$4230</h5>
                        </div>

                        <div id="ct-donut" class="ct-chart wid"></div>

                        <div class="mt-4">
                            <table class="table mb-0">
                                <tbody>
                                    <tr>
                                        <td><span class="badge bg-primary">Desk</span></td>
                                        <td>Desktop</td>
                                        <td class="text-end">54.5%</td>
                                    </tr>
                                    <tr>
                                        <td><span class="badge bg-success">Mob</span></td>
                                        <td>Mobile</td>
                                        <td class="text-end">28.0%</td>
                                    </tr>
                                    <tr>
                                        <td><span class="badge bg-warning">Tab</span></td>
                                        <td>Tablets</td>
                                        <td class="text-end">17.5%</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-xl-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Activity</h4>
                        <ol class="activity-feed">
                            <li class="feed-item">
                                <div class="feed-item-list">
                                    <span class="date">Jan 22</span>
                                    <span class="activity-text">Responded to need “Volunteer
                                        Activities”</span>
                                </div>
                            </li>
                            <li class="feed-item">
                                <div class="feed-item-list">
                                    <span class="date">Jan 20</span>
                                    <span class="activity-text">At vero eos et accusamus et iusto odio
                                        dignissimos ducimus qui deleniti atque...<a href="#"
                                            class="text-success">Read
                                            more</a></span>
                                </div>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->
    </div>
@endsection
