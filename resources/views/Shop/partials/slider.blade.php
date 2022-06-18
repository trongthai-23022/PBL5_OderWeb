<div class="wrap-main-slide">
    <div class="slide-carousel owl-carousel style-nav-1" data-items="1" data-loop="1" data-nav="true" data-dots="false">
        @php
            $position = [
                'middle' => 1,
                'left' => 2,
                'right' => 3,
            ]
        @endphp

        @foreach($sliders as $slider)
            @if(empty($slider->product_id))
                <div class="item-slide">
                    <img src="{{$slider->image_path}}" alt="{{$slider->image_name}}" class="img-slide">
                    <div class="slide-info slide-{{$position[$slider->content_position]}}">
                        <h2 style="color: red" class="f-title">{!! $slider->title !!}</h2>
                        <span class="subtitle">{{$slider->subtitle}}</span>
                        <p class="s-subtitle">{!! $slider->description !!}</p>
                    </div>
                </div>
            @else
                <div class="item-slide">
                    <img src="{{$slider->image_path}}" alt="{{$slider->image_name}}" class="img-slide">
                    <div class="slide-info slide-{{$position[$slider->content_position]}}">
                        <h2 class="f-title">{!! $slider->title !!}</h2>
                        <span class="subtitle">{{$slider->subtitle}}</span>
                        <p class="sale-info">Only price: <span class="price">{{number_format($slider->getProduct->price)}} đ</span>
                        </p>
                        @php

                            $productName = \App\Models\Product::select('name')->where('id',$slider->product_id )->first();
                            $slug = \Illuminate\Support\Str::slug($productName, '-');
                        @endphp
                        <a href="{{route('detail', [ 'slug' => $slug,'id' => $slider->product_id])}}"  class="btn-link">Shop Now</a>
                    </div>
                </div>
            @endif
        @endforeach

        {{--        <div class="item-slide">--}}
        {{--            <img src="{{asset('customers/assets/images/main-slider-1-2.jpg')}}" alt="" class="img-slide">--}}
        {{--            <div class="slide-info slide-2">--}}
        {{--                <h2 class="f-title">Extra 25% Off</h2>--}}
        {{--                <span class="f-subtitle">On online payments</span>--}}
        {{--                <p class="discount-code">Use Code: #FA6868</p>--}}
        {{--                <h4 class="s-title">Get Free</h4>--}}
        {{--                <p class="s-subtitle">TRansparent Bra Straps</p>--}}
        {{--            </div>--}}
        {{--        </div>--}}
        {{--        <div class="item-slide">--}}
        {{--            <img src="{{asset('customers/assets/images/main-slider-1-3.jpg')--}}
        {{--            }}" alt="" class="img-slide">--}}
        {{--            <div class="slide-info slide-3">--}}
        {{--                <h2 class="f-title">Great Range of <b>Exclusive Furniture Packages</b></h2>--}}
        {{--                <span class="f-subtitle">Exclusive Furniture Packages to Suit every need.</span>--}}
        {{--                <p class="sale-info">Stating at: <b class="price">$225.00</b></p>--}}
        {{--                <a href="#" class="btn-link">Shop Now</a>--}}
        {{--            </div>--}}
        {{--        </div>--}}
    </div>
</div>
