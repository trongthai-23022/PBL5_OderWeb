@extends('layouts.app')

@section('title')
    <title>Trang chu</title>
@endsection

@section('content')

    <main id="main">
        <div class="container">
            @if(!is_null($sliders))
                @include('SuperKay.partials.slider')
            @endif


            {{--            @include('SuperKay.partials.banner')--}}
            @if(!is_null($onSaleProducts))
                @include('SuperKay.partials.onsale')
            @endif



            @include('SuperKay.partials.latest-product')

            @include('SuperKay.partials.product-cate')

        </div>

    </main>
@endsection




