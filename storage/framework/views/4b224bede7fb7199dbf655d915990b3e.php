

<?php $__env->startSection('title', 'Profile'); ?>
<?php $__env->startSection('page-title', 'Profile'); ?>
<?php $__env->startSection('breadcrumb', 'Profile'); ?>

<?php $__env->startPush('styles'); ?>
<?php echo $__env->make('Student.partials.page_theme_styles', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="page-shell">
  <div class="hero-card">
    <div class="hero-kicker">Identity</div>
    <div class="hero-title">Student Profile</div>
    <div class="hero-sub">
      Aapki personal, academic aur program details yahan available hain.
    </div>
  </div>

  <div class="profile-grid">
    <div class="profile-panel">
      <div class="avatar-lg"><?php echo e(strtoupper(substr($student->name ?? 'S', 0, 2))); ?></div>
      <div style="font-size:18px;font-weight:700;margin-bottom:6px;"><?php echo e($student->name); ?></div>
      <div style="font-size:12px;color:var(--text-2);margin-bottom:14px;">Student</div>
      <div class="list-item-meta">
        <?php echo e($student->email); ?><br>
        <?php echo e($student->mobile); ?>

      </div>
    </div>

    <div class="profile-panel">
      <div class="soft-card-title">Profile Details</div>
      <div class="kv-grid">
        <div class="kv-box">
          <div class="kv-label">College</div>
          <div class="kv-value"><?php echo e($student->college); ?></div>
        </div>
        <div class="kv-box">
          <div class="kv-label">Registration No.</div>
          <div class="kv-value"><?php echo e($student->regno); ?></div>
        </div>
        <div class="kv-box">
          <div class="kv-label">Course</div>
          <div class="kv-value"><?php echo e($student->course_name); ?></div>
        </div>
        <div class="kv-box">
          <div class="kv-label">Year</div>
          <div class="kv-value"><?php echo e($student->year_name); ?></div>
        </div>
        <div class="kv-box">
          <div class="kv-label">Program</div>
          <div class="kv-value"><?php echo e($student->program_name); ?></div>
        </div>
        <div class="kv-box">
          <div class="kv-label">Location</div>
          <div class="kv-value"><?php echo e($student->location_name); ?></div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Student.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Aditya Pratap\Desktop\main_lms\resources\views\Student\profile.blade.php ENDPATH**/ ?>