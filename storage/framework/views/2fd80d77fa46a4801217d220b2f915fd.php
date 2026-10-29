<!DOCTYPE html>
<html lang="hi">

<head>
  <?php echo $__env->make('Student.includes.head', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
  <?php echo $__env->yieldPushContent('styles'); ?>
</head>

<body>

  <div class="s-wrapper">

    
    <?php echo $__env->make('Student.includes.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    
    <div class="s-main">

      
      <?php echo $__env->make('Student.includes.topbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

      
      <div style="padding: 0 24px; margin-top: 16px;">
        <?php if(session('success')): ?>
        <div class="alert-success">✓ &nbsp;<?php echo e(session('success')); ?></div>
        <?php endif; ?>
        <?php if(session('error')): ?>
        <div class="alert-error">✕ &nbsp;<?php echo e(session('error')); ?></div>
        <?php endif; ?>
        <?php if($errors->any()): ?>
        <div class="alert-error">
          <ul style="padding-left:16px;margin:0;">
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </ul>
        </div>
        <?php endif; ?>
      </div>

      
      <main class="s-page">
        <?php echo $__env->yieldContent('content'); ?>
      </main>

      
      <?php echo $__env->make('Student.includes.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    </div>

  </div>

</body>

</html><?php /**PATH C:\Users\Aditya Pratap\Desktop\main_lms\resources\views\Student\layouts\app.blade.php ENDPATH**/ ?>