@extends('layouts.app')
@section('content')
<div class="col-xs-12 col-sm-4 col-sm-offset-4">
@if ($errors)
  @foreach($errors->all() as $error )
    <div class="alert alert-danger" role="alert">{{ $error }}</div>
  @endforeach
@endif
</div>
<div class="col-xs-12 col-sm-4 col-sm-offset-4">
{!! Form::open(['url' => '/recover', 'method' => 'post', 'class'=>'form_login']) !!}
<h3>Recuperar Senha</h3>
{!! Form::label('user','E-mail ou Celular') !!}
{!! Form::text('user',old('user') ) !!}
{!! Form::submit('Recuperar Senha',['class="btn btn-primary"']) !!}
<hr/>
<p><a href="/login">Login</a></p>
<p><a href="/register">Quero me cadastrar</a></p>
{!! Form::close() !!}
</div>
@endsection
