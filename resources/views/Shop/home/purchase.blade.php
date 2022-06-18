@extends('layouts.app')

@section('title')
    <title>Trang chu</title>
@endsection

@section('custom_css')
    <style>
        ul {
            list-style-type: none;
        }
        li.order-item{
            padding: 10px;
            background-color: #f4f4f4;
            margin-top: 10px;
            margin-right: 20px;
            border-radius: 10px;
        }
    </style>
@endsection

@section('custom_js')
    <!-- all plugins here -->
    <script src="{{asset('customers/nextpage-lite/assets/js/vendor.js')}}"></script>
    <script src="{{asset('admins/jquery.min.js')}}"></script>
    <script>
        $(function () {

            var url = window.location.pathname,
                urlRegExp = new RegExp(url.replace(/\/$/, '') + "$"); // create regexp to match current url pathname and remove trailing slash if present as it could collide with the link in navigation in case trailing slash wasn't present there
            // now grab every link from the navigation
            $('.multi-tab li').each(function () {
                // and test its normalized href against the url pathname regexp
                if (urlRegExp.test(this.href.replace(/\/$/, ''))) {
                    $(this).addClass('active');
                }
            });

        });
    </script>
    <script src="{{asset('vendor/sweetAlert2/sweetalert2@11.js')}}"></script>
    <script src="{{asset('admins/common.js')}}"></script>
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
    <div class="row d-flex justify-content-center">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs multi-tab" role="tablist">
            <li role="presentation" class=" col-md-2"><a href="#all" aria-controls="all" role="tab"
                                                         data-toggle="tab"><b>Tất cả</b></a></li>
            <li role="presentation" class=" col-md-2"><a href="#processing" aria-controls="processing" role="tab"
                                                         data-toggle="tab"><b>Đang xử lý</b></a></li>
            <li role="presentation" class=" col-md-2"><a href="#intransit" aria-controls="intransit" role="tab"
                                                         data-toggle="tab"><b>Đang giao</b></a></li>
            <li role="presentation" class=" col-md-2"><a href="#completed" aria-controls="completed" role="tab"
                                                         data-toggle="tab"><b>Đã hoàn thành</b></a></li>
            <li role="presentation" class=" col-md-2"><a href="#canceled" aria-controls="canceled" role="tab"
                                                         data-toggle="tab"><b>Đã hủy</b></a></li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="all">
                <div>
                    <ul>
                        <h3 class="box-title mt-4">Tất cả đơn đã đặt</h3>
                        @foreach($allOrders as $order)
                            <li class="order-item">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-md-6">
                                            <p class="price">Đặt vào lúc: <b>{{$order->created_at}}</b></p>
                                        </div>
                                        <div class="col-md-6">
                                            <p class="price float-right"><b>{{$status[$order->status]}}</b></p>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="col-md-12">
                                            <p class="price">Lời nhắn: <b>{{$order->note}}</b></p>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="col-md-6">

                                            <p class="price">Số lượng: <b>{{$order->item_count}}</b></p>

                                        </div>
                                        <div class="col-md-6">

                                            <p class="price">Tổng tiền:
                                                <b>{{number_format(intval($order->total),0,',','.')}} đ</b>
                                            </p>

                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-md-12">
                                            @for($i=0; $i < count($order['products']); $i++)
                                                <img style="height: 50px; margin-top: 4px"
                                                     src="{{$order->products[$i]['image_path']}}"
                                                     alt="{{$order['products'][$i]['image_name']}}">
                                            @endfor
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="d-flex justify-content-end">
                                        <a class="btn btn-default">Xem chi tiết</a>
                                        @if($order->status !== \App\Enums\OrderStatusEnum::PROCESSING)
                                            <a class="btn btn-default">Mua Lai</a>
                                        @endif
                                        @if($order->status === \App\Enums\OrderStatusEnum::PROCESSING)
                                            <a class="btn btn-default">Hủy đơn</a>
                                        @endif
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="processing">
                <div>
                    <ul>
                        <h3 class="box-title mt-4">Các đơn đang được xử lý</h3>
                        @foreach($processing as $order)
                            <li class="order-item">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-md-6">
                                            <p class="price">Đặt vào lúc: <b>{{$order->created_at}}</b></p>
                                        </div>
                                        <div class="col-md-6">
                                            <p class="price float-right"><b>{{$status[$order->status]}}</b></p>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="col-md-12">
                                            <p class="price">Lời nhắn: <b>{{$order->note}}</b></p>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="col-md-6">

                                            <p class="price">Số lượng: <b>{{$order->item_count}}</b></p>

                                        </div>
                                        <div class="col-md-6">

                                            <p class="price">Tổng tiền:
                                                <b>{{number_format(intval($order->total),0,',','.')}} đ</b>
                                            </p>

                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-md-12">
                                            @for($i=0; $i < count($order['products']); $i++)
                                                <img style="height: 50px; margin-top: 4px"
                                                     src="{{$order->products[$i]['image_path']}}"
                                                     alt="{{$order['products'][$i]['image_name']}}">
                                            @endfor
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="d-flex justify-content-end">
                                        <a class="btn btn-default">Xem chi tiết</a>
                                        @if($order->status !== \App\Enums\OrderStatusEnum::PROCESSING)
                                            <a class="btn btn-default">Mua Lai</a>
                                        @endif

                                        <form id="status" method="post">
                                            @csrf
                                            <input type="hidden" value="{{$order->id}}" class="order-id">
                                            <input type="hidden" value="{{\App\Enums\OrderStatusEnum::CANCELED}}" class="order-status">
                                            <input form="status" type="button" class="btn btn-small cancel" value="Hủy đơn" data-url="{{route('orders.update')}}">
                                        </form>
                                    </div>
                                </div>
                            </li>
                        @endforeach


                    </ul>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="intransit">
                <div>
                    <ul>
                        <h3 class="box-title mt-4">Các đơn đang giao</h3>
                        @foreach($inTransit as $order)
                            <li class="order-item">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-md-6">
                                            <p class="price">Đặt vào lúc: <b>{{$order->created_at}}</b></p>
                                        </div>
                                        <div class="col-md-6">
                                            <p class="price float-right"><b>{{$status[$order->status]}}</b></p>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="col-md-12">
                                            <p class="price">Lời nhắn: <b>{{$order->note}}</b></p>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="col-md-6">

                                            <p class="price">Số lượng: <b>{{$order->item_count}}</b></p>

                                        </div>
                                        <div class="col-md-6">

                                            <p class="price">Tổng tiền:
                                                <b>{{number_format(intval($order->total),0,',','.')}} đ</b>
                                            </p>

                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-md-12">
                                            @for($i=0; $i < count($order['products']); $i++)
                                                <img style="height: 50px; margin-top: 4px"
                                                     src="{{$order->products[$i]['image_path']}}"
                                                     alt="{{$order['products'][$i]['image_name']}}">
                                            @endfor
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="d-flex justify-content-end">
                                        <a class="btn btn-default">Xem chi tiết</a>
                                        @if($order->status !== \App\Enums\OrderStatusEnum::PROCESSING)
                                            <a class="btn btn-default">Mua Lai</a>
                                        @endif
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="completed">
                <div >
                    <ul>
                        <h3 class="box-title mt-4">Các đơn đã hoàn thành</h3>
                        @foreach($completed as $order)
                            <li class="order-item">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-md-6">
                                            <p class="price">Đặt vào lúc: <b>{{$order->created_at}}</b></p>
                                        </div>
                                        <div class="col-md-6">
                                            <p class="price float-right"><b>{{$status[$order->status]}}</b></p>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="col-md-12">
                                            <p class="price">Lời nhắn: <b>{{$order->note}}</b></p>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="col-md-6">

                                            <p class="price">Số lượng: <b>{{$order->item_count}}</b></p>

                                        </div>
                                        <div class="col-md-6">

                                            <p class="price">Tổng tiền:
                                                <b>{{number_format(intval($order->total),0,',','.')}} đ</b>
                                            </p>

                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-md-12">
                                            @for($i=0; $i < count($order['products']); $i++)
                                                <img style="height: 50px; margin-top: 4px"
                                                     src="{{$order->products[$i]['image_path']}}"
                                                     alt="{{$order['products'][$i]['image_name']}}">
                                            @endfor
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="d-flex justify-content-end">
                                        <a class="btn btn-default">Xem chi tiết</a>
                                        @if($order->status !== \App\Enums\OrderStatusEnum::PROCESSING)
                                            <a class="btn btn-default">Mua Lai</a>
                                        @endif
                                    </div>
                                </div>
                            </li>
                        @endforeach

                    </ul>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="canceled">
                <div >
                    <ul>
                        <h3 class="box-title mt-4">Các đơn đã hủy</h3>
                        @foreach($canceled as $order)
                            <li class="order-item">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-md-6">
                                            <p class="price">Đặt vào lúc: <b>{{$order->created_at}}</b></p>
                                        </div>
                                        <div class="col-md-6">
                                            <p class="price float-right"><b>{{$status[$order->status]}}</b></p>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="col-md-12">
                                            <p class="price">Lời nhắn: <b>{{$order->note}}</b></p>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="col-md-6">

                                            <p class="price">Số lượng: <b>{{$order->item_count}}</b></p>

                                        </div>
                                        <div class="col-md-6">

                                            <p class="price">Tổng tiền:
                                                <b>{{number_format(intval($order->total),0,',','.')}} đ</b>
                                            </p>

                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-md-12">
                                            @for($i=0; $i < count($order['products']); $i++)
                                                <img style="height: 50px; margin-top: 4px"
                                                     src="{{$order->products[$i]['image_path']}}"
                                                     alt="{{$order['products'][$i]['image_name']}}">
                                            @endfor
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="d-flex justify-content-end">
                                        <a class="btn btn-default">Xem chi tiết</a>
                                        @if($order->status !== \App\Enums\OrderStatusEnum::PROCESSING)
                                            <a class="btn btn-default">Mua Lai</a>
                                        @endif
                                    </div>
                                </div>
                            </li>
                        @endforeach



                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
