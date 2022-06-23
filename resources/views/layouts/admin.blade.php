<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @yield('title')

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('AdminLTE/dist/css/adminlte.min.css') }}">

    <link rel="stylesheet" href="{{ asset('https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admins/sidebar/sidebar.css') }}">
    <script src="https://kit.fontawesome.com/00de14950c.js" crossorigin="anonymous"></script>
    @yield('custom_css')
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
    @include('admin.partials.header')

    @include('admin.partials.sidebar')

    @yield('content')


    @include('admin.partials.footer')
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{ asset('AdminLTE/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('AdminLTE/dist/js/adminlte.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
@yield('custom_js')
</body>
</html>
