

<?php $__env->startSection('title', 'Subject Mock Tests'); ?>

<?php $__env->startSection('content'); ?>
<main class="main-content">
  <div class="page-body">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <div>
        <h1 class="mb-1 h4">Subject Mock Tests</h1>
        <p class="mb-0 text-muted">All subject-wise mock tests.</p>
      </div>
      <a href="<?php echo e(route('admin.subject-mocktest.create')); ?>" class="btn btn-primary">+ Add Mock Test</a>
    </div>

    <?php if(session('success')): ?>
    <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <div class="card border-0 shadow-sm rounded-4">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered align-middle">
            <thead class="table-light">
              <tr>
                <th>#</th>
                <th>Subject</th>
                <th>Title</th>
                <th>Max Marks</th>
                <th>File</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php $__empty_1 = true; $__currentLoopData = $mockTests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
              <tr>
                <td><?php echo e($key + 1); ?></td>
                <td><?php echo e($row->subject_name ?? '-'); ?></td>
                <td><?php echo e($row->title); ?></td>
                <td><?php echo e($row->max_marks); ?></td>
                <td>
                  <?php if($row->upload_file): ?>
                  <a href="<?php echo e(asset('uploads/mock-tests/' . $row->upload_file)); ?>" target="_blank">View File</a>
                  <?php else: ?>
                  -
                  <?php endif; ?>
                </td>
                <td class="d-flex gap-2">
                  <a href="<?php echo e(route('admin.subject-mocktest.show', $row->subject_mock_test_id)); ?>" class="btn btn-sm btn-primary">View</a>
                  <a href="<?php echo e(route('admin.subject-mocktest.edit', $row->subject_mock_test_id)); ?>" class="btn btn-sm btn-warning text-dark">Edit</a>
                  <form action="<?php echo e(route('admin.subject-mocktest.delete', $row->subject_mock_test_id)); ?>" method="POST" onsubmit="return confirm('Delete this mock test?')">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                  </form>
                </td>
              </tr>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
              <tr>
                <td colspan="6" class="text-center text-muted">No mock test found.</td>
              </tr>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</main>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Aditya Pratap\Desktop\main_lms\resources\views\Admin\Content\list_subject_mock.blade.php ENDPATH**/ ?>