@extends('layouts.app')

@section('title')
    <title>Cart</title>
@endsection

@section('custom_css')

@endsection

@section('custom_js')
    <script src="{{asset('vendor/sweetAlert2/sweetalert2@11.js')}}"></script>
    <script src="{{asset('admins/common.js')}}"></script>
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

                        <a class="btn btn-checkout" href="{{route('cart.checkout.info')}}">Check out</a>
                        <a class="link-to-shop" href="{{route('shop')}}">Continue Shopping<i
                                    class="fa fa-arrow-circle-right"
                                    aria-hidden="true"></i></a>
                    </div>

                </div>

                <div class="wrap-show-advance-info-box style-1 box-in-site">
                    <h3 class="title-box">Most Viewed Products</h3>
                    <div class="wrap-products">
                        <div class="products slide-carousel owl-carousel style-nav-1 equal-container" data-items="5"
                             data-loop="false" data-nav="true" data-dots="false"
                             data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"3"},"1200":{"items":"5"}}'>

                            <div class="product product-style-2 equal-elem ">
                                <div class="product-thumnail">
                                    <a href="#" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                        <figure><img src="assets/images/products/digital_04.jpg" width="214"
                                                     height="214" alt="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                        </figure>
                                    </a>
                                    <div class="group-flash">
                                        <span class="flash-item new-label">new</span>
                                    </div>
                                    <div class="wrap-btn">
                                        <a href="#" class="function-link">quick view</a>
                                    </div>
                                </div>
                                <div class="product-info">
                                    <a href="#" class="product-name"><span>Radiant-360 R6 Wireless Omnidirectional Speaker [White]</span></a>
                                    <div class="wrap-price"><span class="product-price">$250.00</span></div>
                                </div>
                            </div>

                            <div class="product product-style-2 equal-elem ">
                                <div class="product-thumnail">
                                    <a href="#" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                        <figure><img src="assets/images/products/digital_17.jpg" width="214"
                                                     height="214" alt="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                        </figure>
                                    </a>
                                    <div class="group-flash">
                                        <span class="flash-item sale-label">sale</span>
                                    </div>
                                    <div class="wrap-btn">
                                        <a href="#" class="function-link">quick view</a>
                                    </div>
                                </div>
                                <div class="product-info">
                                    <a href="#" class="product-name"><span>Radiant-360 R6 Wireless Omnidirectional Speaker [White]</span></a>
                                    <div class="wrap-price">
                                        <ins><p class="product-price">$168.00</p></ins>
                                        <del><p class="product-price">$250.00</p></del>
                                    </div>
                                </div>
                            </div>

                            <div class="product product-style-2 equal-elem ">
                                <div class="product-thumnail">
                                    <a href="#" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                        <figure><img src="assets/images/products/digital_15.jpg" width="214"
                                                     height="214" alt="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                        </figure>
                                    </a>
                                    <div class="group-flash">
                                        <span class="flash-item new-label">new</span>
                                        <span class="flash-item sale-label">sale</span>
                                    </div>
                                    <div class="wrap-btn">
                                        <a href="#" class="function-link">quick view</a>
                                    </div>
                                </div>
                                <div class="product-info">
                                    <a href="#" class="product-name"><span>Radiant-360 R6 Wireless Omnidirectional Speaker [White]</span></a>
                                    <div class="wrap-price">
                                        <ins><p class="product-price">$168.00</p></ins>
                                        <del><p class="product-price">$250.00</p></del>
                                    </div>
                                </div>
                            </div>

                            <div class="product product-style-2 equal-elem ">
                                <div class="product-thumnail">
                                    <a href="#" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                        <figure><img src="assets/images/products/digital_01.jpg" width="214"
                                                     height="214" alt="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                        </figure>
                                    </a>
                                    <div class="group-flash">
                                        <span class="flash-item bestseller-label">Bestseller</span>
                                    </div>
                                    <div class="wrap-btn">
                                        <a href="#" class="function-link">quick view</a>
                                    </div>
                                </div>
                                <div class="product-info">
                                    <a href="#" class="product-name"><span>Radiant-360 R6 Wireless Omnidirectional Speaker [White]</span></a>
                                    <div class="wrap-price"><span class="product-price">$250.00</span></div>
                                </div>
                            </div>

                            <div class="product product-style-2 equal-elem ">
                                <div class="product-thumnail">
                                    <a href="#" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                        <figure><img src="assets/images/products/digital_21.jpg" width="214"
                                                     height="214" alt="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                        </figure>
                                    </a>
                                    <div class="wrap-btn">
                                        <a href="#" class="function-link">quick view</a>
                                    </div>
                                </div>
                                <div class="product-info">
                                    <a href="#" class="product-name"><span>Radiant-360 R6 Wireless Omnidirectional Speaker [White]</span></a>
                                    <div class="wrap-price"><span class="product-price">$250.00</span></div>
                                </div>
                            </div>

                            <div class="product product-style-2 equal-elem ">
                                <div class="product-thumnail">
                                    <a href="#" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                        <figure><img src="assets/images/products/digital_03.jpg" width="214"
                                                     height="214" alt="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                        </figure>
                                    </a>
                                    <div class="group-flash">
                                        <span class="flash-item sale-label">sale</span>
                                    </div>
                                    <div class="wrap-btn">
                                        <a href="#" class="function-link">quick view</a>
                                    </div>
                                </div>
                                <div class="product-info">
                                    <a href="#" class="product-name"><span>Radiant-360 R6 Wireless Omnidirectional Speaker [White]</span></a>
                                    <div class="wrap-price">
                                        <ins><p class="product-price">$168.00</p></ins>
                                        <del><p class="product-price">$250.00</p></del>
                                    </div>
                                </div>
                            </div>

                            <div class="product product-style-2 equal-elem ">
                                <div class="product-thumnail">
                                    <a href="#" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                        <figure><img src="assets/images/products/digital_04.jpg" width="214"
                                                     height="214" alt="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                        </figure>
                                    </a>
                                    <div class="group-flash">
                                        <span class="flash-item new-label">new</span>
                                    </div>
                                    <div class="wrap-btn">
                                        <a href="#" class="function-link">quick view</a>
                                    </div>
                                </div>
                                <div class="product-info">
                                    <a href="#" class="product-name"><span>Radiant-360 R6 Wireless Omnidirectional Speaker [White]</span></a>
                                    <div class="wrap-price"><span class="product-price">$250.00</span></div>
                                </div>
                            </div>

                            <div class="product product-style-2 equal-elem ">
                                <div class="product-thumnail">
                                    <a href="#" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                        <figure><img src="assets/images/products/digital_05.jpg" width="214"
                                                     height="214" alt="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                        </figure>
                                    </a>
                                    <div class="group-flash">
                                        <span class="flash-item bestseller-label">Bestseller</span>
                                    </div>
                                    <div class="wrap-btn">
                                        <a href="#" class="function-link">quick view</a>
                                    </div>
                                </div>
                                <div class="product-info">
                                    <a href="#" class="product-name"><span>Radiant-360 R6 Wireless Omnidirectional Speaker [White]</span></a>
                                    <div class="wrap-price"><span class="product-price">$250.00</span></div>
                                </div>
                            </div>
                        </div>
                    </div><!--End wrap-products-->
                </div>

            </div><!--end main content area-->


@endsection





