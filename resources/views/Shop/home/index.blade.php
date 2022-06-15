@extends('layouts.app')

@section('title')
    <title>Trang chu</title>
@endsection

@section('custom_css')
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




