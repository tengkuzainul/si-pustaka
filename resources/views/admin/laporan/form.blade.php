@extends('layouts.dashboard.app', ['title' => 'Laporan Perpustakaan'])

@section('content')
    <div class="container-fluid">

        <!-- start page title -->
        <div class="page-title-box">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h6 class="page-title">Books</h6>
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Beranda</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('cetak.form') }}">Laporan Perpustakaan</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Formulir Pembuatan Laporan</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="row">
            <form class="needs-validation" novalidate method="GET" action="{{ route('cetak') }}">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Formulir Pembuatan Laporan</h4>
                            <div class="row align-items-center g-3 mt-3">

                                <div class="col-md-6">
                                    <label for="tglAwal" class="form-label">Tanggal Awal Laporan</label>
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
                                    <label for="tglAkhir" class="form-label">Tanggal Akhir Laporan</label>
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
                                        class="mdi mdi-download me-2"></i>Buat & Download Laporan</button>
                            </div>
                        </div>
                    </div>
                </div> <!-- end col -->
            </form>

        </div>
    </div>
@endsection
