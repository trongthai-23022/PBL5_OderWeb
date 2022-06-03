
@extends('layouts.admin')

@section('title')
    <title>Categories</title>
@endsection

@section('custom_css')
    <link rel="stylesheet" href="{{asset('admins/category/edit/edit.css')}}">
@endsection

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        @include('admin.partials.content-header', ['name'=>'Category', 'key'=>'Update'])

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <form action="{{route('categories.update', ['id' => $category->id])}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label>Category name</label>
                                <input type="text"
                                       class="form-control @error('name') is-invalid @enderror"
                                       placeholder="Enter category name"
                                       name="name"
                                       value="{{$category->name}}"
                                >
                                @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

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

