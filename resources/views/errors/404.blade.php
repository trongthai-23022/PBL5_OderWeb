<!DOCTYPE html>
<html lang="en">


<head>

    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>404 Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{asset('admins/errors/404.css')}}" rel="stylesheet">
</head>


<body>
<<<<<<< HEAD
<div class="d-flex align-items-center justify-content-center vh-100">
    <div class="text-center">
        <h1 class="display-1 fw-bold beri-color">404</h1>
        <p class="fs-3"> <span class="text-danger beri-color">Opps!</span> Page not found.</p>
        <p class="lead">
            The page you’re looking for doesn’t exist.
        </p>
        <a href="{{ url()->previous() }}" class="btn btn-primary beri-bg-color">Go Home</a>
=======
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

>>>>>>> 8b15f1342ea07ff8f56820d445dee2967872b45c
    </div>
</div>
</body>


</html>
