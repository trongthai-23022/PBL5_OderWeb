@extends('layouts.admin')

@section('title')
    <title>Permissions</title>
@endsection
@section('custom_css')
    <link rel="stylesheet" href="{{asset('admins/permission/edit/edit.css')}}">
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
                        <form action="{{route('permissions.update',['id'=>$permission->id])}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label>Permission name</label>
                                <input type="text"
                                       class="form-control @error('name') is-invalid @enderror"
                                       placeholder="example: add product"
                                       name="name"
                                       value="{{$permission->name}}"
                                >
                                @error('name')
                                    <div class="alert alert-danger">{{$message}}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Parent permission</label>
                                <select class="form-control @error('parent_id') is-invalid @enderror"
                                        name="parent_id">
                                    <option value="0">Itself</option>
                                    {!! $htmlOption !!}
                                </select>
                                @error('parent_id')
                                <div class="alert alert-danger">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Permission description</label>
                                <input type="text"
                                       class="form-control @error('description') is-invalid @enderror "
                                       placeholder="example: Them san pham"
                                       name="description"
                                       value="{{$permission->display_name}}"
                                >
                                @error('description')
                                <div class="alert alert-danger">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Permission key_code</label>
                                <input type="text"
                                       class="form-control @error('key_code') is-invalid @enderror"
                                       placeholder="example: product_add"
                                       name="key_code"
                                       value="{{$permission->key_code}}"
                                >
                                @error('key_code')
                                <div class="alert alert-danger">{{$message}}</div>
                                @enderror
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

