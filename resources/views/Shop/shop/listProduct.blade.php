@extends('Shop.shop.shop')

@section('breadscrum')
    <div class="wrap-breadcrumb">
        <ul>
            <li class="item-link"><a href="/" class="link">home</a></li>
            <li class="item-link"><span>{{$category->name}}</span></li>
        </ul>
    </div>
@endsection
@section('title-cate')
    <h1 class="shop-title">{{$category->name}}</h1>
@endsection
@section('listP')
    <div class="row">

        <ul class="product-list grid-products equal-container">

            @foreach($products as $product)
                <li class="col-lg-4 col-md-6 col-sm-6 col-xs-6 ">
                    <div class="product product-style-3 equal-elem ">
                        <div class="product-thumnail">
                            <a href="{{route('detail',['slug'=> $product->slug,'id'=>$product->id])}}"
                               title="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                <figure><img src="{{$product->main_image_path}}" alt=""></figure>
                            </a>
                        </div>
                        <div class="product-info">
                            <a href="{{route('detail',['slug'=> $product->slug,'id'=>$product->id])}}"
                               class="product-name"><span>{{$product->name}}</span></a>
                            <div class="wrap-price"><span class="product-price">{{$product->price}} VND</span></div>
                            <a href="#" class="btn add-to-cart">Add To Cart</a>
                        </div>
                    </div>
                </li>
            @endforeach

        </ul>

    </div>
@endsection
