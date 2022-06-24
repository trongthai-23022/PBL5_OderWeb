@foreach($products as $product)
    <div class="product product-style-2 equal-elem ">
        <div class="product-thumnail">
            <a href="{{route('detail', [ 'slug' => $product->slug,'id' => $product->id])}}"
               title="T-Shirt Raw Hem Organic Boro Constrast Denim">
                <figure><img
                        style="width: 100%; height: 250px;object-fit: cover;"
                        src="{{$product->main_image_path}}" width="800" height="800"
                        alt="{{$product->main_image_name}}"></figure>
            </a>
            <div class="group-flash">
                @if(!empty($product->tags))
                    @php($i = 0)
                    @foreach($product->tags as $tag)
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
                    <input type="hidden" value="1" name="cart_product_qty" class="cart_product_qty_{{$product->id}}">
                    <input type="hidden" value="{{$product->id}}" name="cart_product_id" class="cart_product_id_{{$product->id}}">
                    <input type="button" value="Add To Cart" class="function-link add-to-cart" data-product_item="{{$product->id}}" data-url="{{route('cart.store')}}">
                </form>
            </div>
        </div>
        <div class="product-info">
            <a href="{{route('detail', [ 'slug' => $product->slug,'id' => $product->id])}}"
               class="product-name"><span>{{$product->name}}</span></a>
            <div class="wrap-price">
                <span class="product-price">đ {{number_format($product->price)}}</span>
                <span class="product-price" style="font-weight: normal; font-size: 12px;float: right;">Đã bán: {{$product->amount}}</span>
            </div>

        </div>
    </div>
@endforeach
