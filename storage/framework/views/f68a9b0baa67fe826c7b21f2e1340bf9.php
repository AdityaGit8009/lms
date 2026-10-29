

<?php $__env->startSection('title', 'Student Login Status'); ?>

<?php $__env->startSection('content'); ?>
<main class="main-content">
  <div class="page-body p-3">

    <div class="d-flex justify-content-between align-items-center mb-4">
      <div>
        <h1 class="mb-1">Student Login Status</h1>
        <p class="text-muted mb-0">Student login monitoring panel</p>
      </div>
    </div>

    <div class="card shadow-sm border-0 mb-4">
      <div class="card-body">
        <form method="GET" action="<?php echo e(route('admin.student.login.status')); ?>">
          <div class="row g-3">
            <div class="col-md-3">
              <label class="form-label">Center</label>
              <select name="center_id" class="form-select">
                <option value="">All</option>
                <?php $__currentLoopData = $centers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $center): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($center->center_id); ?>" <?php echo e(request('center_id') == $center->center_id ? 'selected' : ''); ?>>
                  <?php echo e($center->center_name); ?>

                </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </select>
            </div>

            <div class="col-md-3">
              <label class="form-label">Program</label>
              <select name="programme_id" class="form-select">
                <option value="">All</option>
                <?php $__currentLoopData = $programmes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $programme): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($programme->programme_id); ?>" <?php echo e(request('programme_id') == $programme->programme_id ? 'selected' : ''); ?>>
                  <?php echo e($programme->programme_name); ?>

                </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </select>
            </div>

            <div class="col-md-3">
              <label class="form-label">Technology</label>
              <select name="technology_id" class="form-select">
                <option value="">All</option>
                <?php $__currentLoopData = $technologies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $technology): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($technology->technology_id); ?>" <?php echo e(request('technology_id') == $technology->technology_id ? 'selected' : ''); ?>>
                  <?php echo e($technology->technology_name); ?>

                </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </select>
            </div>

            <div class="col-md-3">
              <label class="form-label">Batch</label>
              <select name="batch_id" class="form-select">
                <option value="">All</option>
                <?php $__currentLoopData = $batches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $batch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($batch->batch_id); ?>" <?php echo e(request('batch_id') == $batch->batch_id ? 'selected' : ''); ?>>
                  <?php echo e($batch->batch_name); ?>

                </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </select>
            </div>

            <div class="col-12">
              <button class="btn btn-primary">Filter</button>
              <a href="<?php echo e(route('admin.student.login.status')); ?>" class="btn btn-secondary">Reset</a>
            </div>
          </div>
        </form>
      </div>
    </div>

    <div class="card shadow-sm border-0">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered align-middle">
            <thead>
              <tr>
                <th>Sr. No.</th>
                <th>Student Name</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>Batch</th>
                <th>Last Login Date</th>
                <th>Last Login Time</th>
                <th>Status</th>
                <th>Logs</th>
              </tr>
            </thead>
            <tbody>
              <?php $__empty_1 = true; $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
              <tr>
                <td><?php echo e($students->firstItem() + $key); ?></td>
                <td><?php echo e($student->stu_name); ?></td>
                <td><?php echo e($student->stu_email); ?></td>
                <td><?php echo e($student->stu_mobile); ?></td>
                <td><?php echo e($student->batch_name ?? '-'); ?></td>
                <td><?php echo e($student->last_login_at ? \Carbon\Carbon::parse($student->last_login_at)->format('d-m-Y') : '-'); ?></td>
                <td><?php echo e($student->last_login_at ? \Carbon\Carbon::parse($student->last_login_at)->format('h:i A') : '-'); ?></td>
                <td>
                  <?php if($student->status === 'online'): ?>
                  <span class="badge bg-success">Online</span>
                  <?php else: ?>
                  <span class="badge bg-secondary">Offline</span>
                  <?php endif; ?>
                </td>
                <td>
                  <button class="btn btn-sm btn-primary viewLogsBtn"
                    data-url="<?php echo e(route('admin.student.login.logs', $student->stu_id)); ?>">
                    Logs
                  </button>
                </td>
              </tr>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
              <tr>
                <td colspan="9" class="text-center">No records found</td>
              </tr>
              <?php endif; ?>
            </tbody>
          </table>
        </div>

        <?php echo e($students->withQueryString()->links()); ?>

      </div>
    </div>
  </div>
</main>

<div class="modal fade" id="logsModal" tabindex="-1">
  <div class="modal-dialog modal-xl modal-dialog-scrollable">
    <div class="modal-content" id="logsModalContent"></div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const modal = new bootstrap.Modal(document.getElementById('logsModal'));
    const content = document.getElementById('logsModalContent');

    document.querySelectorAll('.viewLogsBtn').forEach(btn => {
      btn.addEventListener('click', function() {
        const url = this.dataset.url;
        content.innerHTML = '<div class="modal-body text-center p-5">Loading...</div>';
        modal.show();

        fetch(url)
          .then(res => res.text())
          .then(html => {
            content.innerHTML = html;
            bindFilter();
          });
      });
    });

    function bindFilter() {
      const form = document.getElementById('studentLogFilterForm');
      if (!form) return;

      form.addEventListener('submit', function(e) {
        e.preventDefault();
        const url = form.action + '?' + new URLSearchParams(new FormData(form)).toString();

        fetch(url)
          .then(res => res.text())
          .then(html => {
            content.innerHTML = html;
            bindFilter();
          });
      });
    }
  });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Aditya Pratap\Desktop\main_lms\resources\views\Admin\login_status\student_index.blade.php ENDPATH**/ ?>