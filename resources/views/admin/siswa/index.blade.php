@extends('layouts.dashboard.app', ['title' => 'Manajemen Siswa'])

@section('content')
    <div class="container-fluid">

        <!-- Mulai Judul Halaman -->
        <div class="page-title-box">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h6 class="page-title">Manajemen Siswa</h6>
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Beranda</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('siswa') }}">Manajemen Siswa</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Data Siswa</li>
                    </ol>
                </div>

                <div class="col-md-4">
                    <div class="float-end d-none d-md-block">
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="mdi mdi-account-box me-2"></i> Tambah Siswa
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="{{ route('siswa.create') }}">Tambah Data Baru</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Daftar Siswa -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title">Daftar Siswa</h4>
                        <div class="table-responsive mb-3 fixed-solution mt-4">
                            <table id="datatable" class="table table-bordered dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Siswa</th>
                                        <th>Email</th>
                                        <th>NISN</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Kelas</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($siswas as $siswa)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $siswa->name }}</td>
                                            <td>{{ $siswa->email }}</td>
                                            <td>{{ $siswa->username }}</td>
                                            <td>{{ $siswa->siswaData->gender == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                                            <td>
                                                <span class="badge bg-primary w-100">{{ $siswa->siswaData->class }}</span>
                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-center align-items-center gap-2">
                                                    <a href="{{ route('siswa.edit', $siswa->id) }}" class="btn btn-warning">
                                                        <i class="fa fa-edit"></i> Edit
                                                    </a>
                                                    <a href="{{ route('siswa.destroy', $siswa->id) }}"
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
            </div> <!-- end col -->
        </div>
    </div>
@endsection
