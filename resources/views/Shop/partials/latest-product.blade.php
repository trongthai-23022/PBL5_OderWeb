<!--Latest Products-->
<div class="wrap-show-advance-info-box style-1">
    <h3 class="title-box">Latest Products</h3>
    <div class="wrap-top-banner">
        <a href="#" class="link-banner banner-effect-2">
            <figure><img src="{{$bannerLatest->image_path}}" width="1170" height="240" alt="{{$bannerCate->image_name}}"></figure>
        </a>
    </div>
    <div class="wrap-products">
        <div class="wrap-product-tab tab-style-1">
            <div class="tab-contents">
                <div class="tab-content-item active" id="digital_1a">
                    <div class="wrap-products slide-carousel owl-carousel style-nav-1 equal-container" data-items="5"
                         data-loop="false" data-nav="true" data-dots="false"
                         data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"4"},"1200":{"items":"5"}}'>
                        @php
                            $colors = [
                                'new' => 'new-label',
                                'sale' => 'sale-label',
                                'bestseller' => 'bestseller-label',
                            ];
                        @endphp
                        @foreach($latestProducts as $latestProduct)
                            <div class="product product-style-2 equal-elem ">
                                <div class="product-thumnail">
                                    <a href="{{route('detail', [ 'slug' => $latestProduct->slug,'id' => $latestProduct->id])}}"
                                       title="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                        <figure><img
                                                style="width: 100%; height: 250px;object-fit: cover;"
                                                src="{{$latestProduct->main_image_path}}" width="800" height="800"
                                                alt="{{$latestProduct->main_image_name}}"></figure>
                                    </a>
                                    <div class="group-flash">
                                        @if(!empty($latestProduct->tags))
                                            @php($i = 0)
                                         @foreach($latestProduct->tags as $tag)
                                                @if($i == 2)
                                                    @break
                                                @endif
                                                    <span class="flash-item {{array_key_exists($tag->name,$colors) ?$colors[$tag->name] . '':'new-label'}}">{{$tag->name}}</span>

                                                    @php($i++)
                                         @endforeach
                                        @endif
                                    </div>
                                    <div class="wrap-btn">
                                        <form method="post">
                                            @csrf
                                            <input type="hidden" value="1" name="cart_product_qty" class="cart_product_qty_{{$latestProduct->id}}">
                                            <input type="hidden" value="{{$latestProduct->id}}" name="cart_product_id" class="cart_product_id_{{$latestProduct->id}}">
                                            <input type="button" value="Add To Cart" class="function-link add-to-cart" data-product_item="{{$latestProduct->id}}" data-url="{{route('cart.store')}}">
                                        </form>
                                    </div>
                                </div>
                                <div class="product-info">
                                    <a href="{{route('detail', [ 'slug' => $latestProduct->slug,'id' => $latestProduct->id])}}"
                                       class="product-name"><span>{{$latestProduct->name}}</span></a>
                                    <div class="wrap-price"><span
                                            class="product-price">đ {{number_format($latestProduct->price)}}</span></div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
