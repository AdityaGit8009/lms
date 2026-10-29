

<?php $__env->startSection('title', 'Feedback Forms'); ?>

<?php $__env->startSection('content'); ?>
<div class="container py-4">
  <h2 class="mb-4">Feedback Forms</h2>

  <div class="row g-3">
    <?php $__empty_1 = true; $__currentLoopData = $forms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $form): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
    <div class="col-md-6 col-lg-4">
      <div class="card border-0 shadow-sm h-100 rounded-4">
        <div class="card-body">
          <h5><?php echo e($form->title); ?></h5>
          <p class="text-muted"><?php echo e($form->description); ?></p>
          <a href="<?php echo e(route('student.feedback.show', $form->form_id)); ?>" class="btn btn-primary">
            Open Form
          </a>
        </div>
      </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
    <div class="col-12">
      <div class="alert alert-info">No feedback forms available.</div>
    </div>
    <?php endif; ?>
  </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('student.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Aditya Pratap\Desktop\main_lms\resources\views\Student\feedback\index.blade.php ENDPATH**/ ?>