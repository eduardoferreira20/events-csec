<?php $__env->startSection('style'); ?>
<?php if($field == "apresentation" || $field == "palestrantes" || $field == "add_palestrante"): ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/simeditor/simditor.css')); ?>" />
<?php elseif($field == "general"): ?>
<link rel="stylesheet" href="<?php echo e(asset('css/clockpicker/bootstrap-clockpicker.min.css')); ?>"/>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('titulo-principal'); ?>
<?php if($field == "apresentation"): ?>
Editar descrição
<?php elseif($field == "general"): ?>
Editar informações
<?php elseif($field == "palestrantes"): ?>
Editar informações de palestrante
<?php elseif($field == "oficinas"): ?>
Editar informações do Minicurso
<?php elseif($field == "add_palestrante"): ?>
Adicionar palestrante
<?php elseif($field == "adicionar_palestras"): ?>
Adicionar palestra
<?php elseif($field == "palestras"): ?>
Editar informações da palestra
<?php elseif($field == "add_minicurso"): ?>
Adicionar minicurso
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('conteudo-principal'); ?>
<?php if($field == "apresentation"): ?>
<div class="d-flex my-4">
  <?php echo Form::open(array('route' => ['events.edit', $id],'method'=>'POST')); ?>

  <?php echo Form::textarea('input', $old->apresentation, ['id' => 'editor']); ?>

  <div class="mt-4">
    <a href="<?php echo e(route('events.show', ['id' => $id])); ?>" class="btn btn-primary mr-3">
      Voltar
    </a>
    <?php echo Form::hidden('info', 'editar_apresentacao'); ?>

    <?php echo Form::submit('Salvar', ['class'=>'btn btn-primary']); ?>

  </div>
  <?php echo Form::close(); ?>

</div>
<?php elseif($field == "general"): ?>
<?php echo Form::open(array('route' => ['events.edit', $id],'method'=>'POST')); ?>

<div class="d-flex flex-column panel-body">    
  <div class="d-flex flex-column mb-4">
    <?php echo Form::label('title','Nome do evento:'); ?>

    <?php echo Form::text('title', $old['title'], ['class' => 'form-control']); ?>

  </div>
    <div class="d-flex flex-column mb-4">
    <?php echo Form::label('link','Link do evento:'); ?>

    <?php echo Form::text('link', $old['link'], ['class' => 'form-control','placeholder' => 'Caso o evento tenha um site']); ?>

  </div>

  <div class="d-flex flex-column mb-4">
    <?php echo Form::label('local','Local do evento:'); ?>

    <?php echo Form::text('local', $old['local'], ['class' => 'form-control']); ?>

  </div>
  <div class="d-flex flex-column mb-4">
    <?php echo Form::label('rua','Rua do evento:'); ?>

    <?php echo Form::text('rua', $old['rua'], ['class' => 'form-control']); ?>

  </div>
  <div class="d-flex flex-column mb-4">
    <?php echo Form::label('cidade','Bairro do evento:'); ?>

    <?php echo Form::text('cidade', $old['cidade'], ['class' => 'form-control']); ?>

  </div>
  <div class="d-flex flex-column mb-4">
    <?php echo Form::label('valor','Valor do evento:'); ?>

    <?php echo Form::text('valor', $old['valor'], ['class' => 'form-control']); ?>

  </div>
  <div class="d-flex flex-column mb-4">
    <?php echo Form::label('hora_comple','Horas ofertadas:'); ?>

    <?php echo Form::text('hora_comple', $old['hora_comple'], ['class' => 'form-control']); ?>

  </div>
  <div class="d-flex flex-fill mb-4">
    <div class="d-flex flex-column mr-4">
      <?php echo Form::label('start_date','Data de início:'); ?>

      <?php echo Form::date('start_date', $old['start_date'], ['class' => 'form-control']); ?>

    </div>
    <div class="d-flex flex-column">
      <?php echo Form::label('end_date','Data de término:'); ?>

      <?php echo Form::date('end_date', $old['end_date'], ['class' => 'form-control']); ?>

    </div>
  </div>
  <div class="d-flex flex-fill mb-4">
    <div class="d-flex flex-column mr-4">
      <?php echo Form::label('all_day','Dia todo?'); ?>

      <?php echo Form::checkbox('all_day', $old['all_day'], false); ?>

    </div>
    <div class="d-flex flex-column mr-4 clockpicker">
      <?php echo Form::label('start_time','Horário inicial:'); ?>

      <?php echo Form::text('start_time', $old['start_time'], ['class' => 'form-control', 'placeholder' => '--:--']); ?>

    </div>

    <div class="d-flex flex-column clockpicker">
      <?php echo Form::label('end_time','Horário final:'); ?>

      <?php echo Form::text('end_time', $old['end_time'], ['class' => 'form-control', 'placeholder' => '--:--']); ?>

    </div>
  </div>
  <div class="mt-4">
    <a href="<?php echo e(route('events.show', ['id' => $id])); ?>" class="btn btn-primary mr-3">
      Voltar
    </a>
    <?php echo Form::hidden('info', 'editar_informacoes'); ?>

    <?php echo Form::submit('Salvar',['class'=>'btn btn-primary']); ?>

  </div>
  <?php echo Form::close(); ?>

