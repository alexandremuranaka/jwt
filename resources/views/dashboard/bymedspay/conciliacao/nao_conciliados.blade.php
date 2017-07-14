@extends('layouts.dashboard')

@section('subTitle')
Não Identificados
@endsection

@section('content')

<div class="row">
    <form method="post" action="/dashboard/bymedspay/conciliacao/nao-identificados/conciliar">
    {{ csrf_field() }}
    <div class="table">
         <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Data</th>
                    <th>Registro</th>
                    <th>TUSS</th>
                    <th>Descrição</th>
                    <th>Plano de Saúde</th>
                    <th>Valor</th>
                    <th>Conciliar</th>
                </tr>
            </thead>
            <tbody>
                @foreach($Items as $Item)
                <tr>
                    <td>{{ date('d/m/Y',strtotime($Item->date)) }}</td>
                    <td>{{ $Item->register }}</td>
                    <td>{{ $Item->tuss }}</td>
                    <td>{{ $Item->description }}</td>
                    <td>{{ $Item->insurer }}</td>
                    <td>R$ {{ number_format($Item->value,2,',','.') }}</td>
                    <td>
                        <select name="conciliar[{{ $Item->id }}]" class="form-control">
                            <option value="0"></option>
                            @foreach($Procedures as $Procedure)
                                @if($Procedure->register->reference == $Item->register)
                                <option value="{{ $Procedure->id }}" @if($Item->tuss==$Procedure->tuss_id && $Item->date==$Procedure->date) selected @endif>{{ $Procedure->register->reference }} - {{ $Procedure->register->name }} {{ $Procedure->tuss_id }} - {{ $Procedure->tuss->description }}</option>
                                @endif
                            @endforeach
                        </select>
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="7">
                        <button type="submit" class="btn btn-primary pull-right">Conciliar Selecionados</button>
                    </td>
                </tr>
            </tfoot>
        </table>
        </form>
    </div>
</div>

@endsection

@section('footer_scripts')
    <script src="/assets/AdminLTE-2.3.11/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="/assets/AdminLTE-2.3.11/plugins/datatables/dataTables.bootstrap.min.js"></script>
    <script>
        $("#tbNaoIdentificados").DataTable();
    </script>
@endsection
