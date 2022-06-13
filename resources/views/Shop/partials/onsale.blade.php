<!--On Sale-->
<div style="" class="wrap-show-advance-info-box style-1 has-countdown">
    <h3 class="title-box">On Sale</h3>
    <div class="wrap-countdown mercado-countdown" data-expire="2020/12/12 12:34:56"></div>
    <div class="wrap-products slide-carousel owl-carousel style-nav-1 equal-container " data-items="5" data-loop="false" data-nav="true" data-dots="false" data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"4"},"1200":{"items":"5"}}'>
            @foreach($onSaleProducts as $onSaleProduct)
                <div class="product product-style-2 equal-elem ">
                    <div class="product-thumnail">
                        <a href="{{route('detail', [ 'slug' => $onSaleProduct->slug,'id' => $onSaleProduct->id])}}" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
                            <figure><img src="{{$onSaleProduct->main_image_path}}" width="800" height="800" alt="{{$onSaleProduct->main_image_name}}"></figure>
                        </a>
                        <div class="group-flash">
                            <span class="flash-item sale-label">sale</span>
                        </div>
                        <div class="wrap-btn">
                            <form method="post">
                                @csrf
                                <input type="hidden" value="1" name="cart_product_qty" class="cart_product_qty_{{$onSaleProduct->id}}">
                                <input type="hidden" value="{{$onSaleProduct->id}}" name="cart_product_id" class="cart_product_id_{{$onSaleProduct->id}}">
{{--                                <input type="hidden" value="{{$onSaleProduct->name}}" name="cart_product_name" class="cart_product_name_{{$onSaleProduct->id}}">--}}
{{--                                <input type="hidden" value="{{$onSaleProduct->price}}" name="cart_product_price" class="cart_product_price_{{$onSaleProduct->id}}">--}}
{{--                                <input type="hidden" value="{{$onSaleProduct->main_image_path}}" name="cart_product_main_image_path" class="cart_product_main_image_path_{{$onSaleProduct->id}}">--}}
{{--                                <input type="hidden" value="{{$onSaleProduct->main_image_name}}" name="cart_product_main_image_name" class="cart_product_main_image_name_{{$onSaleProduct->id}}">--}}
                                <input type="button" value="Add To Cart" class="function-link add-to-cart" data-product_item="{{$onSaleProduct->id}}" data-url="{{route('cart.store')}}">
{{--                                <button type="button"  class="btn btn-default ">ADD TO CART</button>--}}
                            </form>

                        </div>
                    </div>
                    <div class="product-info">
                        <a href="{{route('detail', [ 'slug' => $onSaleProduct->slug,'id' => $onSaleProduct->id])}}" class="product-name"><span>{{$onSaleProduct->name}}</span></a>
                        <div class="wrap-price"><span class="product-price">đ {{number_format($onSaleProduct->price)}}</span></div>
                    </div>
                </div>
            @endforeach
    </div>
</div>
