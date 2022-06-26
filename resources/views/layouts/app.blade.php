<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @yield('title')
    <link
        href="https://fonts.googleapis.com/css?family=Lato:300,400,400italic,700,700italic,900,900italic&amp;subset=latin,latin-ext"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css?family=Open%20Sans:300,400,400italic,600,600italic,700,700italic&amp;subset=latin,latin-ext"
        rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('customers/assets/css/animate.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('customers/assets/css/font-awesome.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('customers/assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('customers/assets/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('customers/assets/css/chosen.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('customers/assets/css/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('customers/assets/css/color-01.css')}}">

    @yield('custom_css')

</head>
<body class="home-page home-01 ">

@include('Shop.partials.mobile-menu')

@include('Shop.partials.header')
<main id="main" style="background-color: #f0f0f0 ">
<div class="container" style="padding: 20px; background-color: #ffffff">
    @yield('content')
</div>
</main>


@include('Shop.partials.footer')

<script src="{{asset('customers/assets/js/jquery-1.12.4.minb8ff.js?ver=1.12.4')}}"></script>
<script src="{{asset('customers/assets/js/jquery-ui-1.12.4.minb8ff.js?ver=1.12.4')}}"></script>
<script src="{{asset('customers/assets/js/bootstrap.min.js')}}"></script>
<script src="{{asset('customers/assets/js/jquery.flexslider.js')}}"></script>
<script src="{{asset('customers/assets/js/chosen.jquery.min.js')}}"></script>
<script src="{{asset('customers/assets/js/owl.carousel.min.js')}}"></script>
<script src="{{asset('customers/assets/js/jquery.countdown.min.js')}}"></script>
<script src="{{asset('customers/assets/js/jquery.sticky.js')}}"></script>
<script src="{{asset('customers/assets/js/functions.js')}}"></script>
@yield('custom_js')
</body>
</html>
