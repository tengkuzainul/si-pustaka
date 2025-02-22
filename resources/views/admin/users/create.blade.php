@extends('layouts.dashboard.app', ['title' => 'Manajemen Pengguna'])

@section('content')
    <div class="container-fluid">

        <!-- Awal Judul Halaman -->
        <div class="page-title-box">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h6 class="page-title">Manajemen Pengguna</h6>
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Beranda</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('users') }}">Manajemen Pengguna</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Data</li>
                    </ol>
                </div>

                <div class="col-md-4">
                    <div class="float-end d-none d-md-block">
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="mdi mdi-account-multiple-plus me-2"></i> Tambah Pengguna
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="{{ route('users.create') }}">Tambah Data Baru</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Awal Form Tambah Pengguna -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <form class="needs-validation" novalidate action="{{ route('users.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <h4 class="card-title">Form Tambah Pengguna</h4>
                            <div class="row align-items-center g-3 mt-3">
                                <div class="col-md-4">
                                    <div class="d-flex justify-content-center mb-4">
                                        <img id="selectedAvatar"
                                            src="https://mdbootstrap.com/img/Photos/Others/placeholder-avatar.jpg"
                                            class="rounded-circle" style="width: 100px; height: 100px; object-fit: cover;"
                                            alt="gambar contoh" />
                                    </div>

                                    <div class="d-flex justify-content-center">
                                        <div data-mdb-ripple-init class="btn btn-primary btn-rounded">
                                            <label class="form-label text-white m-1" for="customFile2">Pilih Berkas</label>
                                            <input type="file" name="image_profile" class="form-control d-none"
                                                id="customFile2" onchange="displaySelectedImage(event, 'selectedAvatar')" />
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <label for="name" class="form-label">Nama Lengkap</label>
                                    <input type="text" name="name"
                                        class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}"
                                        id="name" placeholder="Nama Lengkap" autofocus>

                                    @error('name')
                                        <div class="valid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" name="username"
                                        class="form-control @error('username') is-invalid @enderror"
                                        value="{{ old('username') }}" id="username" placeholder="Username">

                                    @error('username')
                                        <div class="valid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label" for="role">Pilih Peran</label>
                                    <select class="form-control @error('role') is-invalid @enderror text-dark select2"
                                        name="role">
                                        <option>Pilih</option>
                                        <optgroup label="Peran">
                                            <option value="Superadmin" class="text-dark">Superadmin</option>
                                            <option value="Admin" class="text-dark">Admin</option>
                                        </optgroup>
                                    </select>

                                    @error('role')
                                        <div class="valid-feedback">
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
                                        <div class="valid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="password" class="form-label">Kata Sandi</label>
                                    <input type="password" name="password"
                                        class="form-control @error('password') is-invalid @enderror"
                                        value="{{ old('password') }}" id="password" placeholder="Kata Sandi">

                                    @error('password')
                                        <div class="valid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="password_confirmation" class="form-label">Konfirmasi Kata Sandi</label>
                                    <input type="password" name="password_confirmation"
                                        class="form-control @error('password_confirmation') is-invalid @enderror"
                                        value="{{ old('password_confirmation') }}" id="password_confirmation"
                                        placeholder="Konfirmasi Kata Sandi">

                                    @error('password_confirmation')
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
                                        class="mdi mdi-check-circle me-2"></i>Simpan Data</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div> <!-- akhir col -->
        </div>
    </div>

    <script>
        function displaySelectedImage(event, elementId) {
            const selectedImage = document.getElementById(elementId);
            const fileInput = event.target;

            if (fileInput.files && fileInput.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    selectedImage.src = e.target.result;
                };

                reader.readAsDataURL(fileInput.files[0]);
            }
        }
    </script>
@endsection
