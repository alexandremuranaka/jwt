@extends('layouts.app')

@section('content')
<div class="col-xs-12 col-sm-6 col-sm-offset-3">
  @if ($errors)
    @foreach($errors->all() as $error )
      <div class="alert alert-danger" role="alert">{{ $error }}</div>
    @endforeach
  @endif
</div>
<div class="col-xs-12 col-sm-6 col-sm-offset-3">
    {!! Form::open(['url' => '/register','method' => 'post','class' => "form_login",'files' => true]) !!}
      <h3>Cadastro</h3>
      {!! Form::label('name','Nome') !!}
      {!! Form::text('name',  old('name') ) !!}

      {!! Form::label('email','E-mail') !!}
      {!! Form::text('email',old('email'))!!}

      {!! Form::label('cellphone','Celular') !!}
      {!! Form::text('cellphone',old('cellphone'),['class'=>'cellphone']) !!}

      {!! Form::label('Photo','Foto') !!}
      {!! Form::file('photo') !!}
      {!! Form::label('password','Senha') !!}
      {!! Form::password('password') !!}
      {!! Form::submit('Cadastrar' ,['id' => 'btn_cadastro', 'class' => 'btn btn-primary']) !!}
    {!! Form::close() !!}
</div>
@endsection
