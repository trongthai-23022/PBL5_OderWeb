@extends('layouts.app')

@section('title')
    <title>Cart</title>
@endsection

@section('custom_css')

@endsection

@section('custom_js')
    <script src="{{asset('vendor/sweetAlert2/sweetalert2@11.js')}}"></script>
    <script src="{{asset('customers/cart/cart.js')}}"></script>
@endsection

@section('content')
    <div class="wrap-breadcrumb">
        <ul>
            <li class="item-link"><a href="{{route('app.home')}}" class="link">Home</a></li>
            @php
                Cart::setGlobalTax(10);
                    $segments = '' ;
            @endphp
            @foreach(\Illuminate\Support\Facades\Request::segments() as $segment)
                @php
                    $segments .= '/'. $segment;
                @endphp
                <li>
                    <a href="{{ $segments }}">{{$segment}}</a>
                </li>
            @endforeach
        </ul>
    </div>
    <div class=" main-content-area">
        @if(\Gloudemans\Shoppingcart\Facades\Cart::count() == 0)
            <div class="container pb-60">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <div class=""><img
                                style="height: 200px"
                                src="{{asset('customers/emptycart.png')}}" alt="empty-cart">
                        </div>
                        <a href="{{route('app.home')}}" class="btn btn-submit btn-submitx">Chọn món ngay</a>
                    </div>
                </div>
            </div><!--end container-->
        @else
            <div class="wrap-iten-in-cart">
                <h3 class="box-title mt-4">Products Name</h3>
                <ul class="products-cart">

                    @foreach(\Gloudemans\Shoppingcart\Facades\Cart::content() as $cartItem)
                        <div class="col">
                            <li class="pr-cart-item">
                                <div class="product-image">
                                    <figure><img src="{{$cartItem->options->image_path}}"
                                                 alt="{{$cartItem->options->image_name}}"></figure>
                                </div>
                                <div class="product-name">
                                    <a class="link-to-product"
                                       href="{{route('detail', [ 'slug' => $cartItem->options->slug,'id' => $cartItem->id])}}">{{$cartItem->name}}</a>
                                </div>
                                <div class="price-field product-price"><p
                                        id="cart-item-price-{{$cartItem->rowId}}"
                                        class="price">{{number_format($cartItem->price,0,',','.')}} đ</p>
                                    <input hidden
                                           id="cart-item-price-hidden-{{$cartItem->rowId}}"
                                           class="price" value="{{$cartItem->price}}"
                                    >
                                </div>
                                <div class="quantity">
                                    <div class="quantity-input">
                                        <input id="{{$cartItem->rowId}}" type="text" class="qty-input"
                                               name="product-quatity"
                                               data-row_id="{{$cartItem->rowId}}"
                                               data-url="{{route('cart.update')}}"
                                               value="{{$cartItem->qty}}" data-min="1"
                                               data-max="20" pattern="[0-9]*">
                                        <a class="btn btn-increase qty-change" href=""
                                           data-row_id="{{$cartItem->rowId}}"
                                           data-url="{{route('cart.update')}}"
                                        ></a>
                                        <a class="btn btn-reduce qty-change" href=""
                                           data-row_id="{{$cartItem->rowId}}"
                                           data-url="{{route('cart.update')}}"
                                        ></a>
                                    </div>
                                </div>
                                <div class="price-field sub-total"><p
                                        id="cart-item-total-{{$cartItem->rowId}}"
                                        class="price">{{number_format($cartItem->price * $cartItem->qty,0,',','.')}}
                                        đ</p></div>
                                <div class="delete">
                                    <a href=""
                                       data-url="{{route('cart.destroy', ['rowId'=> $cartItem->rowId])}}"
                                       class="delete_cart_action">
                                        <i class="fa fa-times-circle fa-2x"></i>
                                    </a>
                                </div>
                            </li>
                        </div>
                    @endforeach
                </ul>
            </div>
            <div class="summary">
                <div class="order-summary">
                    <h4 class="title-box">Order Summary</h4>
                    <p class="summary-info"><span class="title">Tổng</span><b
                            id="cart-sub-total"
                            class="index">{{\Gloudemans\Shoppingcart\Facades\Cart::subtotal(0,',','.')}} đ</b>
                    </p>
                    <p class="summary-info"><span class="title">Free Ship</span><b
                            class="index">0 đ</b></p>
                    <p class="summary-info"><span class="title">Thuế (10%)</span><b
                            id="cart-tax"
                            class="index">{{\Gloudemans\Shoppingcart\Facades\Cart::tax(0,',','.')}} đ</b></p>
                    <p class="summary-info total-info "><span class="title">Thành tiền</span><b
                            id="cart-total"
                            class="index">{{\Gloudemans\Shoppingcart\Facades\Cart::total(0,',','.')}} đ</b></p>
                </div>
                <div class="checkout-info">

                    <div class="row">
                        <div class="col-md-3">
                            <a class="btn btn-checkout" href="{{route('cart.removeall')}}">Xóa giỏ hàng</a>
                        </div>
                        <div class="col-md-9">
                            <a class="btn btn-checkout" href="{{route('cart.checkout.info')}}">Đặt hàng</a>
                        </div>
                    </div>
                    <a class="link-to-shop" href="{{route('app.shop',['id'=>0, 'slug'=>'all'])}}">Tiếp tục mua<i
                            class="fa fa-arrow-circle-right"
                            aria-hidden="true"></i></a>
                </div>

            </div>
        @endif

            @if(!is_null($onSaleProducts))
                @include('Shop.partials.onsale')
            @endif

    </div><!--end main content area-->

@endsection





