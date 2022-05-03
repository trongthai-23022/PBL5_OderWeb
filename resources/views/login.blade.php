<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Log in</title>
    <style></style>
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap') }}">
    <link rel="stylesheet" href="{{ asset('https://preview.colorlib.com/theme/bootstrap/login-form-07/fonts,_icomoon,_style.css+css,_owl.carousel.min.css+css,_bootstrap.min.css+css,_style.css.pagespeed.cc.Gajl4v2LrE.css') }}">
    <link rel="stylesheet" href="{{asset('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css')}}">

</head>
<body>
<div class="content">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <img src="https://d1csarkz8obe9u.cloudfront.net/posterpreviews/restaurant-logo-design-template-08a68b9418adeb6c8599892284a22ef1_screen.jpg?ts=1599559226" alt="Image" class="img-fluid">
            </div>
            <div class="col-md-6 contents">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="mb-4">
                            <h3>Sign In</h3>
                        </div>
                        <form action="" method="post">
                            @csrf
                            <div class="form-group first">

                                <input type="email" class="form-control" name="email" placeholder="Email">
                            </div>
                            <div class="form-group last mb-4">
                                <input type="password" class="form-control" name="password" placeholder="Password">
                            </div>
                            <div class="d-flex mb-5 align-items-center">
                                <label class="control control--checkbox mb-0"><span class="caption">Remember me</span>
                                    <input type="checkbox" checked name="remember"/>
                                    <div class="control__indicator"></div>
                                </label>
                                <span class="ml-auto"><a href="#" class="forgot-pass">Forgot Password</a></span>
                            </div>
                            <input type="submit" value="Log In" class="btn btn-block btn-primary">
                            <span class="d-block text-left my-4 text-muted">&mdash; or login with &mdash;</span>
                            <div class="social-login">
                                <a href="#" class="facebook">
                                    <span class="fa fa-facebook"></span>
                                </a>
                                <a href="#" class="twitter">
                                    <span class="icon-twitter mr-3"></span>
                                </a>
                                <a href="#" class="google">
                                    <span class="icon-google mr-3"></span>
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>

</html>

