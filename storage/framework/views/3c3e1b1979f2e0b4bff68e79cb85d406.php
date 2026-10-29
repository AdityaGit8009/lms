

<?php $__env->startSection('title', 'Student Approvals'); ?>

<?php $__env->startSection('content'); ?>
<main class="main-content">
  <div class="page-body">

    <div class="page-hdr">
      <div>
        <div class="breadcrumb-bar">
          <a href="<?php echo e(route('admin.dashboard')); ?>">Dashboard</a>
          <span>/</span>
          <span>Student Approvals</span>
        </div>
        <h1>Student Approvals</h1>
        <p>Review and update student approval status from the registration pipeline.</p>
      </div>
    </div>

    <?php if(session('success')): ?>
    <div class="alert alert-success mb-3">
      <?php echo e(session('success')); ?>

    </div>
    <?php endif; ?>

    <?php if($errors->any()): ?>
    <div class="alert alert-danger mb-3">
      <?php echo e($errors->first()); ?>

    </div>
    <?php endif; ?>

    <div class="row">
      <div class="col-12">
        <div class="card d1">
          <div class="card-header">
            <div>
              <div class="card-title">All Registered Students</div>
              <div class="card-subtitle">Admin can update approval workflow directly from this screen.</div>
            </div>
          </div>

          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered table-striped align-middle" id="approvalTable">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>College</th>
                    <th>Email</th>
                    <th>Mobile</th>
                    <th>Course</th>
                    <th>Year</th>
                    <th>Program</th>
                    <th>Current Status</th>
                    <th style="min-width: 260px;">Update Status</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $__empty_1 = true; $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                  <?php
                  $status = $student->approval_status ?? 'Pending';
                  $badgeClass = 'bg-warning';

                  if ($status === 'Approved') {
                  $badgeClass = 'bg-success';
                  } elseif ($status === 'Rejected') {
                  $badgeClass = 'bg-danger';
                  }
                  ?>

                  <tr>
                    <td><?php echo e($student->id); ?></td>
                    <td><?php echo e($student->name); ?></td>
                    <td><?php echo e($student->college); ?></td>
                    <td><?php echo e($student->email); ?></td>
                    <td><?php echo e($student->mobile); ?></td>
                    <td><?php echo e($student->course_name); ?></td>
                    <td><?php echo e($student->year_name); ?></td>
                    <td><?php echo e($student->program_name); ?></td>
                    <td>
                      <span class="badge <?php echo e($badgeClass); ?>">
                        <?php echo e($status); ?>

                      </span>
                    </td>
                    <td>
                      <form action="<?php echo e(route('admin.approvals.updateStatus', $student->id)); ?>" method="POST" class="d-flex gap-2">
                        <?php echo csrf_field(); ?>

                        <select name="approval_status" class="form-select form-select-sm">
                          <option value="Pending" <?php echo e($status == 'Pending' ? 'selected' : ''); ?>>Pending</option>
                          <option value="Approved" <?php echo e($status == 'Approved' ? 'selected' : ''); ?>>Approved</option>
                          <option value="Rejected" <?php echo e($status == 'Rejected' ? 'selected' : ''); ?>>Rejected</option>
                        </select>

                        <button type="submit" class="btn btn-primary btn-sm">
                          Update
                        </button>
                      </form>
                    </td>
                  </tr>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                  <tr>
                    <td colspan="10" class="text-center text-muted">
                      No student records found.
                    </td>
                  </tr>
                  <?php endif; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</main>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Aditya Pratap\Desktop\main_lms\resources\views\Admin\student_approvals.blade.php ENDPATH**/ ?>