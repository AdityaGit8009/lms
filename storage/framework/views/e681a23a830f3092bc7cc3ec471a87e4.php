

<?php $__env->startSection('title', 'Schedule'); ?>
<?php $__env->startSection('page-title', 'Schedule'); ?>
<?php $__env->startSection('breadcrumb', 'Schedule'); ?>

<?php $__env->startPush('styles'); ?>
<?php echo $__env->make('Student.partials.page_theme_styles', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="page-shell">
  <div class="hero-card">
    <div class="hero-kicker">Time Planner</div>
    <div class="hero-title">Class Schedule</div>
    <div class="hero-sub">
      Weekly sessions, mentor timings aur study slots ko yahan se manage kijiye.
    </div>
  </div>

  <div class="soft-card">
    <div class="soft-card-title">Weekly Schedule</div>
    <div class="list-stack">
      <?php $__empty_1 = true; $__currentLoopData = $schedule; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
      <div class="list-item">
        <div class="list-item-left">
          <div class="list-item-title"><?php echo e($item['subject']); ?></div>
          <div class="list-item-meta"><?php echo e($item['day']); ?> • <?php echo e($item['time']); ?></div>
        </div>
        <span class="tag-badge tag-purple"><?php echo e($item['day']); ?></span>
      </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
      <div class="list-item">
        <div class="list-item-left">
          <div class="list-item-title">No schedule available</div>
        </div>
      </div>
      <?php endif; ?>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Student.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Aditya Pratap\Desktop\main_lms\resources\views\Student\schedule.blade.php ENDPATH**/ ?>