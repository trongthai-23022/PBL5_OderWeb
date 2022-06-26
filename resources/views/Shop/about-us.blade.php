<<<<<<< HEAD
=======
@extends('layouts.app')

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

            <!-- <div class="main-content-area"> -->
            <div class="aboutus-info style-center">
                <b class="box-title">Interesting Facts</b>
                <p class="txt-content">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the dummy text ever since the 1500s, when an unknown printer took a galley of type</p>
            </div>

            <div class="row">

                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <div class="aboutus-info style-small-left">
                        <b class="box-title">What we really do?</b>
                        <p class="txt-content">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock,</p>
                    </div>
                    <div class="aboutus-info style-small-left">
                        <b class="box-title">History of the Company</b>
                        <p class="txt-content">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock,</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <div class="aboutus-info style-small-left">
                        <b class="box-title">Our Vision</b>
                        <p class="txt-content">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock,</p>
                    </div>
                    <div class="aboutus-info style-small-left">
                        <b class="box-title">Cooperate with Us!</b>
                        <p class="txt-content">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock,</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <div class="aboutus-info style-small-left">
                        <b class="box-title">Cooperate with Us!</b>
                        <div class="list-showups">
                            <label>
                                <input type="radio" class="hidden" name="showup" id="shoup1" value="shoup1" checked="checked">
                                <span class="check-box"></span>
                                <span class='function-name'>Support 24/7</span>
                                <span class="desc">Lorem Ipsum is simply dummy text of the printing and typesetting industry...</span>
                            </label>
                            <label>
                                <input type="radio" class="hidden" name="showup" id="shoup2" value="shoup2">
                                <span class="check-box"></span>
                                <span class='function-name'>Best Quanlity</span>
                                <span class="desc">Lorem Ipsum is simply dummy text of the printing and typesetting industry...</span>
                            </label>
                            <label>
                                <input type="radio" class="hidden" name="showup" id="shoup3" value="shoup3">
                                <span class="check-box"></span>
                                <span class='function-name'>Fastest Delivery</span>
                                <span class="desc">Lorem Ipsum is simply dummy text of the printing and typesetting industry...</span>
                            </label>
                            <label>
                                <input type="radio" class="hidden" name="showup" id="shoup4" value="shoup4">
                                <span class="check-box"></span>
                                <span class='function-name'>Customer Care</span>
                                <span class="desc">Lorem Ipsum is simply dummy text of the printing and typesetting industry...</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="our-team-info">
                <h4 class="title-box">Our teams</h4>
                <div class="our-staff">
                    <div
                        class="slide-carousel owl-carousel style-nav-1 equal-container"
                        data-items="5"
                        data-loop="false"
                        data-nav="true"
                        data-dots="false"
                        data-margin="30"
                        data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"3"},"1200":{"items":"4"}}' >

                        <div class="team-member equal-elem">
                            <div class="media">
                                <a href="#" title="LEONA">
                                    <figure><img src="assets/images/member-leona.jpg" alt="LEONA"></figure>
                                </a>
                            </div>
                            <div class="info">
                                <b class="name">leona</b>
                                <span class="title">Director</span>
                                <p class="desc">Contrary to popular belief, Lorem Ipsum is not simply random text...</p>
                            </div>
                        </div>

                        <div class="team-member equal-elem">
                            <div class="media">
                                <a href="#" title="LUCIA">
                                    <figure><img src="assets/images/member-lucia.jpg" alt="LUCIA"></figure>
                                </a>
                            </div>
                            <div class="info">
                                <b class="name">LUCIA</b>
                                <span class="title">Manager</span>
                                <p class="desc">Contrary to popular belief, Lorem Ipsum is not simply random text...</p>
                            </div>
                        </div>

                        <div class="team-member equal-elem">
                            <div class="media">
                                <a href="#" title="NANA">
                                    <figure><img src="assets/images/member-nana.jpg" alt="NANA"></figure>
                                </a>
                            </div>
                            <div class="info">
                                <b class="name">NANA</b>
                                <span class="title">Marketer</span>
                                <p class="desc">Contrary to popular belief, Lorem Ipsum is not simply random text...</p>
                            </div>
                        </div>

                        <div class="team-member equal-elem">
                            <div class="media">
                                <a href="#" title="BRAUM">
                                    <figure><img src="assets/images/member-braum.jpg" alt="BRAUM"></figure>
                                </a>
                            </div>
                            <div class="info">
                                <b class="name">BRAUM</b>
                                <span class="title">Member</span>
                                <p class="desc">Contrary to popular belief, Lorem Ipsum is not simply random text...</p>
                            </div>
                        </div>

                        <div class="team-member equal-elem">
                            <div class="media">
                                <a href="#" title="LUCIA">
                                    <figure><img src="assets/images/member-lucia.jpg" alt="LUCIA"></figure>
                                </a>
                            </div>
                            <div class="info">
                                <b class="name">LUCIA</b>
                                <span class="title">Manager</span>
                                <p class="desc">Contrary to popular belief, Lorem Ipsum is not simply random text...</p>
                            </div>
                        </div>

                        <div class="team-member equal-elem">
                            <div class="media">
                                <a href="#" title="NANA">
                                    <figure><img src="assets/images/member-nana.jpg" alt="NANA"></figure>
                                </a>
                            </div>
                            <div class="info">
                                <b class="name">NANA</b>
                                <span class="title">Marketer</span>
                                <p class="desc">Contrary to popular belief, Lorem Ipsum is not simply random text...</p>
                            </div>
                        </div>

                    </div>

                </div>

            </div>
            <!-- </div> -->




@endsection
>>>>>>> 1d4099b3c7008416c3d75f26bcf61db0667404f3
