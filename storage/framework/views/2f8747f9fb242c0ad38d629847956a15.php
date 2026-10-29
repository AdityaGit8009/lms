

<?php $__env->startSection('title','Master Entry'); ?>

<?php $__env->startSection('content'); ?>

<main class="main-content">
  <div class="page-body">

    <!-- HEADER -->
    <div class="page-hdr">
      <div>
        <div class="breadcrumb-bar">
          <a href="<?php echo e(route('admin.dashboard')); ?>">Dashboard</a>
          <span>/</span>
          <span>Master Entry</span>
        </div>
        <h1>Master Entry</h1>
        <p>Manage all master data like categories, batches, roles and configurations.</p>
      </div>
    </div>

    <!-- CARDS -->
    <div class="row g-3 mb-4">
      
    </div>

  </div>
</main>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    if (typeof initDataTable === 'function') {
      initDataTable('masterTable');
    }
  });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('Admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Aditya Pratap\Desktop\main_lms\resources\views\Admin\masterentry.blade.php ENDPATH**/ ?>