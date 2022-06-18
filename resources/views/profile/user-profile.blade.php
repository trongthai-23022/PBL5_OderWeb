@extends('layouts.app')
@section('title')
    <title>User Account</title>
@endsection

@section('custom_css')

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
@endsection

@section('custom_js')

    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="{{asset('admins/common.js')}}}"></script>

@endsection


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
    <div class="row">
        <div class="col-md-12">
            @if(session('message'))
                <div class="alert alert-danger response_message ">
                    {{session('message')}}
                </div>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3"><!--left col-->
            <div class="text-center">
                @if(!is_null($userInfo) && !is_null($userInfo->image_path))
                    <img style="width: 192px; height: 192px;object-fit: cover;" src="{{$userInfo->image_path}}" class="avatar img-circle img-thumbnail" alt="avatar">
                @else
                    <img src="http://ssl.gstatic.com/accounts/ui/avatar_2x.png" class="avatar img-circle img-thumbnail" alt="avatar">
                @endif
                <h6>Upload an avatar</h6>
                    <input form="user-info" name="avt_image" type="file" class=" form-control-file text-center center-block file-upload">
            </div></hr><br>


        </div><!--/col-3-->
        @if(is_null($userInfo))
            <div class="col-sm-9">
                <h3>Tài khoản của tôi</h3>
                <div>
                    <hr>
                    <form class="form" action="{{route('account.store')}}" method="post" id="user-info" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="username"><h4>Tên đăng nhập</h4></label>
                                <input type="text" disabled value="{{auth()->user()->name}}" class="form-control" name="username" id="username" >
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="email"><h4>Email</h4></label>
                                <input type="email" disabled value="{{auth()->user()->email}}" class="form-control" name="email" id="email" placeholder="you@email.com" title="enter your email.">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="name"><h4>Họ tên</h4></label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="full name" title="enter your last name if any.">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="phone"><h4>Số điện thoại</h4></label>
                                <input type="text" class="form-control" name="phone" id="phone" placeholder="enter phone" title="enter your phone number if any.">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="address"><h4>Địa chỉ</h4></label>
                                <input type="text" class="form-control" name="address" id="address" placeholder="somewhere" title="enter a location">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <label for="gender"><h4>Giới tính</h4></label>
                                <div class="form-check">
                                    <input class="form-check-input" value="1" type="radio" name="gender" id="flexRadioDefault1" checked>
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        Nam
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" value="0" type="radio" name="gender" id="flexRadioDefault2" >
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        Nữ
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-12">
                                <br>
                                <button form="user-info" class="btn btn-lg btn-success" type="submit"><i class="glyphicon glyphicon-ok-sign"></i> Save</button>
                            </div>
                        </div>
                    </form>

                    <hr>

                </div><!--/tab-pane-->
            </div><!--/tab-content-->
        @else
            <div class="col-sm-9">
            <h3>Tài khoản của tôi</h3>
            <div>
                <hr>
                <form class="form" action="#" method="post" id="user-info" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <div class="col-xs-6">
                            <label for="username"><h4>Username</h4></label>
                            <input disabled type="text" class="form-control" name="username" id="username" value="{{auth()->user()->name}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-6">
                            <label for="email"><h4>Email</h4></label>
                            <input disabled value="{{auth()->user()->email}}" type="email" class="form-control" name="email" id="email" placeholder="you@email.com" title="enter your email.">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-6">
                            <label for="name"><h4>Họ tên</h4></label>
                            <input type="text" value="{{$userInfo->name}}" class="form-control" name="name" id="name" placeholder="full name" title="enter your last name if any.">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-6">
                            <label for="phone"><h4>Số điện thoại</h4></label>
                            <input type="text" value="{{$userInfo->phone_number}}" class="form-control" name="phone" id="phone" placeholder="enter phone" title="enter your phone number if any.">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-6">
                            <label for="address"><h4>Địa chỉ</h4></label>
                            <input type="text" value="{{$userInfo->address}}" class="form-control" name="address" id="address" placeholder="somewhere" title="enter a location">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <label for="gender"><h4>Giới tính</h4></label>
                            <div class="form-check">
                                <input class="form-check-input" value="1" type="radio" name="gender"  {{$userInfo->gender==1?'checked':''}} id="flexRadioDefault1" checked>
                                <label  class="form-check-label" for="flexRadioDefault1">
                                    Nam
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" value="0" type="radio" name="gender" {{$userInfo->gender==0?'checked':''}} id="flexRadioDefault2">
                                <label class="form-check-label" for="flexRadioDefault2">
                                    Nữ
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-12">
                            <br>
                            <button form="user-info" class="btn btn-lg btn-success" type="submit"><i class="glyphicon glyphicon-ok-sign"></i> Save</button>
                        </div>
                    </div>
                </form>

                <hr>

            </div><!--/tab-pane-->
        </div><!--/tab-content-->
        @endif

    </div><!--/col-9-->

@endsection
