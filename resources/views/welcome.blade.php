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
              <div class="col-xs-12 col-sm-12">
                <h3>Novo Registro de Procedimento</h3>
                {!! Form::open(['url' => '/api/auth/procedures/store','id' => "form_cadastro",'files' => true]) !!}

                  {!! Form::label('user_id','user_id') !!}
                  {!! Form::text('user_id',null,['disabled' => 'true']) !!}

                  {!! Form::label('hospital_id','hospital_id') !!}
                  {!! Form::select('hospital_id', ['0' => 'Selecione um Hospital'] ) !!}

                  {!! Form::label('date','date') !!}
                  {!! Form::text('date') !!}

                  {!! Form::label('tuss_id','tuss_id') !!}
                  {!! Form::select('tuss_id', ['0' => 'Selecione o TUSS']) !!}

                  {!! Form::label('member_id','member_id') !!}
                  {!! Form::text('member_id') !!}

                  {!! Form::label('medical_insurance','medical_insurance') !!}
                  {!! Form::text('medical_insurance') !!}

                  {!! Form::label('insurance_type','insurance_type') !!}
                  {!! Form::text('insurance_type') !!}

                  {!! Form::label('patient_name','patient_name') !!}
                  {!! Form::text('patient_name') !!}

                  {!! Form::label('register_number','register_number') !!}
                  {!! Form::text('register_number') !!}

                  {!! Form::label('procedured_number','procedured_number') !!}
                  {!! Form::text('procedured_number') !!}

                  {!! Form::submit('Registrar' ,['id' => 'btn_cadastro', 'class' => 'btn btn-primary']) !!}
                {!! Form::close() !!}

              </div>
              <div class="col-xs-12 col-sm-12">
                <h3>User Procedures list</h3>
                <div class="table-responsive">
                  <table id="procedures_list" class="table table-striped table-hover">
                    <thead>
                      <th>user_id</th>
                      <th>hospital_id</th>
                      <th>tuss_id</th>
                      <th>date</th>
                      <th>member_id</th>
                      <th>medical_insurance</th>
                      <th>insurance_type</th>
                      <th>patient_name</th>
                      <th>register_number</th>
                      <th>procedured_number</th>
                    </thead>
                    <tbody class="procedures_list_content">
                    </tbody>
                  </table>
                </div>
              </div>

            </div>
          </div>
        </section>


    </body>
</html>
