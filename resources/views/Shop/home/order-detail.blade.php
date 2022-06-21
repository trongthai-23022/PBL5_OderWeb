@extends('layouts.app')

@section('title')
    <title>Chi tiết đơn</title>
@endsection

@section('custom_css')
    <link rel="stylesheet" type="text/css" href="{{asset('customers/assets/css/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('customers/assets/css/color-01.css')}}">
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
            <h3 class="box-title mt-4">Trạng thái đơn hàng: <span><b style="color: #6667AB">{{$orderStatus[$order->status]}}</b></span></h3>
            <hr>
            <h3 class="box-title mt-4">Danh sách món ăn</h3>
            <ul class="products-cart">
                <li class="pr-cart-item">
                    <div class="product-image">
                        <b></b>
                    </div>
                    <div class="product-name">
                        <b>Tên món</b>
                    </div>
                    <div class="price-field product-price">
                        <b>Giá</b>
                    </div>
                    <div class="price-field">
                        <b>Số lượng</b>
                    </div>
                    <div class="price-field sub-total">
                        <b>Thành tiền</b>
                    </div>

                </li>
                @foreach($orderItems as $item)
                    <div class="col">
                        <li class="pr-cart-item">
                            <div class="product-image">
                                <figure><img src="{{$item['image_path']}}"
                                             alt="{{$item['image_name']}}"></figure>
                            </div>
                            <div class="product-name">
                                <p class="price">{{$item['name']}}</p>
                            </div>
                            <div class="price-field">
                                <p class="price">{{number_format(intval($item['price']),0,',','.')}} đ</p>
                            </div>
                            <div class="price-field">

                                <p class="price">{{$item['qty']}}</p>
                            </div>
                            <div class="price-field product-price">
                                <p class="price">{{number_format(intval($item['item_total']),0,',','.')}} đ</p>
                            </div>
                        </li>
                    </div>
                @endforeach
                <li class="pr-cart-item">
                    <div class="product-name">
                        <p class="price">Tổng số lượng: {{$order->item_count}}</p>
                    </div>
                    <div class="product-name">
                        <p class="price">Số tiền: {{number_format($order->sub_total,0,',','.')}} đ</p>
                    </div>
                    <div class="product-name">
                        <p class="price">Thuế (10%): {{number_format($order->tax,0,',','.')}} đ</p>
                    </div>
                    <div class=" price-field ">
                        <p class="price">Thành tiền: {{number_format($order->total,0,',','.')}} đ</p>
                    </div>
                </li>

            </ul>
        </div>
        <hr>
        <div class="wrap-address-billing" style="width: 100%">
            <h3 class="box-title">Thông tin khách hàng</h3>
            <form action="" method="post" name="frm-billing" id="order">
                <p class="row-in-form">
                    <label for="fname">Họ Tên</label>
                    <input id="fname" type="text" name="name" value="{{$order->user_name}}"
                           placeholder="Your name" disabled>
                </p>
                <p class="row-in-form">
                    <label for="email">Email</label>
                    <input id="email" type="email" name="email" value="{{$order->user_email}}"
                           placeholder="Type your email" disabled>
                </p>
                <p class="row-in-form">
                    <label for="phone">Số điện thoại</label>
                    <input id="phone" type="text" name="phone" value="{{$order->user_phone}}"
                           placeholder="10 digits format" disabled>
                </p>
                <p class="row-in-form">
                    <label for="add">Địa chỉ</label>
                    <input id="add" type="text" name="address" value="{{$order->user_address}}"
                           placeholder="Street at apartment number" disabled>
                </p>
                <div class="row-in-form">
                    <div class="form-group">
                        <label>Lời nhắn</label>
                        <textarea name="note" class="form-control"
                                  rows="3">{{$order->user_note}}</textarea>
                    </div>
                </div>
            </form>
        </div>
    </div><!--end main content area-->

@endsection


