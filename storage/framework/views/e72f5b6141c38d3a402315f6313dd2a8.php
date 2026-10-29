

<?php $__env->startSection('title', 'Announcements'); ?>
<?php $__env->startSection('page-title', 'Announcements'); ?>
<?php $__env->startSection('breadcrumb', 'Announcements'); ?>

<?php $__env->startPush('styles'); ?>
<?php echo $__env->make('Student.partials.page_theme_styles', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="page-shell">
  <div class="hero-card">
    <div class="hero-kicker">Notice Board</div>
    <div class="hero-title">Announcements</div>
    <div class="hero-sub">
      Latest updates, mentor notices aur important communication yahin milega.
    </div>
  </div>

  <div class="soft-card">
    <div class="soft-card-title">Latest Announcements</div>
    <div class="list-stack">
      <?php $__empty_1 = true; $__currentLoopData = $announcements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
      <div class="list-item">
        <div class="list-item-left">
          <div class="list-item-title"><?php echo e($item['title']); ?></div>
          <div class="list-item-meta">Published on: <?php echo e($item['date']); ?></div>
        </div>
        <span class="tag-badge tag-purple">New</span>
      </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
      <div class="list-item">
        <div class="list-item-left">
          <div class="list-item-title">No announcements available</div>
        </div>
      </div>
      <?php endif; ?>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Student.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Aditya Pratap\Desktop\main_lms\resources\views\Student\announcements.blade.php ENDPATH**/ ?>