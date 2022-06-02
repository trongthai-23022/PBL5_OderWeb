@extends('layouts.admin')

@section('title')
    <title>Permissions</title>
@endsection

@section('custom_css')
    <link rel="stylesheet" href="{{asset('admins/permission/edit/edit.css')}}">
@endsection
@section('custom_js')
    <script src="{{asset('admins/permission/add/add.js')}}"></script>
@endsection
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        @include('admin.partials.content-header', ['name'=>'Permission', 'key'=>'Add'])

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <form action="{{route('permissions.store')}}" method="post">
                            @csrf

                            <div class="form-group">
                                <label>Module name</label>
                                <select class="form-control"
                                        name="module">
                                    @foreach($modules as $key => $value)
                                        @php($module = $key . '.' . $value)
                                        <option value={{$module}}>{{$key}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <b>Actions</b>
                                <div class="card border-primary mb-3 mt-4 col-md-12"  style="max-width: 100%;">
                                    <div class="card-header mt-2 text-white text-uppercase">
                                        <label>
                                            <input type="checkbox" name="" class="wrapper-checkbox">
                                        </label>
                                        <b>Check all</b>
                                    </div>
                                    <div class="row">
                                        @foreach(config('permissions.module_actions') as $actionKey => $actionValue)
                                            @php($action = $actionKey . '.' . $actionValue)
                                            <div class="card-body text-primary col-md-3">
                                                <label>
                                                    <input type="checkbox"
                                                           name="actions[]"
                                                           class="child-checkbox"
                                                           value="{{$action}}">
                                                </label>
                                                {{str_replace('_', ' ', $actionValue)}}
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
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

