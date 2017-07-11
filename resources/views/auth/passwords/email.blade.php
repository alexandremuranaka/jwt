@extends('layouts.app')
@section('content')

<div class="col-xs-12 col-sm-4 col-sm-offset-4">
@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif

<form class="form_login" method="POST" action="{{ route('password.email') }}">
    {{ csrf_field() }}

    <div class="col-xs-12 col-sm-12">
      <h3>Recuperar Senha</h3>
      <label for="email" class="">E-Mail Address</label>
      <input id="email" type="email" class="{{ $errors->has('email') ? ' has-error' : '' }}" name="email" value="{{ old('email') }}" required>
      @if ($errors->has('email'))
        <span class="error">{{ $errors->first('email') }}</span>
      @endif
    </div>

    <div class="col-xs-12 col-sm-12">
        <button type="submit" class="btn btn-primary">Recuperar</button>
    </div>
    <div class="clearfix"></div>
</form>
</div>
@endsection