</div>
<?php elseif($field == "palestrantes"): ?>
<div class="d-flex my-4">
  <?php echo Form::open(array('route' => ['events.edit', $id],'method'=>'POST', 'files' => true)); ?>

  <?php echo Form::label('nome','Nome completo do palestrante:'); ?>

  <?php echo Form::text('nome', $old->nome, ['class' => 'form-control mb-4']); ?>

  <?php echo Form::label('instituicao','Instituição responsável:'); ?>

  <?php echo Form::text('instituicao', $old->instituicao, ['class' => 'form-control mb-4']); ?>

  <?php echo Form::label('cargo','Profissão:'); ?>

  <?php echo Form::text('cargo', $old->cargo, ['class' => 'form-control mb-4']); ?>

  <?php echo Form::label('url','Endereço web da Instituição:'); ?>

  <?php echo Form::text('url', $old->url, ['class' => 'form-control mb-4']); ?>

 
  <div class="d-flex flex-column">
    <?php echo Form::label('input','Descrição do palestrante:'); ?>

    <?php echo Form::textarea('input', $old->apresentacao, ['id' => 'editor']); ?>   
  </div>
  <div class="mt-4">
    <a href="<?php echo e(route('events.show', ['id' => $id])); ?>" class="btn btn-primary mr-3">
      Voltar
    </a>
    <?php echo Form::hidden('id', $old->id); ?>

    <?php echo Form::hidden('info', 'editar_palestrante'); ?>

    <?php echo Form::submit('Salvar', ['class'=>'btn btn-primary']); ?>

  </div>
  <?php echo Form::close(); ?>

</div>
<?php elseif($field == "oficinas"): ?>
<div class="d-flex my-4">
  <?php echo Form::open(array('route' => ['events.edit', $id],'method'=>'POST')); ?>

  <?php echo Form::label('titulo','Título:'); ?>

  <?php echo Form::text('titulo', null, ['class' => 'form-control mb-4']); ?>

  <?php echo Form::label('palestrante1','Palestrante:'); ?>

  <?php echo Form::text('palestrante1', null, ['class' => 'form-control mb-4']); ?>

  <?php echo Form::label('palestrante2','Palestrante:'); ?>

  <?php echo Form::text('palestrante2', null, ['class' => 'form-control mb-4']); ?>

  <?php echo Form::label('palestrante3','Palestrante:'); ?>

  <?php echo Form::text('palestrante3', null, ['class' => 'form-control mb-4']); ?>

  <?php echo Form::label('palestrante4','Palestrante:'); ?>

  <?php echo Form::text('palestrante4', null, ['class' => 'form-control mb-4']); ?>

  <div class="d-flex flex-fill mb-4">
  <div class="d-flex flex-column mb-4">
    <?php echo Form::label('start_date','Data:'); ?>

    <?php echo Form::date('start_date', null, ['class' => 'form-control']); ?>

  </div>
</div>
  <div class="d-flex flex-fill mb-4">
  <div class="d-flex flex-column mr-4 clockpicker">
    <?php echo Form::label('start_time','Horário inicial:'); ?>

    <?php echo Form::text('start_time', null, ['class' => 'form-control', 'placeholder' => '--:--']); ?>

  </div>
  <div class="d-flex flex-column mr-4 clockpicker">
    <?php echo Form::label('end_time','Horário final:'); ?>

    <?php echo Form::text('end_time', null, ['class' => 'form-control', 'placeholder' => '--:--']); ?>

  </div>
</div>
  <div class="d-flex flex-column mb-4">
    <?php echo Form::label('hora_comple','Horas ofertadas:'); ?>

    <?php echo Form::text('hora_comple', null, ['class' => 'form-control']); ?>

  </div>
  <div class="d-flex flex-column mb-4">
    <?php echo Form::label('local','Local do curso:'); ?>

    <?php echo Form::text('local', $old->local, ['class' => 'form-control']); ?>

    <?php echo Form::label('valor','Valor do curso:'); ?>

    <?php echo Form::text('valor', $old->valor, ['class' => 'form-control']); ?>

  </div>
  <div class="d-flex flex-column">
    <?php echo Form::label('input','Descrição do palestrante:'); ?>

    <?php echo Form::textarea('input', $old->apresentation, ['id' => 'editor']); ?>   
  </div>
  <div class="mt-4">
    <a href="<?php echo e(route('events.show', ['id' => $id])); ?>" class="btn btn-primary mr-3">
      Voltar
    </a>
    <?php echo Form::hidden('id', $old->id); ?>

    <?php echo Form::hidden('info', 'editar_oficinas'); ?>

    <?php echo Form::submit('Salvar', ['class'=>'btn btn-primary']); ?>

  </div>
  <?php echo Form::close(); ?>

