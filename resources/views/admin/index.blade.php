@extends('layouts.app')
@section('content')
<div class="col-xs-12 col-sm-4 col-sm-offset-4">
  @if ($errors)
    @foreach($errors->all() as $error )
      <div class="alert alert-danger" role="alert">{{ $error }}</div>
    @endforeach
  @endif
  @if(!empty ( $message ))
    <div class="alert alert-danger" role="alert">{{ $message }}</div>
  @endif
</div>
<div class="col-xs-12 col-sm-4 col-sm-offset-4">

{!! Form::open(['url' => '/', 'method' => 'post', 'class'=>'form_login']) !!}
<h3>Login</h3>
{!! Form::label('user','E-mail ou Celular') !!}
{!! Form::text('user',old('user') ) !!}
{!! Form::label('password','Senha') !!}
{!! Form::password('password') !!}
{!! Form::submit('Entrar',['class="btn btn-primary"']) !!}
<hr/>
<p><a href="/recover">Esqueci minha Senha</a></p>
<p><a href="/register">Quero me cadastrar</a></p>
{!! Form::close() !!}
</div>
@endsection
