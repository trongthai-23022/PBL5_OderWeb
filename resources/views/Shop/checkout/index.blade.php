@extends('layouts.app')
@section('title')
    <title>Checkout</title>
@endsection

@section('custom_css')
@endsection

@section('custom_js')
    <script src="{{asset('vendor/sweetAlert2/sweetalert2@11.js')}}"></script>
    <script>
        $(document).on('click','.check_code',function (){
            let urlRequest = $(this).data('url');
            let coupon_code = $('#coupon-code').val();
            let oldTotal = $(this).data('total');
            $.ajax({
                url: urlRequest,
                method: 'get',
                data: {
                    coupon_code: coupon_code,
                },
                success: function (data) {
                    if (data.code === 200) {
                        $( "#response_code" ).empty().append( "<p style='color: #6667AB'>Bạn được giảm giá " +data.discount +"%</p>" );
                        let finalTotal  = Math.ceil(parseFloat(oldTotal*(1-data.discount*0.01)));
                        let total = numberWithCommas(finalTotal);
                        $('#final-total').text(total + ' đ');
                        $('#coupon-code-hidden').val(data.code_id);
                    }
                    if(data.code === 204){
                        $( "#response_code" ).empty().append( "<p style='color: red'>Mã giảm giá không tồn tại, vui lòng kiểm tra lại!</p>" );
                        $('#final-total').text(numberWithCommas(oldTotal) + ' đ');
                    }
                }
            })
        });
        function numberWithCommas(x) {
            return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }
        $(document).on('click', '.confirm', function () {
            Swal.fire({
                title: 'Bạn chắc chắn muốn đặt?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'OK',
                cancelButtonText: 'Hủy'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Đặt hàng thành công!',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    setTimeout(function(){
                        $( "#order" ).submit();
                    }, 1500);
                }
            })
        });
    </script>
@endsection

@section('content')
    <div class="wrap-breadcrumb">
        <ul>
            <li class="item-link"><a href="{{route('app.home')}}" class="link">home</a></li>
            <li class="item-link"><span>Check out</span></li>
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
                    <a href="{{route('app.home')}}" class="btn btn-submit btn-submitx">Về trang chủ</a>
                </div>
            </div>
        </div><!--end container-->
    @else
        <div class="main-content-area">
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
            <div class="wrap-address-billing" style="width: 100%">
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
                    <div class="row-in-form">
                        <div class="form-group">
                            <label>Lời nhắn</label>
                            <textarea name="note" class="form-control"
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
                            <span
                                class="payment-desc">There are many variations of passages of Lorem Ipsum available</span>
                        </label>
                        <label class="payment-method">
                            <input name="payment-method" id="payment-method-paypal" value="paypal" type="radio">
                            <span>Paypal</span>
                            <span class="payment-desc">You can pay with your credit</span>
                            <span class="payment-desc">card if you don't have a paypal account</span>
                        </label>
                    </div>
                    <p class="summary-info grand-total"><span>Tổng cộng</span> <span id="final-total" class="grand-total-price">{{\Gloudemans\Shoppingcart\Facades\Cart::total(0,',','.')}} đ</span>
                    </p>
                    <button form="" class="btn btn-medium confirm">ĐẶT NGAY</button>
                </div>
                <div class="summary-item shipping-method">
                    <h4 class="title-box">Discount Codes</h4>
                    <p class="row-in-form">
                        <label for="coupon-code">Mã giảm giá:</label>
                        <input id="coupon-code" type="text" placeholder="">
                        <input form="order" id="coupon-code-hidden" type="hidden" value="" name="coupon-code-hidden" placeholder="">
                    </p>
                    <div id="response_code">
                        <p></p>
                    </div>
                    <a class="btn btn-small check_code" data-url="{{route('codes.check')}}" data-total="{{\Gloudemans\Shoppingcart\Facades\Cart::total(0,',','')}}">Apply</a>
                </div>
            </div>


        </div><!--end main content area-->
    @endif

@endsection