</div>
<?php elseif($field == "add_palestrante"): ?>
<div class="d-flex my-4">
  <?php echo Form::open(array('route' => ['events.edit', $id],'method'=>'POST')); ?>

  <?php echo Form::label('nome','Nome completo do palestrante:'); ?>

  <?php echo Form::text('nome', null, ['class' => 'form-control mb-4']); ?>

  <?php echo Form::label('instituicao','Instituição responsável:'); ?>

  <?php echo Form::text('instituicao', null, ['class' => 'form-control mb-4']); ?>

  <?php echo Form::label('url','Endereço web da Instituição:'); ?>

  <?php echo Form::text('url', null, ['class' => 'form-control mb-4']); ?>

  <div class="d-flex flex-column">
    <?php echo Form::label('input','Descrição do palestrante:'); ?>

    <?php echo Form::textarea('input', null, ['id' => 'editor']); ?> 
  </div> 
  <div class="mt-4">
    <a href="<?php echo e(route('events.show', ['id' => $id])); ?>" class="btn btn-primary mr-3">
      Voltar
    </a>
    <?php echo Form::hidden('info', 'adicionar_palestrante'); ?>

    <?php echo Form::submit('Salvar', ['class'=>'btn btn-primary']); ?>

  </div>
  <?php echo Form::close(); ?>

</div>
<?php elseif($field == "add_minicurso"): ?>
<div class="d-flex my-4">
  <?php echo Form::open(array('route' => ['events.edit', $id],'method'=>'POST')); ?>

  <?php echo Form::label('titulo','Título:'); ?>

  <?php echo Form::text('titulo', null, ['class' => 'form-control mb-4']); ?>

  <?php echo Form::label('palestrante1','Palestrante:'); ?>

  <?php echo Form::text('palestrante1', null, ['class' => 'form-control mb-4']); ?>

  <?php echo Form::label('palestrante2','Palestrante:'); ?>

  <?php echo Form::text('palestrante2', null, ['class' => 'form-control mb-4']); ?>

  <?php echo Form::label('palestrante3','Palestrante:'); ?>

  <?php echo Form::text('palestrante3', null, ['class' => 'form-control mb-4']); ?>

  <?php echo Form::label('palestrante4','Palestrante:'); ?>

  <?php echo Form::text('palestrante4', null, ['class' => 'form-control mb-4']); ?>

  <div class="d-flex flex-fill mb-4">
  <div class="d-flex flex-column mb-4">
    <?php echo Form::label('start_date','Data:'); ?>

    <?php echo Form::date('start_date', null, ['class' => 'form-control']); ?>

  </div>
</div>
  <div class="d-flex flex-fill mb-4">
  <div class="d-flex flex-column mr-4 clockpicker">
    <?php echo Form::label('start_time','Horário inicial:'); ?>

    <?php echo Form::text('start_time', null, ['class' => 'form-control', 'placeholder' => '--:--']); ?>

  </div>
  <div class="d-flex flex-column mr-4 clockpicker">
    <?php echo Form::label('end_time','Horário final:'); ?>

    <?php echo Form::text('end_time', null, ['class' => 'form-control', 'placeholder' => '--:--']); ?>

  </div>
</div>
  <div class="d-flex flex-column mb-4">
    <?php echo Form::label('hora_comple','Horas ofertadas:'); ?>

    <?php echo Form::text('hora_comple', null, ['class' => 'form-control']); ?>

  </div>
  <div class="d-flex flex-column mb-4">
    <?php echo Form::label('local','Local do curso:'); ?>

    <?php echo Form::text('local', null, ['class' => 'form-control']); ?>

    <?php echo Form::label('valor','Valor do curso:'); ?>

    <?php echo Form::text('valor', null, ['class' => 'form-control']); ?>

  </div>
  <div class="d-flex flex-column">
    <?php echo Form::label('input','Descrição do minicurso:'); ?>

    <?php echo Form::textarea('input', null, ['id' => 'editor']); ?> 
  </div> 
  <div class="mt-4">
    <a href="<?php echo e(route('events.show', ['id' => $id])); ?>" class="btn btn-primary mr-3">
      Voltar
    </a>
    <?php echo Form::hidden('info', 'adicionar_minicurso'); ?>

    <?php echo Form::submit('Salvar', ['class'=>'btn btn-primary']); ?>

  </div>
  <?php echo Form::close(); ?>

</div>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<?php if($field == "general"): ?>
<script src="<?php echo e(asset('js/clockpicker/bootstrap-clockpicker.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/lib/moment.min.js')); ?>"></script>
<script>
  $('.clockpicker').clockpicker({
    placement: 'bottom',
    default: 'now',
    align: 'left',
    autoclose: true,
  });
</script>
<script>
  document.getElementById('all_day').onchange = function() {
    document.getElementById('start_time').disabled = this.checked;
    document.getElementById('end_time').disabled = this.checked;
  };
</script>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.padrao', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>