@extends('layouts.app')

@section('content')


    <div class="wrap-breadcrumb">
        <ul>
            <li class="item-link"><a href="{{route('app.home')}}" class="link">Home</a></li>
            @php
                $segments = '' ;
            @endphp
            @foreach(\Illuminate\Support\Facades\Request::segments() as $segment)
                @php
                    $segments .= '/'. $segment;
                @endphp
                <li>
                    <a href="{{ $segments }}">{{$segment}}</a>
                </li>
            @endforeach
        </ul>
    </div>

    <!-- <div class="main-content-area"> -->
    <div class="aboutus-info style-center">
        <b class="box-title">DỰ ÁN CÔNG NGHỆ PHẦN MỀM</b>
        <p class="txt-content">Đây là dự án trong chương trình học phần mang tên PBL5. Với quá trình lên ý tưởng và kết hợp các kiến thức đã học được, nhóm chung tôi gồm 4 người đã tạo ra được sản phẩm Food Order Web này.</p>
    </div>

    <div class="row">

        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="aboutus-info style-small-left">
                <b class="box-title">Project Objectives</b>
                <p class="txt-content">Những người có nhiệm vụ quản lý website của nhà hàng có thể quản lý tất cả món ăn của nhà hàng, nhập thông tin cho món ăn để hiển thị trên trang chính của khách hàng. Khách hàng có thể đặt món theo ý thích, bình luận, đánh giá món ăn.</p>
            </div>
            <div class="aboutus-info style-small-left">
                <b class="box-title">Project Scope</b>
                <p class="txt-content">Cung cấp cho tất cả các bên muốn quản lý và bán sản phẩm: Quán ăn, nhà hàng, shop bán hàng…</p>
            </div>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="aboutus-info style-small-left">
                <b class="box-title">Project WBS </b>
                <p class="txt-content">
                    -	Study requirement:  3-5 days <br>
                    -	Create prototypes (review and update):  4 days <br>
                    -	Create DD (review and update): 7 days <br>
                    -	Coding: 30-50 days <br>
                    -	Integration testing: 5 days <br>
                </p>
            </div>
            <div class="aboutus-info style-small-left">
                <b class="box-title">Development Environments</b>
                <p class="txt-content">
                    -	Ngôn ngữ lập trình: Php, Javascript <br>
                    -	Framework: Laravel 8.x <br>
                    -	Library: Boostrap 4, Ajax, Jquery <br>
                    -	Web Server :  apache 2.4.52.0 <br>
                    -	DB: MySQL <br>
                    -	IDE: PhpStorm 2022.1 <br>
                    -	Source control: Git, Github <br>
                </p>
            </div>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="aboutus-info style-small-left">
                <b class="box-title">Main Actors!</b>
                <div class="list-showups">
                    <label>
                        <input type="radio" class="hidden" name="showup" id="shoup1" value="shoup1" checked="checked">
                        <span class="check-box"></span>
                        <span class='function-name'>Administrator</span>
                        <span class="desc">Có quyền xem, thêm mới, sửa, xóa tất cả các module</span>
                    </label>
                    <label>
                        <input type="radio" class="hidden" name="showup" id="shoup2" value="shoup2">
                        <span class="check-box"></span>
                        <span class='function-name'>Normal User </span>
                        <span class="desc">Xem tất cả các món ăn, chi tiết món ăn, thêm vào giỏ hàng, đặt món, bình luận đánh giá</span>
                    </label>
                    <label>
                        <input type="radio" class="hidden" name="showup" id="shoup3" value="shoup3">
                        <span class="check-box"></span>
                        <span class='function-name'>Guest</span>
                        <span class="desc">Xem tất cả các món ăn và chi tiết</span>
                    </label>
                </div>
            </div>
        </div>
    </div>

    <div class="our-team-info">
        <h4 class="title-box">Our teams</h4>
        <div class="our-staff">
            <div
                class="slide-carousel owl-carousel style-nav-1 equal-container"
                data-items="5"
                data-loop="false"
                data-nav="true"
                data-dots="false"
                data-margin="30"
                data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"3"},"1200":{"items":"4"}}' >

                <div class="team-member equal-elem">
                    <div class="media">
                        <a href="#" title="Thanh">
                            <figure><img src="assets/images/anh46.png" alt="THANH"></figure>
                        </a>
                    </div>
                    <div class="info">
                        <b class="name">hồ bá thanh</b>
                        <span class="title">Member</span>
                        <p class="desc">Là thành viên của nhóm dự án</p>
                    </div>
                </div>

                <div class="team-member equal-elem">
                    <div class="media">
                        <a href="#" title="Trong">
                            <figure><img src="assets/images/anh46.png" alt="TRONG"></figure>
                        </a>
                    </div>
                    <div class="info">
                        <b class="name">trần xuân trọng</b>
                        <span class="title">Member</span>
                        <p class="desc">Là thành viên của nhóm dự án</p>
                    </div>
                </div>

                <div class="team-member equal-elem">
                    <div class="media">
                        <a href="#" title="Thai">
                            <figure><img src="assets/images/anh46.png" alt="THAI"></figure>
                        </a>
                    </div>
                    <div class="info">
                        <b class="name">Hoàng Trọng Thái</b>
                        <span class="title">Member</span>
                        <p class="desc">Là thành viên của nhóm dự án</p>
                    </div>
                </div>

                <div class="team-member equal-elem">
                    <div class="media">
                        <a href="#" title="Tho">
                            <figure><img src="assets/images/anh46.png" alt="THO"></figure>
                        </a>
                    </div>
                    <div class="info">
                        <b class="name">thái văn thọ</b>
                        <span class="title">Member</span>
                        <p class="desc">Là thành viên của nhóm dự án</p>
                    </div>
                </div>

            </div>

        </div>

    </div>
    <!-- </div> -->

@endsection
