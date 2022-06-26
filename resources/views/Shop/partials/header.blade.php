<header id="header" class="header header-style-1">

    <div class="container-fluid">
        <div class="row">
            <div class="topbar-menu-area">
                <div class="container">
                    <div class="topbar-menu left-menu">
                        <ul>
                            <li class="menu-item" >
                                <a title="Hotline: (+123) 456 789" href="#" ><span class="icon label-before fa fa-mobile"></span>Hotline: (+123) 456 789</a>
                            </li>
                        </ul>
                    </div>
                    <div class="topbar-menu right-menu">
                        <ul>
                            @if(!\Illuminate\Support\Facades\Auth::check())
                                <li class="menu-item" ><a title="Register or Login" href="{{route('login')}}">Sign in</a></li>
                                <li class="menu-item" ><a title="Register or Login" href="{{route('register')}}">Register</a></li>
                            @else
                                <li class="menu-item menu-item-has-children parent" >
                                    <a title="Profile" href="{{route('account.show')}}"><span class="img label-before">
                                            @if(auth()->check())
                                                @php
                                                    $profile = \App\Models\UserProfile::where('user_id',auth()->user()->id)->first();
                                                    if(!is_null($profile)){
                                                        $avt = $profile->image_path;
                                                        if (!is_null($avt))
                                                            echo '<img style="vertical-align: middle;width: 20px;height: 20px;object-fit: cover;border-radius: 50%;" src="'.$avt .'" alt="avt">';
                                                        else
                                                            echo '<img style="vertical-align: middle;width: 20px;height: 20px;" src="http://ssl.gstatic.com/accounts/ui/avatar_2x.png" class="avatar img-circle img-thumbnail" alt="avatar">';
                                                    }
                                                    else{
                                                        echo '<img style="vertical-align: middle;width: 20px;height: 20px;" src="http://ssl.gstatic.com/accounts/ui/avatar_2x.png" class="avatar img-circle img-thumbnail" alt="avatar">';
                                                    }
                                                @endphp
                                            @endif

                                        </span>{{auth()->user()->name}}<i class="fa fa-angle-down" aria-hidden="true"></i></a>
                                    <ul class="submenu curency" >
                                        <li class="menu-item" >

                                            <a title="Profile" href="{{route('account.show')}}">Tài khoản </a>
                                        </li>
                                        <li class="menu-item" >
                                            <a title="Profile" href="{{route('purchase.show')}}">Đơn mua</a>
                                        </li>
                                        @if(\Illuminate\Support\Facades\Auth::check())
                                            <li class="menu-item" >
                                                <form id="logout" action="{{route('logout')}}" method="post">
                                                    @csrf
                                                    <a href="javascript:$('#logout').submit();">Đăng xuất</a>
                                                </form>
                                            </li>
                                        @endif
                                    </ul>
                                </li>
                            @endif

                        </ul>
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="mid-section main-info-area">

                    <div class="wrap-logo-top left-section">
                        <a href="index.html" class="link-to-home"><img src="{{asset('customers/assets/images/logo-top-1.png')}}" alt="mercado"></a>
                    </div>

                    <div class="wrap-search center-section">
                        <div class="wrap-search-form">
                            <form id="shop_filter" name="shop_filter" method="get" action="{{route('app.shop',['id' => 0,'slug' => 'all'])}}">
                                @csrf
                                <input type="text" name="search" value="{{$search??''}}" placeholder="Search here...">
                                <button form="shop_filter" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                            </form>
                        </div>
                    </div>

                    <div class="wrap-icon right-section">

                        <div class="wrap-icon-section minicart">
                            <a href="{{route('cart.index')}}" class="link-direction">
                                <i class="fa fa-shopping-basket" aria-hidden="true"></i>
                                <div class="left-info">
                                    <span id="cart-items-count" class="index">{{\Gloudemans\Shoppingcart\Facades\Cart::count()}} items</span>
                                    <span class="title">CART</span>
                                </div>
                            </a>
                        </div>
                        <div class="wrap-icon-section show-up-after-1024">
                            <a href="#" class="mobile-navigation">
                                <span></span>
                                <span></span>
                                <span></span>
                            </a>
                        </div>
                    </div>

                </div>
            </div>

            <div class="nav-section header-sticky">
                <div class="header-nav-section">
                    <div class="container">
                        <ul class="nav menu-nav clone-main-menu" id="mercado_haead_menu" data-menuname="Sale Info" >
                        </ul>
                    </div>
                </div>

                <div class="primary-nav-section">
                    <div class="container">
                        <ul class="nav primary clone-main-menu" id="mercado_main" data-menuname="Main menu" >
                            <li class="menu-item home-icon">
                                <a href="{{route('app.home')}}" class="link-term mercado-item-title"><i class="fa fa-home" aria-hidden="true"></i></a>
                            </li>
                            <li class="menu-item">
                                <a href="{{route('app.shop',['id' => 0,'slug' => 'all'])}}" class="link-term mercado-item-title">Shop</a>
                            </li>
                            <li class="menu-item">
                                <a href="{{route('orders.flashorder')}}" class="link-term mercado-item-title">Flash Order</a>
                            </li>
                            <li class="menu-item">
                                <a href="{{route('cart.checkout.info')}}" class="link-term mercado-item-title">Checkout</a>
                            </li>
                            <li class="menu-item">
                                <a href="{{route('app.about-us')}}" class="link-term mercado-item-title">About Us</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
