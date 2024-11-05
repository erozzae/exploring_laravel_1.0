@extends('layouts.master')
@section('content')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Tables</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                    <li class="breadcrumb-item active">Tables</li>
                </ol>
                <div class="card mb-4">
                    <div class="btn-add m-2">
                        <button type="button" class="btn btn-sm btn-primary float-end" data-bs-toggle="modal"
                            data-bs-target="#form_add">
                            Add Data
                        </button>

                        <div class="modal modal-md fade" id="form_add" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('crud.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <input class="form-control form-control-sm" type="text" name="name"
                                                    placeholder="book's name">
                                            </div>
                                            <div class="mb-3">
                                                <input class="form-control form-control-sm" type="text"
                                                    name="description" placeholder="book's description">
                                            </div>
                                            <div class="mb-3">
                                                <label for="formFile" class="form-label">book's image</label>
                                                <input class="form-control form-control-sm" name="image" type="file">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                                            <button type="button" class="btn btn-sm btn-danger"
                                                data-bs-dismiss="modal">Cancel</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        DataTable Example
                    </div>
                    <div class="card-body">
                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Image</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($books as $item)
                                    <tr>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->description }}</td>
                                        <td><img class="rounded" src="{{ asset('storage/' . $item->image) }}" alt="img" style="max-width: 100px"></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
        <footer class="py-4 bg-light mt-auto">
            <div class="container-fluid px-4">
                <div class="d-flex align-items-center justify-content-between small">
                    <div class="text-muted">Copyright &copy; Your Website 2023</div>
                    <div>
                        <a href="#">Privacy Policy</a>
                        &middot;
                        <a href="#">Terms &amp; Conditions</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
@endsection
