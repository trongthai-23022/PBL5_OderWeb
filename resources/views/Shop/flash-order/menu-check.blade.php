<div class="widget mercado-widget categories-widget">
    <h2 class="widget-title">Tất Cả Danh Mục</h2>
    <div class="widget-content">
        <ul class="list-category">
            @foreach($parentCates as $parentCate)
                <li class="category-item {{$parentCate->child_categories->count()?'has-child-cate':''}}">
                    <a
                       class="cate-link"> Món {{$parentCate->name}}</a>
                    @if($parentCate->child_categories->count())
                        <span class="toggle-control">+</span>
                    @endif
                    @include('Shop.flash-order.child-menu-check', ['parentCate' => $parentCate])
                </li>
            @endforeach
        </ul>
    </div>
</div><!-- Categories widget-->
