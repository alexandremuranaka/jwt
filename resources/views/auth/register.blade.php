@extends('layouts.app')
@section('content')

<div class="col-xs-12 col-sm-6 col-sm-offset-3">
<form class="form_login" method="POST" action="{{ route('register') }}">
  {{ csrf_field() }}

  <div class="col-xs-12">
    <h3>Cadastro</h3>
    <label for="name" class="{{ $errors->has('name') ? ' has-error' : '' }}">Name</label>
    <input id="name" type="text" class="{{ $errors->has('name') ? ' has-error' : '' }}" name="name" required autofocus>
    @if ($errors->has('name')) <span class="error">{{ $errors->first('name') }}</span> @endif
  </div>

    <div class="col-xs-12">
      <label for="email" class="{{ $errors->has('email') ? ' has-error' : '' }}">E-Mail Address</label>
      <input id="email" type="email" class="{{ $errors->has('email') ? ' has-error' : '' }}" name="email" value="{{ old('email') }}" required>
      @if ($errors->has('email')) <span class="error">{{ $errors->first('email') }}</span> @endif
    </div>

      <div class="col-xs-12">
        <label for="cellphone" class="{{ $errors->has('cellphone') ? ' has-error' : '' }}">Celular</label>
        <input id="cellphone" type="text" class="{{ $errors->has('cellphon') ? ' has-error' : '' }}" name="cellphone" value="" required>
        @if ($errors->has('cellphone')) <span class="error">{{ $errors->first('email') }}</span> @endif
      </div>

  <div class="col-xs-12">
    <label for="password" class="{{ $errors->has('password') ? ' has-error' : '' }}">Senha</label>
    <input id="password" type="password" class="{{ $errors->has('password') ? ' has-error' : '' }}" name="password" required>
    @if ($errors->has('password')) <span class="error">{{ $errors->first('password') }}</span> @endif
  </div>

  <div class="col-xs-12">
    <label for="password-confirm" class="{{ $errors->has('password') ? ' has-error' : '' }}">Confirmar Senha</label>
    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
  </div>

  <div class="col-xs-12 col-sm-6">
    <button class="btn btn-primary">Cadastrar</button>
  </div>
  <div class="clearfix"></div>
</form>
</div>
@endsection
