@extends('layouts.app')
@section('content')
<div class="col-xs-12 col-sm-4 col-sm-offset-4">
<form class="form_login" method="POST" action="{{ route('login') }}">
  {{ csrf_field() }}

  <div class="col-xs-12 col-sm-12">
    <h3>Login</h3>
    <label for="email">E-Mail ou Celular</label>
    <input id="email" type="email" class="{{ $errors->has('email') ? ' has-error' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
    @if ($errors->has('email'))
    <span class="error">{{ $errors->first('email') }}</span>
    @endif
  </div>

  <div class="col-xs-12 col-sm-12">
    <label for="password">Password</label>
    <input id="password" type="password" class="{{ $errors->has('password') ? ' has-error' : '' }}" name="password" required>
    @if ($errors->has('password'))
    <span class="error">{{ $errors->first('password') }}</span>
    @endif
  </div>

  <div class="col-xs-12 col-sm-12">
    <button type="submit" class="btn btn-primary">Entrar</button>
  </div>

  <div class="col-xs-12">
    <hr/>
    <p>
      <a href="{{ route('password.request') }}">Esqueci minha senha</a><br/>
      <a href="{{ route('register') }}">Quero me cadastrar</a>
    </p>
  </div>
  <div class="clearfix"></div>

</form>
</div>
@endsection
