<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">
    <title>Sistem Informasi Perpustakaan &mdash; Log In</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description">
    <meta content="Themesbrand" name="author">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/dashboard/images/favicon.ico') }}">

    <link href="{{ asset('assets/dashboard/libs/chartist/chartist.min.css') }}" rel="stylesheet">

    <!-- Bootstrap Css -->
    <link href="{{ asset('assets/dashboard/css/bootstrap.min.cs') }}s" id="bootstrap-style" rel="stylesheet"
        type="text/css">
    <!-- Icons Css -->
    <link href="{{ asset('assets/dashboard/css/icons.min.css') }}" rel="stylesheet" type="text/css">
    <!-- App Css-->
    <link href="{{ asset('assets/dashboard/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

</head>

<body class="account-pages" data-bs-theme="dark">
    <!-- Begin page -->
    <div class="accountbg"
        style="background: url('{{ asset('assets/image/perpus.png') }}');background-size: cover;background-position: center; opacity: 76%;">
    </div>

    <div class="wrapper-page account-page-full">

        <div class="card shadow-none">
            <div class="card-block">

                <div class="account-box">

                    <div class="card-box shadow-none p-4">
                        <div class="p-2">
                            <div class="text-center mt-4">
                                <a href="{{ url('/login') }}" class="logo logo-dark">
                                    <span class="logo-lg">
                                        <img src="{{ asset('assets/image/logo-smk.png') }}" alt=""
                                            height="70">
                                    </span>
                                    <span class="h5 text-dark">SISTEM INFORMASI PERPUSTAKAAN</span>
                                </a>

                                <a href="{{ url('/login') }}" class="logo logo-light">
                                    <span class="logo-lg">
                                        <span class="logo-lg">
                                            <img src="{{ asset('assets/image/logo-smk.png') }}" alt=""
                                                height="70">
                                        </span>
                                        <span class="h5 text-white">SISTEM INFORMASI PERPUSTAKAAN</span>
                                    </span>
                                </a>
                            </div>

                            <h4 class="font-size-18 mt-5 text-center">Welcome Portal Perpustakaan !</h4>
                            <p class="text-muted text-center">Sign in to continue to Dashboard.</p>

                            <form class="mt-4" action="{{ route('login') }}" method="POST">
                                @csrf

                                <div class="mb-3">
                                    <label class="form-label" for="email">Email</label>
                                    <input type="email" name="email" value="{{ old('email') }}"
                                        class="form-control @error('email')
                                        is-invalid
                                    @enderror"
                                        id="email" placeholder="Enter email">

                                    @error('email')
                                        <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>


                                <div class="mb-3">
                                    <label class="form-label" for="password">Password</label>
                                    <input type="password" name="password"
                                        class="form-control @error('password') is-invalid @enderror" id="password"
                                        placeholder="Enter password">

                                    @error('password')
                                        <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-3 row">
                                    <div class="col-sm-6">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="remember"
                                                name="remember" {{ old('remember') ? 'checked' : '' }}>
                                            <label class="form-check-label" for="remember">Remember
                                                me</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 text-end">
                                        <button class="btn btn-primary rounded-pill w-lg waves-effect waves-light"
                                            type="submit">Log
                                            In <i
                                                class="ms-2 {{ $errors->any() ? 'bi bi-emoji-frown-fill' : 'bi bi-emoji-smile-fill' }}"></i></button>
                                    </div>
                                </div>

                            </form>

                            <div class="mt-5 pt-4 text-center">
                                <script>
                                    document.write(new Date().getFullYear())
                                </script> Sistem Informasi Perpustakaan.
                                </p>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>



    <!-- JAVASCRIPT -->
    @include('layouts.dashboard.js')

</body>

</html>
