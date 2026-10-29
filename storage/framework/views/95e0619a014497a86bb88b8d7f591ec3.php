<?php $__env->startSection('title','Revenue'); ?>

<?php $__env->startSection('content'); ?>
<?php
$transactions = [
['Priya Sharma','React Masterclass','₹3,200','UPI','23 Mar','Paid','badge-green'],
['Ankit Verma','Data Science Pro','₹5,600','Card','23 Mar','Paid','badge-green'],
['Deepak Kumar','Digital Marketing','₹900','UPI','22 Mar','Pending','badge-amber'],
];
?>

<main class="main-content">
  <div class="page-body">

    <div class="page-hdr">
      <div>
        <div class="breadcrumb-bar">
          <a href="<?php echo e(route('admin.dashboard')); ?>">Dashboard</a>
          <span>/</span><span>Revenue</span>
        </div>
        <h1>Revenue & Payouts</h1>
      </div>
    </div>

    <!-- STATS -->
    <div class="row g-3 mb-4">
      <div class="col-xl-3">
        <div class="rev-stat">
          <div>₹2,12,400</div>
          <small>Monthly Revenue</small>
        </div>
      </div>
    </div>

    <!-- TABLE -->
    <div class="card">
      <div class="card-header">
        <div class="card-title">Transactions</div>
      </div>

      <div class="card-body">
        <table id="transTable" class="tbl">
          <thead>
            <tr>
              <th>Student</th>
              <th>Course</th>
              <th>Amount</th>
              <th>Status</th>
            </tr>
          </thead>

          <tbody>
            <?php $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
              <td><?php echo e($t[0]); ?></td>
              <td><?php echo e($t[1]); ?></td>
              <td><?php echo e($t[2]); ?></td>
              <td><span class="badge <?php echo e($t[6]); ?>"><?php echo e($t[5]); ?></span></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </tbody>
        </table>
      </div>
    </div>

  </div>
</main>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
  initDataTable('transTable');
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('Admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Aditya Pratap\Desktop\main_lms\resources\views\Admin\revenue.blade.php ENDPATH**/ ?>