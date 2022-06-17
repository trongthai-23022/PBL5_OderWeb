@extends('layouts.app')
@section('title')
    <title>Checkout</title>
@endsection

@section('custom_css')

@endsection

@section('custom_js')

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
@endsection
@section('content')
    <div class="wrap-breadcrumb">
        <ul>
            <li class="item-link"><a href="#" class="link">home</a></li>
            <li class="item-link"><span>login</span></li>
        </ul>
    </div>
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
    <div class=" main-content-area">
        <div class="wrap-iten-in-cart">
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
                            </div>
                            <div class="price-field">

                                <p class="price">{{$cartItem->qty}}</p>
                            </div>
                            <div class="price-field sub-total"><p
                                    id="cart-item-total-{{$cartItem->rowId}}"
                                    class="price">{{number_format($cartItem->price * $cartItem->qty,0,',','.')}}
                                    đ</p></div>
                        </li>
                    </div>
                @endforeach
                <li class="pr-cart-item">
                    <div class="product-name">
                        <b>Tổng số lượng: {{\Gloudemans\Shoppingcart\Facades\Cart::count()}}</b>
                    </div>
                    <div class="product-name">
                        <b>Thuế (10%): {{\Gloudemans\Shoppingcart\Facades\Cart::tax(0,',','.')}} đ</b>
                    </div>
                    <div class="product-name">
                        <b>Thành tiền: {{\Gloudemans\Shoppingcart\Facades\Cart::total(0,',','.')}} đ</b>
                    </div>
                </li>

            </ul>
        </div>
        <hr>
        <div class="wrap-address-billing">
            <h3 class="box-title">Thông tin khách hàng</h3>
            <form action="{{route('cart.order')}}" method="post" name="frm-billing" id="order">
                <p class="row-in-form">
                    <label for="fname">Họ Tên<span>*</span></label>
                    <input id="fname" type="text" name="name" value="{{$userInfo->name}}"
                           placeholder="Your name">
                </p>
                <p class="row-in-form">
                    <label for="email">Email</label>
                    <input id="email" type="email" name="email" value="{{$userInfo->email}}"
                           placeholder="Type your email">
                </p>
                <p class="row-in-form">
                    <label for="phone">Số điện thoại<span>*</span></label>
                    <input id="phone" type="text" name="phone" value="{{$userInfo->phone_number}}"
                           placeholder="10 digits format">
                </p>
                <p class="row-in-form">
                    <label for="add">Địa chỉ*</label>
                    <input id="add" type="text" name="address" value="{{$userInfo->address}}"
                           placeholder="Street at apartment number">
                </p>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Lời nhắn</label>
                        <textarea id="tinymce-editor" name="note" class="form-control"
                                  rows="3"></textarea>
                    </div>
                </div>
                @csrf
            </form>
        </div>
        <div class="summary summary-checkout">
            <div class="summary-item payment-method">
                <h4 class="title-box">Phương thức thanh toán</h4>
                <p class="summary-info"><span class="title">Thanh toán khi nhận</span></p>
                <div class="choose-payment-methods">
                    <label class="payment-method">
                        <input name="payment-method" id="payment-method-bank" value="bank" type="radio">
                        <span>Direct Bank Transder</span>
                        <span class="payment-desc">But the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable</span>
                    </label>
                    <label class="payment-method">
                        <input name="payment-method" id="payment-method-visa" value="visa" type="radio">
                        <span>visa</span>
                        <span class="payment-desc">There are many variations of passages of Lorem Ipsum available</span>
                    </label>
                    <label class="payment-method">
                        <input name="payment-method" id="payment-method-paypal" value="paypal" type="radio">
                        <span>Paypal</span>
                        <span class="payment-desc">You can pay with your credit</span>
                        <span class="payment-desc">card if you don't have a paypal account</span>
                    </label>
                </div>
                <p class="summary-info grand-total"><span>Tổng cộng</span> <span class="grand-total-price">{{\Gloudemans\Shoppingcart\Facades\Cart::total(0,',','.')}} đ</span></p>
                <button form="order" class="btn btn-medium">ĐẶT HÀNG</button>
            </div>
            <div class="summary-item shipping-method">
                <h4 class="title-box">Discount Codes</h4>
                <p class="row-in-form">
                    <label for="coupon-code">Mã giảm giá:</label>
                    <input form="order" id="coupon-code" type="text" name="coupon-code" value="" placeholder="">
                </p>
                <a href="#" class="btn btn-small">Apply</a>
            </div>
        </div>


    </div><!--end main content area-->
    @endif

@endsection
