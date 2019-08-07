<?php $__env->startSection('conteudo-principal'); ?>
<?php if($info == 'mostrar_edicao'): ?>
<?php echo Form::open(array('route' => ['events.inscricoes', $evento->id],'method'=>'POST')); ?>

<div class="d-flex flex-column">
    <div class="d-flex flex-column my-4">
        <?php echo Form::label('inicio_inscricoes','Início:'); ?>

        <?php echo Form::date('inicio_inscricoes', null, ['class' => 'form-control']); ?>

    </div>
    <div class="d-flex flex-column">
        <?php echo Form::label('fim_inscricoes','Término:'); ?>

        <?php echo Form::date('fim_inscricoes', null, ['class' => 'form-control']); ?>

    </div>
    <div class="d-flex my-4">
        <a href="<?php echo e(route('events.show', ['id' => $evento->id])); ?>" class="btn btn-primary mr-3">Voltar</a>
        <?php echo Form::hidden('info', 'add'); ?>

        <?php echo Form::submit('Registrar',['class'=>'btn btn-primary']); ?>

    </div>
</div>
<?php echo Form::close(); ?>


<?php elseif($info == 'mostrar_inscricao'): ?>
<p>Ol&aacute;!</p>
<p>Ficamos feliz por voc&ecirc; ter se interessado pelo nosso evento.</p>
<p>Informamos da necessidade de realizar um dep&oacute;sito no valor de <strong>R$ <?php echo e($evento->valor); ?> reais</strong> para inscri&ccedil;&atilde;o no evento.</p>
<p>Ap&oacute;s, realizado dep&oacute;sito/transfer&ecirc;ncia, &eacute; necess&aacute;rio enviar o comprovante para n&oacute;s pelo campo abaixo e aguardar a confirma&ccedil;&atilde;o da sua inscri&ccedil;&atilde;o!</p>
<?php echo Form::open(array('route' => ['events.inscricoes', $evento->id],'method' => 'POST', 'files' => true)); ?>

<?php echo Form::label('comprovante','Enviar comprovante:'); ?>

<?php echo Form::file('comprovante', ['class' => 'file-field', 'accept' => 'application/pdf, image/jpeg, image/png, image/jpg']); ?>

<a href="<?php echo e(route('events.show', ['id' => $evento->id])); ?>" class="btn btn-primary mr-3">Voltar</a>
<?php echo Form::hidden('info', 'inscrever'); ?>

<?php echo Form::submit('Enviar',['class'=>'btn btn-primary my-4']); ?>

<?php echo Form::close(); ?>

<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.padrao', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>