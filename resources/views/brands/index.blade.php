@extends('layouts.master')
@section('content')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Brands</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                    <li class="breadcrumb-item active">Brands</li>
                </ol>
                <div class="card mb-4">
                    <div class="btn-add m-2">
                        <button type="button" class="btn_modal btn btn-sm btn-primary float-end">
                            Add Data
                        </button>
                        {{-- Modal --}}
                        <div class="modal modal-md fade" id="form_add" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form id="formData" action="" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <input class="form-control form-control-sm" type="text" id="name"
                                                    name="name" placeholder="brand's name">
                                            </div>
                                            <div class="mb-3">
                                                <input class="form-control form-control-sm" type="text" id="location"
                                                    name="location" placeholder="brand's location">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn-submit btn btn-sm btn-primary">Submit</button>
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
                        Brands data
                    </div>
                    <div class="card-body">
                        <table id="brands_data" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Location</th>
                                </tr>
                            </thead>
                            <tbody>

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


@section('js')
    {{-- <script src="{{ asset('js/brand/crud.js') }}"></script> --}}
    <script>
        $(document).ready(function() {
            // loadData()

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })

            //get csrf token
            let _token = $('meta[name="csrf-token"]').attr('content');
            //getData
            $('#brands_data').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('brand.getData') }}",
                    type: "get"
                },
                columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                }, {
                    data: 'name',
                    name: 'name'
                }, {
                    data: 'location',
                    name: 'location'
                }]
            });

            //StoreData
            $('#formData').submit(function(e) {
                e.preventDefault();
                $('.btn-submit').prop('disabled', true)

                let name = $('#name').val();
                let location = $('#location').val();

                $.ajax({
                    type: "post",
                    url: "{{ route('brand.store') }}",
                    data: {
                        name: name,
                        location:location,

                    },
                    success: function(response) {
                        $('#form_add').modal('hide');
                        alert(`Data sukses disimpan: ${response.data}`);
                        $('.btn-submit').prop('disabled', false);
                    },
                    error: function(xhr, status, error) {
                        alert(`Terjadi kesalahan: ${xhr.responseText}`);
                        $('.btn-submit').prop('disabled', false);
                    }

                })
            });


            $('.btn_modal').click(function(e) {
                e.preventDefault();
                $('#name').val('');
                $('#location').val('');
                $('#form_add').modal('show')
            });

        });
    </script>
@endsection>
