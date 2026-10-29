<?php $__env->startSection('title', 'Instructors'); ?>

<?php $__env->startSection('content'); ?>
<?php
$instructors = [
[68,'Ravi Kumar','ravi.kumar@educore.in','+91 98100 11111','Senior Developer',['React','Node.js','MongoDB'],4.9,3,1284,'₹48K','active'],
[25,'Neha Joshi','neha.joshi@educore.in','+91 98100 22222','UX Designer',['Figma','UX Research','Design'],4.7,2,876,'₹28K','active'],
[31,'Amit Patel','amit.patel@educore.in','+91 98100 33333','Data Scientist',['Python','ML','Statistics'],4.9,2,2103,'₹62K','active'],
[47,'Sunita Rao','sunita.rao@educore.in','+91 98100 44444','Marketing Expert',['SEO','PPC','Social Media'],4.4,1,567,'₹18K','inactive'],
[52,'Karan Gupta','karan.gupta@educore.in','+91 98100 55555','Python Engineer',['Python','Django','REST API'],4.8,2,3418,'₹54K','active'],
];

$smap = ['active'=>'badge-green','inactive'=>'badge-muted'];

$stats = [
['ic-accent','bi-person-badge-fill','28','Total Instructors'],
['ic-green','bi-patch-check-fill','24','Active'],
['ic-amber','bi-star-fill','4.67','Avg Rating'],
['ic-sky','bi-currency-rupee','₹2.9L','Monthly Payouts']
];
?>

<main class="main-content">
  <div class="page-body">

    <div class="page-hdr">
      <div>
        <div class="breadcrumb-bar">
          <a href="<?php echo e(route('admin.dashboard')); ?>">Dashboard</a>
          <span>/</span>
          <span>Instructors</span>
        </div>
        <h1>Instructors</h1>
        <p>Manage teaching staff, courses and payout information.</p>
      </div>

      <div class="page-hdr-right">
        <button class="btn btn-ghost btn-sm" onclick="showToast('Email sent','info')">
          <i class="bi bi-envelope me-1"></i>Email All
        </button>
        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addInstructorModal">
          <i class="bi bi-person-plus-fill me-1"></i>Add Instructor
        </button>
      </div>
    </div>

    <!-- STATS -->
    <div class="row g-3 mb-4">
      <?php $__currentLoopData = $stats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <div class="col-6 col-xl-3">
        <div class="card d-flex flex-row align-items-center gap-3 p-3">
          <div class="icon-circle ic-48 <?php echo e($s[0]); ?>">
            <i class="bi <?php echo e($s[1]); ?>"></i>
          </div>
          <div>
            <div class="fw-700" style="font-size:1.5rem"><?php echo e($s[2]); ?></div>
            <div class="text-xs text-muted"><?php echo e($s[3]); ?></div>
          </div>
        </div>
      </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <!-- CARDS -->
    <div class="row g-3 mb-4">
      <?php $__currentLoopData = $instructors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $ins): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <div class="col-md-6 col-xl-3">
        <div class="instructor-card">
          <span class="badge <?php echo e($smap[$ins[10]]); ?>"><?php echo e(ucfirst($ins[10])); ?></span>

          <img src="https://i.pravatar.cc/100?img=<?php echo e($ins[0]); ?>">

          <div class="ic-name"><?php echo e($ins[1]); ?></div>
          <div class="ic-role"><?php echo e($ins[4]); ?></div>

          <div class="ic-rating">
            <i class="bi bi-star-fill"></i> <?php echo e($ins[6]); ?>

          </div>

          <div class="ic-stats">
            <div>
              <div><?php echo e(number_format($ins[8])); ?></div>
              <small>Students</small>
            </div>
            <div>
              <div><?php echo e($ins[7]); ?></div>
              <small>Courses</small>
            </div>
            <div>
              <div><?php echo e($ins[9]); ?></div>
              <small>Earned</small>
            </div>
          </div>

          <div class="ic-tags">
            <?php $__currentLoopData = $ins[5]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <span class="ic-tag"><?php echo e($tag); ?></span>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </div>
        </div>
      </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <!-- TABLE -->
    <div class="card">
      <div class="card-header">
        <div class="card-title">All Instructors</div>
      </div>

      <div class="card-body">
        <table id="instructorsTable" class="tbl">
          <thead>
            <tr>
              <th>Name</th>
              <th>Email</th>
              <th>Courses</th>
              <th>Students</th>
              <th>Status</th>
            </tr>
          </thead>

          <tbody>
            <?php $__currentLoopData = $instructors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ins): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
              <td><?php echo e($ins[1]); ?></td>
              <td><?php echo e($ins[2]); ?></td>
              <td><?php echo e($ins[7]); ?></td>
              <td><?php echo e(number_format($ins[8])); ?></td>
              <td>
                <span class="badge <?php echo e($smap[$ins[10]]); ?>">
                  <?php echo e(ucfirst($ins[10])); ?>

                </span>
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
  document.addEventListener('DOMContentLoaded', function() {
    if (typeof initDataTable === 'function') {
      initDataTable('instructorsTable');
    }
  });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('Admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Aditya Pratap\Desktop\main_lms\resources\views\Admin\instructors.blade.php ENDPATH**/ ?>