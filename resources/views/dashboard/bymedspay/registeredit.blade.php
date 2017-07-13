@extends('layouts.dashboard')
@section('content')

<div class="col-xs-12 col-sm-12">
  <h1>Editar Registro</h1>
  <hr/>
</div>

<div class="col-xs-12 col-sm-12">
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

  <div class="col-xs-12 col-sm-12">
{!! Form::open(['url' => '/dashboard/bymedspay/register/$register->id/update', 'method' => 'post', 'class' => 'form_basic']) !!}

  {!! Form::hidden('id', $register->id) !!}
  {!! Form::hidden('user_id', $register->user_id) !!}

  {!! Form::label('hospital','Hospital') !!}
  {!! Form::select('hospital_id',$hospitals,$register->hospital_id) !!}

  {!! Form::label('barcode','Código de Barras') !!}
  {!! Form::text('barcode', old('barcode', $register->barcode)) !!}

  {!! Form::label('secondary_number','Número Secundário') !!}
  {!! Form::text('secondary_number', old('secondary_number', $register->secondary_number)) !!}

  {!! Form::label('patient_name','Nome do Paciente') !!}
  {!! Form::text('patient_name', old('patient_name', $register->patient_name)) !!}

  {!! Form::label('patient_birthday','Data de Nascimento') !!}
  {!! Form::text('patient_birthday', old('patient_birthday', $register->patient_birthday) ,['class' => 'data']) !!}

  {!! Form::label('medical_insurance','Convênio Médico') !!}
  {!! Form::text('medical_insurance', old('medical_insurance', $register->medical_insurance)) !!}

  {!! Form::label('insurance_type','Plano') !!}
  {!! Form::text('insurance_type', old('insurance_type', $register->insurance_type)) !!}

  {!! Form::checkbox('favorite', old('favorite'),$register->favorite,['class' => 'left']) !!}
  {!! Form::label('favorite','Marcar como favorito',['class' => 'left']) !!}
  <div class="clearfix"></div>
  <div class="row">
    <div class="col-xs-12 col-sm-6">
      {!! Form::submit('Alterar', ['class' => 'btn btn-primary']) !!}
    </div>
  </div>
  <div class="clearfix"></div>
{!! Form::close() !!}



@endsection
