<!doctype html>
<html lang="{{ config('app.locale') }}">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>byMeds</title>

<!-- Fonts -->
<link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
<link href="/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="/assets/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="/assets/css/app.css" rel="stylesheet" type="text/css"/>

<script defer src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script defer src="/assets/js/bootstrap.min.js"></script>
<script defer src="/assets/js/jquery.mask.min.js"></script>
<script defer src="/assets/js/app.js"></script>

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>


<section id="login">
  <div class="container">
    <div class="row">
      <div class="col-xs-12 col-sm-4 col-sm-offset-4">
        <a href="/"><img src="/assets/images/bymeds_logo.png" alt="logo bymeds"/></a>
      </div>
        @yield('content')
    </div>
  </div>
</section>


</body>
</html>
