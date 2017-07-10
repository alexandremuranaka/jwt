@extends('layouts.admin')

@section('content')
        <section>
          <div class="container">
            <div class="row">
              <div class="col-xs-12 col-sm-6 col-sm-offset-3">
                <h1>Login app</h1>
                {!! Form::open(['id' => "form_login"]) !!}
                  {!! Form::label('user','user') !!}
                  {!! Form::text('user',null,['class' => 'login_email']) !!}
                  {!! Form::label('password','password') !!}
                  {!! Form::password('password') !!}
                  {!! Form::submit('Entrar' ,['id' => 'btn_login', 'class' => 'btn btn-primary']) !!}
                {!! Form::close() !!}
              </div>

            </div>
          </div>
      </section>
@endsection
