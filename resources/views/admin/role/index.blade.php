@extends('layouts.admin')

@section('title')
    <title>Roles</title>
@endsection

@section('custom_css')

@endsection
@section('custom_js')
    <script src="{{asset('vendor/sweetAlert2/sweetalert2@11.js')}}"></script>
    <script src="{{asset('admins/role/index/index.js')}}"></script>
    <script src="{{asset('admins/common.js')}}"></script>
@endsection
@section('custom_css')
    <link href="{{asset('admins/role/index/index.css')}}" rel="stylesheet"/>
@endsection
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include('admin.partials.content-header', ['name'=>'Roles', 'key'=>'List'])
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    @can('role-add')
                        <div class="col-md-12">
                            <a href="{{ route('roles.create') }}" class="btn btn-success float-left m-2 text-uppercase">Add
                                new role</a>
                        </div>
                    @endcan
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
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Description</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($roles as $role)
                                <tr>
                                    <th scope="row">{{$role->id}}</th>
                                    <td>{{$role->name}}</td>
                                    <td>{{$role->display_name}}</td>
                                    <td>
                                        @can('role-edit')
                                            <a href="{{route('roles.edit', ['id' => $role->id])}}"
                                               class="btn btn-primary"><i class="fa fa-edit mr-2"></i>Edit</a>
                                        @endcan
                                        @can('role-delete')
                                            <a href=""
                                               data-url="{{route('roles.delete', ['id' => $role->id])}}"
                                               class="btn btn-danger action_delete"><i class="fa fa-trash mr-2"></i>Delete</a>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12">
                        {{$roles->links()}}
                    </div>

                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

