

<?php $__env->startSection('title', 'Password Badlein'); ?>
<?php $__env->startSection('page-title', 'Password Badlein'); ?>
<?php $__env->startSection('breadcrumb', 'Password Badlein'); ?>

<?php $__env->startPush('styles'); ?>
<?php echo $__env->make('Student.partials.page_theme_styles', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="page-shell">
  <div class="hero-card">
    <div class="hero-kicker">Security</div>
    <div class="hero-title">Password Badlein</div>
    <div class="hero-sub">
      Account security ko strong banaye rakhne ke liye apna password regularly update karein.
    </div>
  </div>

  <div class="soft-card">
    <div class="soft-card-title">Update Password</div>

    <form method="POST" action="#" class="form-grid">
      <?php echo csrf_field(); ?>

      <div class="field-group">
        <label>Current Password</label>
        <input type="password" name="current_password" placeholder="Current password enter karein">
      </div>

      <div class="field-group">
        <label>New Password</label>
        <input type="password" name="new_password" placeholder="New password enter karein">
      </div>

      <div class="field-group">
        <label>Confirm Password</label>
        <input type="password" name="new_password_confirmation" placeholder="Password dobara enter karein">
      </div>

      <div class="page-actions">
        <button type="submit" class="btn-soft">Update Password</button>
      </div>
    </form>
  </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Student.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Aditya Pratap\Desktop\main_lms\resources\views\Student\change_password.blade.php ENDPATH**/ ?>