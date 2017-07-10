@extends('layouts.api')

@section('content')
        <section>
          <div class="container">
            <div class="row">
              <div class="col-xs-12 col-sm-6">
                <h1>Login api</h1>
                {!! Form::open(['id' => "form_login"]) !!}
                  {!! Form::label('user','user') !!}
                  {!! Form::text('user',null,['class' => 'login_email']) !!}
                  {!! Form::label('password','password') !!}
                  {!! Form::password('password') !!}
                  {!! Form::submit('Entrar' ,['id' => 'btn_login', 'class' => 'btn btn-primary']) !!}
                {!! Form::close() !!}
              </div>
                <div class="col-xs-12 col-sm-6">
                  <h1>Cadastro api</h1>
                  {!! Form::open(['url' => '/api/auth/register','id' => "form_cadastro",'files' => true]) !!}
                    {!! Form::label('name','name') !!}
                    {!! Form::text('name') !!}

                    {!! Form::label('email','email') !!}
                    {!! Form::text('email')!!}

                    {!! Form::label('cellphone','cellphone') !!}
                    {!! Form::text('cellphone',null,['class'=>'cellphone']) !!}

                    {!! Form::label('Photo','Photo') !!}
                    {!! Form::file('photo') !!}
                    {!! Form::label('password','password') !!}
                    {!! Form::password('password') !!}
                    {!! Form::submit('Cadastrar' ,['id' => 'btn_cadastro', 'class' => 'btn btn-primary']) !!}
                  {!! Form::close() !!}
                </div>
            </div>
          </div>
        </section>

        <section id="logged">
          <div class="container">
            <div class="row">
              <div class="col-xs-12 col-sm-4">
                <div id="user_data"></div>
                <button id="btn_user_jwt" class="btn btn-primary">Usuario</button>
              </div>
              <div class="col-xs-12 col-sm-12">
                <h3>Novo Registro de Procedimento</h3>
                {!! Form::open(['url' => '/api/auth/procedures/store','id' => "form_procedure"]) !!}


                  {!! Form::hidden('user_id',null,['id' => 'user_id']) !!}
                  {!! Form::hidden('token',null,['id' => 'token']) !!}

                  {!! Form::label('hospital_id','hospital_id') !!}
                  {!! Form::select('hospital_id', ['' => 'Selecione um Hospital'] ) !!}

                  {!! Form::label('date','date') !!}
                  {!! Form::text('date',null,['class' => 'date']) !!}

                  {!! Form::label('tuss_id','tuss_id') !!}
                  {!! Form::select('tuss_id', ['' => 'Selecione o TUSS']) !!}

                  {!! Form::label('member_id','member_id') !!}
                  {!! Form::text('member_id') !!}

                  {!! Form::label('medical_insurance','medical_insurance') !!}
                  {!! Form::text('medical_insurance') !!}

                  {!! Form::label('insurance_type','insurance_type') !!}
                  {!! Form::text('insurance_type') !!}

                  {!! Form::label('patient_name','patient_name') !!}
                  {!! Form::text('patient_name') !!}

                  {!! Form::label('register_number','register_number') !!}
                  {!! Form::text('register_number') !!}

                  {!! Form::label('procedured_number','procedured_number') !!}
                  {!! Form::text('procedured_number') !!}

                  {!! Form::label('procedured_comment','procedured_comment') !!}
                  {!! Form::text('procedured_comment') !!}

                  {!! Form::submit('Registrar' ,['id' => 'btn_procedure', 'class' => 'btn btn-primary']) !!}
                {!! Form::close() !!}

              </div>
              <div class="col-xs-12 col-sm-12">
                <h3>User Procedures list</h3>
                <div class="table-responsive">
                  <table id="procedures_list" class="table table-striped table-hover">
                    <thead>
                      <th>user_id</th>
                      <th>hospital_id</th>
                      <th>date</th>
                      <th>tuss_id</th>
                      <th>member_id</th>
                      <th>medical_insurance</th>
                      <th>insurance_type</th>
                      <th>patient_name</th>
                      <th>register_number</th>
                      <th>procedured_number</th>
                      <th>comments</th>
                    </thead>
                    <tbody class="procedures_list_content">
                    </tbody>
                  </table>
                </div>


              </div>

            </div>
          </div>
        </section>
        <section>
          <div class="container">
            <div class="row">
              <div class="col-xs-12 col-sm-6">
                <button id="btn_procedure_list" class="btn btn-primary">Listar Procedimentos</button>
              </div>
                <div class="col-xs-12 col-sm-6">
                  <button id="btn_tuss" class="btn btn-primary">Listar TUSS</button>
                </div>
            </div>
          </div>
        </section>
@endsection
