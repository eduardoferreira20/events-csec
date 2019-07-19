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
    </h4>
      <h6>Período:
        <?php echo e($data['start_date']); ?>  às  <?php echo e($data['start_time']); ?>

        <?php if($data['start_date'] != $data['end_date']): ?>
        Até <?php echo e($data['end_date']); ?>

        <?php endif; ?>
        <?php if($data['all_day']): ?>
        <br>
        <br>
        Durante todo o dia.
        <?php else: ?>
        até <?php echo e($data['end_date']); ?> às <?php echo e($data['end_time']); ?>

        <?php endif; ?>
      </h6>
      <?php if($data['link'] != null): ?>
      <h6>Para mais informações:<a target="_blank" href="<?php echo e($data['link']); ?>">  <?php echo e($data['link']); ?></a></h6>
      <?php else: ?>
      <!-- não aparece nada -->
      <?php endif; ?>
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
        <div id="programacao" class="tab-pane fade">
          <div class="card">
            <div class="card-body">
              <div class="d-flex mb-3 flex-column">
                a
              </div>
            </div>
          </div>
        </div>
        <div id="folder" class="tab-pane fade">
          <div class="card">
            <div class="card-body">
              <div class="d-flex mb-3 flex-column">
                a2
              </div>
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
            <div class="modal-body">
              <div class="row">
                <div class="col-3 text-center">
                  <!-- <img src="https://mdbootstrap.com/img/Photos/Avatars/img%20(1).jpg" alt="<?php echo e($palestrante->nome); ?>"
                  class="img-fluid z-depth-1-half rounded-circle"> -->
                  <div style="height: 10px"></div>
                  <p class="title mb-0"><?php echo e($palestrante->nome); ?></p>
                  <p class="text-muted " style="font-size: 13px"><?php echo e($palestrante->cargo); ?></p>
                </div>
                <div class="col-9">
                  <p><?php echo $palestrante->apresentacao; ?></p>
                </div>
              </div>
            </div>
            <?php else: ?>
            <div class="modal-body">
              <div class="row">
                <div class="col-3 text-center">
                  <!-- <img src="https://mdbootstrap.com/img/Photos/Avatars/img%20(1).jpg" alt="IMG of Avatars"
                  class="img-fluid z-depth-1-half rounded-circle"> -->
                  <div style="height: 10px"></div>
                  <p class="title mb-0"><?php echo e($palestrante->nome); ?></p>
                  <p class="text-muted " style="font-size: 13px"><?php echo e($palestrante->cargo); ?></p>
                </div>
                <div class="col-9">
                  <p></p>
                </div>
              </div>
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
  <div class="d-flex flex-column" id="palestras">
    <div class="d-flex mr-auto mb-3">
      <h2>
        Inscrição evento:
      </h2>
    </div>
    
    <div class="tab-content">
      <div id="inscricao" class="tab-pane fade in active">
        <div class="card">
          <div class="card-body">
            <?php if(auth()->guard('admin-web')->check()): ?>
            <?php if($data['inicio_inscricoes'] == null): ?>
            Datas não definidas!
            <br>
            <br>
            <?php echo Form::open(array('route' => ['events.inscricoes', $data['id']],'method'=>'POST')); ?>

            <?php echo Form::hidden('info', 'mostrar_edicao'); ?>

            <?php echo Form::submit('Definir datas', ['class'=>'btn btn-danger']); ?>

            <?php echo Form::close(); ?>

            <?php elseif($data['inicio_inscricoes']  != null): ?>
            Deseja mudar as datas?
            <?php echo Form::open(array('route' => ['events.inscricoes', $data['id']],'method'=>'POST')); ?>

            <?php echo Form::hidden('info', 'mostrar_edicao'); ?>

            <?php echo Form::submit('Redefinir datas', ['class'=>'btn btn-danger']); ?>

            <?php echo Form::close(); ?>

            <?php endif; ?>
            <?php else: ?>
            <?php if(date('d-m', strtotime($hora)) > date('d-m',strtotime($data['fim_inscricoes']))): ?>
            <div class="alert alert-danger" role="alert">
              Inscrições encerradas!
            </div>
            <?php else: ?>
            <?php if(auth()->guard('user-web')->check()): ?>
            <?php echo Form::open(array('route' => ['events.inscricoes', $data['id']],'method'=>'POST')); ?>

            <?php echo Form::hidden('info', 'mostrar_inscricao'); ?>

            <?php echo Form::submit('Inscrever-se', ['class'=>'btn btn-primary']); ?>

            <?php echo Form::close(); ?>

            <?php endif; ?>
            <?php endif; ?>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- <div class="d-flex flex-column" id="palestras">
    <div class="d-flex mr-auto mb-3">
      <h2>
        Minicursos:
      </h2>
    </div>
    <div class="card" style="width: 32.5%;">
      <?php $__currentLoopData = $oficinas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cursos): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <img src="https://mdbootstrap.com/img/Photos/Avatars/img%20(1).jpg" class="card-img-top" alt="...">

      <div class="card-body">
        <h5 class="card-title"><?php echo e($cursos->titulo); ?></h5>
        <p class="card-text"><?php echo e($cursos->apresentation); ?></p>
      </div>
      <ul class="list-group list-group-flush">
        <li class="list-group-item"><?php echo e($cursos->palestrante1); ?></li>
        <?php if($cursos->palestrante2 != null): ?>
        <li class="list-group-item"><?php echo e($cursos->palestrante2); ?></li>
        <li class="list-group-item"><?php echo e($cursos->palestrante3); ?></li>
        <li class="list-group-item"><?php echo e($cursos->palestrante4); ?></li>
        <?php endif; ?>
        <li class="list-group-item"><?php echo e($cursos->start_date); ?></li>
        <li class="list-group-item"><?php echo e($cursos->valor); ?></li>
      </ul>
      <div class="card-body">
        <div class="d-flex">
          <?php if(auth()->guard('admin-web')->check()): ?>
          <?php echo Form::open(array('route' => ['events.edit', $data['id']],'method'=>'POST')); ?>

          <?php echo Form::hidden('info', 'oficinas'); ?>

          <?php echo Form::hidden('old', $cursos->id); ?>

          <?php echo Form::submit('Editar campo', ['class'=>'btn btn-primary']); ?>

          <?php echo Form::close(); ?>

          <?php endif; ?>
        </div> 
      </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
      <?php if(auth()->guard('admin-web')->check()): ?>
      <div class="card-header">
        <?php echo Form::open(array('route' => ['events.edit', $data['id']],'method'=>'POST')); ?>

        <?php echo Form::hidden('info', 'add_minicurso'); ?>

        <?php echo Form::submit('+ Adicionar minicurso', ['class'=>'btn btn-link']); ?>

        <?php echo Form::close(); ?>

      </div>
      <?php endif; ?>
    </div>
  </div> -->
  <?php if(auth()->guard('admin-web')->check()): ?>
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
        <li class="present">
          <a data-toggle="tab" href="#ata">Ata de presença</a>
        </li>
      </ul>
      <div class="tab-content">
        <div id="confirmacao" class="tab-pane fade in active">
          <div class="card">
            <div class="card-body">
              <div class="d-flex mb-5 flex-column">

                <table  class="table">
                  <thead>
                    <tr>
                      <th scope="col">Nome</th>
                      <th scope="col">Status inscrições</th>
                       <?php if(auth()->guard('admin-web')->check()): ?>
                      <th scope="col">Ação</th>
                        <?php endif; ?>
                    </tr>
                  </thead>
                  <tbody> 
                   <?php $__currentLoopData = $inscricaos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $inscricaos): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                   <tr>
                    <td scope="row"><?php echo e($inscricaos->user->name); ?></td>
                    <?php if($inscricaos->status == 0): ?>
                    <td>Aguardando confirmação...</td>
                    <?php else: ?>
                    <td>Inscrição confirmada!</td>
                    <?php endif; ?>
                   <?php if(auth()->guard('admin-web')->check()): ?>
                    <td>
                      <?php if($inscricaos->status == 0): ?>
                     <a class="btn btn-success" href="javascript:(confirm('Confirmar status da inscrição de <?php echo e($inscricaos->user->name); ?>?') ? window.location.href='<?php echo e(route('events.aprovar', $inscricaos->id)); ?>' : false)">Status</a>
                     <?php else: ?>
                      <a class="btn btn-warning" href="javascript:(confirm('Mudar status da inscrição de <?php echo e($inscricaos->user->name); ?>?') ? window.location.href='<?php echo e(route('events.aprovar', $inscricaos->id)); ?>' : false)">Status</a>
                     <?php endif; ?>
                     <a class="btn btn-danger" href="javascript:(confirm('Deletar essa inscrição?') ? window.location.href='<?php echo e(route('events.deletarIns', $inscricaos->id)); ?>' : false)">Deletar</a>
                   </td>
                   <?php endif; ?>
                 </tr>
                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
               </tbody>
             </table>
           </div>
         </div>
       </div>
     </div>
   <div id="ata" class="tab-pane fade">
    <div class="card">
      <div class="card-body">
        <div class="d-flex mb-5 flex-column">

          <table  class="table">
            <thead>
              <tr>
                <th scope="col">Nome</th>
                <th scope="col">Status presença</th>
                <th scope="col">Ação</th>
              </tr>
            </thead>
            <tbody> 
             <?php $__currentLoopData = $presenca; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $presenca): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
             <tr>
              <?php if($presenca->status == 1): ?>
              <td scope="row"><?php echo e($presenca->user->name); ?></td>
              <?php if($presenca->presenca == 0): ?>
              <td>Faltou</td>
              <?php else: ?>
              <td>Presente</td>
              <?php endif; ?>
            <?php if(auth()->guard('admin-web')->check()): ?>
              <td>
                <a class="btn btn-success" href="<?php echo e(route('events.presenca', $presenca->id)); ?>">Status</a>
             </td>
             <?php endif; ?>
             <?php endif; ?>
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
<?php endif; ?>
<?php if(auth()->guard('admin-web')->check()): ?>
<div class="d-flex flex-column" id="credenciamento">
    <div class="d-flex mr-auto mb-3">
      <h2>
        Certificados:
      </h2>
    </div>
    <div class="d-flex flex-column text-justify" id="tabela">
      <div class="tab-content">
        <div id="confirmacao" class="tab-pane fade in active">
          <div class="card">
            <div class="card-body">
              <div class="d-flex mb-5 flex-column">

                <table  class="table">
                  <thead>
                    <tr>
                      <th scope="col">Nome</th>
                      <th scope="col">Email</th>
                      <th scope="col">Status</th>
                      <th scope="col">Ação</th>
                    </tr>
                  </thead>
                  <tbody> 
                  <tr   >
                    <td>
                     <?php $__currentLoopData = $certificado; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $certificado): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                     <?php if($certificado->presenca == 1): ?>
                     <tr>
                      <td class="nome"><?php echo e($certificado->user->name); ?></td>
                      <td class="nome"><?php echo e($certificado->user->email); ?></td>
                      <?php if($certificado->envio == 0): ?>
                      <td class="nome" id="nome"><strong>Não enviado</strong></td>
                      <?php else: ?>
                      <td class="nome" id="nome"><strong>Enviado</strong></td>
                      <?php endif; ?>
                      <td>
                      <a target="_blank" href="<?php echo e((url('/certificado/download/'.$certificado->evento->id.'/usuario/'.$certificado->user->id) )); ?>" class="btn btn-success" >Abrir</a>
                      <a href="<?php echo e(url('/send/certificado/'.$certificado->evento->id.'/evento/'.$certificado->user->id).'/presenca'); ?>" class="btn btn-info">Enviar</a>
                    </td>
                    <?php endif; ?>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </td>
                  </tr>
               </tbody>
             </table>
           </div>
         </div>
       </div>
     </div>
   </div>
</div>
<?php endif; ?>
<div class="d-flex flex-column" id="relatorio">
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
<script type="text/javascript">
  var tempo = window.setInterval(carrega, 1000);
function carrega()
{
$('#tabela').load("showevent.blade.php");
}
</script>
<!-- Pagina organizador evento -->

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.padrao', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>