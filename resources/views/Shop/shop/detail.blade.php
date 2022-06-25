@extends('layouts.app')

@section('title')
    <title>Chi tiet san pham</title>
@endsection

@section('custom_css')
    <link rel="stylesheet" type="text/css" href="{{asset('customers/assets/css/main.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('customers/assets/css/flexslider.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('customers/assets/css/style.css')}}">
@endsection

@section('custom_js')
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
            <div class="row">

                <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12 main-content-area">
                    <div class="wrap-product-detail">
                        <div class="detail-media">
                            <div class="product-gallery">
                                <ul class="slides">
                                    <li data-thumb="{{$product->main_image_path}}">
                                        <img src="{{$product->main_image_path}}" alt="product thumbnail"/>
                                    </li>
                                    @if(!empty($product->detailImages))
                                        @foreach($product->detailImages as $img)
                                            <li data-thumb="{{$img->image_path}}">
                                                <img src="{{$img->image_path}}" alt="product thumbnail"/>
                                            </li>
                                        @endforeach
                                    @endif

                                </ul>
                            </div>
                        </div>
                        <div class="detail-info">
                            <div class="product-rating">
                                <b style="font-size: 130%; margin-right: 5px">{{$ratesAvg}} </b>
                                <div class="star-rating">
                                    <span class="width-{{ceil($ratesAvg)*20}}-percent"></span>
                                </div>
                                <a href="#" class="count-review">({{$ratesCount}} reviews)</a>
                            </div>
                            <h2 class="product-name">{{$product->name}}</h2>
                            <div class="wrap-price"><span
                                    class="product-price">{{number_format($product->price)}} VND</span></div>
                            <div class="stock-info in-stock">
                                <p class="availability"><b>Đã bán: </b><b>{{$product->amount}}</b></p>
                            </div>
                            <form method="post">
                                @csrf
                                <div class="quantity">
                                    <span><b>Số lượng:</b></span>
                                    <div class="quantity-input">
                                        <input type="text" data-max="120" pattern="[0-9]*" value="1"
                                               name="product-quatity"
                                               class="product-quatity cart_product_qty_{{$product->id}}">
                                        <a class="btn btn-reduce" href="#"></a>
                                        <a class="btn btn-increase" href="#"></a>
                                    </div>
                                </div>
                                <div class="wrap-butons">

                                    <input type="hidden" value="1" name="cart_product_qty"
                                           class="cart_product_qty_{{$product->id}}">
                                    <input type="hidden" value="{{$product->id}}" name="cart_product_id"
                                           class="cart_product_id_{{$product->id}}">
                                    <input type="button" value="Thêm vào giỏ hàng" class="function-link add-to-cart"
                                           data-product_item="{{$product->id}}" data-url="{{route('cart.store')}}">
                                </div>
                            </form>
                        </div>
                        <div class="advance-info">
                            <div class="tab-control normal">
                                <a href="#review" class="tab-control-item active">ĐÁNH GIÁ</a>
                                <a href="#description" class="tab-control-item ">CHI TIẾT VỀ MÓN ĂN</a>

                            </div>
                            <div class="tab-contents">
                                <div class="tab-content-item active " id="review">

                                    <div class="wrap-review-form">
                                        <!-- #review_form_wrapper -->
                                        <div id="review_form_wrapper">
                                            <div id="review_form">
                                                <div id="respond" class="comment-respond">

                                                    <form action="{{route('product.comment')}}" method="post"
                                                          id="commentform" class="comment-form" novalidate="">
                                                        @csrf
                                                        <input type="hidden" name="product_id" value="{{$product->id}}">
                                                        <div class="comment-form-rating">
                                                            <span><b>Đánh giá của bạn: </b></span>
                                                            <p class="stars">
                                                                <label for="rated-1"></label>
                                                                <input type="radio" id="rated-1" name="rating"
                                                                       value="1">
                                                                <label for="rated-2"></label>
                                                                <input type="radio" id="rated-2" name="rating"
                                                                       value="2">
                                                                <label for="rated-3"></label>
                                                                <input type="radio" id="rated-3" name="rating"
                                                                       value="3">
                                                                <label for="rated-4"></label>
                                                                <input type="radio" id="rated-4" name="rating"
                                                                       value="4">
                                                                <label for="rated-5"></label>
                                                                <input type="radio" id="rated-5" name="rating" value="5"
                                                                       checked="checked">
                                                            </p>
                                                        </div>
                                                        <p class="comment-form-comment">
                                                            <label for="comment"><b>Cảm nhận của bạn về món ăn</b><span
                                                                    class="required">*</span>
                                                            </label>
                                                            <textarea id="comment" name="comment" cols="45"
                                                                      rows="8"></textarea>
                                                        </p>
                                                        <p class="form-submit">
                                                            <input name="submit" type="submit" id="submit"
                                                                   class="submit" value="Đăng">
                                                        </p>
                                                    </form>

                                                </div><!-- .comment-respond-->
                                            </div><!-- #review_form -->
                                        </div>
                                        <!-- #end review_form_wrapper -->


                                        <!-- #comments list-->
                                        <div id="comments">
                                            <h2 class="woocommerce-Reviews-title">{{sizeof($product->comments)}} review
                                                for <span>{{$product->name}}</span></h2>
                                            <ol class="commentlist">
                                                @php
                                                    $sort = new \Illuminate\Database\Eloquent\Collection();
                                                    $sort = $product->comments;
                                                    $comments = $sort->sortByDesc('created_at');
                                                @endphp
                                                @foreach($comments as $comment)
                                                    <li class="comment byuser comment-author-admin bypostauthor even thread-even depth-1"
                                                        id="li-comment-20">
                                                        <div id="comment-20" class="comment_container">
                                                            <img alt=""
                                                                 src="{{$comment->getUserAvt()}}"
                                                                 height="80" width="80">
                                                            <div class="comment-text">
                                                                <div class="star-rating">
                                                                    <span
                                                                        class="width-{{$comment->rate->rate_value*20}}-percent">Rated <strong
                                                                            class="rating">{{$comment->rate->rate_value}}</strong> out of 5</span>
                                                                </div>
                                                                <p class="meta">
                                                                    <strong
                                                                        class="woocommerce-review__author">{{$comment->getUserName()}}</strong>
                                                                    <span class="woocommerce-review__dash">–</span>
                                                                    <time
                                                                        class="woocommerce-review__published-date">{{$comment->getCreatedAttribute()}}</time>
                                                                </p>
                                                                <div class="description">
                                                                    <p>{{$comment->content}}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ol>
                                        </div><!-- # end comments list-->


                                    </div>
                                </div>
                                <div class="tab-content-item " id="description">
                                    {!!$product->description!!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!--end main products area-->

                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12 sitebar">
                    <div class="widget widget-our-services ">
                        <div class="widget-content">
                            <ul class="our-services">

                                <li class="service">
                                    <a class="link-to-service" href="#">
                                        <i class="fa fa-truck" aria-hidden="true"></i>
                                        <div class="right-content">
                                            <b class="title">Free Shipping</b>
                                            <span class="subtitle">On Oder Over $99</span>
                                            <p class="desc">Lorem Ipsum is simply dummy text of the printing...</p>
                                        </div>
                                    </a>
                                </li>

                                <li class="service">
                                    <a class="link-to-service" href="#">
                                        <i class="fa fa-gift" aria-hidden="true"></i>
                                        <div class="right-content">
                                            <b class="title">Special Offer</b>
                                            <span class="subtitle">Get a gift!</span>
                                            <p class="desc">Lorem Ipsum is simply dummy text of the printing...</p>
                                        </div>
                                    </a>
                                </li>

                                <li class="service">
                                    <a class="link-to-service" href="#">
                                        <i class="fa fa-reply" aria-hidden="true"></i>
                                        <div class="right-content">
                                            <b class="title">Order Return</b>
                                            <span class="subtitle">Return within 7 days</span>
                                            <p class="desc">Lorem Ipsum is simply dummy text of the printing...</p>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div><!-- Categories widget-->

                    <div class="widget mercado-widget widget-product">
                        <h2 class="widget-title">Popular Products</h2>
                        <div class="widget-content">
                            <ul class="products">
                                <li class="product-item">
                                    <div class="product product-widget-style">
                                        <div class="thumbnnail">
                                            <a href="detail.html"
                                               title="Radiant-360 R6 Wireless Omnidirectional Speaker [White]">
                                                <figure><img src="assets/images/products/digital_01.jpg" alt="">
                                                </figure>
                                            </a>
                                        </div>
                                        <div class="product-info">
                                            <a href="#" class="product-name"><span>Radiant-360 R6 Wireless Omnidirectional Speaker...</span></a>
                                            <div class="wrap-price"><span class="product-price">$168.00</span></div>
                                        </div>
                                    </div>
                                </li>

                                <li class="product-item">
                                    <div class="product product-widget-style">
                                        <div class="thumbnnail">
                                            <a href="detail.html"
                                               title="Radiant-360 R6 Wireless Omnidirectional Speaker [White]">
                                                <figure><img src="assets/images/products/digital_17.jpg" alt="">
                                                </figure>
                                            </a>
                                        </div>
                                        <div class="product-info">
                                            <a href="#" class="product-name"><span>Radiant-360 R6 Wireless Omnidirectional Speaker...</span></a>
                                            <div class="wrap-price"><span class="product-price">$168.00</span></div>
                                        </div>
                                    </div>
                                </li>

                                <li class="product-item">
                                    <div class="product product-widget-style">
                                        <div class="thumbnnail">
                                            <a href="detail.html"
                                               title="Radiant-360 R6 Wireless Omnidirectional Speaker [White]">
                                                <figure><img src="assets/images/products/digital_18.jpg" alt="">
                                                </figure>
                                            </a>
                                        </div>
                                        <div class="product-info">
                                            <a href="#" class="product-name"><span>Radiant-360 R6 Wireless Omnidirectional Speaker...</span></a>
                                            <div class="wrap-price"><span class="product-price">$168.00</span></div>
                                        </div>
                                    </div>
                                </li>

                                <li class="product-item">
                                    <div class="product product-widget-style">
                                        <div class="thumbnnail">
                                            <a href="detail.html"
                                               title="Radiant-360 R6 Wireless Omnidirectional Speaker [White]">
                                                <figure><img src="assets/images/products/digital_20.jpg" alt="">
                                                </figure>
                                            </a>
                                        </div>
                                        <div class="product-info">
                                            <a href="#" class="product-name"><span>Radiant-360 R6 Wireless Omnidirectional Speaker...</span></a>
                                            <div class="wrap-price"><span class="product-price">$168.00</span></div>
                                        </div>
                                    </div>
                                </li>

                            </ul>
                        </div>
                    </div>

                </div><!--end sitebar-->

            </div><!--end row-->

@endsection
