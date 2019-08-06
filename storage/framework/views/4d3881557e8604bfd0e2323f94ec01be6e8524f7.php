<?php $__env->startSection('titulo-principal'); ?>
<div class="d-flex">
  <div class="d-flex flex-fill">
    <?php echo e($user->name); ?>

  </div>
  <div class="d-flex align-self-center">
    <a href="<?php echo e(route('events.index')); ?>" class="btn btn-primary">Voltar</a>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('conteudo-principal'); ?>
<div class="d-flex flex-column">
  <div class="d-flex mb-4" id="cabecalho">
    <div class="d-flex flex-column mr-auto">
    	<h5 class= "mb-0">< <?php echo e($user->email); ?> ></h5>
    	<h5>Empresa/Instituição: <?php echo e($user->instituicao); ?></h5>
    </div>
    <div class="d-flex flex-column align-items-end">
    </div>
  </div>
  <div class="d-flex flex-column mb-4" id="informacoes">
    <div class="d-flex flex-column">
      <ul class="nav nav-tabs ml-0 mb-0">
        <li class="active"><a data-toggle="tab" href="#apresentacao">Apresentação</a></li>
        <li><a data-toggle="tab" href="#dadosgerais">Dados Gerais</a></li>
        <li><a data-toggle="tab" href="#dadoscomplementares">Dados Complementares</a></li>
        <li><a data-toggle="tab" href="#eventos">Eventos inscritos</a></li>
      </ul>
      <div class="tab-content">
        <div id="apresentacao" class="tab-pane fade in active">
          <div class="card">
            <div class="card-body">
              <div class="d-flex mb-5 flex-column">
                <?php if($user->apresentation != null): ?>
                <?php echo $user->apresentation; ?>

                <?php else: ?>
                <div class="text-muted">
                  Nada para informar.
                </div>
                <?php endif; ?>
              </div>
              <div class="d-flex">
                <?php echo Form::open(array('route' => ['user.edit', $user->id],'method'=>'POST')); ?>

                <?php echo Form::hidden('info', 'apresentation'); ?>

                <?php echo Form::hidden('old', $user->apresentation); ?>

                <?php echo Form::submit('Editar campo', ['class'=>'btn btn-primary']); ?>

                <?php echo Form::close(); ?>

              </div>
            </div>
          </div>
        </div>
        <div id="dadosgerais" class="tab-pane fade">
          <div class="card">
            <div class="card-body">
              <div class="d-flex mb-5">
               Nome: <?php echo e($user->name); ?> </br>
               E-mail: <?php echo e($user->email); ?> </br>
               Nacionalidade: <?php echo e($user->nacionalidade); ?></br>
               Documento: <?php echo e($user->documento); ?></br>
               Empresa/Instituição: <?php echo e($user->instituicao); ?> </br>
               Telefone Residencial: <?php echo e($user->phone); ?></br>
               Telefone Celular: <?php echo e($user->celular); ?></br>
             </div>
             <div class="d-flex">
              <?php echo Form::open(array('route' => ['user.edit', $user->id],'method'=>'POST')); ?>

              <?php echo Form::hidden('info', 'users'); ?>

              <?php echo Form::submit('Editar campo', ['class'=>'btn btn-primary']); ?>

              <?php echo Form::close(); ?>

            </div>
          </div>
        </div>
      </div>
      <div id="dadoscomplementares" class="tab-pane fade">
        <div class="card">
          <div class="card-body">
            <div class="d-flex mb-5">
              CEP: <?php echo e($endereco->cep); ?></br>
              Logradouro: <?php echo e($endereco->logradouro); ?></br>
              Número: <?php echo e($endereco->numero); ?></br>
              Complemento: <?php echo e($endereco->complemento); ?></br>
              Bairro: <?php echo e($endereco->bairro); ?></br>
              Cidade: <?php echo e($endereco->cidade); ?></br>
            </div>
            <div class="d-flex">
              <?php echo Form::open(array('route' => ['user.edit', $user->id],'method'=>'POST')); ?>


              <?php echo Form::hidden('info', 'enderecos'); ?>

              <?php echo Form::hidden('old', $endereco->user_id); ?>

              <?php echo Form::submit('Editar campo', ['class'=>'btn btn-primary']); ?>

              <?php echo Form::close(); ?>

            </div>
          </div>
        </div>
      </div>
      <div id="eventos" class="tab-pane fade">
        <div class="card">
          <div class="card-body">
            <div class="d-flex mb-5">

              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Evento</th>
                    <th scope="col">Dia</th>
                    <th scope="col">Status</th>
                    <th scope="col">Ação</th>
                  </tr>
                </thead>
                <tbody>
                   <?php $__currentLoopData = $evento; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $evento): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <tr>
                    <th><?php echo e($evento->evento->title); ?></th>
                    <td><?php echo e(date('d/m/Y - H:m', strtotime($evento->evento->start_date))); ?></td>
                    <?php if($evento->status == 0): ?>
                    <td>Aguardando confirmação</td>
                    <?php else: ?>
                    <td>Inscrição confirmada</td>
                    <?php endif; ?>
                    <td><a class="btn btn-info" href="<?php echo e(route('events.edit',$evento->evento->id)); ?>">Visitar</a></td>
                  </tr>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
              </table>

            </div>
          </div>
        </div>
      </div> 
    </div>  
  </div>
</div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.padrao', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>