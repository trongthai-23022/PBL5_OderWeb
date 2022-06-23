<div class="widget mercado-widget categories-widget">
    <h2 class="widget-title">All Categories</h2>
    <div class="widget-content">
        <ul class="list-category">
            <li class="category-item">
                <a href="{{route('app.shop',['slug' => 'all', 'id' => 0 ])}}" class="cate-link">Tất cả</a>
            </li>
            @foreach($parentCates as $parentCate)
            <li class="category-item {{$parentCate->child_categories->count()?'has-child-cate':''}}">
                <a href="{{route('app.shop',['slug' => \Illuminate\Support\Str::slug($parentCate->name), 'id' => $parentCate->id ])}}"
                   class="cate-link">Món {{$parentCate->name}}</a>
                @if($parentCate->child_categories->count())
                    <span class="toggle-control">+</span>
                @endif
                @include('Shop.shop.child-menu', ['parentCate' => $parentCate])
            </li>
            @endforeach
        </ul>
    </div>
</div><!-- Categories widget-->
