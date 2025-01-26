@extends('layouts.dashboard.app', ['title' => 'Late Charge Setting'])

@section('content')
    <div class="container-fluid">

        <!-- start page title -->
        <div class="page-title-box">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h6 class="page-title">Late Charge Setting</h6>
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('denda.setting') }}">Late Charge Setting</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Setting</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="row">
            <form class="needs-validation" novalidate action="{{ route('denda.update') }}" method="POST"
                enctype="multipart/form-data" id="form-create-books">
                @csrf
                @method('PUT')

                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Setting Late Charge Form</h4>
                            <div class="row align-items-center g-3 mt-3">

                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <p class="text-body fw-bold h4">Charge Count :
                                            {{ 'Rp. ' . number_format($denda->jumlah_denda ?? 0) }}</p>
                                        @php
                                            $contohTerlambat = 2;
                                            $total = $denda->jumlah_denda * $contohTerlambat;
                                        @endphp
                                        <p class="small text-danger">*Jumlah denda berlaku per 1 (satu) hari keterlambatan.
                                            Cth: terlambat {{ $contohTerlambat }} hari =
                                            {{ 'Rp. ' . number_format($denda->jumlah_denda ?? 0) }} x
                                            {{ $contohTerlambat }} = {{ 'Rp. ' . number_format($total) }}
                                        </p>
                                    </div>
                                    <label for="jumlah_denda" class="form-label">Charge Count</label>
                                    <input type="number" name="jumlah_denda"
                                        class="form-control @error('jumlah_denda') is-invalid @enderror"
                                        value="{{ old('jumlah_denda', $denda->jumlah_denda ?? null) }}" id="jumlah_denda"
                                        placeholder="Charge Count">

                                    @error('jumlah_denda')
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
