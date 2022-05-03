@extends('layouts.admin')

@section('title')
    <title>Products</title>
@endsection
@section('custom_css')
    <link rel="stylesheet" href="{{asset('admins/product/index/index.css')}}">
@endsection
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include('partials.content-header', ['name'=>'Product', 'key'=>'List'])
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <a href="{{ route('products.create') }}" class="btn btn-success float-right m-2">Add</a>
                    </div>
                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Product name</th>
                                <th scope="col">Price</th>
                                <th scope="col">Image</th>
                                <th scope="col">Category name</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $i = 1;
                            @endphp
                            @foreach($products as $product)
                                <tr>
                                    <th scope="row">{{$products->perPage()*($products->currentPage()-1)+$i}}</th>
                                    <td>{{$product->name}}</td>
                                    <td>{{$product->price}}</td>
                                    <td><img class="product-main-image"
                                             src="{{isset($product->main_image_name)?
                                                $product->main_image_path: url('https://cdn3.vectorstock.com/i/1000x1000/35/52/placeholder-rgb-color-icon-vector-32173552.jpg')
                                                }}"
                                             alt="{{isset($product->main_image_name)?
                                                $product->main_image_name: 'no-image'
                                                }}"></td>
                                    <td>{{$product->category->name}}</td>
                                    <td>
                                        <a href="#" class="btn btn-primary"><i class="fa fa-edit mr-2"></i>Edit</a>
                                        <a href="" class="btn btn-danger"><i class="fa fa-trash mr-2"></i>Delete</a>
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
                        {{$products->links()}}
                    </div>

                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

