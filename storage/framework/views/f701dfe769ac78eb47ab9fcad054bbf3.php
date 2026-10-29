

<?php $__env->startSection('title', 'View Subject Mock Test'); ?>

<?php $__env->startSection('content'); ?>
<main class="main-content">
  <div class="page-body">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <div>
        <h1 class="mb-1 h4">View Mock Test</h1>
        <p class="mb-0 text-muted">Single row stored mock test content.</p>
      </div>
      <div class="d-flex gap-2">
        <a href="<?php echo e(route('admin.subject-mocktest.edit', $mockTest->subject_mock_test_id)); ?>" class="btn btn-warning text-dark">Edit</a>
        <a href="<?php echo e(route('admin.subject-mocktest.index')); ?>" class="btn btn-outline-secondary">Back</a>
      </div>
    </div>

    <?php if(session('success')): ?>
    <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <div class="card border-0 shadow-sm rounded-4">
      <div class="card-body">
        <div class="row g-3 mb-4">
          <div class="col-md-4"><strong>Subject:</strong> <?php echo e($mockTest->subject_name ?? '-'); ?></div>
          <div class="col-md-4"><strong>Title:</strong> <?php echo e($mockTest->title); ?></div>
          <div class="col-md-4"><strong>Max Marks:</strong> <?php echo e($mockTest->max_marks); ?></div>
        </div>

        <?php if($mockTest->upload_file): ?>
        <div class="mb-3">
          <strong>Attachment:</strong>
          <a href="<?php echo e(asset('uploads/mock-tests/' . $mockTest->upload_file)); ?>" target="_blank">Open File</a>
        </div>
        <?php endif; ?>

        <div class="border rounded-4 p-3 bg-white">
          <?php echo $mockTest->mock_test; ?>

        </div>
      </div>
    </div>
  </div>
</main>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Aditya Pratap\Desktop\main_lms\resources\views\Admin\Content\show_subject_mock.blade.php ENDPATH**/ ?>