<!doctype html>
    <html lang="<?php echo e(app()->getLocale()); ?>">
    <head>
        <meta charset="utf-8">
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="<?php echo e(asset('css/app.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('css/lib/bootstrap.min.css')); ?>">

        <?php echo $__env->yieldContent('style'); ?>
        <title>Calendário CSEC</title>
    </head>

    <body>
        <?php echo $__env->yieldContent('content'); ?>
    </body>

    <script src="<?php echo e(asset('js/lib/jquery.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/lib/bootstrap.min.js')); ?>"></script>  
    <?php echo $__env->yieldContent('script'); ?>
</html>