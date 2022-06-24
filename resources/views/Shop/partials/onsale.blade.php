<!--On Sale-->
<div style="" class="wrap-show-advance-info-box style-1 has-countdown">
    <h3 class="title-box">On Sale</h3>
    <div class="wrap-countdown mercado-countdown" data-expire="2020/12/12 12:34:56"></div>
    <div class="wrap-products slide-carousel owl-carousel style-nav-1 equal-container " data-items="5" data-loop="false" data-nav="true" data-dots="false" data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"4"},"1200":{"items":"5"}}'>
        @php($colors = [
        'new' => 'new-label',
        'sale' => 'sale-label',
        'bestseller' => 'bestseller-label',
    ])
        @include('Shop.components.product-item',[
                                    'products' => $onSaleProducts,
                                    'colors' => $colors])
    </div>
</div>
