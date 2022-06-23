
@if($parentCate->child_categories->count())
    <ul class="sub-cate">
        @foreach($parentCate->child_categories as $child)
            <li class="category-item {{$child->child_categories->count() > 0?'has-child-cate':''}}">
                <a href="{{route('app.shop',['slug' => \Illuminate\Support\Str::slug($child->name), 'id' => $child->id ])}}"
                   class="cate-link">Món {{$child->name}}</a>
                @include('Shop.shop.child-menu',['parentCate' => $child])
            </li>
        @endforeach
    </ul>
@endif
