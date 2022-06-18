@extends('layouts.admin')

@section('title')
    <title>Products</title>
@endsection


@section('custom_css')
    <link href="{{asset('vendor/select2/select2.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('admins/product/add/add.css')}}" rel="stylesheet"/>
@endsection

@section('custom_js')
    <script src="{{asset('admins/jquery.min.js')}}"></script>
    <script src="{{asset('admins/product/add/add.js')}}"></script>
    <script src="{{asset('vendor/select2/select2.min.js')}}"></script>
    <script src="https://cdn.tiny.cloud/1/vnu0ov8n5r5z6vuhscwugch5dll4ecxqzp9zylomvtliz8iu/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="{{asset('admins/common.js')}}"></script>

@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        @include('admin.partials.content-header', ['name'=>'Product', 'key'=>'Add'])
        <div class="row justify-content-center">
            <div class="col-md-9 rounded">
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
        </div>
        <form action="{{route('products.store')}}" method="post" enctype="multipart/form-data">
            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row justify-content-center">
                        <div class="col-md-9 rounded bg-white px-3 mb-3">
                            @csrf

                            <div class="form-group">
                                <label>Product name</label>
                                <input type="text"
                                       class="form-control @error('name') is-invalid @enderror"
                                       placeholder="Enter product name"
                                       name="name"
                                       value="{{old('name')}}"
                                >
                                @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Price</label>
                                <input type="number"
                                       class="form-control @error('price') is-invalid @enderror"
                                       placeholder="Enter price"
                                       name="price"
                                       value="{{old('price')}}"
                                >
                                @error('price')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Product main image</label>
                                <input type="file"
                                       id="fileupload"
                                       class="form-control-file"
                                       placeholder="Chooses a file"
                                       name="product_image"
                                       onchange="readURL(this);"
                                >
                                <div class="row mt-4">
                                    <div id="dvPreview"></div>
<<<<<<< HEAD
=======
                                </div>
                            </div>
>>>>>>> d90344c57a3c99ef4220ffe5f8a613b153f1580b

                                </div>

                                <div class="form-group">
                                    <label>Product detail image </label>
                                    <input type="file"
                                           multiple
                                           class="form-control-file"
                                           placeholder="Chooses a file"
                                           name="product_images[]"
                                           id="gallery-photo-add"
                                    >
                                    <div class="">
                                        <div id="gallery" class="gallery"></div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Select a category</label>
                                    <select
                                        class="form-control  @error('category_id') is-invalid @enderror"
                                        name="category_id">
                                        <option value="">Category</option>
                                        {!! $htmlOption !!}
                                    </select>
                                    @error('category_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Enter tags</label>
                                    <select name="tags[]" class="form-control tags_select2" multiple="multiple">
                                    </select>
                                </div>

                                <div>
                                    <div class="form-group ">
                                        <label>Product Description</label>
                                        <textarea id="tinymce-editor" name="description"
                                                  class="form-control @error('description') is-invalid @enderror"
                                                  rows="3">{{old('description')}}</textarea>
                                        @error('description')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>

                        </div>
                        <!-- /.row -->

                    </div><!-- /.container-fluid -->
                </div>
            </div>
        </form>
        <!-- /.content -->

    </div>
    <!-- /.content-wrapper -->
@endsection


