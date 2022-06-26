
@if($parentCate->child_categories->count())
    <ul class="sub-cate">
        @foreach($parentCate->child_categories as $child)
            <li class="category-item {{$child->child_categories->count() > 0?'has-child-cate':''}}">
                <input type="checkbox"
                       name="cate"
                       class="cate-checkbox"
                       value="{{$child->id}}"
                       attr-name="{{$child->name}}"
                       data-url="{{route('orders.flash_order_ajax')}}"
                >
                <a
                   class="cate-link">Món {{$child->name}}</a>
                @include('Shop.flash-order.child-menu-check',['parentCate' => $child])
            </li>
        @endforeach
    </ul>
@endif
