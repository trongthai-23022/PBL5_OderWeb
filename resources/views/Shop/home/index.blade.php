@extends('layouts.app')

@section('title')
    <title>Trang chu</title>
@endsection

@section('custom_css')
    {{--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />--}}
@endsection

@section('content')

    <main id="main">
        <div class="container">
            @if(!is_null($sliders))
                @include('Shop.partials.slider')
            @endif


            {{--            @include('Shop.partials.banner')--}}
            @if(!is_null($onSaleProducts))
                @include('Shop.partials.onsale')
            @endif



            @include('Shop.partials.latest-product')

            @include('Shop.partials.product-cate')

        </div>

    </main>
@endsection


@section('custom_js')
    <script src="{{asset('vendor/sweetAlert2/sweetalert2@11.js')}}"></script>
    <script src="{{asset('admins/common.js')}}"></script>
@endsection




