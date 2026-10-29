<?php $__env->startSection('title','Students'); ?>

<?php $__env->startSection('content'); ?>

<?php
$students = [
[8,'Ankit Verma','ankit@email.com','Data Science Pro','Active','92%','9,840','24 Mar','batch-A'],
[5,'Priya Sharma','priya@email.com','React Masterclass','Active','78%','8,210','22 Mar','batch-B'],
[5,'Priya Sharma','priya@email.com','React Masterclass','Active','78%','8,210','22 Mar','batch-B'],
[9,'Sita Nair','sita@email.com','Python Beginners','Active','65%','7,560','20 Mar','batch-A'],
[15,'Rahul Tiwari','rahul@email.com','AWS Cloud Essentials','Active','54%','6,900','19 Mar','batch-C'],
];

$sm = [
'Active'=>'badge-green',
'Inactive'=>'badge-muted',
'Pending'=>'badge-amber'
];
?>

<main class="main-content">
  <div class="page-body">

    <!-- HEADER -->
    <div class="page-hdr">
      <div>
        <div class="breadcrumb-bar">
          <a href="<?php echo e(route('admin.dashboard')); ?>">Dashboard</a>
          <span>/</span><span>Students</span>
        </div>
        <h1>Students</h1>
        <p>Manage enrolled students</p>
      </div>

      <div class="page-hdr-right">
        <button class="btn btn-ghost btn-sm" data-bs-toggle="modal" data-bs-target="#bulkModal">
          Bulk Action
        </button>

        <a href="<?php echo e(route('admin.add_student')); ?>" class="btn btn-primary btn-sm">
          Add Student
        </a>
      </div>
    </div>

    <!-- SUMMARY -->
    <div class="summary-row">
      <?php $__currentLoopData = [
      ['8,472','Total Students'],
      ['7,210','Active'],
      ['892','Inactive'],
      ['370','Pending']
      ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <div class="summary-box">
        <div class="sb-val"><?php echo e($s[0]); ?></div>
        <div class="sb-lbl"><?php echo e($s[1]); ?></div>
      </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <!-- TABLE -->
    <div class="card">
      <div class="card-header">
        <div class="card-title">All Students</div>
      </div>

      <div class="card-body">

        <table id="studentsTable" class="table">

          <thead>
            <tr>
              <th>Student</th>
              <th>Email</th>
              <th>Course</th>
              <th>Progress</th>
              <th>XP</th>
              <th>Status</th>
              <th>Joined</th>
              <th>Batch</th>
              <th>Actions</th>
            </tr>
          </thead>

          <tbody>
            <?php $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>

              <td><?php echo e($s[1]); ?></td>
              <td><?php echo e($s[2]); ?></td>
              <td><?php echo e($s[3]); ?></td>

              <td><?php echo e($s[5]); ?></td>

              <td><?php echo e($s[6]); ?></td>

              <td>
                <span class="badge <?php echo e($sm[$s[4]]); ?>">
                  <?php echo e($s[4]); ?>

                </span>
              </td>

              <td><?php echo e($s[7]); ?></td>

              <td><?php echo e($s[8]); ?></td>

              <td>
                <button class="btn btn-sm">View</button>
              </td>

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
  initDataTable('studentsTable');
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('Admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Aditya Pratap\Desktop\main_lms\resources\views\Admin\students.blade.php ENDPATH**/ ?>