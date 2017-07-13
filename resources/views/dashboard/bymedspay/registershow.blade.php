@extends('layouts.dashboard')
@section('content')

<div class="col-xs-12 col-sm-12">
  <h1>Detalhe do Registro <span><a href="/dashboard/bymedspay/register/{{$register->id}}/edit"><i class="fa fa-pencil"></i> Editar</a></span></h1>
  <hr/>
</div>

<div class="col-xs-12 col-sm-12">
  <div class="register">
    <p><strong>Código:</strong>{{ $register->barcode }} - {{ $register->secondary_number }}</p>
    <p><strong>Paciente:</strong> {{ $register->patient_name }} - {{ $register->patient_birthday }}</p>
    <p><strong>Convênio:</strong>{{ $register->medical_insurance }} - {{ $register->insurance_type }}</p>
  </div>
</div>

{!! Form::open(['url' => '/dashboard/bymedspay/register/favorite/$register->id/update', 'method' => 'post', 'class' => 'form_line']) !!}

  {!! Form::hidden('id', $register->id ) !!}

  @if($register->favorite == 1)
    {!! Form::hidden('favorite', 0) !!}
  @else
    {!! Form::hidden('favorite', 1) !!}
  @endif


  <div class="col-xs-12 col-sm-4">
    @if($register->favorite == 1)
    {!! Form::submit('Desmarcar como favorito', ['class' => 'btn_favorite']) !!}
    @else
    {!! Form::submit('Marcar como favorito', ['class' => 'btn_favorite']) !!}
    @endif

</div>

{!! Form::close() !!}



@endsection
