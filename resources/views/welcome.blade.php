<!doctype html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

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
        <section>
          <div class="container">
            <div class="row">
              <div class="col-xs-12 col-sm-6">
                <h1>Login</h1>
                {!! Form::open(['id' => "form_login"]) !!}
                  {!! Form::label('user','user') !!}
                  {!! Form::text('user',null,['class' => 'login_email']) !!}
                  {!! Form::label('password','password') !!}
                  {!! Form::password('password') !!}
                  {!! Form::submit('Entrar' ,['id' => 'btn_login', 'class' => 'btn btn-primary']) !!}
                {!! Form::close() !!}
              </div>
                <div class="col-xs-12 col-sm-6">
                  <h1>Cadastro</h1>
                  {!! Form::open(['url' => '/api/auth/register','id' => "form_cadastro",'files' => true]) !!}
                    {!! Form::label('name','name') !!}
                    {!! Form::text('name') !!}

                    {!! Form::label('email','email') !!}
                    {!! Form::text('email')!!}

                    {!! Form::label('cellphone','cellphone') !!}
                    {!! Form::text('cellphone',null,['class'=>'cellphone']) !!}

                    {!! Form::label('Photo','Photo') !!}
                    {!! Form::file('photo') !!}
                    {!! Form::label('password','password') !!}
                    {!! Form::password('password') !!}
                    {!! Form::submit('Cadastrar' ,['id' => 'btn_cadastro', 'class' => 'btn btn-primary']) !!}
                  {!! Form::close() !!}
                </div>
                @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
            </div>
          </div>
        </section>

        <section id="logged">
          <div class="container">
            <div class="row">
              <div class="col-xs-12 col-sm-4">
                <div id="user_data"></div>
                <button id="btn_user_jwt" class="btn btn-primary">Usuario</button>
              </div>
              <div class="col-xs-12 col-sm-4">
                <ul id="hospital_list"></ul>
              </div>

            </div>
          </div>
        </section>


    </body>
</html>
