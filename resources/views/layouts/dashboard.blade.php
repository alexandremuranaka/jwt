<!doctype html>
<html lang="{{ config('app.locale') }}">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

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
			<div class="item"><p><a href="/dashboard/bymedspay/hospital"><i class="fa fa-file-o"></i>Selecionar Hospital</a></p></div>
			<div class="item"><p><a href="/dashboard/bymedspay/my-register"><i class="fa fa-file-o"></i>Meus Atendimentos</a></p></div>
			<div class="item"><p><a href="/dashboard/bymedspay/register"><i class="fa fa-file-o"></i>Registrar Atendimento</a></p></div>
			<div class="item"><p><a href="/dashboard/bymedspay/register-all"><i class="fa fa-file-o"></i>Todos Atendimentos</a></p></div>
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

<div id="wrapper" class="active">
  <div class="container-fluid">
  	<div class="row">
      @yield('content')
    </div>
  </div>
</div>
</body>
</html>
