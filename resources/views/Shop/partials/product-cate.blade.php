<!--Product Categories-->
<div class="wrap-show-advance-info-box style-1">
    <h3 class="title-box">Product Categories</h3>
    <div class="wrap-top-banner">
        <a href="#" class="link-banner banner-effect-2">
            <figure><img src="{{$bannerCate->image_path}}" width="1170" height="240" alt="{{$bannerCate->image_name}}"></figure>
        </a>
    </div>
    <div class="wrap-products">
        <div class="wrap-product-tab tab-style-1">
            <div class="tab-control">
                @php($i = 0)
                @foreach($categories as $category)
                    @if($i == 0)
                        <a href="#{{'cate-'. $category->id}}" class="tab-control-item active">{{$category->name}}</a>
                    @else
                        <a href="#{{'cate-'. $category->id}}" class="tab-control-item ">{{$category->name}}</a>
                    @endif
                    @php($i++)
                @endforeach
            </div>
            <div class="tab-contents">

                @php($i = 0)
                @php($colors = [
                        'new' => 'new-label',
                        'sale' => 'sale-label',
                        'bestseller' => 'bestseller-label',
                    ])
                @foreach($categories as $category)
                    @if($i == 1)
                        <div class="tab-content-item active" id="{{'cate-'. $category->id}}">
                            <div class="wrap-products slide-carousel owl-carousel style-nav-1 equal-container" data-items="5" data-loop="false" data-nav="true" data-dots="false" data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"4"},"1200":{"items":"5"}}' >
                                @foreach($category->latestProducts as $latestProduct)
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
                                                    @php($j = 0)
                                                    @foreach($latestProduct->tags as $tag)
                                                        @if($j == 2)
                                                            @break
                                                        @endif
                                                        <span class="flash-item {{array_key_exists($tag->name,$colors) ?$colors[$tag->name] . '':'new-label'}}">{{$tag->name}}</span>

                                                        @php($j++)
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
                    @else
                        <div class="tab-content-item " id="{{'cate-'. $category->id}}">
                            <div class="wrap-products slide-carousel owl-carousel style-nav-1 equal-container" data-items="5" data-loop="false" data-nav="true" data-dots="false" data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"4"},"1200":{"items":"5"}}' >
                                @foreach($category->latestProducts as $latestProduct)
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
                                                    @php($j = 0)
                                                    @foreach($latestProduct->tags as $tag)
                                                        @if($j == 2)
                                                            @break
                                                        @endif
                                                        <span class="flash-item {{array_key_exists($tag->name,$colors) ?$colors[$tag->name] . '':'new-label'}}">{{$tag->name}}</span>
                                                        @php($j++)
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
                    @endif

                    @php($i++)
                @endforeach

            </div>
        </div>
    </div>
</div>
