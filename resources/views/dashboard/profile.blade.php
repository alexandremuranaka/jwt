@extends('layouts.dashboard')
@section('content')

<div class="col-xs-12 col-sm-12">
  <h1>Perfil</h1>
  <hr/>
  @if ($errors)
    @foreach($errors->all() as $error )
      <div class="alert alert-danger" role="alert">{{ $error }}</div>
    @endforeach
  @endif
  
  @if(Session::has('fail'))
    <div class="alert alert-danger" role="alert">{!! Session::get('fail') !!}</div>
  @endif

  @if(Session::has('success'))
    <div class="alert alert-success" role="alert">{!! Session::get('success') !!}</div>
  @endif
</div>
<div class="col-xs-12 col-sm-6">

  {!! Form::open(['url' => '/dashboard/profile/update', 'method' => 'post', 'class'=>'form_basic']) !!}
  <h3>Dados Pessoais</h3>
  {!! Form::hidden('id',$user->id) !!}
  {!! Form::label('name','Nome') !!}
  {!! Form::text('name',$user->name) !!}
  <label>E-mail</label>
  <p class="inputtext">{{$user->email}}</p>
  <label>Celular</label>
  <p class="inputtext telefone">{{$user->cellphone}}</p>
  {!! Form::submit('Atualizar',['class' => 'btn btn-primary']) !!}
  {!! Form::close() !!}
</div>
<div class="col-xs-12 col-sm-6">

  {!! Form::open(['url' => '/dashboard/profile/updatepass', 'method' => 'post', 'class'=>'form_basic']) !!}
  <h3>Senha</h3>
  {!! Form::hidden('id',$user->id) !!}
  {!! Form::label('oldpass','Senha Atual') !!}
  {!! Form::password('oldpass') !!}

  {!! Form::label('newpass','Nova Senha') !!}
  {!! Form::password('newpass') !!}

  {!! Form::label('confirmpass','Confirmar Senha') !!}
  {!! Form::password('confirmpass') !!}

  {!! Form::submit('Atualizar',['class' => 'btn btn-primary']) !!}
  {!! Form::close() !!}
</div>
@endsection
