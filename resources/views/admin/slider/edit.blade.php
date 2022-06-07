@extends('layouts.admin')

@section('title')
    <title>Sliders</title>
@endsection


@section('custom_css')
    <link href="{{asset('admins/slider/edit/edit.css')}}" rel="stylesheet"/>
@endsection

@section('custom_js')
    <script src="{{asset('admins/slider/edit/edit.js')}}"></script>
    <script src="https://cdn.tiny.cloud/1/vnu0ov8n5r5z6vuhscwugch5dll4ecxqzp9zylomvtliz8iu/tinymce/6/tinymce.min.js"
            referrerpolicy="origin"></script>
    <script src="{{asset('admins/common.js')}}"></script>
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        @include('admin.partials.content-header', ['name'=>'Slider', 'key'=>'Add'])
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
        <form action="{{route('sliders.update',['id'=> $slide->id])}}" method="post" enctype="multipart/form-data">
            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row justify-content-center">
                        <div class="col-md-9 rounded bg-white px-3 mb-3">
                            @csrf
                            <div class="form-group">
                                <label>Content position</label>
                                <select class="form-control "
                                        name="content_position">
                                    <option value="left" {{$slide->content_position === 'left'?'selected':''}}>left
                                    </option>
                                    <option value="middle" {{$slide->content_position === 'middle'?'selected':''}}>middle
                                    </option>
                                    <option value="right" {{$slide->content_position === 'right'?'selected':''}}>right
                                    </option>
                                </select>
                                {{--                                @error('parent_id')--}}
                                {{--                                <div class="alert alert-danger">{{ $message }}</div>--}}
                                {{--                                @enderror--}}
                            </div>
                            <div class="form-group">
                                <div class="form-group ">
                                    <label>Title</label>
                                    <textarea id="tinymce-editor" name="title"
                                              class="form-control "
                                              rows="3">{{$slide->title}}
                                        {{old('title')}}
                                </textarea>
                                    {{--                                @error('description')--}}
                                    {{--                                <div class="alert alert-danger">{{ $message }}</div>--}}
                                    {{--                                @enderror--}}
                                </div>
                                {{--                                @error('name')--}}
                                {{--                                <div class="alert alert-danger">{{ $message }}</div>--}}
                                {{--                                @enderror--}}
                            </div>

                            <div class="form-group">
                                <label>Subtitle</label>
                                <input type="text"
                                       {{--                                       @error('name') is-invalid @enderror--}}
                                       class="form-control "
                                       placeholder="Enter slide subtitle"
                                       name="subtitle"
                                       value="{{$slide->subtitle}}"
                                >
                                {{--                                @error('name')--}}
                                {{--                                <div class="alert alert-danger">{{ $message }}</div>--}}
                                {{--                                @enderror--}}
                            </div>

                            <div class="form-group">
                                <label>Slide image</label>
                                <input type="file"
                                       class="form-control-file"
                                       placeholder="Chooses a file"
                                       name="slider_image"
                                >
                                <div class="col mt-3">
                                    <img  src="{{$slide->image_path}}"
                                         alt="{{$slide->image_name}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Product ID</label>
                                <input type="text"
                                       {{--                                       @error('name') is-invalid @enderror--}}
                                       class="form-control "
                                       placeholder="Enter product id"
                                       name="product_id"
                                       value="{{$slide->product_id}}"
                                >
                            </div>

                            <div>
                                <div class="form-group ">
                                    <label>Description</label>
                                    <textarea id="tinymce-editor" name="description"
                                              class="form-control "
                                              rows="3">
                                    {{$slide->description}}
                                </textarea>
                                    {{--                                @error('description')--}}
                                    {{--                                <div class="alert alert-danger">{{ $message }}</div>--}}
                                    {{--                                @enderror--}}
                                </div>
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


