@extends('layouts.dashboard.app', ['title' => 'Members'])

@section('content')
    <div class="container-fluid">

        <!-- start page title -->
        <div class="page-title-box">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h6 class="page-title">Members</h6>
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('member') }}">Members Management</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Create</li>
                    </ol>
                </div>

                <div class="col-md-4">
                    <div class="float-end d-none d-md-block">
                        <div class="dropdown">
                            <button class="btn btn-primary  dropdown-toggle" type="button" id="dropdownMenuButton"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="mdi mdi-account-box me-2"></i> Create Member
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="{{ route('users.create') }}">Add New Data</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <form class="needs-validation" novalidate action="{{ route('member.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <h4 class="card-title">Form Create Member</h4>
                            <div class="row align-items-center g-3 mt-3">
                                <div class="col-md-6">
                                    <label for="nama_member" class="form-label">Fullname</label>
                                    <input type="text" name="nama_member"
                                        class="form-control @error('nama_member') is-invalid @enderror"
                                        value="{{ old('nama_member') }}" id="nama_member" placeholder="Fullname" autofocus>

                                    @error('nama_member')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="text" name="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        value="{{ old('email') }}" id="email" placeholder="Email">

                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="no_hp" class="form-label">Phone</label>
                                    <input type="text" name="no_hp"
                                        class="form-control @error('no_hp') is-invalid @enderror"
                                        value="{{ '+62', old('no_hp') }}" id="no_hp" placeholder="Phone">

                                    @error('no_hp')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label mb-3 d-flex">Gender</label>

                                    <div class="form-check form-check-inline">
                                        <input type="radio" id="L" name="gender"
                                            class="form-check-input @error('gender') is-invalid @enderror" value="L"
                                            {{ old('gender') == 'L' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="L">Laki-Laki</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input type="radio" id="P" name="gender"
                                            class="form-check-input @error('gender') is-invalid @enderror" value="P"
                                            {{ old('gender') == 'P' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="P">Perempuan</label>
                                    </div>

                                    @error('gender')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-md-12">
                                    <label for="alamat" class="form-label">Address</label>
                                    <input type="text" name="alamat"
                                        class="form-control @error('alamat') is-invalid @enderror"
                                        value="{{ old('alamat') }}" id="alamat" placeholder="Address">

                                    @error('alamat')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="card-footer">
                            <div class="d-flex justify-content-between align-items-center">
                                <button type="submit" class="btn btn-primary px-3"><i
                                        class="mdi mdi-rotate-right me-2"></i>Reset</button>
                                <button type="submit" class="btn btn-success px-3"><i
                                        class="mdi mdi-check-circle me-2"></i>Save Data</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div> <!-- end col -->
        </div>
    </div>
@endsection
