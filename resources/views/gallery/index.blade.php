@extends('layouts.master')

@section('css')
<link href="{{ asset('lightbox2-dev/dist/css/lightbox.css') }}" rel="stylesheet" />
@endsection

@section('content')
    <div id="layoutSidenav_content">
        <main>
            <div class="gallery mt-5">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="d-flex justify-content-end">
                            <button class="btn btn-sm btn-primary m-2" data-bs-toggle="modal" data-bs-target="#form_add">Add
                                Data</button>

                            <div class="modal modal-md fade" id="form_add" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('gallery.store') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <input class="form-control form-control-sm" type="text"
                                                        name="name" placeholder="title">
                                                </div>
                                                <div class="mb-3">
                                                    <input class="form-control form-control-sm" type="text"
                                                        name="description" placeholder="description">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="formFile" class="form-label">picture</label>
                                                    <input class="form-control form-control-sm" name="picture"
                                                        type="file">
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
                        <div class="card">
                            <div class="card-header">
                                Gallery
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    @foreach ($data['galleries'] as $item)
                                        <div class="col-sm-3">
                                            <div>
                                                <a class="example-image-link" href="{{ asset('storage/' . $item->picture) }}"
                                                    data-lightbox="roadtrip" data-title="{{ $item->description }}"
                                                    style="max-width: 100px">

                                                    <img class="example-image" src="{{ asset('storage/' . $item->picture) }}" alt="img"
                                                    style="max-width: 100px">
                                                </a>

                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        {{-- @foreach ($data['galleries'] as $item)

            <div>
                <a class="example-image-link" href="{{ asset('storage/' . $item->picture) }}"
                    data-lightbox="roadtrip" data-title="{{ $item->description }}"
                    style="max-width: 100px"></a>
                <img src="{{ asset('storage/' . $item->picture) }}" alt="img"
                    style="max-width: 100px">
            </div>

    @endforeach --}}
    </div>
@endsection

sec
