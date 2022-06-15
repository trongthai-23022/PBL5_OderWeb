@extends('layouts.app')

@section('title')
    <title>Trang chu</title>
@endsection

@section('custom_css')
@endsection

@section('content')
    <div class="container">
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
        <div class="row">
            <div class="col-md-12">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Active</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Dropdown</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#">Separated link</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection
