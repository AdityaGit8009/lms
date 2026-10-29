

<?php $__env->startSection('title', 'Results / Marks'); ?>
<?php $__env->startSection('page-title', 'Results / Marks'); ?>
<?php $__env->startSection('breadcrumb', 'Results / Marks'); ?>

<?php $__env->startPush('styles'); ?>
<?php echo $__env->make('Student.partials.page_theme_styles', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="page-shell">
  <div class="hero-card">
    <div class="hero-kicker">Academic Performance</div>
    <div class="hero-title">Results / Marks</div>
    <div class="hero-sub">
      Test scores, assessments aur academic trend ek executive view me.
    </div>
  </div>

  <div class="soft-card">
    <div class="soft-card-title">Assessment Results</div>
    <div class="list-stack">
      <?php $__empty_1 = true; $__currentLoopData = $results; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
      <div class="list-item">
        <div class="list-item-left">
          <div class="list-item-title"><?php echo e($item['exam']); ?></div>
          <div class="list-item-meta">Marks: <?php echo e($item['marks']); ?>/<?php echo e($item['out_of']); ?> • Grade: <?php echo e($item['grade']); ?></div>
        </div>
        <span class="tag-badge <?php echo e(in_array($item['grade'], ['A','A+']) ? 'tag-green' : 'tag-amber'); ?>">
          <?php echo e($item['grade']); ?>

        </span>
      </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
      <div class="list-item">
        <div class="list-item-left">
          <div class="list-item-title">No results available</div>
        </div>
      </div>
      <?php endif; ?>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Student.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Aditya Pratap\Desktop\main_lms\resources\views\Student\results.blade.php ENDPATH**/ ?>