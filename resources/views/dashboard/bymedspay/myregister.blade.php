@extends('layouts.dashboard')
@section('content')

<div class="col-xs-12 col-sm-12">
  <h1>Meus Registros</h1>
  <hr/>
</div>

<div class="col-xs-12 col-sm-12">

  <div class="sanfona fav">
    <h4>Registros Favoritos <i class="fa fa-star"></i></h4>
    <div class="conteudo" style="display:block;">
      @foreach($favorities as $fav)
        <div class="registro_item"><p>{{$fav->barcode}} {{$fav->patient_name}} ({{$fav->medical_insurance}}) - {{$fav->name}}
          <a href="/dashboard/bymedspay/register/{{$fav->id}}/show"><i class="fa fa-eye"></i></a><a href="/dashboard/bymedspay/register/{{$fav->id}}/destroy"><i class="fa fa-times"></i></a></p></div>
      @endforeach
    </div>
  </div>

  <div class="sanfona">
    <h4>Últimos Registros <i class="fa fa-list"></i></h4>
    <div class="conteudo">
      @foreach($registers as $register)
        <div class="registro_item"><p>{{$register->barcode}} {{$register->patient_name}} ({{$register->medical_insurance}}) - {{$register->name}}
          <a href="/dashboard/bymedspay/register/{{$register->id}}/show"><i class="fa fa-eye"></i></a><a href="/dashboard/bymedspay/register/{{$register->id}}/destroy"><i class="fa fa-times"></i></a></p></div>
      @endforeach
    </div>
  </div>

</div>

<div class="col-xs-12 col-sm-4"><a class="btn btn-primary mtop" href="/dashboard/bymedspay/register">Adicionar Registro</a></div>
@endsection
