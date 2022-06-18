@extends('layouts.admin')

@section('title')
    <title>Permissions</title>
@endsection

@section('custom_js')
    <script src="{{asset('vendor/sweetAlert2/sweetalert2@11.js')}}"></script>
    <script src="{{asset('admins/permission/index/index.js')}}"></script>
    <script src="{{asset('admins/common.js')}}"></script>

@endsection

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include('admin.partials.content-header', ['name'=>'Permissions', 'key'=>'List'])
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    @can('permission-add')
                    <div class="col-md-12">
                        <div class="col-6">
                            <a href="{{ route('permissions.create') }}"
                               class="btn btn-success float-left m-2 text-uppercase">Add new permission</a>
                        </div>
                    </div>
                    @endcan
                    <div class="col-md-6">
                        @if(session('success'))
                            <div class="alert alert-success response_message">
                                {{session('success')}}
                            </div>
                        @elseif(session('failure'))
                            <div class="alert alert-danger response_message">
                                {{session('failure')}}
                            </div>
                        @endif
                    </div>
                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Display name</th>
                                <th scope="col">Key_code</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php($i = 1)
                            @foreach($permissions as $permission)
                                <tr>
                                    <th scope="row">{{config('constants.pagination_records')*($permissions->currentPage()-1) + $i}}</th>
                                    <td>{{$permission->name}}</td>
                                    <td>{{$permission->display_name}}</td>
                                    <td>{{$permission->key_code}}</td>
                                    <td>
                                        @can('permission-edit')
                                            <a href="{{route('permissions.edit', ['id' => $permission->id])}}"
                                               class="btn btn-primary"><i class="fa fa-edit mr-2"></i>Edit</a>
                                        @endcan
                                        @can('permission-delete')
                                            <a
                                                data-url="{{route('permissions.delete', ['id' => $permission->id])}}"
                                                class="btn btn-danger action_delete"><i class="fa fa-trash mr-2 "></i>Delete</a>
                                        @endcan
                                    </td>
                                </tr>
                                @php($i++)
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12">
                        {{$permissions->links()}}
                    </div>

                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

