$(document).ready(function () {
    // loadData()

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $("#brands_data").DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ route('brand.getData') }}",
            type: "get",
        },
        columns: [
            {
                data: "DT_RowIndex",
                name: "DT_RowIndex",
                orderable: false,
                searchable: false,
            },
            {
                data: "name",
                name: "name",
            },
            {
                data: "location",
                name: "location",
            },
        ],
    });
});
