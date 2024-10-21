@extends('layouts.dashboard.app', ['title' => 'Report'])

@section('content')
    <div class="container-fluid">

        <!-- start page title -->
        <div class="page-title-box">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h6 class="page-title">Books</h6>
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('cetak.form') }}">Report</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Form</li>
                    </ol>
                </div>

                <div class="col-md-4">
                    <div class="float-end d-none d-md-block">
                        <div class="dropdown">
                            <button class="btn btn-primary  dropdown-toggle" type="button" id="dropdownMenuButton"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="mdi mdi-book-variant me-2"></i> Create Books
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="{{ route('buku.create') }}">Add New Data</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <form class="needs-validation" novalidate method="GET" action="{{ route('cetak') }}">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Form Create Books</h4>
                            <div class="row align-items-center g-3 mt-3">

                                <div class="col-md-6">
                                    <label for="tglAwal" class="form-label">First Date</label>
                                    <div class="input-group">
                                        <input type="date" class="form-control  @error('tglAwal') is-invalid @enderror"
                                            name="tglAwal" value="{{ old('tglAwal') }}" id="tglAwal">

                                        <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                    </div>

                                    @error('tglAwal')
                                        <div class="valid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="tglAkhir" class="form-label">End Date</label>
                                    <div class="input-group">
                                        <input type="date" class="form-control @error('tglAwal') is-invalid @enderror"
                                            name="tglAkhir" value="{{ old('tglAkhir') }}" id="tglAkhir">

                                        <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                    </div>

                                    @error('tglAkhir')
                                        <div class="valid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                            </div>
                        </div>

                        <div class="card-footer">
                            <div class="d-flex justify-content-between align-items-center">
                                <button type="reset" class="btn btn-primary px-3"><i
                                        class="mdi mdi-rotate-right me-2"></i>Reset</button>
                                <button type="submit" class="btn btn-success px-3"><i
                                        class="mdi mdi-check-circle me-2"></i>Save Data</button>
                            </div>
                        </div>
                    </div>
                </div> <!-- end col -->
            </form>

        </div>
    </div>
@endsection
