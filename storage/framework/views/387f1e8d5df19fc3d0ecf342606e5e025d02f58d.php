<?php $__env->startSection('titulo-principal'); ?>
  <div class="d-flex">
    <div class="d-flex flex-fill">
      <?php echo e($data['title']); ?>

    </div>
    <div class="d-flex align-self-center">
      <a href="<?php echo e(route('events.index')); ?>" class="btn btn-primary">Voltar</a>
    </div>
  </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('conteudo-principal'); ?>
  <div class="d-flex mb-4">
    <div class="d-flex flex-column mr-auto">
      <h4>
        Organizador:
        <a class="btn btn-link" href="<?php echo e(route('user.index', ['id' => $info->id])); ?>">
          <?php echo e($info->name); ?>

        </a>
      <h6>Período:
        <?php echo e($data['start_date']); ?>  às  <?php echo e($data['start_time']); ?>

        <?php if($data['start_date'] != $data['end_date']): ?>
          Até <?php echo e($data['end_date']); ?>

        <?php endif; ?>
        <?php if($data['all_day']): ?>
          <br>
          Durante todo o dia.
        <?php else: ?>
          até <?php echo e($data['end_date']); ?> as <?php echo e($data['end_time']); ?>

        <?php endif; ?>
      </h6>
      <?php if(auth()->guard('admin-web')->check()): ?>
      <div class="d-flex mt-4">
        <?php echo Form::open(array('route' => ['events.edit', $data['id']],'method'=>'POST')); ?>

        <?php echo Form::hidden('info', 'general'); ?>

        <?php echo Form::submit('Editar informações', ['class'=>'btn btn-primary']); ?>

        <?php echo Form::close(); ?>

      </div>
      <?php endif; ?>
    </div> 
  </div>
  <div class="d-flex flex-column mb-4">
    <div class="d-flex flex-column mb-3">
      <h2>Informações:</h2>
    </div>
    <div class="d-flex flex-column">
      <ul class="nav nav-tabs ml-0 mb-0">
        <li class="active"><a data-toggle="tab" href="#descricao">Descrição</a></li>
        <li class=""><a data-toggle="tab" href="#programacao">Programação</a></li>
        <li class=""><a data-toggle="tab" href="#folder">Folder</a></li>
      </ul>
      <div class="tab-content">
        <div id="descricao" class="tab-pane fade in active">
          <div class="card">
            <div class="card-body">
              <div class="d-flex mb-3 flex-column">
                <?php if($data['apresentation'] != null): ?>
                  <?php echo $data['apresentation']; ?>

                <?php else: ?>
                  <div class="text-muted">
                    Nada para informar.
                  </div>
                <?php endif; ?>
              </div>
              <?php if(auth()->guard('admin-web')->check()): ?>
              <div class="d-flex">
                <?php echo Form::open(array('route' => ['events.edit', $data['id']],'method'=>'POST')); ?>

                <?php echo Form::hidden('info', 'apresentation'); ?>

                <?php echo Form::submit('Editar campo', ['class'=>'btn btn-primary']); ?>

                <?php echo Form::close(); ?>

              </div>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>    
    </div>
  </div>
  <div class="d-flex flex-column">
    <div class="d-flex mr-auto mb-3">
      <h2>Palestrantes:</h2>
    </div>
    <div id="accordion d-flex text-justify">
      <div class="card">
        <?php $__currentLoopData = $palestrantes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $palestrante): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <div class="card-header d-flex" id="heading<?php echo e($palestrante->id); ?>">
            <button class="btn btn-link" data-toggle="collapse" data-target="#collapse<?php echo e($palestrante->id); ?>" aria-expanded="false" aria-controls="collapse<?php echo e($palestrante->id); ?>">
              <?php echo e($palestrante->nome); ?>

            </button>
            <?php if($palestrante->instituicao != null): ?>
              <a class="btn btn-link d-flex mr-auto" href="<?php echo e($palestrante->url); ?>">
                <?php echo e($palestrante->instituicao); ?>

              </a>
            <?php endif; ?>
            <div class="d-flex">
              <?php if(auth()->guard('admin-web')->check()): ?>
              <?php echo Form::open(array('route' => ['events.edit', $data['id']],'method'=>'POST')); ?>

              <?php echo Form::hidden('info', 'palestrantes'); ?>

              <?php echo Form::hidden('old', $palestrante->id); ?>

              <?php echo Form::submit('Editar campo', ['class'=>'btn btn-primary']); ?>

              <?php echo Form::close(); ?>

              <?php endif; ?>
            </div>
          </div>
          <div id="collapse<?php echo e($palestrante->id); ?>" class="collapse" aria-labelledby="heading<?php echo e($palestrante->id); ?>" data-parent="#accordion">
            <div class="card-body">
              <?php if($palestrante->apresentacao != null): ?>
                <?php echo $palestrante->apresentacao; ?>

              <?php else: ?>
                <div class="text-muted">
                  Nada para informar.
                </div>
              <?php endif; ?> 
            </div>
          </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php if(auth()->guard('admin-web')->check()): ?>
        <div class="card-header">
          <?php echo Form::open(array('route' => ['events.edit', $data['id']],'method'=>'POST')); ?>

          <?php echo Form::hidden('info', 'add_palestrante'); ?>

          <?php echo Form::submit('+ Adicionar palestrante', ['class'=>'btn btn-link']); ?>

          <?php echo Form::close(); ?>

        </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
  <div class="d-flex flex-column" id="admissao">
    <div class="d-flex mr-auto mb-3">
      <h2>
        Admissão:
      </h2>
    </div>
    <div class="d-flex flex-column text-justify">
      <ul class="nav nav-tabs ml-0 mb-0">
        <li class="active">
          <a data-toggle="tab" href="#inscricao">Inscrição</a>
        </li>
        <li class="">
          <a data-toggle="tab" href="#submissao">Submissão de trabalhos</a>
        </li>
      </ul>
      <div class="tab-content">
        <div id="inscricao" class="tab-pane fade in active">
          <div class="card">
            <div class="card-body">
              <?php if($data['inicio_inscricoes'] == null): ?>
              <?php if(auth()->guard('admin-web')->check()): ?>
                Datas não definidas!
                <?php echo Form::open(array('route' => ['events.inscricoes', $data['id']],'method'=>'POST')); ?>

                <?php echo Form::hidden('info', 'mostrar_edicao'); ?>

                <?php echo Form::submit('Definir datas', ['class'=>'btn btn-danger']); ?>

                <?php echo Form::close(); ?>

              <?php elseif($data['inicio_inscricoes'] && $data['fim_inscricoes'] != null): ?>
              Deseja mudar as datas?
                <?php echo Form::open(array('route' => ['events.inscricoes', $data['id']],'method'=>'POST')); ?>

                <?php echo Form::hidden('info', 'mostrar_edicao'); ?>

                <?php echo Form::submit('Redefinir datas', ['class'=>'btn btn-danger']); ?>

                <?php echo Form::close(); ?>

                <?php endif; ?>
              <?php else: ?>
              <?php if(auth()->guard('user-web')->check()): ?>
                <?php echo Form::open(array('route' => ['events.inscricoes', $data['id']],'method'=>'POST')); ?>

                <?php echo Form::hidden('info', 'mostrar_inscricao'); ?>

                <?php echo Form::submit('Inscrever-se', ['class'=>'btn btn-primary']); ?>

                <?php echo Form::close(); ?>

              <?php endif; ?>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="d-flex flex-column" id="credenciamento">
    <div class="d-flex mr-auto mb-3">
      <h2>
        Credenciamento:
      </h2>
    </div>
    <div class="d-flex flex-column text-justify">
      <ul class="nav nav-tabs ml-0 mb-0">
        <li class="active">
          <a data-toggle="tab" href="#confirmacao">Confirmação da Inscrição</a>
        </li>
        <li class="">
          <a data-toggle="tab" href="#ata">Ata de presentes</a>
        </li>
      </ul>
      <div class="tab-content">
        <div id="confirmacao" class="tab-pane fade in active">
          <div class="card">
            <div class="card-body">
              
            </div>
          </div>
        </div>
      </div>
    </div>
  </div><div class="d-flex flex-column" id="relatorio">
      <div class="d-flex mr-auto mb-3">
        <h2>
          Relatório final:
        </h2>
      </div>
      <div class="d-flex flex-column text-justify">
            <div class="card">
              <?php if(auth()->guard('admin-web')->check()): ?>
              <div class="card-body">
                  <?php echo Form::submit('Enviar fotos', ['class'=>'btn btn-danger']); ?>

                  <?php echo Form::submit('Preencher relatório', ['class'=>'btn btn-danger']); ?>

              </div>
              <?php endif; ?>
            </div>
      </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.padrao', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>