

<?php $__env->startSection('title', 'Certificates'); ?>
<?php $__env->startSection('page-title', 'Certificates'); ?>
<?php $__env->startSection('breadcrumb', 'Certificates'); ?>

<?php $__env->startPush('styles'); ?>
<?php echo $__env->make('Student.partials.page_theme_styles', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="page-shell">
  <div class="hero-card">
    <div class="hero-kicker">Achievements</div>
    <div class="hero-title">Certificates</div>
    <div class="hero-sub">
      Earned certificates aur completion recognitions ko yahan se access karein.
    </div>
  </div>

  <div class="cards-grid-2">
    <?php $__empty_1 = true; $__currentLoopData = $certificates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
    <div class="soft-card">
      <div class="soft-card-title">
        <span><?php echo e($item['title']); ?></span>
        <span class="tag-badge tag-green"><?php echo e($item['status']); ?></span>
      </div>
      <div class="list-item-meta">Issued On: <?php echo e($item['issued_on']); ?></div>
      <div class="page-actions" style="margin-top:14px;">
        <a href="#" class="btn-soft">View</a>
        <a href="#" class="btn-soft">Download</a>
      </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
    <div class="soft-card">
      <div class="soft-card-title">No certificates yet</div>
    </div>
    <?php endif; ?>
  </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Student.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Aditya Pratap\Desktop\main_lms\resources\views\Student\certificates.blade.php ENDPATH**/ ?>