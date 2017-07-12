@extends('layouts.dashboard')
@section('content')

<div class="col-xs-12 col-sm-12">
  <h1>Selecionar Hospital</h1>
  <hr/>

  @if(Session::has('fail'))
    <div class="alert alert-danger" role="alert">{!! Session::get('fail') !!}</div>
  @endif
<form method="post" action="/dashboard/bymedspay/hospital" class="form_basic">
  <input type="hidden" name="_token" value="{{ csrf_token() }}" />
  <div class="col-xs-12 col-sm-12">
    <select class="select" name="id">
      <option value="0">Selecione um Hospital</option>
      @foreach($hospitals as $hospital)
        <option value="{{$hospital->id}}">{{$hospital->name}}</option>
      @endforeach
    </select>
  </div>
  <div class="clearfix"></div>
  <div class="col-xs-12 col-sm-4">
    <button class="btn btn-primary">Selecionar</button>
  </div>
  <div class="clearfix"></div>
</form>
</div>
@endsection
