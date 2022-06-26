@extends('layouts.app')

@section('title')
    <title>Shop</title>
@endsection

@section('custom_css')
    <style>
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }

    </style>
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

                <div class="wrap-shop-control" style="background-color: #6667AB;">
                    <h1 class="shop-title" style="color: white">FLASH ORDER</h1>
                    <div class="wrap-right">

                        <div class="sort-item orderby ">
                            <select name="orderby" class="use-chosen" id="orderby" >
                                <option value="amount-desc" selected="selected">Số lượng đã bán: giảm dần</option>
                                <option value="amount-asc">Số lượng đã bán: tăng dần</option>
                                <option value="price-desc">Giá: giảm dần</option>
                                <option value="price-asc">Giá: tăng dần</option>

                            </select>
                        </div>

                    </div>

                </div><!--end wrap shop control-->

                <div class="wrap-shop-control">

                     <div class="p-4" style="margin-left: 20px; margin-top: 20px; margin-right: 20px">
                         <h4>Nhập số tiền mà bạn muốn</h4>
                             <input type="number" name="form-sum" class="form-control sum-input"
                                    id="sum-input" placeholder="100.000"
                                    data-url="{{route('orders.flash_order_ajax')}}"
                             >
                         <div class="">
                             <p style="margin-top: 20px;">Các danh mục bạn đã chọn:</p>
                             <div class="checked-cates"></div>
                         </div>
                     </div>


                </div>

                <div class="row">

                    <ul class="product-list grid-products equal-container" id="recommend-products">
                        @foreach($recommendProducts as $item)
                            <li class="col-lg-4 col-md-6 col-sm-6 col-xs-6 ">
                                <div class="product product-style-3 equal-elem ">
                                    <div class="product-thumnail">
                                        <a href="{{route('detail', [ 'slug' => $item['slug'],'id' => $item['id']])}}"
                                           title="{{$item['name']}}">
                                            <figure><img
                                                    style="width: 100%; height: 250px;object-fit: cover;"
                                                    src="{{$item['main_image_path']}}" alt="{{$item['main_image_name'] . $item['id']}}"></figure>
                                        </a>
                                    </div>
                                    <div class="product-info">
                                        <a href="{{route('detail', [ 'slug' => $item['slug'],'id' => $item['id']])}}"
                                           class="product-name"><span>{{$item['name']}}</span></a>
                                        <div class="wrap-price">
                                            <span class="product-price">đ {{number_format($item['price'])}}</span>
                                            <span class="product-price" style="font-weight: normal; font-size: 12px;float: right;">Đã bán: {{$item['amount']}}</span>
                                        </div>
                                        <form method="post">
                                            @csrf
                                            <div class="wrap-butons">

                                                <input type="hidden" value="1" name="cart_product_qty"
                                                       class="cart_product_qty_{{$item['id']}}">
                                                <input type="hidden" value="{{$item['id']}}" name="cart_product_id"
                                                       class="cart_product_id_{{$item['id']}}">
                                                <input type="button" value="Thêm vào giỏ hàng" class="function-link add-to-cart"
                                                       data-product_item="{{$item['id']}}" data-url="{{route('cart.store')}}">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>

                </div>

                <div class="wrap-pagination-info">
                    {{$recommendProducts->links()}}
                </div>
            </div><!--end main products area-->

            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12 ">
                <div class="widget mercado-widget filter-widget brand-widget">
                        @include('Shop.flash-order.menu-check')
                </div><!-- brand widget-->


                <div class="widget mercado-widget widget-product">
                    <h2 class="widget-title">Sản phẩm phổ biến</h2>
                    <div class="widget-content">
                        <ul class="products">
                            @foreach($popular as $item)
                            <li class="product-item">
                                <div class="product product-widget-style">
                                    <div class="thumbnnail">
                                        <a href="{{route('detail',['id' => $item->id, 'slug' => $item->slug])}}" title="Radiant-360 R6 Wireless Omnidirectional Speaker [White]">
                                            <figure><img src="{{$item->main_image_path}}" alt="{{$item->main_image_name}}"></figure>
                                        </a>
                                    </div>
                                    <div class="product-info">
                                        <a href="#" class="product-name"><span>{{$item->name}}</span></a>
                                        <div class="wrap-price"><span class="product-price">{{number_format($item->price,0,',','.')}}</span></div>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div><!-- brand widget-->

            </div><!--end sitebar-->

        </div><!--end row-->

    </div><!--end container-->

@endsection

@section('custom_js')
    <script src="{{asset('customers/shop/filter.js')}}"></script>
    <script src="{{asset('vendor/sweetAlert2/sweetalert2@11.js')}}"></script>
    <script src="{{asset('admins/common.js')}}"></script>
    <script src="{{asset('customers/shop/flash-order.js')}}"></script>

@endsection

