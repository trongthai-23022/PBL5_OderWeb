@extends('layouts.app')

@section('title')
    <title>Shop</title>
@endsection

@section('custom_js')
    <script src="{{asset('customers/shop/filter.js')}}"></script>
    <script src="{{asset('vendor/sweetAlert2/sweetalert2@11.js')}}"></script>
    <script src="{{asset('admins/common.js')}}"></script>
@endsection

@section('content')

        <div class="main-site left-sidebar">

            <div class="wrap-breadcrumb">
                <ul>
                    <li class="item-link"><a href="{{route('app.home')}}" class="link">Home</a></li>
                    @php
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
            <div class="row">

                <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12 main-content-area">

                    <div class="banner-shop">
                        <a href="#" class="banner-link">
                            <figure><img src="assets/images/shop-banner.jpg" alt=""></figure>
                        </a>
                    </div>

                    <div class="wrap-shop-control">

                        <h1 class="shop-title">{{$cateName}}</h1>

                        <div class="wrap-right">

                            <div class="sort-item orderby ">
                                <select name="orderby" class="use-chosen" >
                                    <option value="menu_order" selected="selected">Default sorting</option>
                                    <option value="popularity">Sort by popularity</option>
                                    <option value="rating">Sort by average rating</option>
                                    <option value="date">Sort by newness</option>
                                    <option value="price">Sort by price: low to high</option>
                                    <option value="price-desc">Sort by price: high to low</option>
                                </select>
                            </div>

                            <div class="sort-item product-per-page">
                                <select name="post-per-page" class="use-chosen" >
                                    <option value="12" selected="selected">12 per page</option>
                                    <option value="16">16 per page</option>
                                    <option value="18">18 per page</option>
                                    <option value="21">21 per page</option>
                                    <option value="24">24 per page</option>
                                    <option value="30">30 per page</option>
                                    <option value="32">32 per page</option>
                                </select>
                            </div>

                            <div class="change-display-mode">
                                <a href="#" class="grid-mode display-mode active"><i class="fa fa-th"></i>Grid</a>
                                <a href="list.html" class="list-mode display-mode"><i class="fa fa-th-list"></i>List</a>
                            </div>

                        </div>

                    </div><!--end wrap shop control-->

                    <div class="row">

                        <ul class="product-list grid-products equal-container">
                            @foreach($cateProducts as $item)
                                <li class="col-lg-4 col-md-6 col-sm-6 col-xs-6 ">
                                <div class="product product-style-3 equal-elem ">
                                    <div class="product-thumnail">
                                        <a href="{{route('detail', [ 'slug' => $item->slug,'id' => $item->id])}}"
                                           title="{{$item->name}}">
                                            <figure><img
                                                    style="width: 100%; height: 250px;object-fit: cover;"
                                                    src="{{$item->main_image_path}}" alt="{{$item->main_image_name . $item->id}}"></figure>
                                        </a>
                                    </div>
                                    <div class="product-info">
                                        <a href="{{route('detail', [ 'slug' => $item->slug,'id' => $item->id])}}"
                                           class="product-name"><span>{{$item->name}}</span></a>
                                        <div class="wrap-price">
                                            <span class="product-price">đ {{number_format($item->price)}}</span>
                                            <span class="product-price" style="font-weight: normal; font-size: 12px;float: right;">Đã bán: {{$item->amount}}</span>
                                        </div>
                                        <form method="post">
                                            @csrf
                                            <div class="wrap-butons">

                                                <input type="hidden" value="1" name="cart_product_qty"
                                                       class="cart_product_qty_{{$item->id}}">
                                                <input type="hidden" value="{{$item->id}}" name="cart_product_id"
                                                       class="cart_product_id_{{$item->id}}">
                                                <input type="button" value="Thêm vào giỏ hàng" class="function-link add-to-cart"
                                                       data-product_item="{{$item->id}}" data-url="{{route('cart.store')}}">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>

                    </div>

                    <div class="wrap-pagination-info">
                        {{$cateProducts->links()}}
                    </div>
                </div><!--end main products area-->

                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12 ">
                    @include('Shop.shop.menu')

                    <div class="widget mercado-widget filter-widget brand-widget">
                        <h2 class="widget-title">Brand</h2>
                        <div class="widget-content">
                            <ul class="list-style vertical-list list-limited" data-show="6">
                                <li class="list-item"><a class="filter-link active" >Fashion Clothings</a></li>
                                <li class="list-item"><a class="filter-link " >Laptop Batteries</a></li>
                                <li class="list-item"><a class="filter-link " >Printer & Ink</a></li>
                                <li class="list-item"><a class="filter-link " >CPUs & Prosecsors</a></li>
                                <li class="list-item"><a class="filter-link " >Sound & Speaker</a></li>
                                <li class="list-item"><a class="filter-link " >Shop Smartphone & Tablets</a></li>
                                <li class="list-item default-hiden"><a class="filter-link " >Printer & Ink</a></li>
                                <li class="list-item default-hiden"><a class="filter-link " >CPUs & Prosecsors</a></li>
                                <li class="list-item default-hiden"><a class="filter-link " >Sound & Speaker</a></li>
                                <li class="list-item default-hiden"><a class="filter-link " >Shop Smartphone & Tablets</a></li>
                                <li class="list-item"><a data-label='Show less<i class="fa fa-angle-up" aria-hidden="true"></i>' class="btn-control control-show-more" href="#">Show more<i class="fa fa-angle-down" aria-hidden="true"></i></a></li>
                            </ul>
                        </div>
                    </div><!-- brand widget-->

                    <div class="widget mercado-widget filter-widget price-filter">
                        <h2 class="widget-title">Price</h2>
                        <div class="widget-content">
                            <div id="slider-range"></div>
                            <p>
                                <label for="amount">Price:</label>
                                <input type="text" id="amount" readonly>
                                <button class="filter-submit">Filter</button>
                            </p>
                        </div>
                    </div><!-- Price-->

                    <div class="widget mercado-widget filter-widget">
                        <h2 class="widget-title">Color</h2>
                        <div class="widget-content">
                            <ul class="list-style vertical-list has-count-index">
                                <li class="list-item"><a class="filter-link " href="#">Red <span>(217)</span></a></li>
                                <li class="list-item"><a class="filter-link " href="#">Yellow <span>(179)</span></a></li>
                                <li class="list-item"><a class="filter-link " href="#">Black <span>(79)</span></a></li>
                                <li class="list-item"><a class="filter-link " href="#">Blue <span>(283)</span></a></li>
                                <li class="list-item"><a class="filter-link " href="#">Grey <span>(116)</span></a></li>
                                <li class="list-item"><a class="filter-link " href="#">Pink <span>(29)</span></a></li>
                            </ul>
                        </div>
                    </div><!-- Color -->

                    <div class="widget mercado-widget filter-widget">
                        <h2 class="widget-title">Size</h2>
                        <div class="widget-content">
                            <ul class="list-style inline-round ">
                                <li class="list-item"><a class="filter-link active" href="#">s</a></li>
                                <li class="list-item"><a class="filter-link " href="#">M</a></li>
                                <li class="list-item"><a class="filter-link " href="#">l</a></li>
                                <li class="list-item"><a class="filter-link " href="#">xl</a></li>
                            </ul>
                            <div class="widget-banner">
                                <figure><img src="assets/images/size-banner-widget.jpg" width="270" height="331" alt=""></figure>
                            </div>
                        </div>
                    </div><!-- Size -->

                    <div class="widget mercado-widget widget-product">
                        <h2 class="widget-title">Popular Products</h2>
                        <div class="widget-content">
                            <ul class="products">
                                <li class="product-item">
                                    <div class="product product-widget-style">
                                        <div class="thumbnnail">
                                            <a href="detail.html" title="Radiant-360 R6 Wireless Omnidirectional Speaker [White]">
                                                <figure><img src="assets/images/products/digital_01.jpg" alt=""></figure>
                                            </a>
                                        </div>
                                        <div class="product-info">
                                            <a href="#" class="product-name"><span>Radiant-360 R6 Wireless Omnidirectional Speaker...</span></a>
                                            <div class="wrap-price"><span class="product-price">$168.00</span></div>
                                        </div>
                                    </div>
                                </li>

                                <li class="product-item">
                                    <div class="product product-widget-style">
                                        <div class="thumbnnail">
                                            <a href="detail.html" title="Radiant-360 R6 Wireless Omnidirectional Speaker [White]">
                                                <figure><img src="assets/images/products/digital_17.jpg" alt=""></figure>
                                            </a>
                                        </div>
                                        <div class="product-info">
                                            <a href="#" class="product-name"><span>Radiant-360 R6 Wireless Omnidirectional Speaker...</span></a>
                                            <div class="wrap-price"><span class="product-price">$168.00</span></div>
                                        </div>
                                    </div>
                                </li>

                                <li class="product-item">
                                    <div class="product product-widget-style">
                                        <div class="thumbnnail">
                                            <a href="detail.html" title="Radiant-360 R6 Wireless Omnidirectional Speaker [White]">
                                                <figure><img src="assets/images/products/digital_18.jpg" alt=""></figure>
                                            </a>
                                        </div>
                                        <div class="product-info">
                                            <a href="#" class="product-name"><span>Radiant-360 R6 Wireless Omnidirectional Speaker...</span></a>
                                            <div class="wrap-price"><span class="product-price">$168.00</span></div>
                                        </div>
                                    </div>
                                </li>

                                <li class="product-item">
                                    <div class="product product-widget-style">
                                        <div class="thumbnnail">
                                            <a href="detail.html" title="Radiant-360 R6 Wireless Omnidirectional Speaker [White]">
                                                <figure><img src="assets/images/products/digital_20.jpg" alt=""></figure>
                                            </a>
                                        </div>
                                        <div class="product-info">
                                            <a href="#" class="product-name"><span>Radiant-360 R6 Wireless Omnidirectional Speaker...</span></a>
                                            <div class="wrap-price"><span class="product-price">$168.00</span></div>
                                        </div>
                                    </div>
                                </li>

                            </ul>
                        </div>
                    </div><!-- brand widget-->

                </div><!--end sitebar-->

            </div><!--end row-->

        </div><!--end container-->

@endsection

