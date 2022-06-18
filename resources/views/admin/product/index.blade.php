@extends('layouts.admin')

@section('title')
    <title>Products</title>
@endsection
@section('custom_css')
    <link rel="stylesheet" href="{{asset('admins/product/index/index.css')}}">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.12.1/datatables.min.css"/>

@endsection


@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include('admin.partials.content-header', ['name'=>'Product', 'key'=>'List'])
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        @can('product-add')
                            <a href="{{ route('products.create') }}"
                               class="btn btn-success float-left m-2 text-uppercase">Add new product</a>
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
                        <form id="form1" method="get">
                            @csrf
                            <div class="input-group-append d-flex justify-content-between">
                                <div class="col-md-3 form-group">
                                    <label>Select a category</label>
                                    <select
                                        class="form-control  "
                                        name="category_id">
                                        <option value="">All</option>
                                        {!! $cate_options !!}
                                    </select>
                                </div>
                                <div class="col-md-3 form-group">
                                    <label>Sort by</label>
                                    <select
                                        class="form-control "
                                        name="sort_by">
                                        <option value="created_at-desc" {{$sort_by=='created_at-desc'? 'selected':''}}>Latest</option>
                                        <option value="created_at-asc" {{$sort_by=='created_at-asc'? 'selected':''}}>Earliest</option>
                                        <option value="price-desc" {{$sort_by=='price-desc'? 'selected':''}}>Price Desc</option>
                                        <option value="price-asc" {{$sort_by=='price-asc'? 'selected':''}}>Price Asc</option>
                                        <option value="name-desc" {{$sort_by=='name-desc'? 'selected':''}}>Name Desc</option>
                                        <option value="name-asc" {{$sort_by=='name-asc'? 'selected':''}}>Name Asc</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <div class="float-right form-group">
                                        <label class="form-label" for="form1">Search</label>
                                        <div class="input-group-append">
                                            <div class="input-group">
                                                <input name="q" type="search" id="form1" class="form-control" value="{{$search}}"/>
                                            </div>
                                            <button form="form1" id="search-button" type="submit" class="btn btn-primary">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-12">
                        <table id="table-products" class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">ID</th>
                                <th scope="col">Product name</th>
                                <th scope="col">Price</th>
                                <th scope="col">Image</th>
                                <th scope="col">Category</th>
                                <th scope="col">Created At</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Actions</th>
                                {{--                                <th scope="col">Edit</th>--}}
                                {{--                                <th scope="col">Delete</th>--}}
                            </tr>
                            </thead>
                            <body>
                            @php
                                $i = 1;
                            @endphp
                            @foreach($products as $product)
                                <tr>
                                    <th scope="row">{{$products->perPage()*($products->currentPage()-1)+$i}}</th>
                                    <td>{{$product->id}}</td>
                                    <td>{{$product->name}}</td>
                                    <td>{{number_format($product->price)}}</td>
                                    <td><img class="product-main-image"
                                             src="{{isset($product->main_image_name)?
                                                $product->main_image_path: url('https://cdn3.vectorstock.com/i/1000x1000/35/52/placeholder-rgb-color-icon-vector-32173552.jpg')
                                                }}"
                                             alt="{{isset($product->main_image_name)?$product->main_image_name: 'no-image'
                                                }}"></td>
                                    <td>{{optional($product->category)->name}}</td>
                                    <td>{{ $product->created_at->format('Y/m/d')}}</td>
                                    <td>{{ $product->amount}}</td>
                                    <td>
                                        @can('product-edit')
                                            <a href="{{route('products.edit',['id'=>$product->id])}}"
                                               class="btn btn-primary"><i class="fa fa-edit mr-2"></i>Edit</a>
                                        @endcan
                                        @can('product-delete')
                                            <a href="" class="btn btn-danger action_delete"
                                               data-url="{{route('products.delete',['id'=>$product->id])}}">
                                                <i class="fa fa-trash mr-2"></i>Delete</a>
                                        @endcan
                                    </td>
                                </tr>
                                @php
                                    $i++;
                                @endphp
                            @endforeach
                            </body>
                        </table>
                        <div class="row">
                            {{$products->links()}}
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

@section('custom_js')
    <script src="{{asset('vendor/sweetAlert2/sweetalert2@11.js')}}"></script>
    <script src="{{asset('admins/common.js')}}"></script>

@endsection

