

<?php $__env->startSection('title', 'Quizzes'); ?>
<?php $__env->startSection('page-title', 'Quizzes'); ?>
<?php $__env->startSection('breadcrumb', 'Quizzes'); ?>

<?php $__env->startPush('styles'); ?>
<?php echo $__env->make('Student.partials.page_theme_styles', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="page-shell">
  <div class="hero-card">
    <div class="hero-kicker">Assessment Zone</div>
    <div class="hero-title">Quizzes</div>
    <div class="hero-sub">
      Quiz performance, upcoming tests aur subject-wise marks yahin track honge.
    </div>
  </div>

  <div class="soft-card">
    <div class="soft-card-title">Quiz Overview</div>
    <div class="list-stack">
      <?php $__empty_1 = true; $__currentLoopData = $quizzes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $quiz): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
      <div class="list-item">
        <div class="list-item-left">
          <div class="list-item-title"><?php echo e($quiz['title']); ?></div>
          <div class="list-item-meta"><?php echo e($quiz['course']); ?> • Marks: <?php echo e($quiz['marks']); ?></div>
        </div>
        <span class="tag-badge <?php echo e($quiz['status'] === 'Completed' ? 'tag-green' : 'tag-purple'); ?>">
          <?php echo e($quiz['status']); ?>

        </span>
      </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
      <div class="list-item">
        <div class="list-item-left">
          <div class="list-item-title">Abhi koi quiz data nahi hai</div>
        </div>
      </div>
      <?php endif; ?>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Student.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Aditya Pratap\Desktop\main_lms\resources\views\Student\quiz.blade.php ENDPATH**/ ?>