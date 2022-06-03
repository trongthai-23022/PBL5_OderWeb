@extends('layouts.admin')

@section('title')
    <title>Users</title>
@endsection

@section('custom_css')
    <link href="{{asset('vendor/select2/select2.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('admins/user/add/add.css')}}" rel="stylesheet"/>
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        @include('admin.partials.content-header', ['name'=>'User', 'key'=>'Update'])
        <form action="{{route('users.update',['id'=>$user->id])}}" method="post" enctype="multipart/form-data">
            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row justify-content-center">
                        <div class="col-md-9 rounded- bg-white px-3 mb-3">
                            @csrf
                            <div class="form-group">
                                <label>User name</label>
                                <input type="text"
                                       class="form-control @error('name') is-invalid @enderror"
                                       placeholder="Enter user name"
                                       name="name"
                                       value="{{$user->name}}"
                                >
                                @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email"
                                       class="form-control @error('email') is-invalid @enderror"
                                       placeholder="Enter email"
                                       name="email"
                                       value="{{$user->email}}"
                                >
                                @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password"
                                       class="form-control @error('password') is-invalid @enderror"
                                       placeholder="Enter password"
                                       name="password"
                                >
                                @error('password')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Role</label>
                                <select class="form-control select2-init"
                                        name="role_ids[]"
                                        multiple>
                                    <option value=""></option>
                                    @foreach($roles as $role)
                                        <option {{$user_role->contains('id',$role->id)?'selected': ''}}
                                                value="{{$role->id}}">{{$role->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>

                        </div>


                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
        </form>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

@section('custom_js')
    <script src="{{asset('vendor/select2/select2.min.js')}}"></script>
        <script src="{{asset('admins/user/add/add.js')}}"></script>


@endsection
