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

        <!-- Awal Konten -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title">Semua Pengguna</h4>
                        <div class="table-responsive mb-3 fixed-solution mt-4">
                            <table id="datatable" class="table table-bordered dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Username</th>
                                        <th>Role</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <div class="d-flex justify-content-start align-items-center gap-2">
                                                    @if (!$user->image_profile)
                                                        <img src="{{ 'https://ui-avatars.com/api/?name=' . $user->name . '&background=000&color=fdfdfd&rounded=true' }}"
                                                            alt="gambar-default" class="rounded-circle" width="40"
                                                            height="40">
                                                    @else
                                                        <img src="{{ Storage::url($user->image_profile) }}"
                                                            alt="{{ $user->image_profile }}" class="rounded-circle"
                                                            width="40" height="40">
                                                    @endif
                                                    <p class="text-white ms-2">{{ $user->name }}</p>
                                                </div>
                                            </td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->username }}</td>
                                            <td>
                                                <span
                                                    class="badge bg-{{ $user->role == 'Superadmin' ? 'primary' : 'info' }} w-100">{{ $user->role }}</span>
                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-center align-items-center gap-2">
                                                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning">
                                                        <i class="fa fa-edit"></i> Edit
                                                    </a>
                                                    <a href="{{ route('users.destroy', $user->id) }}"
                                                        class="btn btn-danger" data-confirm-delete="true">
                                                        <i class="fa fa-trash"></i> Hapus
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div> <!-- akhir col -->
        </div>
    </div>
@endsection
