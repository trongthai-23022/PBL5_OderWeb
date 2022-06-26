
@extends('layouts.admin')

@section('title')
    <title>Mã giảm giá</title>
@endsection

@section('custom_css')
    <link rel="stylesheet" type="text/css" href="{{asset('vendor/datatable/datatables.min.css')}}"/>
@endsection


@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include('admin.partials.content-header', ['name'=>'Coupon-code', 'key'=>'List'])
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
{{--                        @can('code-add')--}}
                            <a href="{{ route('codes.create') }}"
                               class="btn btn-success float-left m-2 text-uppercase">Add new coupon-code</a>
{{--                        @endcan--}}
                    </div>
                    <div class="col-md-12">
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
                        <table class="table" id="table-coupon">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">ID</th>
                                <th scope="col">CODE</th>
                                <th scope="col">Giảm giá</th>
                                <th scope="col">Mô tả</th>
                                <th scope="col">Trạng thái</th>
                                <th scope="col">Tạo lúc</th>
                                <th scope="col">Cập nhật lúc</th>
                                <th scope="col">Sửa</th>
                                <th scope="col">Xóa</th>
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
    <script type="text/javascript" src="{{asset('vendor/datatable/pdfmake.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('vendor/datatable/vfs_fonts.js')}}"></script>
    <script type="text/javascript" src="{{asset('vendor/datatable/datatables.min.js')}}"></script>
    <script src="{{asset('vendor/sweetAlert2/sweetalert2@11.js')}}"></script>
    <script src="{{asset('admins/common.js')}}"></script>
    <script>
        $(function() {
            $('#table-coupon').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('api.codes.index') !!}',
                order: [[ 6, "desc" ]],
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'id', name: 'id' },
                    { data: 'code', name: 'code' },
                    { data: 'discount', name: 'discount' },
                    { data: 'description', name: 'description' },
                    { data: 'is_enable', name: 'is_enable' },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'updated_at', name: 'updated_at' },
                    {
                        targets: 8,
                        orderable: false,
                        searchable: false,
                        data: "edit",
                        render: function ( data, type, row, meta ) {
                            return `<a href="${data}"
                                        class="btn btn-primary"><i class="fa fa-edit mr-2"></i>Sửa</a>`;
                        }
                    },
                    {
                        targets: 9,
                        orderable: false,
                        searchable: false,
                        data: "delete",
                        render: function ( data, type, row, meta ) {
                            return `<a
                                        class="btn btn-danger action_delete" data-url="${data}"><i class="fa fa-trash mr-2"></i>Xóa</a>`;
                        }
                    },
                ],
            });

        });
    </script>
@endsection

