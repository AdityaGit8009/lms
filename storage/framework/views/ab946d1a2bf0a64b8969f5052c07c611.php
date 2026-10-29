<div class="modal-header">
  <h5 class="modal-title">Login Logs - <?php echo e($student->stu_name); ?></h5>
  <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
</div>

<div class="modal-body">
  <div class="row g-3 mb-4">
    <div class="col-md-6">
      <div class="card border-0 bg-light">
        <div class="card-body">
          <h6 class="text-muted">Total Session</h6>
          <h4><?php echo e($totalSessions); ?></h4>
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <div class="card border-0 bg-light">
        <div class="card-body">
          <h6 class="text-muted">Total Active Time</h6>
          <h4><?php echo e($totalActiveTime); ?></h4>
        </div>
      </div>
    </div>
  </div>

  <form id="studentLogFilterForm" action="<?php echo e(route('admin.student.login.logs', $student->stu_id)); ?>" method="GET">
    <div class="row g-3 mb-4">
      <div class="col-md-4">
        <label class="form-label">Date</label>
        <input type="date" name="date" class="form-control" value="<?php echo e(request('date')); ?>">
      </div>
      <div class="col-md-3">
        <label class="form-label">From</label>
        <input type="date" name="from_date" class="form-control" value="<?php echo e(request('from_date')); ?>">
      </div>
      <div class="col-md-3">
        <label class="form-label">To</label>
        <input type="date" name="to_date" class="form-control" value="<?php echo e(request('to_date')); ?>">
      </div>
      <div class="col-md-2">
        <label class="form-label d-block">&nbsp;</label>
        <button type="submit" class="btn btn-primary w-100">Filter</button>
      </div>
    </div>
  </form>

  <div class="table-responsive">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>#</th>
          <th>Login</th>
          <th>Logout</th>
          <th>Last Seen</th>
          <th>Session Time</th>
          <th>Status</th>
          <th>IP</th>
        </tr>
      </thead>
      <tbody>
        <?php $__empty_1 = true; $__currentLoopData = $logs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <?php
        $start = $log->login_at ? \Carbon\Carbon::parse($log->login_at) : null;
        $end = $log->logout_at
        ? \Carbon\Carbon::parse($log->logout_at)
        : ($log->last_seen_at ? \Carbon\Carbon::parse($log->last_seen_at) : now());
        $minutes = $start ? $start->diffInMinutes($end) : 0;
        ?>
        <tr>
          <td><?php echo e($i + 1); ?></td>
          <td><?php echo e($log->login_at ? \Carbon\Carbon::parse($log->login_at)->format('d-m-Y h:i A') : '-'); ?></td>
          <td><?php echo e($log->logout_at ? \Carbon\Carbon::parse($log->logout_at)->format('d-m-Y h:i A') : '-'); ?></td>
          <td><?php echo e($log->last_seen_at ? \Carbon\Carbon::parse($log->last_seen_at)->format('d-m-Y h:i A') : '-'); ?></td>
          <td><?php echo e(floor($minutes/60)); ?>h <?php echo e($minutes%60); ?>m</td>
          <td>
            <?php if($log->status === 'online'): ?>
            <span class="badge bg-success">Online</span>
            <?php else: ?>
            <span class="badge bg-secondary">Offline</span>
            <?php endif; ?>
          </td>
          <td><?php echo e($log->ip_address ?? '-'); ?></td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <tr>
          <td colspan="7" class="text-center">No logs found</td>
        </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div><?php /**PATH C:\Users\Aditya Pratap\Desktop\main_lms\resources\views\Admin\login_status\student_logs_modal.blade.php ENDPATH**/ ?>