@extends('layouts.dashboard')
@section('content')

<div class="col-xs-12 col-sm-12">
  <h1>Registros</h1>
  <hr/>

  @if(Session::has('fail'))
    <div class="alert alert-danger" role="alert">{!! Session::get('fail') !!}</div>
  @endif

@endsection
