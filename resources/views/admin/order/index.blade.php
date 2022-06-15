@extends('layouts.admin')

@section('title')
    <title>Orders</title>
@endsection
@section('custom_css')
    <link rel="stylesheet" href="{{asset('admins/product/index/index.css')}}">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.12.1/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/date-1.1.2/fc-4.1.0/fh-3.2.3/r-2.3.0/rg-1.2.0/sc-2.0.6/sb-1.3.3/sl-1.4.0/datatables.min.css"/>


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
                        @can('product-add')
                            <a href="{{ route('products.create') }}"
                               class="btn btn-success float-left m-2 text-uppercase">Add new product</a>
                        @endcan
                    </div>
                    <div class="col-md-6">
                        @if(session('success'))
                            <div class="alert alert-success response_message ">
                                {{session('success')}}
                            </div>
                        @elseif(session('failure'))
                            <div class="alert alert-danger response_message ">
                                {{session('failure')}}
                            </div>
                        @endif
                    </div>
                    <div class="col-md-12">
                        <table class="table table-striped" id="table-index">
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
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.12.1/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/date-1.1.2/fc-4.1.0/fh-3.2.3/r-2.3.0/rg-1.2.0/sc-2.0.6/sb-1.3.3/sl-1.4.0/datatables.min.js"></script>
    <script>
        $(function() {
            $('#table-index').DataTable({
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
                        data: "edit",
                        render: function ( data, type, row, meta ) {
                            return `<a href="${data}"
                                        class="btn btn-primary"><i class="fa fa-edit mr-2"></i>Xem</a>`;
                        }
                    },
                    // {
                    //     targets: 7,
                    //     orderable: false,
                    //     searchable: false,
                    //     data: "delete",
                    //     render: function ( data, type, row, meta ) {
                    //         return `<a href="" class="btn btn-danger action_delete"
                    //                                                        data-url="${data}"">
                    //                                                         <i class="fa fa-trash mr-2"></i>Delete</a>`;
                    //     }
                    // },

                ],

            });
        });
    </script>
@endsection

