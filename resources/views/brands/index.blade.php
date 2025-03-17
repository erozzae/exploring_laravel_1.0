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
                        {{-- Modal Add Data --}}
                        <div class="modal modal-md fade" id="form_add" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form id="formAddData" action="" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <input class="form-control form-control-sm" type="text" id="name-add"
                                                    name="name" placeholder="brand's name">
                                            </div>
                                            <div class="mb-3">
                                                <input class="form-control form-control-sm" type="text" id="location-add"
                                                    name="location" placeholder="brand's location">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit"
                                                class="btn-add-submit btn btn-sm btn-primary">Submit</button>
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
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
                {{-- Modal Edit Data --}}
                <div class="modal modal-md fade" id="form_edit" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form id="formEditData" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <input class="form-control form-control-sm" type="text" id="name-edit"
                                            name="name" placeholder="brand's name" value="">
                                    </div>
                                    <div class="mb-3">
                                        <input class="form-control form-control-sm" type="text" id="location-edit"
                                            name="location" placeholder="brand's location" value="">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn-edit-submit btn btn-sm btn-primary">Submit</button>
                                    <button type="button" class="btn btn-sm btn-danger"
                                        data-bs-dismiss="modal">Cancel</button>
                                </div>
                            </form>
                        </div>
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
    <script>
        $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })

            //get csrf token
            let _token = $('meta[name="csrf-token"]').attr('content');
            //getData
            let brandsTable = $('#brands_data').DataTable({
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
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                    },
                ],
                createdRow: function(row, data, index) {
                    $(row).find('.btn_edit').click(function(e) {
                        e.preventDefault();

                        let id = $(this).data('id');
                        setTimeout(() => {
                            $('#form_edit').modal('show');
                        }, 0);

                        $.ajax({
                            type: "get",
                            url: '{{ route('brand.getDataById', ['id' => ':id']) }}'
                                .replace(
                                    ':id', id),
                            success: function(response) {
                                $('#name-edit').val(response.data.name);
                                $('#location-edit').val(response.data.location);
                            }
                        });


                        $("#formEditData").off('submit').on("submit", function(e) {
                            e.preventDefault();
                            $('.btn-edit-submit').prop('disabled', true);

                            let name = $('#name-edit').val()
                            let location = $('#location-edit').val()

                            $.ajax({
                                type: "post",
                                url: '{{ route('brand.edit', ['id' => ':id']) }}'
                                    .replace(
                                        ':id', id),
                                data: {
                                    name: name,
                                    location: location,
                                },
                                success: function(response) {
                                    $('#form_edit').modal('hide');

                                    $('.btn-edit-submit').prop('disabled',
                                        false);
                                    brandsTable.ajax.reload(null, true);
                                },
                                error: function(xhr, status, error) {
                                    alert(
                                        `Terjadi kesalahan: ${xhr.responseText}`
                                    );
                                    $('.btn-edit-submit').prop('disabled',
                                        false);
                                }
                            });
                        });
                    });

                    $(row).find(".btn_delete").click(function(e) {
                        e.preventDefault();

                        let id = $(this).data('id');
                        if (confirm("Hapus data?") == true) {
                            $('.btn_delete').prop('disabled', true);

                            $.ajax({
                                type: "post",
                                url: '{{ route('brand.delete', ['id' => ':id']) }}'
                                    .replace(
                                        ':id', id),
                                success: function(response) {
                                    $('.btn_delete').prop('disabled',
                                        false);
                                    brandsTable.ajax.reload(null, true);
                                }
                            });
                        }
                    });
                }
            });

            //StoreData
            $('#formAddData').submit(function(e) {
                e.preventDefault();
                $('.btn-add-submit').prop('disabled', true)

                let name = $('#name-add').val();
                let location = $('#location-add').val();

                $.ajax({
                    type: "post",
                    url: "{{ route('brand.store') }}",
                    data: {
                        name: name,
                        location: location,

                    },
                    success: function(response) {
                        $('#form_add').modal('hide');
                        $('.btn-add-submit').prop('disabled', false);
                        brandsTable.ajax.reload(null, true);
                    },
                    error: function(xhr, status, error) {
                        alert(`Terjadi kesalahan: ${xhr.responseText}`);
                        $('.btn-add-submit').prop('disabled', false);
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
