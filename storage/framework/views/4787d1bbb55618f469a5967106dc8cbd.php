

<?php $__env->startSection('title', 'Assignments'); ?>
<?php $__env->startSection('page-title', 'Assignments'); ?>
<?php $__env->startSection('breadcrumb', 'Assignments'); ?>

<?php $__env->startPush('styles'); ?>
<?php echo $__env->make('Student.partials.page_theme_styles', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="page-shell">
  <div class="hero-card">
    <div class="hero-kicker">Work Queue</div>
    <div class="hero-title">Assignments</div>
    <div class="hero-sub">
      Yahan se aap upcoming submissions, completed work aur due dates track kar sakte hain.
    </div>
  </div>

  <div class="cards-grid-2">
    <div class="soft-card">
      <div class="soft-card-title">Pending Work</div>
      <div class="list-stack">
        <?php $__currentLoopData = collect($assignments ?? [])->where('status', 'Pending'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="list-item">
          <div class="list-item-left">
            <div class="list-item-title"><?php echo e($item['title']); ?></div>
            <div class="list-item-meta"><?php echo e($item['course']); ?> • Due: <?php echo e($item['due_date']); ?></div>
          </div>
          <span class="tag-badge tag-pink">Pending</span>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>
    </div>

    <div class="soft-card">
      <div class="soft-card-title">Submitted Work</div>
      <div class="list-stack">
        <?php $__currentLoopData = collect($assignments ?? [])->where('status', 'Submitted'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="list-item">
          <div class="list-item-left">
            <div class="list-item-title"><?php echo e($item['title']); ?></div>
            <div class="list-item-meta"><?php echo e($item['course']); ?> • Submitted</div>
          </div>
          <span class="tag-badge tag-green">Submitted</span>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>
    </div>
  </div>

  <div class="soft-card">
    <div class="soft-card-title">All Assignments</div>
    <div class="list-stack">
      <?php $__empty_1 = true; $__currentLoopData = $assignments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
      <div class="list-item">
        <div class="list-item-left">
          <div class="list-item-title"><?php echo e($item['title']); ?></div>
          <div class="list-item-meta"><?php echo e($item['course']); ?> • Due Date: <?php echo e($item['due_date']); ?></div>
        </div>
        <span class="tag-badge <?php echo e($item['status'] === 'Submitted' ? 'tag-green' : 'tag-pink'); ?>">
          <?php echo e($item['status']); ?>

        </span>
      </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
      <div class="list-item">
        <div class="list-item-left">
          <div class="list-item-title">No assignments found</div>
        </div>
      </div>
      <?php endif; ?>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Student.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Aditya Pratap\Desktop\main_lms\resources\views\Student\assignments.blade.php ENDPATH**/ ?>