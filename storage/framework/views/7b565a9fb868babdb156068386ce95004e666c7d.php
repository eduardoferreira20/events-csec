<?php $__env->startSection('estilos'); ?>
<link rel="stylesheet" href="<?php echo e(asset('css/fullcalendar/fullcalendar.min.css')); ?>"/>
<link rel="stylesheet" href="<?php echo e(asset('css/clockpicker/bootstrap-clockpicker.min.css')); ?>"/>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('titulo-principal'); ?>
Calendário de eventos
<?php $__env->stopSection(); ?>

<?php $__env->startSection('conteudo-principal'); ?>
<?php echo $calendar->calendar(); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('sidebar'); ?>
<?php if(auth()->guard('admin-web')->check()): ?>
<aside class="widget">
    <h3 class="widgettitle">
        <span>Elaborar evento</span>
    </h3>
    <div>
        <div class="d-flex flex-column">    
            <?php echo Form::open(array('route' => 'events.add','method'=>'POST')); ?>

            <div class="d-flex flex-column mb-4">
                <?php echo Form::label('event_name','Nome do evento:'); ?>

                <?php echo Form::text('event_name', null, ['class' => 'form-control']); ?>

            </div>
            <div class="d-flex flex-column mb-4">
                <?php echo Form::label('start_date','Data de início:'); ?>

                <?php echo Form::date('start_date', null, ['class' => 'form-control', 'style' => 'width:170px']); ?>

            </div>
            <div class="d-flex flex-column mb-4">
                <?php echo Form::label('end_date','Data de término:'); ?>

                <?php echo Form::date('end_date', null, ['class' => 'form-control', 'style' => 'width:170px']); ?>

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
            <div class="d-flex flex-fill mb-4">
                <div class="d-flex flex-column mr-4">
                    <?php echo Form::label('e_pago','É pago?'); ?>

                    <?php echo Form::checkbox('all_day', true); ?>

                </div>
                <div class="d-flex flex-column mr-4">
                    <?php echo Form::label('valor','Valor do evento:'); ?>

                <?php echo Form::text('valor', null, ['class' => 'form-control']); ?>

                </div>
            </div>
            <div class="d-flex flex-column mb-4">
                <?php echo Form::label('hora_comple','Horas complementares:'); ?>

                <?php echo Form::text('hora_comple', null, ['class' => 'form-control']); ?>

            </div>
            <div class="d-flex flex-column mb-4">
                <?php echo Form::label('local','Local do evento:'); ?>

                <?php echo Form::text('local', null, ['class' => 'form-control']); ?>

            </div>
            <div class="d-flex flex-column mb-4">
                <?php echo Form::label('cidade','Cidade:'); ?>

                <?php echo Form::text('cidade', null, ['class' => 'form-control']); ?>

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
</aside>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<?php if(auth()->guard('admin-web')->check()): ?>
<script src="<?php echo e(asset('js/clockpicker/bootstrap-clockpicker.min.js')); ?>"></script>
<?php endif; ?>
<script src="<?php echo e(asset('js/lib/moment.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/fullcalendar/fullcalendar.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/fullcalendar/locale/pt-br.js')); ?>"></script>

<?php if(auth()->guard('admin-web')->check()): ?>
<script>
    $('.clockpicker').clockpicker({
        placement: 'bottom',
        default: 'now',
        align: 'left',
        autoclose: true,
    });
</script>

<script>
    function myFunction() {
        if(document.querySelector('all_day').checked == true){
            document.getElementById('start_time').disabled = this.checked;
            document.getElementById('end_time').disabled = this.checked;
        }
    }
</script>
<?php endif; ?>

<?php echo $calendar->script(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.padrao', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>