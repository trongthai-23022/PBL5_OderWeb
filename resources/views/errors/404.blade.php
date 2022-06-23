<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>404</title>
    <link rel="stylesheet" href="{{asset('admins/errors/404.css')}} ">
</head>
<body>
<div id="error-page">
    <div class="content">
        <h1 class="header" data-text="404">404</h1>
        <h2 data-text="PAGE NOT POUND">PAGE NOT POUND</h2>
        <p>

            The page you were looking for doesn't exist, Please go back to the page now!
        </p>
        <div class="btns">
            <a href="{{ url()->previous() }}">Go Back</a>
        </div>

    </div>
</div>
</body>
</html>

