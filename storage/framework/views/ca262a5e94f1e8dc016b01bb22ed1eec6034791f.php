<?php $__env->startSection('estilos'); ?>
<?php if($field == "apresentation"): ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/simeditor/simditor.css')); ?>" />
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('titulo-principal'); ?>
<?php if($field == "apresentation"): ?>
Editar apresentação
<?php elseif($field == "enderecos"): ?>
Editar dados complementares
<?php elseif($field == "users"): ?>
Editar dados
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('conteudo-principal'); ?>
<?php if($field == "apresentation"): ?>
<div class="d-flex my-4">
<?php echo Form::open(array('route' => ['user.edit', $id],'method'=>'POST')); ?>

<?php echo Form::textarea('input', $old, ['id' => 'editor']); ?>

<div class="mt-4">
<a href="<?php echo e(route('user.index', ['id' => $id])); ?>" class="btn btn-primary mr-3">Voltar</a>
<?php echo Form::hidden('info', 'add_apresentation'); ?>

<?php echo Form::submit('Salvar', ['class'=>'btn btn-primary']); ?>

</div>
<?php echo Form::close(); ?>

</div>

<?php elseif($field == "enderecos"): ?>
  <div class="d-flex flex-column">
    <?php echo Form::open(array('route' => ['user.edit', $id],'method'=>'POST')); ?>

        <?php echo Form::label('cep','CEP: '); ?>

        <?php echo Form::text('cep', $old->cep, ['class' => 'form-control', 'style' => 'width:100px']); ?>


        <?php echo Form::label('logradouro','Logradouro: '); ?>

        <?php echo Form::text('logradouro', $old->logradouro, ['class' => 'form-control', 'style' => 'width:500px']); ?>


        <?php echo Form::label('numero','Numero: '); ?>

        <?php echo Form::text('numero', $old->numero, ['class' => 'form-control', 'style' => 'width:80px']); ?>


        <?php echo Form::label('complemento','Complemento: '); ?>

        <?php echo Form::text('complemento', $old->complemento, ['class' => 'form-control', 'style' => 'width:500px']); ?>


        <?php echo Form::label('bairro','Bairro: '); ?>

        <?php echo Form::text('bairro', $old->bairro, ['class' => 'form-control', 'style' => 'width:200px']); ?>


        <?php echo Form::label('cidade','Cidade: '); ?>

        <?php echo Form::text('cidade', $old->cidade, ['class' => 'form-control', 'style' => 'width:200px']); ?>


        <div class="mt-4">
        <a href="<?php echo e(route('user.index', ['id' => $id])); ?>" class="btn btn-primary mr-3">Voltar</a>

        <?php echo Form::hidden('info', 'add_endereco'); ?>

        <?php echo Form::submit('Salvar', ['class'=>'btn btn-primary']); ?>

        </div>
    <?php echo Form::close(); ?>

  </div>

<?php elseif($field == "users"): ?>
  <div class="d-flex flex-column">
    <?php echo Form::open(array('route' => ['user.edit', $id],'method'=>'POST')); ?>

        <?php echo Form::label('name','Nome Completo: '); ?>

        <?php echo Form::text('name', $old->name, ['class' => 'form-control', 'style' => 'width:500px']); ?>


        <?php echo Form::label('email', 'E-mail: '); ?>

        <?php echo Form::email('email', $old->email, ['class' => 'form-control', 'style' => 'width:300px']); ?>


        <?php echo Form::label('nacionalidade','Nacionalidade: '); ?>

        <?php echo Form::text('nacionalidade', $old->nacionalidade, ['class' => 'form-control', 'style' => 'width:300px']); ?>


        <?php echo Form::label('documento', 'Documento: '); ?>


        <?php echo Form::select('tipo', ['1' => 'CPF', '2' => 'Passaporte'], $old->tipo, ['class' => 'form-control mb-3', 'style' => 'width:150px', 'onChange' => 'yesnoCheck(this)', 'placeholder' => 'Selecione']); ?>


        <?php echo Form::text('documento', $old->documento, ['class' => 'form-control', 'style' => 'width:300px', 'onkeypress' => 'return isNumberKey(event)', 'id' => 'documento']); ?>


        <?php echo Form::label('phone','Telefone: '); ?>

        <?php echo Form::text('phone', $old->phone, ['class' => 'form-control mb-4', 'style' => 'width:150px', 'onkeypress' => 'return isNumberKey(event)', 'placeholder' => '(__) ____-____']); ?>


        <?php echo Form::label('celular','Celular: '); ?>

        <?php echo Form::text('celular', $old->celular, ['class' => 'form-control ', 'style' => 'width:150px','onkeypress' => 'return isNumberKey(event)', 'placeholder' => '(__) _____-____']); ?>


        <div class="mt-4">
        <a href="<?php echo e(route('user.index', ['id' => $id])); ?>" class="btn btn-primary mr-3">Voltar</a>

        <?php echo Form::hidden('info', 'editar_geral'); ?>

        <?php echo Form::submit('Salvar', ['class'=>'btn btn-primary']); ?>

        </div>
    <?php echo Form::close(); ?>

  </div>

<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
 
 <?php if($field == "users"): ?>

<script type="text/javascript">
    function isNumberKey(evt) {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
        return true;
    }
</script>

<script type="text/javascript">
    function yesnoCheck(that) {
        if (that.value == '1') {
            document.getElementById('documento').placeholder = "___.___.___-__";
        }else {
            document.getElementById('documento').placeholder = "";
        }
    }
</script>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.padrao', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>