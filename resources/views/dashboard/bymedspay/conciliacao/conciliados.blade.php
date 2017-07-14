@extends('layouts.dashboard')

@section('subTitle')
Pendentes de Conciliação
@endsection

@section('content')
  <div class="table-responsive">
    <table id="tbProcedimentos" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>Data</th>
          <th>Registro</th>
          <th>Paciente</th>
          <th>Plano de Saúde</th>
          <th>Procedimento</th>
          <th>Valor</th>
          <th>Registrado em</th>
        </tr>
      </thead>
      <tbody>
      @foreach($Procedures as $Procedure)
        <tr>
          <td>{{ date('d/m/Y',strtotime($Procedure->date)) }}</td>
          <td>{{ $Procedure->reference }}</td>
          <td>{{ $Procedure->name }}</td>
          <td>{{ $Procedure->insurer }}</td>
          <td>{{ $Procedure->tuss_id }} - {{ $Procedure->tuss_description }}</td>
          <td>{{ $Procedure->value }}</td>
          <td>{{ date('d/m/Y',strtotime($Procedure->created_at)) }}</td>
        </tr>
      @endforeach
      </tbody>
    </table>
  </div>
@endsection

@section('footer_scripts')
    <script src="/assets/AdminLTE-2.3.11/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="/assets/AdminLTE-2.3.11/plugins/datatables/dataTables.bootstrap.min.js"></script>
    <script>
        $("#tbProcedimentos").DataTable();
    </script>
@endsection
