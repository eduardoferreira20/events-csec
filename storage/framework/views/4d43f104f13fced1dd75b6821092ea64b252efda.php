<?php $__env->startSection('titulo-principal'); ?>
Eventos disponíveis
<?php $__env->stopSection(); ?>

<?php $__env->startSection('conteudo-principal'); ?>
<style type="text/css">
@import  url("http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,400italic");
@import  url("//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.css");
body {
	padding: 60px 0px;
	background-color: rgb(220, 220, 220);
}

.event-list {
	list-style: none;
	font-family: 'Lato', sans-serif;
	margin: 0px;
	padding: 0px;
}
.event-list > li {
	background-color: rgb(255, 255, 255);
	box-shadow: 0px 0px 5px rgb(51, 51, 51);
	box-shadow: 0px 0px 5px rgba(51, 51, 51, 0.7);
	padding: 0px;
	margin: 0px 0px 20px;
}
.event-list > li > time {
	display: inline-block;
	width: 100%;
	color: rgb(255, 255, 255);
	background-color: rgb(197, 44, 102);
	padding: 5px;
	text-align: center;
	text-transform: uppercase;
}
.event-list > li:nth-child(even) > time {
	background-color: rgb(165, 82, 167);
}
.event-list > li > time > span {
	display: none;
}
.event-list > li > time > .day {
	display: block;
	font-size: 56pt;
	font-weight: 100;
	line-height: 1;
}
.event-list > li time > .month {
	display: block;
	font-size: 24pt;
	font-weight: 900;
	line-height: 1;
}
.event-list > li > img {
	width: 100%;
}
.event-list > li > .info {
	padding-top: 5px;
	text-align: center;
}
.event-list > li > .info > .title {
	font-size: 17pt;
	font-weight: 700;
	margin: 0px;
}
.event-list > li > .info > .desc {
	font-size: 13pt;
	font-weight: 300;
	margin: 0px;
}
.event-list > li > .info > ul,
.event-list > li > .social > ul {
	display: table;
	list-style: none;
	margin: 10px 0px 0px;
	padding: 0px;
	width: 100%;
	text-align: center;
}
.event-list > li > .social > ul {
	margin: 0px;
}
.event-list > li > .info > ul > li,
.event-list > li > .social > ul > li {
	display: table-cell;
	cursor: pointer;
	color: rgb(30, 30, 30);
	font-size: 11pt;
	font-weight: 300;
	padding: 3px 0px;
}
.event-list > li > .info > ul > li > a {
	display: block;
	width: 100%;
	color: rgb(30, 30, 30);
	text-decoration: none;
} 
.event-list > li > .social > ul > li {    
	padding: 0px;
}
.event-list > li > .social > ul > li > a {
	padding: 3px 0px;
} 
.event-list > li > .info > ul > li:hover,
.event-list > li > .social > ul > li:hover {
	color: rgb(30, 30, 30);
	background-color: rgb(200, 200, 200);
}
.facebook a,
.twitter a,
.google-plus a {
	display: block;
	width: 100%;
	color: rgb(75, 110, 168) !important;
}
.twitter a {
	color: rgb(79, 213, 248) !important;
}
.google-plus a {
	color: rgb(221, 75, 57) !important;
}
.facebook:hover a {
	color: rgb(255, 255, 255) !important;
	background-color: rgb(75, 110, 168) !important;
}
.twitter:hover a {
	color: rgb(255, 255, 255) !important;
	background-color: rgb(79, 213, 248) !important;
}
.google-plus:hover a {
	color: rgb(255, 255, 255) !important;
	background-color: rgb(221, 75, 57) !important;
}

