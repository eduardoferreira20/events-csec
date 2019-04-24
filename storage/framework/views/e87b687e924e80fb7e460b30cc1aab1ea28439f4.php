  <!DOCTYPE html>
  <html lang="<?php echo e(app()->getLocale()); ?>">
  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Certificado</title>

<style type="text/css">

  .row{
    background-repeat: no-repeat;
    height: 100%;
  }

  .conteiner{
    height: 800px;
    
  }

.nome{
  float: left;
  width: 50%;
}

.pdf-container{
  margin-top: 5%;
}

  </style>

  </head>
  <body>

    <div class="conteiner">
      <div class="row">
        <div class="col-md-12">
          <div class="pdf-container" style="width: 80%; margin-left: 15%;" >
            <table class="table">
              <tbody>
               <?php $__currentLoopData = $user; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
               <tr>
                <p class="nome"><?php echo e($user->name); ?></p>
                <p class="nome"> <?php echo e($user->email); ?></p>
                <p class="nome"><?php echo e($user->documento); ?></p>
                <p></p>
               <a href="<?php echo e((url('/pdf/download/'.$user->id) )); ?>" class="btn" >Download PDF</a>
              </tr>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div> 

  </body>
  </html>