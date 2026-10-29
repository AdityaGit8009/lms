

<?php $__env->startSection('title', 'Mere Courses'); ?>
<?php $__env->startSection('page-title', 'Mere Courses'); ?>
<?php $__env->startSection('breadcrumb', 'Mere Courses'); ?>

<?php $__env->startPush('styles'); ?>
<?php echo $__env->make('Student.partials.page_theme_styles', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="page-shell">
  <div class="hero-card">
    <div class="hero-kicker">Learning Hub</div>
    <div class="hero-title">Mere Courses</div>
    <div class="hero-sub">
      Yahan aapke enrolled courses, progress aur mentor details ek jagah mil jayengi.
    </div>
  </div>

  <div class="stat-strip">
    <div class="mini-stat">
      <div class="mini-stat-label">Total Courses</div>
      <div class="mini-stat-value"><?php echo e(count($courses ?? [])); ?></div>
      <div class="mini-stat-sub">Active learning pipeline</div>
    </div>
    <div class="mini-stat">
      <div class="mini-stat-label">Ongoing</div>
      <div class="mini-stat-value"><?php echo e(collect($courses ?? [])->where('status','Ongoing')->count()); ?></div>
      <div class="mini-stat-sub">Currently in progress</div>
    </div>
    <div class="mini-stat">
      <div class="mini-stat-label">Avg Progress</div>
      <div class="mini-stat-value">
        <?php echo e(count($courses ?? []) ? round(collect($courses)->avg('progress')) : 0); ?>%
      </div>
      <div class="mini-stat-sub">Performance snapshot</div>
    </div>
    <div class="mini-stat">
      <div class="mini-stat-label">Mentors</div>
      <div class="mini-stat-value"><?php echo e(collect($courses ?? [])->pluck('instructor')->unique()->count()); ?></div>
      <div class="mini-stat-sub">Guiding your journey</div>
    </div>
  </div>

  <div class="soft-card">
    <div class="soft-card-title">Course Portfolio</div>

    <div class="list-stack">
      <?php $__empty_1 = true; $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
      <div class="list-item">
        <div class="list-item-left">
          <div class="list-item-title"><?php echo e($course['name']); ?></div>
          <div class="list-item-meta">
            Mentor: <?php echo e($course['instructor']); ?> • Duration: <?php echo e($course['duration']); ?> • Status: <?php echo e($course['status']); ?>

          </div>
          <div class="progress-shell">
            <div class="progress-bar" style="width: <?php echo e($course['progress']); ?>%;"></div>
          </div>
        </div>

        <span class="tag-badge <?php echo e($course['progress'] >= 80 ? 'tag-green' : ($course['progress'] >= 50 ? 'tag-purple' : 'tag-amber')); ?>">
          <?php echo e($course['progress']); ?>%
        </span>
      </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
      <div class="list-item">
        <div class="list-item-left">
          <div class="list-item-title">Abhi koi course available nahi hai</div>
          <div class="list-item-meta">Jaise hi enrollment hoga, yahan courses dikhne lagenge.</div>
        </div>
      </div>
      <?php endif; ?>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Student.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Aditya Pratap\Desktop\main_lms\resources\views\Student\courses.blade.php ENDPATH**/ ?>