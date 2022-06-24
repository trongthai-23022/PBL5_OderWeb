@extends('layouts.app')
@section('title')
    <title>Thank you</title>
@endsection

@section('custom_css')

@endsection
<script src="https://kit.fontawesome.com/00de14950c.js" crossorigin="anonymous"></script>
@section('custom_js')

@endsection
@section('content')

        <div class="container">
            <div class="wrap-breadcrumb">
                <ul>
                    <li class="item-link"><a href="{{route('app.home')}}" class="link">home</a></li>
                    <li class="item-link"><span>Thank You</span></li>
                </ul>
            </div>
        </div>

        <div class="container pb-60">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h2><span><i class="fas fa-heart"></i></span>
                        Cảm ơn bạn đã đặt hàng
                        <span><i class="fas fa-heart"></i></span>
                    </h2>
                    <a href="{{route('app.shop',['id'=>0, 'slug'=>'all'])}}" class="btn btn-submit btn-submitx">Tiếp tục mua</a>
                </div>
            </div>
        </div><!--end container-->
@endsection
