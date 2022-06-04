@extends('layouts.app')

@section('title')
    <title>Trang chu</title>
@endsection

@section('content')

    <main id="main">
        <div class="container">

            @include('SuperKay.partials.slider')

{{--            @include('SuperKay.partials.banner')--}}

            @include('SuperKay.partials.onsale')

            @include('SuperKay.partials.latest-product')

            @include('SuperKay.partials.product-cate')

        </div>

    </main>
@endsection




