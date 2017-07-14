@extends('layouts.dashboard')
@section('content')

<div class="col-xs-12 col-sm-12">
  <h1>Todos Registros</h1>
  <hr/>
</div>

<div class="col-xs-12 col-sm-12">
    <div id="registerall">
      @foreach($registers as $register)
        <div class="registro_item">
          <p>{{$register->barcode}} {{$register->patient_name}} ({{$register->medical_insurance}}) - {{$register->name}}
            <a href="/dashboard/bymedspay/register/{{$register->id}}/show"><i class="fa fa-eye"></i></a>
            <a href="/dashboard/bymedspay/register/{{$register->id}}/destroy"><i class="fa fa-times"></i></a>
          </p>
      </div>
      @endforeach
    </div>
</div>

<div class="col-xs-12 col-sm-4"><button id="register_load" class="btn btn-primary mtop">Carregar mais</button></div>

@endsection
