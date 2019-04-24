<?php $__env->startSection('titulo-principal'); ?>
Eventos disponíveis
<?php $__env->stopSection(); ?>

<?php $__env->startSection('conteudo-principal'); ?>
<div>
<table style="float: left; font-style: 'Montserrat;'" class="table table-bordered">
	<thead>
		<tr>
			<th>Evento</th>
			<th>Data - Hora</th>
			<th>Local</th>
			<th>Cidade</th>
			<th>Valor</th>
			<th>Inicio</th>
			<?php if(auth()->guard('admin-web')->check()): ?>
			<th>Ação</th>
			<?php endif; ?>
		</tr>
	</thead>
	<tbody>	
		<?php $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $titulo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<tr>
			<td><?php echo e($titulo->title); ?></td>
			<td><?php echo e($titulo->start_date); ?></td>
			<td><?php echo e($titulo->local); ?></td>
			<td><?php echo e($titulo->cidade); ?></td>
			<?php if($titulo['valor'] != 0): ?>
			<td>R$ <?php echo e($titulo->valor); ?></td>
			<?php else: ?>
			<td>grátis</td>
			<?php endif; ?>
			<td><?php echo e($titulo->inicio_inscricoes); ?></td>
			<?php if(auth()->guard('admin-web')->check()): ?>
			<td>
				<a class="btn btn-danger" href="javascript:(confirm('Deletar esse vento?') ? window.location.href='<?php echo e(route('events.deletar', $titulo->id)); ?>' : false)">Deletar</a>
				<a class="btn btn-default" href="<?php echo e(route('events.edit',$titulo->id)); ?>">Editar</a>
			</td>
			<?php endif; ?>
		</tr>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	</tbody>
</table>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.padrao', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>