@extends('layouts.admin')

@section('title')
    <title>Sliders</title>
@endsection
@section('custom_css')
    <link rel="stylesheet" href="{{asset('admins/slider/index/index.css')}}">
@endsection
@section('custom_js')
    <script src="{{asset('vendor/sweetAlert2/sweetalert2@11.js')}}"></script>
    <script src="{{asset('admins/common.js')}}"></script>
@endsection

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include('admin.partials.content-header', ['name'=>'Slider', 'key'=>'List'])
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        @can('slider-add')
                            <a href="{{ route('sliders.create') }}"
                               class="btn btn-success float-left m-2 text-uppercase">Add new slider</a>
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
                                <th>#</th>
                                <th>Title</th>
                                <th>Subtitle</th>
                                <th>Description</th>
                                <th>Content position</th>
                                <th>Product (ID)</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $i = 1;
                            @endphp
                            @foreach($sliders as $slider)
                                <tr>
                                    <td>{{$sliders->perPage()*($sliders->currentPage()-1)+$i}}</td>
                                    <td>{{$slider->title}}</td>
                                    <td>{{$slider->subtitle}}</td>
                                    <td>{{$slider->description}}</td>
                                    <td>{{$slider->content_position}}</td>
                                    <td>{{$slider->product_id}}</td>
                                    <td><img class="slider-image"
                                             src="{{isset($slider->image_name)?
                                                $slider->image_path: url('https://cdn3.vectorstock.com/i/1000x1000/35/52/placeholder-rgb-color-icon-vector-32173552.jpg')
                                                }}"
                                             alt="{{isset($slider->image_name)?$slider->image_name: 'no-image'
                                                }}">
                                    </td>
                                    <td>
                                        @can('slider-edit')
                                            <a href="{{route('sliders.edit',['id'=>$slider->id])}}"
                                               class="btn btn-primary"><i class="fa fa-edit mr-2"></i>Edit</a>
                                        @endcan
                                        @can('slider-delete')
                                            <a href="" class="btn btn-danger action_delete"
                                               data-url="{{route('sliders.delete',['id'=>$slider->id])}}">
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
{{--                        {{$sliders->links()}}--}}
                    </div>

                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

