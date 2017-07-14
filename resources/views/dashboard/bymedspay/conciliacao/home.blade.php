@extends('layouts.dashboard')

@section('subTitle')
Conciliador
@endsection

@section('content')
    <!-- function menu -->
    <div class="col-xs-12 col-sm-12">
      <div class="box box-primary">
        <div class="box-header with-border">

        <h3 class="box-title">Planilhas de Recebimento</h3>
         <div class="box-tools pull-right">
            <a href="/dashboard/bymedspay/conciliacao/hospitals" class="btn btn-default">Trocar de Hospital</a>
         </div>
        </div>

        <div class="box-body">
            <a class="btn btn-app" onclick="$('#modalUpload').modal('show')">
                <i class="fa fa-upload"></i> Enviar Planilha
            </a>
            <a class="btn btn-app">
                <i class="fa fa-table"></i> Consultar Planilhas
            </a>
        </div>
      </div>
        <!-- /.box-body -->
    </div>
    <!-- function menu -->
    <div class="clearfix"></div>
    <div class="col-sm-4 col-xs-12">
        <div class="info-box">
        <span class="info-box-icon bg-red"><i class="fa fa-bars"></i></span>

        <div class="info-box-content">
            <span class="info-box-text">Pendentes de Conciliação</span>
            <span class="info-box-number">{{ $qtdPendentes->qtd or 'Nenhum' }}</span>
            <a href="/dashboard/bymedspay/conciliacao/pendentes" class="btn btn-xs btn-default pull-right">Ver</a>
        </div>
        <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <div class="col-sm-4 col-xs-12">
        <div class="info-box">
        <span class="info-box-icon bg-green"><i class="fa fa-money"></i></span>

        <div class="info-box-content">
            <span class="info-box-text">Total Conciliado</span>
            <span class="info-box-number">R$ {{ $valorConciliado->total or '0,00' }}</span>
            <a href="" class="btn btn-xs btn-default pull-right">Ver</a>
        </div>
        <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <div class="col-sm-4 col-xs-12">
        <div class="info-box">
        <span class="info-box-icon bg-yellow"><i class="fa fa-search"></i></span>

        <div class="info-box-content">
            <span class="info-box-text">Recebimentos não identificados</span>
            <span class="info-box-number">R$
            @if(isset($valorConciliado->total))
            {{ $valorTotal->total - $valorConciliado->total }}

            @elseif(isset($valorTotal->total))
            {{ number_format($valorTotal->total,2,',','.') }}
            @else 0,00 @endif</span>
            <a href="/dashboard/bymedspay/conciliacao/nao-identificados" class="btn btn-xs btn-default pull-right">Ver</a>
        </div>
        <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>

    <div class="clearfix"></div>
    <!-- function menu -->
    <div clas="col-xs-12 col-sm-12">
      <div class="box box-primary">
          <div class="box-header with-border">
          <h3 class="box-title">Relatórios</h3>

          </div>
          <div class="box-body">
              <a class="btn btn-app" href="/web/conciliacao/pendentes">
                  <i class="fa fa-bars"></i> Procedimentos Pendentes
              </a>
              <a class="btn btn-app" href="/web/conciliacao/conciliados">
                  <i class="fa fa-bars"></i> Conciliados
              </a>
              <a class="btn btn-app" href="/web/conciliacao/nao-identificados">
                  <i class="fa fa-bars"></i> Recebimentos Não Identificados
              </a>
          </div>
          <!-- /.box-body -->
      </div>
    </div>
    <!-- function menu -->

    <div class="col-xs-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Visão Geral - 3 meses</h3>
            </div>
            <div class="box-body">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <td></td>
                            @foreach($arrTotal as $total)
                                <td>{{ $total['periodo'] }}</td>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Total de Procedimentos</td>
                            @foreach($arrTotal as $total)
                                <td>{{ $total['procedimentos'] }}</td>
                            @endforeach
                        </tr>
                        <tr>
                            <td>Pendentes de Conciliação</td>
                            @foreach($arrTotal as $total)
                                <td>{{ $total['procedimentos'] - $total['conciliados'] }}</td>
                            @endforeach
                        </tr>
                        <tr>
                            <td>Valor Conciliado</td>
                            @foreach($arrTotal as $total)
                                <td>R$ {{ number_format($total['total'],2,',','.') }}</td>
                            @endforeach
                        </tr>
                        <tr>
                            <td>Ganhos - Clínico</td>
                            @foreach($arrTotal as $total)
                                <td>R$ {{ number_format($total['clinico'],2,',','.') }}</td>
                            @endforeach
                        </tr>
                        <tr>
                            <td>Ganhos - Procedimentos</td>
                            @foreach($arrTotal as $total)
                                <td>R$ {{ number_format($total['cirurgico'],2,',','.') }}</td>
                            @endforeach
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

<!-- modal upload -->
<div class="modal" id="modalUpload">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span></button>
            <h4 class="modal-title">Enviar Planilha</h4>
            </div>
            <form method="post" action="/dashboard/bymedspay/conciliacao/planilha" enctype="multipart/form-data">
            {{ csrf_field() }}
                <div class="modal-body">
                    <p><input type="file" name="planilha" required=""></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Enviar</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- modal upload -->
@endsection
