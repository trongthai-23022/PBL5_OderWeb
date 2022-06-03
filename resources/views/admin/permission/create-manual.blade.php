@extends('layouts.admin')

@section('title')
    <title>Permissions</title>
@endsection

@section('custom_css')
    <link rel="stylesheet" href="{{asset('admins/permission/add/add.css')}}">
@endsection
@section('custom_js')
    <script src="{{asset('admins/common.js')}}"></script>
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
                        @if(session('success'))
                            <div class="alert alert-success response_message">
                                {{session('success')}}
                            </div>
                        @elseif(session('failure'))
                            <div class="alert alert-danger response_message">
                                {{session('failure')}}
                            </div>
                        @endif
                        <form action="{{route('permissions.store-manual')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label>Permission name</label>
                                <input type="text"
                                       class="form-control @error('name') is-invalid @enderror"
                                       placeholder="example: add product"
                                       name="name"
                                       value="{{old('name')}}"
                                >
                            </div>
                            @error('name')
                                <div class="alert alert-danger">{{$message}}</div>
                            @enderror

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
                                       class="form-control  @error('description') is-invalid @enderror"
                                       placeholder="example: Them san pham"
                                       name="description"
                                       value="{{old('description')}}"
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
                                       value="{{old('key_code')}}"
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
