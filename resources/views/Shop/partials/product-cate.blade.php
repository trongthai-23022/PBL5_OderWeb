<!--Product Categories-->
<div class="wrap-show-advance-info-box style-1">
    <h3 class="title-box">Product Categories</h3>
    @if(!is_null($bannerCate))
        <div class="wrap-top-banner">
            <a href="#" class="link-banner banner-effect-2">
                <figure><img src="{{$bannerCate->image_path}}" width="1170" height="240"
                             alt="{{$bannerCate->image_name}}"></figure>
            </a>
        </div>
    @endif
    <div class="wrap-products col-12">
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
                            <div class="wrap-products slide-carousel owl-carousel style-nav-1 equal-container"
                                 data-items="5" data-loop="false" data-nav="true" data-dots="false"
                                 data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"4"},"1200":{"items":"5"}}'>
                                @include('Shop.components.product-item',[
                                        'products' => $category->latestProducts,
                                        'colors' => $colors])
                            </div>
                        </div>
                    @else
                        <div class="tab-content-item " id="{{'cate-'. $category->id}}">
                            <div class="wrap-products slide-carousel owl-carousel style-nav-1 equal-container"
                                 data-items="5" data-loop="false" data-nav="true" data-dots="false"
                                 data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"4"},"1200":{"items":"5"}}'>
                                @include('Shop.components.product-item',[
                                        'products' => $category->latestProducts,
                                        'colors' => $colors])
                            </div>
                        </div>
                    @endif

                    @php($i++)
                @endforeach

            </div>
        </div>
    </div>
</div>
