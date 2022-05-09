@extends('layouts.admin')

@section('title')
    <title>Roles</title>
@endsection

@section('custom_css')
    <link href="{{asset('vendor/select2/select2.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('admins/role/add/add.css')}}" rel="stylesheet"/>
@endsection

@section('custom_js')
    <script src="{{asset('admins/role/add/add.js')}}">

    </script>

@endsection


@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        @include('partials.content-header', ['name'=>'Role', 'key'=>'Add'])

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-md-12 rounded bg-white px-3 mb-3">
                        <form action="{{route('roles.store')}}" method="post">
                            @csrf
                            <div class="col">
                                <div class="form-group">
                                    <label>Role name</label>
                                    <input type="text"
                                           class="form-control "
                                           placeholder="Enter role name"
                                           name="name"
                                           value="{{old('name')}}"
                                    >
                                </div>

                                <div class="form-group">
                                    <label>Role description</label>
                                    <textarea name="display_name"
                                              class="form-control"
                                              rows="4"

                                    >{{old('display_name')}}</textarea>
                                </div>
                            </div>
                            <div class="col">
                                <p class="font-weight-bold">Permission of role</p>
                                <div class="row ">
                                    <!-- /card -->
                                    @foreach($parent_permissions as $parent_permission)
                                        <div class="card border-primary mb-3 mt-4 col-md-12"  style="max-width: 100%;">
                                            <div class="card-header mt-2 text-white text-uppercase">
                                                <label>
                                                    <input type="checkbox" name="" class="wrapper-checkbox">
                                                </label>
                                                {{$parent_permission->display_name}}

                                            </div>
                                            <div class="row">
                                                @foreach($parent_permission->childPermissions as $childPermission)
                                                    <div class="card-body text-primary col-md-3">
                                                        <label>
                                                            <input type="checkbox"
                                                                   name="permission_id[]"
                                                                   class="child-checkbox"
                                                                   value="{{$childPermission->id}}">
                                                        </label>
                                                        {{$childPermission->display_name}}
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <button type="submit" class="btn btn-primary mb-3">Submit</button>
                            </div>
                        </form>
                    </div>

                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

