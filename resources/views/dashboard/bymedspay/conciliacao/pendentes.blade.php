@extends('layouts.dashboard')

@section('subTitle')
Pendentes de Conciliação
@endsection

@section('content')

    <!-- function menu -->
    <div class="box box-primary">
        <div class="box-body">
            <a class="btn btn-app" onclick="$('#modalEmail').modal('show')">
                <i class="fa fa-envelope"></i> Enviar por E-mail
            </a>
            <a class="btn btn-app" href="/dashboard/bymedspay/conciliacao/pendentes/excel">
                <i class="fa fa-download"></i> Download em Excel
            </a>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- function menu -->

  <div class="table-responsive">
       <table id="tbProcedimentos" class="table table-bordered table-striped">
          <thead>
              <tr>
                  <th>Data</th>
                  <th>Registro</th>
                  <th>Paciente</th>
                  <th>Plano de Saúde</th>
                  <th>Procedimento</th>
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
                  <td>{{ date('d/m/Y',strtotime($Procedure->created_at)) }}</td>
              </tr>
              @endforeach
          </tbody>
      </table>
  </div>

<!-- modal upload -->
<div class="modal" id="modalEmail">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span></button>
            <h4 class="modal-title">Enviar por E-mail</h4>
            </div>
            <form method="post" action="/dashboard/bymedspay/conciliacao/pendentes/email">
            {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form-group">
                        <label>E-mail Destinatário</label>
                        <input type="text" name="destinatario" required class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Mensagem</label>
                        <textarea name="mensagem" rows="5" class="form-control"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Enviar E-mail</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- modal upload -->
@endsection

@section('footer_scripts')
    <script src="/assets/AdminLTE-2.3.11/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="/assets/AdminLTE-2.3.11/plugins/datatables/dataTables.bootstrap.min.js"></script>
    <script>
        $("#tbProcedimentos").DataTable();
    </script>
@endsection
