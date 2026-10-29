<?php $__env->startSection('title','Reports'); ?>

<?php $__env->startSection('content'); ?>
<?php
$kpis = [
['ic-accent','bi-people-fill','+640','New Enrollments','+8.4%',true],
['ic-green','bi-patch-check-fill','1,389','Completions','+3.2%',true],
['ic-amber','bi-clock-fill','4.2h','Avg Watch Time','+0.3h',true],
['ic-rose','bi-person-x-fill','12.3%','Drop-off Rate','-1.1%',false],
];
?>

<main class="main-content">
  <div class="page-body">

    <div class="page-hdr">
      <div>
        <div class="breadcrumb-bar">
          <a href="<?php echo e(route('admin.dashboard')); ?>">Dashboard</a>
          <span>/</span><span>Reports</span>
        </div>
        <h1>Analytics & Reports</h1>
      </div>
    </div>

    <div class="row g-3 mb-4">
      <?php $__currentLoopData = $kpis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <div class="col-xl-3">
        <div class="report-kpi">
          <i class="bi <?php echo e($k[1]); ?>"></i>
          <div><?php echo e($k[2]); ?></div>
          <small><?php echo e($k[3]); ?></small>
        </div>
      </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <div class="card">
      <div class="card-header">
        <div class="card-title">Course Report</div>
      </div>

      <div class="card-body">
        <table id="reportsTable" class="tbl">
          <thead>
            <tr>
              <th>Course</th>
              <th>Enrollments</th>
              <th>Revenue</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>React Masterclass</td>
              <td>1284</td>
              <td>₹3.2L</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

  </div>
</main>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
  initDataTable('reportsTable');
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('Admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Aditya Pratap\Desktop\main_lms\resources\views\Admin\reports.blade.php ENDPATH**/ ?>