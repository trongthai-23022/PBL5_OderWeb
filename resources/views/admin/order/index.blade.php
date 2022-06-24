@extends('layouts.admin')

@section('title')
    <title>Orders</title>
@endsection
@section('custom_css')
    <link rel="stylesheet" href="{{asset('admins/product/index/index.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('vendor/datatable/datatables.min.css')}}"/>
    <style>
        tfoot input {
            width: 80%;
            padding: 2px;
            box-sizing: border-box;
        }
        .dataTables_length{
            margin-top: 20px;
        }
        .dt-buttons{

        }
    </style>

@endsection


@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include('admin.partials.content-header', ['name'=>'Orders', 'key'=>'List'])
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-12">
                        <table class="table table-striped" id="table-index">
                            <div class="dt-buttons">
                                Export
                            </div>
                            <div class="dataTables_length"></div>

                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Khách hàng</th>
                                <th scope="col">Số điện thoại</th>
                                <th scope="col">Số lượng </th>
                                <th scope="col">Tổng tiền</th>
                                <th scope="col">Đặt hàng lúc</th>
                                <th scope="col">Cập nhật lúc</th>
                                <th scope="col">Trạng thái</th>
                                <th scope="col">Xử lí</th>
{{--                                <th scope="col">Action</th>--}}
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th></th>
                                <th class="search">name</th>
                                <th class="search">phone</th>
                                <th class="search">qty</th>
                                <th class="search">total</th>
                                <th class="search">created_at</th>
                                <th class="search">updated_at</th>
                                <th class="search">status</th>
                                <th></th>
                            </tr>
                            </tfoot>

                        </table>
                    </div>

                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

@section('custom_js')
    <script src="{{asset('vendor/sweetAlert2/sweetalert2@11.js')}}"></script>
    <script src="{{asset('admins/common.js')}}"></script>
    <script type="text/javascript" src="{{asset('vendor/datatable/pdfmake.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('vendor/datatable/vfs_fonts.js')}}"></script>
    <script type="text/javascript" src="{{asset('vendor/datatable/datatables.min.js')}}"></script>
    <script>
        $(function() {
            $('#table-index tfoot th.search').each(function () {
                var title = $(this).text();
                $(this).html('<input type="text" id="' + title +'" placeholder="Search ' + title + '" />');

            });
            // $.fn.dataTable.ext.search.push(function (settings, data, dataIndex) {
            //     let min = parseInt($('#qty').val(), 0);
            //     let qty = parseInt(data[3]) || 0; // use data for the age column
            //
            //     return (isNaN(min) || (min <= qty));
            // });
            $('#table-index').DataTable({
                dom: 'Blrtip',
                select: true,
                buttons: [
                    {
                        extend: 'excel',
                        exportOptions: {
                            columns: ':visible :not(.not-export)'
                        },
                    },
                    {
                        extend: 'pdf',
                        exportOptions: {
                            columns: ':visible :not(.not-export)'
                        },
                    },
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: ':visible :not(.not-export)'
                        },
                    },
                    'colvis'
                ],
                processing: true,
                serverSide: true,
                ajax: '{!! route('api.orders.index') !!}',
                order: [[ 5, "desc" ]],
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'user_name', name: 'user_name' },
                    { data: 'user_phone', name: 'user_phone' },
                    { data: 'item_count', name: 'item_count' },
                    { data: 'total', name: 'total' },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'updated_at', name: 'updated_at' },
                    { data: 'status', name: 'status' },
                    {
                        targets: 8,
                        orderable: false,
                        searchable: false,
                        columnDefs: [
                            {className: "not-export", "targets": [8]}
                        ],

                        data: "edit",
                        render: function ( data, type, row, meta ) {
                            return `<a href="${data}"
                                        class="btn btn-primary"><i class="fa fa-edit mr-2"></i>Xem</a>`;
                        }
                    },
                ],
                initComplete: function () {
                    // Apply the search
                    this.api()
                        .columns()
                        .every(function () {
                            let that = this;

                            $('input', this.footer()).on('keyup change clear', function () {
                                if (that.search() !== this.value) {
                                    that.search(this.value).draw();
                                }
                            });
                        });
                },

            });

            // $('#qty').keyup(function () {
            //     table.draw();
            // });
        });
    </script>
@endsection

