@extends('layouts.dashboard.app', ['title' => 'Books'])

@section('content')
    <div class="container-fluid">

        <!-- start page title -->
        <div class="page-title-box">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h6 class="page-title">Books</h6>
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('buku') }}">Books Management</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Data</li>
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
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title">All Books</h4>
                        <div class="table-responsive mb-3 fixed-solution mt-4">
                            <table id="datatable" class="table table-bordered dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>ISBN</th>
                                        <th>Books Name</th>
                                        <th>Books Stock</th>
                                        <th>Book Category</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>


                                <tbody>
                                    @foreach ($books as $key => $book)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <span
                                                    class="badge bg-{{ $key % 2 == 0 ? 'primary' : 'info' }} w-100">{{ $book->isbn }}</span>
                                            </td>
                                            <td>{{ $book->nama_buku }}</td>
                                            <td>{{ $book->stok_buku }}</td>
                                            <td>{{ $book->kategoriBuku->nama_kategori }}</td>
                                            <td>
                                                <div class="d-flex justify-content-center align-items-center gap-2">
                                                    <a href="{{ route('buku.edit', $book->id) }}" class="btn btn-warning">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <a href="{{ route('buku.destroy', $book->id) }}" class="btn btn-danger"
                                                        data-confirm-delete="true">
                                                        <i class="fa fa-trash"></i>
                                                    </a>
                                                    <a href="{{ route('buku.show', $book->id) }}" class="btn btn-primary">
                                                        <i class="fa fa-eye"></i>
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
