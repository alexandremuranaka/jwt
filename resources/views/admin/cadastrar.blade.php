@extends('layouts.admin')

@section('content')
<section>
  <div class="container">
    <div class="row">
      <div class="col-xs-12 col-sm-6 col-sm-offset-3">
          <h1>Cadastro app</h1>
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
@endsection
