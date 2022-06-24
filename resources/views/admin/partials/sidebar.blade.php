
@php
     use Illuminate\Support\Facades\Auth;
@endphp
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="{{asset('AdminLTE/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo"
             class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{asset('AdminLTE/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2"
                     alt="User Image">
            </div>
            <div class="info">
                @if(Auth::user())
                <a href="#" class="d-block">{{Auth::user()->name}}</a>
                @endif
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2 ">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{route('categories.index')}}" class="nav-link">
                        <i class="fas fa-layer-group"></i>
                        <p style="margin-left: 10px">
                            Danh mục
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#products" data-toggle="collapse" aria-expanded="false" class="nav-link dropdown-toggle">
                        <i class="fas fa-utensils"></i>
                        <p style="margin-left: 10px">Sản phẩm</p></a>

                    <ul class="collapse list-unstyled nav nav-pills nav-sidebar flex-column" id="products">
                        <li class="nav-item " style="margin-left: 20px">
                            <a class="nav-link" href="{{route('products.index')}}">Danh Sách SP</a>
                        </li>
                        <li class="nav-item" style="margin-left: 20px">
                            <a class="nav-link" href="{{route('codes.index')}}" >Mã Giảm Giá</a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="#ad" data-toggle="collapse" aria-expanded="false" class="nav-link dropdown-toggle">
                        <i class="fas fa-ad"></i>
                        <p style="margin-left: 10px">Quảng cáo</p></a>

                    <ul class="collapse list-unstyled nav nav-pills nav-sidebar flex-column" id="ad">
                        <li class="nav-item " style="margin-left: 20px">
                            <a class="nav-link" href="{{route('sliders.index')}}">Sliders</a>
                        </li>
                        <li class="nav-item" style="margin-left: 20px">
                            <a class="nav-link" href="{{route('banners.index')}}">Banners</a>
                        </li>
                    </ul>

                </li>

                <li class="nav-item">

                    <a href="{{route('orders.index')}}" class="nav-link">
                        <i class="fas fa-list-alt"></i>
                        <p style="margin-left: 10px">
                            Đơn hàng
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('users.index')}}" class="nav-link">
                        <i class="fas fa-users"></i>
                        <p style="margin-left: 10px">
                            Người dùng

                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('roles.index')}}" class="nav-link">
                        <i class="fas fa-user-tag"></i>
                        <p style="margin-left: 10px">
                            Vai trò
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('permissions.index')}}" class="nav-link">
                        <i class="fas fa-user-lock"></i>
                        <p style="margin-left: 10px">
                            Phân Quyền
                        </p>
                    </a>
                </li>
            </ul>
            <ul class="nav nav-pills nav-sidebar flex-column mb-auto" data-widget="treeview" role="menu" data-accordion="false">
                @if(Auth::user())

                    <li class="nav-item mb-auto">
                        <a href="{{route('admin.logout')}}" class="nav-link">
                            <i class="fas fa-sign-out-alt"></i>
                            <p style="margin-left: 10px">
                                Log out
                            </p>
                        </a>
                    </li>
                @endif
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
