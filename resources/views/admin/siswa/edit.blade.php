@extends('layouts.dashboard.app', ['title' => 'Siswa'])

@section('content')
    <div class="container-fluid">

        <!-- start page title -->
        <div class="page-title-box">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h6 class="page-title">Siswa</h6>
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('siswa') }}">Siswa Management</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit</li>
                    </ol>
                </div>

                <div class="col-md-4">
                    <div class="float-end d-none d-md-block">
                        <div class="dropdown">
                            <button class="btn btn-primary  dropdown-toggle" type="button" id="dropdownMenuButton"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="mdi mdi-account-box me-2"></i> Edit Siswa
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="{{ route('siswa.edit', $siswa->id) }}">Add New Data</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <form class="row g-3 needs-validation" action="{{ route('siswa.update', $siswa->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="card-body">
                            <h4 class="card-title">Form Edit Siswa</h4>
                            <div class="row align-items-center g-3 mt-3">
                                <div class="col-md-4">
                                    <label for="name" class="form-label">Fullname</label>
                                    <input type="text" name="name"
                                        class="form-control @error('name') is-invalid @enderror"
                                        value="{{ old('name', $siswa->name) }}" id="name" placeholder="Fullname"
                                        autofocus>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="text" name="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        value="{{ old('email', $siswa->email) }}" id="email" placeholder="Email">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <label for="username" class="form-label">NISN</label>
                                    <input type="text" name="username"
                                        class="form-control @error('username') is-invalid @enderror"
                                        value="{{ old('username', $siswa->username) }}" id="username" placeholder="NISN">
                                    @error('username')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <label for="class" class="form-label">Kelas</label>
                                    <input type="text" name="class"
                                        class="form-control @error('class') is-invalid @enderror"
                                        value="{{ old('class', $siswa->dataSiswa->class ?? '') }}" id="class"
                                        placeholder="Kelas">
                                    @error('class')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label mb-3 d-flex">Gender</label>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" id="L" name="gender"
                                            class="form-check-input @error('gender') is-invalid @enderror" value="L"
                                            {{ old('gender', $siswa->dataSiswa->gender ?? '') == 'L' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="L">Laki-Laki</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" id="P" name="gender"
                                            class="form-check-input @error('gender') is-invalid @enderror" value="P"
                                            {{ old('gender', $siswa->dataSiswa->gender ?? '') == 'P' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="P">Perempuan</label>
                                    </div>
                                    @error('gender')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <label for="password" class="form-label">Password (Optional)</label>
                                    <input type="password" name="password"
                                        class="form-control @error('password') is-invalid @enderror" id="password"
                                        placeholder="Password">
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="card-footer">
                            <div class="d-flex justify-content-between align-items-center">
                                <button type="reset" class="btn btn-primary px-3">
                                    <i class="mdi mdi-rotate-right me-2"></i>Reset
                                </button>
                                <button type="submit" class="btn btn-success px-3">
                                    <i class="mdi mdi-check-circle me-2"></i>Save Data
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div> <!-- end col -->
        </div>
    </div>
@endsection
