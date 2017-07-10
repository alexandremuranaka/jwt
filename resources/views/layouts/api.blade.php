<!doctype html>
<html lang="{{ config('app.locale') }}">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>byMeds</title>

<!-- Fonts -->
<link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
<link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="assets/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="assets/css/jwt.css" rel="stylesheet" type="text/css"/>

<script defer src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script defer src="assets/js/bootstrap.min.js"></script>
<script defer src="assets/js/jquery.mask.min.js"></script>
<script defer src="assets/js/jwt.js"></script>

</head>
<body>

<!--
<div class="flex-center position-ref full-height">
    @if (Route::has('login'))
        <div class="top-right links">
            @if (Auth::check())
                <a href="{{ url('/home') }}">Home</a>
            @else
                <a href="{{ url('/login') }}">Login</a>
                <a href="{{ url('/register') }}">Register</a>
            @endif
        </div>
    @endif
</div>
-->

@yield('content')
</body>
</html>