@media (min-width: 768px) {
	.event-list > li {
		position: relative;
		display: block;
		width: 100%;
		height: 120px;
		padding: 0px;
	}
	.event-list > li > time,
	.event-list > li > img  {
		display: inline-block;
	}
	.event-list > li > time,
	.event-list > li > img {
		width: 120px;
		float: left;
	}
	.event-list > li > .info {
		background-color: rgb(245, 245, 245);
		overflow: auto;
	}
	.event-list > li > time,
	.event-list > li > img {
		width: 120px;
		height: 120px;
		padding: 0px;
		margin: 0px;
	}
	.event-list > li > .info {
		position: relative;
		height: 120px;
		text-align: left;
		padding-right: 40px;
	}	
	.event-list > li > .info > .title, 
	.event-list > li > .info > .desc {
		padding: 0px 10px;
	}
	.event-list > li > .info > ul {
		position: absolute;
		left: 0px;
		bottom: 0px;
	}
	.event-list > li > .social {
		position: absolute;
		top: 0px;
		right: 0px;
		display: block;
		width: 40px;
	}
	.event-list > li > .social > ul {
		border-left: 1px solid rgb(230, 230, 230);
	}
	.event-list > li > .social > ul > li {			
		display: block;
		padding: 0px;
	}
	.event-list > li > .social > ul > li > a {
		display: block;
		width: 40px;
		padding: 10px 0px 9px;
	}
</style>
<!-- <div>
<table style="float: left; font-style: 'Montserrat;'" class="table table-bordered">
	<thead>
		<tr>
			<th>Evento</th>
			<th>Data - Hora</th>
			<th>Local</th>
			<th>Cidade</th>
			<th>Valor</th>
			<?php if(auth()->guard('admin-web')->check()): ?>
			<th>Ação</th>
			<?php endif; ?>
		</tr>
	</thead>
	<tbody>	
		<?php $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $titulo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<tr>
			<td><a class="btn btn-link" href="<?php echo e(route('events.show',$titulo->id)); ?>"><?php echo e($titulo->title); ?></a></td>
			<td><?php echo e(date('d/m - H:m', strtotime($titulo->start_date))); ?></td>
			<td><?php echo e($titulo->local); ?></td>
			<td><?php echo e($titulo->cidade); ?></td>
			<?php if($titulo['valor'] != 0): ?>
			<td>R$ <?php echo e($titulo->valor); ?></td>
			<?php else: ?>
			<td>grátis</td>
			<?php endif; ?>
			<?php if(auth()->guard('admin-web')->check()): ?>
			<td>
				<a class="btn btn-danger" href="javascript:(confirm('Deletar esse vento?') ? window.location.href='<?php echo e(route('events.deletar', $titulo->id)); ?>' : false)">Deletar</a>
				<a class="btn btn-info" href="<?php echo e(route('events.edit',$titulo->id)); ?>">Editar</a>
			</td>
			<?php endif; ?>
		</tr>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	</tbody>
</table>
</div> -->
<br>
<br>
<div id="carouselExampleControls" class="carousel slide" data-ride="carousel" style=" overflow: auto !important;">
	<div class="carousel-inner">
		<div class="carousel-item active">
			<div class="container">
				<div class="row">
					<?php $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $titulo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<?php if(date('d-m', strtotime($titulo->end_date)) > date('d-m',strtotime($hora))): ?>
					<div class="col-xs-12 col-sm-offset-2 col-sm-8" style="margin-left: 50px !important;">
						<ul class="event-list" style="">
							<li>
								<time style="background-color: red !important;">
									<span class="day"><?php echo e(date('d', strtotime($titulo->start_date))); ?></span>
									<?php if(date('F', strtotime($titulo->start_date)) == 'January' ): ?>
									<span class="month">Jan</span>
									<?php elseif(date('F', strtotime($titulo->start_date)) == 'February' ): ?>
									<span class="month">Fev</span>
									<?php elseif(date('F', strtotime($titulo->start_date)) == 'March'): ?>
									<span class="month">Mar</span>
									<?php elseif(date('F', strtotime($titulo->start_date)) == 'April' ): ?>
									<span class="month">Abril</span>
									<?php elseif(date('F', strtotime($titulo->start_date)) == 'May' ): ?>
									<span class="month">Maio</span>
									<?php elseif(date('F', strtotime($titulo->start_date)) == 'June' ): ?>
									<span class="month">Jun</span>
									<?php elseif(date('F', strtotime($titulo->start_date)) == 'July' ): ?>
									<span class="month">Jul</span>
									<?php elseif(date('F', strtotime($titulo->start_date)) == 'August' ): ?>
									<span class="month">Ago</span>
									<?php elseif(date('F', strtotime($titulo->start_date)) == 'September' ): ?>
									<span class="month">Set</span>
									<?php elseif(date('F', strtotime($titulo->start_date)) == 'October' ): ?>
									<span class="month">Out</span>
									<?php elseif(date('F', strtotime($titulo->start_date)) == 'November' ): ?>
									<span class="month">Nov</span>
									<?php elseif(date('F', strtotime($titulo->start_date)) == 'December' ): ?>
									<span class="month">Dez</span>
									<?php endif; ?>
								</time>
								<!-- <img alt="Independence Day" src="https://farm4.staticflickr.com/3100/2693171833_3545fb852c_q.jpg" /> -->
								<div class="info">
									<h2 class="title"><?php echo e($titulo->title); ?></h2>
									<p class="desc">Cidade: <?php echo e($titulo->cidade); ?></p>
									<?php if($titulo->valor != 0): ?>
									<p class="desc">Valor: R$<?php echo e($titulo->valor); ?></p>
									<?php else: ?>
									<p class="desc">Valor: Grátis</p>
									<?php endif; ?>
									<p class="desc">Hora: <?php echo e(date('H:m', strtotime($titulo->start_date))); ?></p>
									<p></p>
								</div>
								<div class="social" style="margin-right: 10% !important; margin-top: 4.5% !important;">
									<tbody>
										<tr>
											<td>
												<?php if(auth()->guard('admin-web')->check()): ?>
												<a class="btn btn-danger" href="javascript:(confirm('Deletar esse vento?') ? window.location.href='<?php echo e(route('events.deletar', $titulo->id)); ?>' : false)">Deletar</a>
												<?php endif; ?>
												<a class="btn btn-info" href="<?php echo e(route('events.edit',$titulo->id)); ?>" style="">Visitar</a>
											</td>
										</tr>
									</tbody>
								</div>
							</li>
						</ul>
					</div>
					<?php else: ?>
					<?php endif; ?>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.padrao', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>