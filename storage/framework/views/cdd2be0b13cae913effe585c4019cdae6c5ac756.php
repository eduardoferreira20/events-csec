<!DOCTYPE html>
	<html lang="<?php echo e(app()->getLocale()); ?>">
	<head>
		<meta charset="UTF-8"/>
		<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="<?php echo e(asset('css/app.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('css/lib/bootstrap.min.css')); ?>">
		<link rel='stylesheet' id='smartline-lite-stylesheet-css'  href="<?php echo e(asset('css/smartline/style.css')); ?>"/>
		<link rel='stylesheet' id='smartline-lite-default-fonts-css'  href='//fonts.googleapis.com/css?family=Raleway%3A400%2C700%7CBitter&#038;subset=latin%2Clatin-ext' type='text/css' media='all'/>
		<style type="text/css">
			@media  only screen and (min-width: 60em) {
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
		<?php echo $__env->yieldContent('estilos'); ?>

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
							<a href="<?php echo e(route('index')); ?>">Inicio</a>
						</li>
						<li>
							<a href="<?php echo e(route('events.index')); ?>">Calendário de eventos</a>
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
							<?php echo $__env->yieldContent('titulo-principal'); ?>
						</h2>
						<div class="entry">
							<?php echo $__env->yieldContent('conteudo-principal'); ?>
						</div>	
					</div>				
				</section>
				<section id="sidebar" class="clearfix">
					<?php echo $__env->yieldContent('sidebar'); ?>
					<aside class="widget">
							<h3 class="widgettitle">
								<?php if(auth()->guard('admin-web')->guest()): ?>
								<?php if(auth()->guard('user-web')->guest()): ?>
									<span>Área de acesso</span>
								<?php endif; ?>
								<?php endif; ?>
								<?php if(auth()->guard('admin-web')->check()): ?>
									<span>Painel do Administrador</span>
								<?php endif; ?>
								<?php if(auth()->guard('user-web')->check()): ?>
									<span>Painel do Usuário</span>
								<?php endif; ?>
							</h3>
							<div>
								<?php if(auth()->guard('admin-web')->guest()): ?>
								<?php if(auth()->guard('user-web')->guest()): ?>
									<div class="d-flex">
										<?php echo Form::open(array('route' => 'login','method'=>'POST')); ?>

										<div class="d-flex flex-column mb-4">
											<?php echo Form::label('email','Email:'); ?>

											<?php echo Form::email('email', null, ['class' => 'form-control']); ?>            
										</div>
										<div class="d-flex flex-column mb-4">
											<?php echo Form::label('password','Senha:'); ?>

											<?php echo Form::password('password', ['class' => 'form-control']); ?>   
										</div>
										<div class="d-flex mb-3">
											<div class="mr-3">
												<?php echo Form::checkbox('remember', true); ?>

											</div>
											<?php echo Form::label('remember','Lembre de mim'); ?>

										</div>
										<div class="d-flex">
											<?php echo Form::submit('Entrar',['class'=>'btn btn-primary']); ?>

											<?php if(Route::has('password.request')): ?>
												<a class="btn btn-link" href="<?php echo e(route('password.request')); ?>">
													Esqueci minha senha
												</a>
											<?php endif; ?>
										</div>
										<?php echo Form::close(); ?>

									</div>
									<div class="d-flex mt-3 mb-0">
										<a class="btn btn-link" href="<?php echo e(route('register')); ?>">
											Não possui conta? Crie aqui!
										</a>
									</div>
								<?php endif; ?>
								<?php endif; ?>
								<?php if(auth()->guard('admin-web')->check()): ?>
									<?php echo Form::open(array('route' => 'logout','method'=>'POST')); ?>

									<?php echo Form::submit('Sair',['class'=>'btn btn-primary']); ?>

									<?php echo Form::close(); ?>  
								<?php endif; ?>
								<?php if(auth()->guard('user-web')->check()): ?>
									<div class="d-flex">
										<p>
											Olá,
										</p> 
										<p class="h2">
											<?php echo e(Auth::guard('user-web')->user()->name); ?>

										</p>
									</div>
									<div class="d-flex">
										<?php echo link_to_route('user.index', $title = "Informações da conta", $parameters = [Auth::guard('user-web')->user()->id], $attributes = ['class'=>'btn btn-primary']); ?>

									</div>
									<div class="d-flex mt-2">
										<?php echo Form::open(array('route' => 'logout','method'=>'POST')); ?>

										<?php echo Form::submit('Sair',['class'=>'btn btn-primary']); ?>

										<?php echo Form::close(); ?>

									</div> 
								<?php endif; ?>
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

	<script src="<?php echo e(asset('js/lib/jquery-3.3.1.js')); ?>"></script>
	<script src="<?php echo e(asset('js/lib/bootstrap.min.js')); ?>"></script> 
	<?php echo $__env->yieldContent('script'); ?>

</html>	