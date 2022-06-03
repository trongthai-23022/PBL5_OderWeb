
@extends('layouts.admin')

@section('title')
    <title>Categories</title>
@endsection
@section('custom_css')
    <link rel="stylesheet" href="{{asset('admins/category/add/add.css')}}">
@endsection

@section('custom_js')
    <script src="{{asset('admins/common.js')}}"></script>
@endsection



@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        @include('admin.partials.content-header', ['name'=>'Category', 'key'=>'Add'])

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
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
                        <form action="{{route('categories.store')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label>Category name</label>
                                <input type="text"
                                       class="form-control @error('name') is-invalid @enderror"
                                       placeholder="Enter category name"
                                       name="name"
                                       value="{{old('name')}}"
                                >
                                @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                                <div class="form-group">
                                    <label>Parent category</label>
                                    <select class="form-control @error('parent_id') is-invalid @enderror"
                                            name="parent_id">
                                        <option value="0">itself</option>
                                        {!! $htmlOption !!}
                                    </select>
                                    @error('parent_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
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

