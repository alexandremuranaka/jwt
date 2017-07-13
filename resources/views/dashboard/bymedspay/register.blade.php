@extends('layouts.dashboard')
@section('content')

<div class="col-xs-12 col-sm-12">
  <h1>Novo Registro<span>{{session('hospital_name')}}</span></h1>
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
<div class="col-xs-12 col-sm-12">
  {!! Form::open(['url' => '/dashboard/bymedspay/register', 'method' => 'post', 'class'=>'form_basic']) !!}

    {!! Form::hidden('user_id', Auth::user()->id) !!}
    {!! Form::hidden('hospital_id', session('hospital_id')) !!}

    {!! Form::label('barcode','Código de Barras') !!}
    {!! Form::text('barcode', old('barcode')) !!}

    {!! Form::label('secondary_number','Número Secundário') !!}
    {!! Form::text('secondary_number', old('secondary_number')) !!}

    {!! Form::label('patient_name','Nome do Paciente') !!}
    {!! Form::text('patient_name', old('patient_name')) !!}

    {!! Form::label('patient_birthday','Data de Nascimento') !!}
    {!! Form::text('patient_birthday', old('patient_birthday'),['class' => 'data']) !!}

    {!! Form::label('medical_insurance','Convênio Médico') !!}
    {!! Form::text('medical_insurance', old('medical_insurance')) !!}

    {!! Form::label('insurance_type','Plano') !!}
    {!! Form::text('insurance_type', old('insurance_type')) !!}

    {!! Form::checkbox('favorite', old('favorite'),false,['class' => 'left']) !!}
    {!! Form::label('favorite','Marcar como favorito',['class' => 'left']) !!}


    {!! Form::submit('Registrar', ['class' => 'btn btn-primary']) !!}

  {!! Form::close() !!}
</div>

@endsection
