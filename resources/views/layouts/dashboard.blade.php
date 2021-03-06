<!doctype html>
<html lang="{{ config('app.locale') }}">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>byMeds</title>

<!-- Fonts -->
<link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
<link href="/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="/assets/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="/assets/css/select2.min.css" rel="stylesheet" type="text/css"/>
<link href="/assets/css/app.css" rel="stylesheet" type="text/css"/>

<script defer src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script defer src="/assets/js/bootstrap.min.js"></script>
<script defer src="/assets/js/jquery.mask.min.js"></script>
<script defer src="/assets/js/select2.min.js"></script>

<script defer src="/assets/js/app.js"></script>
</head>
<body>
<section id="header">
	<div class="container-fluid">
		<div class="row">
			<div class="col-xs-5 col-sm-4">
				<a href="/dashboard"><img src="/assets/images/bymeds_logo.png" alt="bymeds logo" /></a>
				<div id="btn_menu" class="active">
					<div class="bar top"></div>
					<div class="bar middle"></div>
					<div class="bar bottom"></div>
				</div>
			</div>
			<div class="col-xs-7 col-sm-8">
				<ul>
					<li>Olá {{ Auth::user()->name }}</li>
					<li>
            {!! Form::open(['url' => '/logout', 'method' => 'post', 'class'=>'form_logout']) !!}
            {!! Form::submit('Sair', ['class' => 'btn_logout']) !!}
            {!! Form::close() !!}
          </li>
				</ul>
			</div>
		</div>
	</div>
</section>

<div id="menu" class="active">
	<div class="item"><p><a href="/dashboard"><i class="fa fa-h-square"></i>Início</a></p></div>
	<div class="item"><p><a href="/dashboard/profile"><i class="fa fa-address-card-o"></i>Cadastro</a></p></div>

	<div class="item father">
		<h3><i class="fa fa-stethoscope"></i>byMeds Pay <i class="fa fa-chevron-right active"></i><i class="fa fa-chevron-down"></i></h3>
		<div class="content">
			<div class="item"><p><a href="/dashboard/bymedspay/hospital"><i class="fa fa-hospital-o"></i>Selecionar Hospital</a></p></div>
			<div class="item father">
				<h3><i class="fa fa-stethoscope"></i>Conciliação<i class="fa fa-chevron-right active"></i><i class="fa fa-chevron-down"></i></h3>
				<div class="content">
					<div class="item"><p><a href="/dashboard/bymedspay/conciliacao"><i class="fa fa-file-o"></i> Conciliação </a></p></div>
					<div class="item"><p><a href="/dashboard/bymedspay/conciliacao/pendentes"><i class="fa fa-file-o"></i> Pendentes </a></p></div>
					<div class="item"><p><a href="/dashboard/bymedspay/conciliacao/pendentes/excel"><i class="fa fa-file-o"></i> Excel </a></p></div>
					<div class="item"><p><a href="/dashboard/bymedspay/conciliacao/nao-identificados"><i class="fa fa-file-o"></i> Não Identificados </a></p></div>
					<div class="item"><p><a href="/dashboard/bymedspay/conciliacao/conciliados"><i class="fa fa-file-o"></i> Conciliados </a></p></div>

				</div>
			</div>
{{--

<div class="item"><p><a href="/dashboard/bymedspay/conciliacao/pendentes/email"><i class="fa fa-file-o"></i> conciliação </a></p></div>
	<div class="item"><p><a href="/dashboard/bymedspay/conciliacao/planilha"><i class="fa fa-file-o"></i> conciliação </a></p></div>
	<div class="item"><p><a href="/dashboard/bymedspay/conciliacao/set-hospital/{id}"><i class="fa fa-file-o"></i> conciliação </a></p></div>
	<div class="item"><p><a href="/dashboard/bymedspay/conciliacao/hospitals"><i class="fa fa-file-o"></i> conciliação </a></p></div>


	<div class="item"><p><a href="/dashboard/bymedspay/conciliacao/nao-identificados/conciliar"><i class="fa fa-file-o"></i> Não Idenficados </a></p></div>

			<div class="item"><p><a href="/dashboard/bymedspay/my-register"><i class="fa fa-address-card-o"></i>Meus Registros</a></p></div>
			<div class="item"><p><a href="/dashboard/bymedspay/register"><i class="fa fa-pencil-square-o"></i>Novo Registro</a></p></div>
			<div class="item"><p><a href="/dashboard/bymedspay/register-all"><i class="fa fa-list"></i>Todos Atendimentos</a></p></div>
			<div class="item"><p><a href="/dashboard/bymedspay/team"><i class="fa fa-users"></i>Minha Equipe</a></p></div>
--}}
		</div>
	</div>


	<div class="item father">
		<h3><i class="fa fa-stethoscope"></i>Casos <i class="fa fa-chevron-right active"></i><i class="fa fa-chevron-down"></i></h3>
		<div class="content">
			<div class="item"><p><a href="/dashboard/abrir"><i class="fa fa-file-o"></i>Abrir</a></p></div>
			<div class="item"><p><a href="/dashboard/pesquisar"><i class="fa fa-search"></i>Pesquisar</a></p></div>
		</div>
	</div>

	<div class="item"><p><a href="/agenda"><i class="fa fa-calendar"></i>Agenda</a></p></div>

	<div class="item father">
		<h3><i class="fa fa-stethoscope"></i>Financeiro <i class="fa fa-chevron-right active"></i><i class="fa fa-chevron-down"></i></h3>
		<div class="content">
			<div class="item"><p><a href="/dashboard/contas-a-pagar"><i class="fa fa-minus"></i>Conta à pagar</a></p></div>
			<div class="item"><p><a href="/dashboard/contas-a-receber"><i class="fa fa-plus"></i>Contas à receber</a></p></div>
			<div class="item"><p><a href="/dashboard/fluxo-de-caixa"><i class="fa fa-balance-scale"></i>Fluxo de Caixa</a></p></div>
			<div class="item"><p><a href="/dashboard/contas-bancarias"><i class="fa fa-bank"></i>Contas Bancárias</a></p></div>
			<div class="item"><p><a href="/dashboard/equipes"><i class="fa fa-users"></i>Equipes</a></p></div>
		</div>
	</div>
	<div class="item father">
		<h3><i class="fa fa-book"></i>Administração <i class="fa fa-chevron-right active"></i><i class="fa fa-chevron-down"></i></h3>
		<div class="content">
			<div class="item"><p><a href="/dashboard/usuarios"><i class="fa fa-user"></i>Usuários</a></p></div>
		</div>
	</div>
</div>
<div id="loading"><h1><i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i></h1></div>

<div id="wrapper" class="active">
  <div class="container-fluid">
  	<div class="row">
			<div class="col-xs-12 col-sm-12">
				@if(Session::has('messageBody'))
				 <div class="alert alert-{{ Session::get('messageType') }} alert-dismissable">
						 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						 <?php echo Session::get('messageBody') ?>
				 </div>
				@endif
			</div>
      @yield('content')
    </div>
  </div>
</div>
</body>
</html>
