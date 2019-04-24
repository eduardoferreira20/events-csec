<?php $__env->startSection('content'); ?>
<h1><?php echo e($event); ?></h1>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>