<?php $__env->startSection('style'); ?>
  <link rel="stylesheet" href="<?php echo e(asset('css/fullcalendar/fullcalendar.min.css')); ?>"/>
  <link rel="stylesheet" href="<?php echo e(asset('css/clockpicker/bootstrap-clockpicker.min.css')); ?>"/>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
  <div class="d-flex">
    <div class="d-flex flex-column panel-group mr-5 ml-5">
      <?php if(auth()->guard('admin-web')->check()): ?>
      <div class="panel panel-primary">
        <div class="panel-heading">Criar evento!</div>
        <div class="d-flex flex-column panel-body">    
          <?php echo Form::open(array('route' => 'events.add','method'=>'POST')); ?>

            <div class="d-flex flex-column mb-4">
              <?php echo Form::label('event_name','Nome do evento:'); ?>

              <?php echo Form::text('event_name', null, ['class' => 'form-control']); ?>

            </div>
            <div class="d-flex flex-fill mb-4">
              <div class="d-flex flex-column mr-4">
                <?php echo Form::label('start_date','Data de início:'); ?>

                <?php echo Form::date('start_date', null, ['class' => 'form-control']); ?>

              </div>
              <div class="d-flex flex-column">
                <?php echo Form::label('end_date','Data de término:'); ?>

                <?php echo Form::date('end_date', null, ['class' => 'form-control']); ?>

              </div>
            </div>
            <div class="d-flex flex-fill mb-4">
              <div class="d-flex flex-column mr-4">
                <?php echo Form::label('all_day','Dia todo?'); ?>

                <?php echo Form::checkbox('all_day', true); ?>

              </div>
              <div class="d-flex flex-column mr-4 clockpicker">
                <?php echo Form::label('start_time','Horário inicial:'); ?>

                <?php echo Form::text('start_time', null, ['class' => 'form-control', 'placeholder' => '--:--']); ?>

              </div>

              <div class="d-flex flex-column clockpicker">
                <?php echo Form::label('end_time','Horário final:'); ?>

                <?php echo Form::text('end_time', null, ['class' => 'form-control', 'placeholder' => '--:--']); ?>

              </div>
            </div>
            <div class="d-flex flex-fill">
              <div class="d-flex mr-4">
                <?php echo Form::select('user_id', $users, null, ['placeholder' => 'Escolher usuário', 'class' => 'form-control']); ?>

              </div>
              <div class="d-flex">
              <?php echo Form::submit('Criar Evento',['class'=>'btn btn-primary']); ?>

              </div>
            </div>
          <?php echo Form::close(); ?>

        </div>
      </div>
      <?php endif; ?>

      <div class="panel panel-primary">
        <div class="panel-heading">Usuário!</div>
        <div class="d-flex flex-column panel-body">
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
            <p>Olá,</p> 
            <p class="h2"><?php echo e(Auth::guard('user-web')->user()->name); ?></p>
          </div>
          <div class="d-flex mt-5">
            <?php echo link_to_route('user.index', $title = "Informações da conta", $parameters = [Auth::guard('user-web')->user()->id], $attributes = ['class'=>'btn btn-primary']); ?>

          </div>
          <div class="d-flex my-3">
            <?php echo link_to_route('user.events', $title = "Eventos Inscritos", $parameters = [Auth::guard('user-web')->user()->id], $attributes = ['class'=>'btn btn-primary']); ?>

          </div>
          <div class="d-flex btn btn-secondary">
            Eventos Responsáveis
          </div>
          <div class="d-flex mt-5">
            <?php echo Form::open(array('route' => 'logout','method'=>'POST')); ?>

            <?php echo Form::submit('Sair',['class'=>'btn btn-primary']); ?>

            <?php echo Form::close(); ?>

          </div> 
          <?php endif; ?>
        </div>
      </div>

    </div> 

    <div class="d-flex ml-4 mr-5">
      <div class="panel panel-primary">
        <div class="panel-heading">Calendario!</div>
        <div class="panel-body">  
          <?php echo $calendar->calendar(); ?>

        </div>
      </div> 
    </div> 

  </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
  <script src="<?php echo e(asset('js/clockpicker/bootstrap-clockpicker.min.js')); ?>"></script>
  <script src="<?php echo e(asset('js/lib/moment.min.js')); ?>"></script>
  <script src="<?php echo e(asset('js/fullcalendar/fullcalendar.min.js')); ?>"></script>
  <script src="<?php echo e(asset('js/fullcalendar/locale/pt-br.js')); ?>"></script>

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

  <?php echo $calendar->script(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>