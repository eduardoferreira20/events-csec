<?php $__env->startSection('conteudo-principal'); ?>
<?php echo Form::open(array('route' => 'register','method'=>'POST')); ?>

<div id="accordion d-flex">
    <div class="card">
        <div class="card-header d-flex" id="headingOne">
            <h4 class="btn btn-link collapsed my-0" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true"
                aria-controls="collapseOne">
                Informações de Login
            </h4>
        </div>
        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
            <div class="card-body">
                <div class="d-flex">
                    <div class="card">
                        <div class="card-body d-flex form-group">
                            <div class="d-flex flex-column mr-4">
                                <?php echo Form::label('email', 'E-mail: '); ?>

                                <?php echo Form::email('email', null, ['class' => 'form-control', 'style' => 'width:300px']); ?>

                            </div>
                            <div class="d-flex flex-column">
                                <?php echo Form::label('password', 'Senha: '); ?>

                                <?php echo Form::password('password', ['class' => 'form-control', 'style' => 'width:250px']); ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header d-flex" id="headingTwo">
            <h4 class="btn btn-link collapsed my-0" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false"
                aria-controls="collapseTwo">
                Informações de credenciamento
            </h4>
        </div>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
            <div class="card-body">
                <div class="d-flex flex-column form-group">
                    <div class="card">
                        <div class="card-body d-flex flex-column">
                            <?php echo Form::label('name','Nome Completo: '); ?>

                            <?php echo Form::text('name', null, ['class' => 'form-control', 'style' => 'width:500px']); ?>

                        </div>
                    </div>
                    <div class="card my-4">
                        <div class="card-body d-flex flex-column">
                            <?php echo Form::label('nacionalidade','Nacionalidade: '); ?>

                            <?php echo Form::text('nacionalidade', null, ['class' => 'form-control', 'style' => 'width:500px']); ?>

                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-body d-flex flex-column">
                            <?php echo Form::label('instituicao','Instituicao: '); ?>

                            <?php echo Form::text('instituicao', null, ['class' => 'form-control', 'style' => 'width:500px']); ?>

                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-body d-flex flex-column">
                            <?php echo Form::label('documento', 'Documento: '); ?>


                            <?php echo Form::select('tipo', ['1' => 'CPF', '2' => 'Passaporte'], null, ['class' => 'form-control mb-3', 'style' => 'width:150px', 'onChange' => 'yesnoCheck(this)', 'placeholder' => 'Selecione']); ?>


                            <?php echo Form::text('documento', null, ['class' => 'form-control', 'style' => 'width:500px', 'onkeypress' => 'return isNumberKey(event)', 'id' => 'documento']); ?>

                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body d-flex flex-column">
                            <?php echo Form::label('phone','Telefone: '); ?>

                            <?php echo Form::text('phone', null, ['class' => 'form-control mb-4', 'style' => 'width:500px', 'onkeypress' => 'return isNumberKey(event)', 'placeholder' => '(__) ____-____']); ?>


                            <?php echo Form::label('celular','Celular: '); ?>

                            <?php echo Form::text('celular', null, ['class' => 'form-control ', 'style' => 'width:500px','onkeypress' => 'return isNumberKey(event)', 'placeholder' => '(__) _____-____']); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo Form::submit('Criar conta', ['class'=>'btn btn-primary my-4']); ?>

<?php echo Form::close(); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script>
    function isNumberKey(evt) {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
        return true;
    }
</script>

<script>
    function yesnoCheck(that) {
        if (that.value == '1') {
            document.getElementById("documento").placeholder = "___.___.___-__";
        }else {
            document.getElementById("documento").placeholder = "";
        }
    }
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.padrao', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>