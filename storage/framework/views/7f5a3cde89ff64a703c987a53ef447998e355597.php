<!DOCTYPE html>
<html lang="pt">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo e($user->user->name); ?></title>

    
    <style type="text/css">

  body{
    font-family: 'Montserrat';
    font-size: 21px;
    background: url("/Certificado1.jpg");
    background-repeat: no-repeat;
    transform: rotate(270deg);
    transform-origin:47% 53%;  
    height: 102%;
    width: 1110px;
    position: fixed;
    background-position: 70% 3%;
    background-size: 111800px !important;
    z-index: -100000000000;
  }

  .table{
    padding-top: 4%;
    padding-left: 47%;
    width: 49%;
  }

  .data{
    padding-top: 24.5%;
    padding-left: 73%;
  }

  p { 
    line-height: 150%; 
    text-align: justify;
  }


</style>
  </head>
  <body>

    <div class="conteiner">
      <div class="r">
        <div class="col-md-12">
          <div class="data"> 
            <?php if(date('F', strtotime($user->evento->start_date)) == 'January' ): ?>
            <p><?php echo $user->evento->cidade; ?>, <?php echo e(date('d', strtotime($user->evento->start_date))); ?> de Janeiro de <?php echo e(date('Y', strtotime($user->evento->start_date))); ?></p>
            <?php elseif(date('F', strtotime($user->evento->start_date)) == 'February' ): ?>
            <p><?php echo $user->evento->cidade; ?>, <?php echo e(date('d', strtotime($user->evento->start_date))); ?> de Fevereiro de <?php echo e(date('Y', strtotime($user->evento->start_date))); ?></p>
            <?php elseif(date('F', strtotime($user->evento->start_date)) == 'March'): ?>
            <p><?php echo $user->evento->cidade; ?>, <?php echo e(date('d', strtotime($user->evento->start_date))); ?> de Março de <?php echo e(date('Y', strtotime($user->evento->start_date))); ?></p>
            <?php elseif(date('F', strtotime($user->evento->start_date)) == 'April' ): ?>
            <p><?php echo $user->evento->cidade; ?>, <?php echo e(date('d', strtotime($user->evento->start_date))); ?> de Abril de <?php echo e(date('Y', strtotime($user->evento->start_date))); ?></p>
            <?php elseif(date('F', strtotime($user->evento->start_date)) == 'May' ): ?>
            <p><?php echo $user->evento->cidade; ?>, <?php echo e(date('d', strtotime($user->evento->start_date))); ?> de Abril de <?php echo e(date('Y', strtotime($user->evento->start_date))); ?></p>
           <?php elseif(date('F', strtotime($user->evento->start_date)) == 'June' ): ?>
            <p><?php echo $user->evento->cidade; ?>, <?php echo e(date('d', strtotime($user->evento->start_date))); ?> de Junho de <?php echo e(date('Y', strtotime($user->evento->start_date))); ?></p>
            <?php elseif(date('F', strtotime($user->evento->start_date)) == 'July' ): ?>
            <p><?php echo $user->evento->cidade; ?>, <?php echo e(date('d', strtotime($user->evento->start_date))); ?> de Julho de <?php echo e(date('Y', strtotime($user->evento->start_date))); ?></p>
            <?php elseif(date('F', strtotime($user->evento->start_date)) == 'August' ): ?>
            <p><?php echo $user->evento->cidade; ?>, <?php echo e(date('d', strtotime($user->evento->start_date))); ?> de Agosto de <?php echo e(date('Y', strtotime($user->evento->start_date))); ?></p>
            <?php elseif(date('F', strtotime($user->evento->start_date)) == 'September' ): ?>
            <p><?php echo $user->evento->cidade; ?>, <?php echo e(date('d', strtotime($user->evento->start_date))); ?> de Setembro de <?php echo e(date('Y', strtotime($user->evento->start_date))); ?></p>
            <?php elseif(date('F', strtotime($user->evento->start_date)) == 'October' ): ?>
            <p><?php echo $user->evento->cidade; ?>, <?php echo e(date('d', strtotime($user->evento->start_date))); ?> de Outubro de <?php echo e(date('Y', strtotime($user->evento->start_date))); ?></p>
            <?php elseif(date('F', strtotime($user->evento->start_date)) == 'November' ): ?>
            <p><?php echo $user->evento->cidade; ?>, <?php echo e(date('d', strtotime($user->evento->start_date))); ?> de Novembro de <?php echo e(date('Y', strtotime($user->evento->start_date))); ?></p>
            <?php elseif(date('F', strtotime($user->evento->start_date)) == 'December' ): ?>
            <p><?php echo $user->evento->cidade; ?>, <?php echo e(date('d', strtotime($user->evento->start_date))); ?> de Dezembro de <?php echo e(date('Y', strtotime($user->evento->start_date))); ?></p>
            <?php endif; ?>
          </div>
          <div class="table">
            <p>Certificamos que <strong><?php echo e($user->user->name); ?></strong>, portador do documento <strong><?php echo e($user->user->documento); ?></strong>, participou com exito do evento <strong><?php echo e($evento->title); ?></strong>  realizado na <strong><?php echo e($evento->local); ?></strong> na cidade de <strong><?php echo e($evento->cidade); ?></strong>, contabilizando carga horária total de <strong><?php echo e($evento->hora_comple); ?></strong> horas.</p>
          </div>
        </div>
      </div>
     </div> 
  </body>
</html>