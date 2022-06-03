@extends('layouts.admin')

@section('title')
    <title>Users</title>
@endsection
@section('custom_css')

@endsection
@section('custom_js')
    <script src="{{asset('vendor/sweetAlert2/sweetalert2@11.js')}}"></script>
    <script src="{{asset('admins/user/index/index.js')}}"></script>
    <script src="{{asset('admins/common.js')}}"></script>
@endsection

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include('admin.partials.content-header', ['name'=>'User', 'key'=>'List'])
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        @can('user-add')
                            <a href="{{ route('users.create') }}" class="btn btn-success float-left m-2 text-uppercase">Add
                                new user</a>
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
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">User name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $i = 1;
                            @endphp
                            @foreach($users as $user)
                                <tr>
                                    <th scope="row">{{$users->perPage()*($users->currentPage()-1)+$i}}</th>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>
                                        @can('user-edit')
                                            <a href="{{route('users.edit',['id'=>$user->id])}}"
                                               class="btn btn-primary"><i class="fa fa-edit mr-2"></i>Edit</a>
                                        @endcan
                                        @can('user-delete')
                                            <a href="" class="btn btn-danger action_delete"
                                               data-url="{{route('users.delete',['id'=>$user->id])}}">
                                                <i class="fa fa-trash mr-2"></i>Delete</a>
                                        @endcan
                                    </td>
                                </tr>
                                @php
                                    $i++;
                                @endphp
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12">
                        {{$users->links()}}
                    </div>

                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

