<!DOCTYPE html>
	<html lang="{{ app()->getLocale() }}">
	<head>
		<meta charset="UTF-8"/>
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('css/lib/bootstrap.min.css') }}">
		<link rel='stylesheet' id='smartline-lite-stylesheet-css'  href="{{ asset('css/smartline/style.css') }}"/>
		<link rel='stylesheet' id='smartline-lite-default-fonts-css'  href='//fonts.googleapis.com/css?family=Raleway%3A400%2C700%7CBitter&#038;subset=latin%2Clatin-ext' type='text/css' media='all'/>
		<style type="text/css">
			@media only screen and (min-width: 60em) {
				#content {
					float: right;
				}
				#sidebar {
					margin-left: 0;
					margin-right: 70%;
					background: -moz-linear-gradient(left, #f3f3f3 0%, #e6e6e6 100%);
					background: -webkit-gradient(linear, left top, right top, color-stop(0%,#f3f3f3), color-stop(100%,#e6e6e6));
					background: -webkit-linear-gradient(left, #f3f3f3 0%,#e6e6e6 100%);
					background: -o-linear-gradient(left, #f3f3f3 0%,#e6e6e6 100%);
					background: -ms-linear-gradient(left, #f3f3f3 0%,#e6e6e6 100%);
					background: linear-gradient(to right, #f3f3f3 0%,#e6e6e6 100%);
				}

			}

			body.custom-background { 
				background-color: #ffffff; 
			}
		</style>
		@yield('estilos')

		<title>CSEC | Portal de eventos</title>
	</head>
	
	<body class="custom-background">
		<div id="wrapper">
			<div id="header-wrap">		
				<header id="header" class="clearfix">
					<div id="custom-header">
						<img src="http://csec.poli.br/wp-content/uploads/2018/02/csec_banner.png" />
					</div>
					<br>
					<div id="logo">
						<a href="http://csec.poli.br/">
							<h1 class="site-title">CSEC</h1>
						</a>
						<h2 class="site-description">Portal de eventos</h2>
					</div>
				</header>
			</div>	
			<div id="navi-wrap">
				<nav id="mainnav" class="clearfix">
					<ul id="mainnav-menu">
						<li>
							<a href="{{ route('index') }}">Inicio</a>
						</li>
						<li>
							<a href="{{ route('events.index') }}">Calendário de eventos</a>
						</li>
						<li>
							<a href="https://docs.google.com/forms/d/e/1FAIpQLSdXQXf84vvnE5KpUWu86qzbGVjSNx0L5nwtMESSPSZXB4OFDQ/viewform?c=0&w=1&includes_info_params=true">Solicitar registro de evento</a>
						</li>
						<li>
							<a href="http://csec.poli.br/institucional/contatos/">Contato</a>
						</li>
						<li>
							<a href="http://csec.poli.br/">Voltar para o site do CSEC</a>
						</li>
					</ul>		
				</nav>
			</div>			
			<div id="wrap">
				<section id="content">
					<div id="post" class="page type-page">	
						<h2 class="page-title">
							@yield('titulo-principal')
						</h2>
						<div class="entry">
							@yield('conteudo-principal')
						</div>	
					</div>				
				</section>
				<section id="sidebar" class="clearfix">
					@yield('sidebar')
					<aside class="widget">
							<h3 class="widgettitle">
								@guest('admin-web')
								@guest('user-web')
									<span>Área de acesso</span>
								@endguest
								@endguest
								@auth('admin-web')
									<span>Painel do Administrador</span>
								@endauth
								@auth('user-web')
									<span>Painel do Usuário</span>
								@endauth
							</h3>
							<div>
								@guest('admin-web')
								@guest('user-web')
									<div class="d-flex">
										{!! Form::open(array('route' => 'login','method'=>'POST')) !!}
										<div class="d-flex flex-column mb-4">
											{!! Form::label('email','Email:') !!}
											{!! Form::email('email', null, ['class' => 'form-control']) !!}            
										</div>
										<div class="d-flex flex-column mb-4">
											{!! Form::label('password','Senha:') !!}
											{!! Form::password('password', ['class' => 'form-control']) !!}   
										</div>
										<div class="d-flex mb-3">
											<div class="mr-3">
												{!! Form::checkbox('remember', true) !!}
											</div>
											{!! Form::label('remember','Lembre de mim') !!}
										</div>
										<div class="d-flex">
											{!! Form::submit('Entrar',['class'=>'btn btn-primary']) !!}
											@if (Route::has('password.request'))
												<a class="btn btn-link" href="{{ route('password.request') }}">
													Esqueci minha senha
												</a>
											@endif
										</div>
										{!! Form::close() !!}
									</div>
									<div class="d-flex mt-3 mb-0">
										<a class="btn btn-link" href="{{ route('register') }}">
											Não possui conta? Crie aqui!
										</a>
									</div>
								@endguest
								@endguest
								@auth('admin-web')
									{!! Form::open(array('route' => 'logout','method'=>'POST')) !!}
									{!! Form::submit('Sair',['class'=>'btn btn-primary']) !!}
									{!! Form::close() !!}  
								@endauth
								@auth('user-web')
									<div class="d-flex">
										<p>
											Olá,
										</p> 
										<p class="h2">
											{{ Auth::guard('user-web')->user()->name }}
										</p>
									</div>
									<div class="d-flex">
										{!! link_to_route('user.index', $title = "Informações da conta", $parameters = [Auth::guard('user-web')->user()->id], $attributes = ['class'=>'btn btn-primary']) !!}
									</div>
									<div class="d-flex mt-2">
										{!! Form::open(array('route' => 'logout','method'=>'POST')) !!}
										{!! Form::submit('Sair',['class'=>'btn btn-primary']) !!}
										{!! Form::close() !!}
									</div> 
								@endauth
							</div>
						</aside>
				</section>	
			</div>
			<footer id="footer" class="clearfix">		
				<div>
					Escola Politécnica de Pernambuco<br>
					Coordenação Setorial de Extensão e Cultura (CSEC)<br>
					Rua Benfica, 455 - Madalena - 50.740-410<br>
					Recife/PE<br>
					Fone/Fax: (81) 3184-7506 / (81) 3184.7506<br>
					E-mail: dex@poli.br<br>
					Site: www.csec.poli.br<br>
					<br>	

					<div id="credit-link">
						Powered by <a href="http://wordpress.org" title="WordPress">WordPress</a> and <a href="http://themezee.com/themes/smartline/" title="Smartline WordPress Theme">Smartline</a>.	
					</div>
				</div>
			</footer>
		</div>
	</body>

	<script src="{{ asset('js/lib/jquery-3.3.1.js') }}"></script>
	<script src="{{ asset('js/lib/bootstrap.min.js') }}"></script> 
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	@yield('script')

</html>	