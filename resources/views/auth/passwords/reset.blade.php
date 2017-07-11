@extends('layouts.app')
@section('content')

<div class="col-xs-12 col-sm-6 col-sm-offset-3">
<form class="form_login" method="POST" action="{{ route('password.request') }}">
    {{ csrf_field() }}
    <input type="hidden" name="token" value="{{ $token }}">
    <label for="email" class="{{ $errors->has('email') ? ' has-error' : '' }}">E-Mail Address</label>
            <input id="email" type="email" class="{{ $errors->has('email') ? ' has-error' : '' }}" name="email" value="{{ $email or old('email') }}" required autofocus>
            @if ($errors->has('email'))
                <span class="error">{{ $errors->first('email') }}</span>
            @endif
    </div>

    <label for="password" class="{{ $errors->has('password') ? ' has-error' : '' }}">Password</label>
            <input id="password" type="password" class="{{ $errors->has('password') ? ' has-error' : '' }}" name="password" required>
            @if ($errors->has('password'))
                <span class="error">{{ $errors->first('password') }}</span>
            @endif
    </div>

    <label for="password-confirm" class="{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">Confirm Password</label>
            <input id="password-confirm" type="password" class="{{ $errors->has('password_confirmation') ? ' has-error' : '' }}" name="password_confirmation" required>
            @if ($errors->has('password_confirmation'))
                <span class="error">{{ $errors->first('password_confirmation') }}</span>
            @endif
    </div>

    <div class="form-group">
        <div class="col-md-6 col-md-offset-4">
            <button type="submit" class="btn btn-primary">Recuperar Senha</button>
        </div>
    </div>
    <div class="clearfix"></div>
</form>
</div>
@endsection
