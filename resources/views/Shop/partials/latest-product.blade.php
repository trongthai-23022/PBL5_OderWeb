<!--Latest Products-->
<div class="wrap-show-advance-info-box style-1">
    <h3 class="title-box">Latest Products</h3>
    @if(!is_null($bannerLatest))
        <div class="wrap-top-banner">
            <a href="#" class="link-banner banner-effect-2">
                <figure><img src="{{$bannerLatest->image_path}}" width="1170" height="240" alt="{{$bannerLatest->image_name}}"></figure>
            </a>
        </div>
    @endif
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
                        @include('Shop.components.product-item',[
                            'products' => $latestProducts,
                            'colors' => $colors])
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
