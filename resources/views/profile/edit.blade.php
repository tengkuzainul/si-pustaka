@extends('layouts.dashboard.app', ['title' => 'Profile Setting'])

@section('content')
    <div class="container-fluid">
        <!-- start page title -->
        <div class="page-title-box">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h6 class="page-title">Profile</h6>
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Profile Setting</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- end page title -->



        <div class="row">
            <div class="col-xl-3">
                <div class="user-sidebar">
                    <div class="card">
                        <form action="{{ route('profile.updateImage') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="">
                                    <div class="d-flex justify-content-end">
                                        <div class="dropdown">
                                            <button class="btn btn-success text-white rounded-circle" type="submit">
                                                <i class="mdi mdi-check-circle"></i>
                                            </button>
                                        </div>

                                    </div>
                                </div>
                                <div class="mt-n4 position-relative">
                                    <div class="text-center">
                                        <img id="image-preview"
                                            src="{{ Auth::user()->image_profile ? Storage::url(Auth::user()->image_profile) : 'https://ui-avatars.com/api/?name=' . Auth::user()->name . '&background=000&color=fdfdfd&rounded=true' }}"
                                            alt="{{ Auth::user()->name }}" class="avatar-xl rounded-circle img-thumbnail">

                                        <input type="file" name="image_profile" id="image_profile" class="d-none"
                                            onchange="previewImage()">

                                        <div class="mt-3">
                                            <h5 class="">{{ Auth::user()->name }}</h5>
                                            <div>
                                                <a href="#" class="text-muted m-1">{{ Auth::user()->role }}</a>
                                            </div>

                                            <div class="mt-4">
                                                <label for="image_profile"
                                                    class="btn btn-primary waves-effect waves-light btn-sm">
                                                    <i class="mdi mdi-upload me-"></i>Upload Image
                                                </label>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div> <!-- end card body -->
                        </form>
                    </div> <!-- end card -->
                </div>
            </div>

            <div class="col-xl-9">
                <div class="card">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#about" role="tab">
                                <i class="bx bx-user-circle font-size-20"></i>
                                <span class="d-none d-sm-block">Profile</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#tasks" role="tab">
                                <i class="bx bx-clipboard font-size-20"></i>
                                <span class="d-none d-sm-block">Reset Password</span>
                            </a>
                        </li>
                    </ul>
                    <!-- Tab content -->
                    <div class="tab-content p-4">

                        <div class="tab-pane active" id="about" role="tabpanel">
                            <div>
                                <div>
                                    <h5 class="font-size-16 mb-4">Profile</h5>
                                    <form action="{{ route('profile.update') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')

                                        <div class="row mb-3">
                                            <label for="name" class="col-sm-2 col-form-label">Name</label>

                                            <div class="col-sm-10">
                                                <input class="form-control @error('name') is-invalid @enderror"
                                                    type="text" name="name"
                                                    value="{{ old('name', Auth::user()->name) }}" placeholder="Name"
                                                    id="name">

                                                @error('name')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="username" class="col-sm-2 col-form-label">Username</label>

                                            <div class="col-sm-10">
                                                <input class="form-control @error('username') is-invalid @enderror"
                                                    type="text" name="username"
                                                    value="{{ old('username', Auth::user()->username) }}"
                                                    placeholder="Username" id="username">

                                                @error('username')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="email" class="col-sm-2 col-form-label">Email</label>

                                            <div class="col-sm-10">
                                                <input class="form-control @error('email') is-invalid @enderror"
                                                    type="text" name="email"
                                                    value="{{ old('email', Auth::user()->email) }}" placeholder="Email"
                                                    id="email">

                                                @error('email')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row float-end mx-1">
                                            <button type="submit" class="btn btn-success btn-rounded px-3">
                                                <i class="mdi mdi-check-circle me-2"></i>Update
                                            </button>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane" id="tasks" role="tabpanel">
                            <div>
                                <h5 class="font-size-16 mb-3">Reset Password</h5>

                                <form action="{{ route('profile.resetPassword') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <div class="row mb-3">
                                        <label for="new_password" class="col-sm-2 col-form-label">Password</label>
                                        <div class="col-sm-10">
                                            <div class="input-group">
                                                <input class="form-control @error('new_password') is-invalid @enderror"
                                                    type="password" name="new_password"
                                                    value="{{ old('new_password') }}" placeholder="Password"
                                                    id="new_password">
                                                <span class="input-group-text show-password" id="inputGroupPrepend"
                                                    style="cursor: pointer">
                                                    <i class="mdi mdi-eye-off"></i>
                                                </span>
                                            </div>

                                            @error('new_password')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="confirmation_password" class="col-sm-2 col-form-label">Password
                                            Confirmation</label>
                                        <div class="col-sm-10">
                                            <div class="input-group">
                                                <input
                                                    class="form-control @error('confirmation_password') is-invalid @enderror"
                                                    type="password" name="confirmation_password"
                                                    value="{{ old('confirmation_password') }}"
                                                    placeholder="Password Confirmation" id="confirmation_password">
                                                <span class="input-group-text show-password" id="inputGroupPrepend"
                                                    style="cursor: pointer">
                                                    <i class="mdi mdi-eye-off"></i>
                                                </span>
                                            </div>

                                            @error('confirmation_password')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row float-end mx-1">
                                        <button type="submit" class="btn btn-success btn-rounded px-3">
                                            <i class="mdi mdi-check-circle me-2"></i>Update
                                        </button>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end row-->
    </div> <!-- container-fluid -->

    <script>
        function previewImage() {
            const input = document.getElementById('image_profile');
            const preview = document.getElementById('image-preview');

            const file = input.files[0];
            if (file) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result;
                };

                reader.readAsDataURL(file);
            }
        }
    </script>

    <script>
        document.querySelectorAll('.show-password').forEach(function(element) {
            element.addEventListener('click', function() {
                const input = this.previousElementSibling;
                const icon = this.querySelector('i');

                if (input.type === "password") {
                    input.type = "text";
                    icon.classList.remove('mdi-eye-off');
                    icon.classList.add('mdi-eye');
                } else {
                    input.type = "password";
                    icon.classList.remove('mdi-eye');
                    icon.classList.add('mdi-eye-off');
                }
            });
        });
    </script>
@endsection
