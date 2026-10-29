<?php $__env->startSection('title','Settings'); ?>

<?php $__env->startSection('content'); ?>

<?php
$navItems = [
['bi-person-fill','Profile',true],
['bi-building','Organization',false],
['bi-shield-lock-fill','Security',false],
['bi-bell-fill','Notifications',false],
['bi-credit-card-fill','Billing',false],
['bi-palette-fill','Appearance',false],
['bi-plug-fill','Integrations',false],
['bi-people-fill','Team & Roles',false],
['bi-envelope-fill','Email Templates',false],
['bi-gear-wide-connected','Advanced',false],
];
?>

<main class="main-content">
  <div class="page-body">

    <div class="page-hdr">
      <div>
        <div class="breadcrumb-bar">
          <a href="<?php echo e(route('admin.dashboard')); ?>">Dashboard</a>
          <span>/</span><span>Settings</span>
        </div>
        <h1>Settings</h1>
        <p>Manage your account, platform preferences and integrations.</p>
      </div>

      <div class="page-hdr-right">
        <button class="btn btn-ghost btn-sm">
          <i class="bi bi-arrow-counterclockwise me-1"></i>Reset Theme
        </button>

        <button class="btn btn-primary btn-sm">
          <i class="bi bi-check2 me-1"></i>Save Changes
        </button>
      </div>
    </div>

    <div class="settings-layout">

      <!-- NAV -->
      <div class="settings-nav">
        <?php $__currentLoopData = $navItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i=>$n): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="settings-nav-item <?php echo e($n[2] ? 'active' : ''); ?>"
          onclick="activateTab(this,'sec<?php echo e($i); ?>')">
          <i class="bi <?php echo e($n[0]); ?>"></i> <?php echo e($n[1]); ?>

        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>

      <!-- CONTENT -->
      <div>

        <!-- PROFILE -->
        <div class="settings-section" id="sec0">
          <div class="settings-section-title">Profile Information</div>

          <div class="row g-3">
            <div class="col-md-6">
              <input type="text" class="form-control" value="Arjun">
            </div>

            <div class="col-md-6">
              <input type="text" class="form-control" value="Mehta">
            </div>
          </div>
        </div>

        <!-- ORGANIZATION -->
        <div class="settings-section" id="sec1" style="display:none">
          <input type="text" class="form-control" value="EduCore Academy">
        </div>

        <!-- SECURITY -->
        <div class="settings-section" id="sec2" style="display:none">
          <button class="btn btn-danger btn-sm">Revoke All</button>
        </div>

        <!-- NOTIFICATIONS -->
        <div class="settings-section" id="sec3" style="display:none">

          <?php
          $notifs = [
          ['New Enrollment','When student enrolls',true,true],
          ['Payment Received','Payment processed',true,true],
          ];
          ?>

          <?php $__currentLoopData = $notifs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $n): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <div><?php echo e($n[0]); ?></div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </div>

        <!-- BILLING -->
        <div class="settings-section" id="sec4" style="display:none">

          <?php
          $plans = [
          ['Starter','₹999/mo',false],
          ['Professional','₹2499/mo',true],
          ];
          ?>

          <?php $__currentLoopData = $plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <div><?php echo e($p[0]); ?> - <?php echo e($p[1]); ?></div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </div>

        <!-- TEAM -->
        <div class="settings-section" id="sec7" style="display:none">

          <?php
          $team = [
          [68,'Arjun Mehta','Super Admin','Active'],
          [25,'Neha Joshi','Manager','Active'],
          ];
          ?>

          <table class="table">
            <?php $__currentLoopData = $team; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
              <td><?php echo e($m[1]); ?></td>
              <td><?php echo e($m[2]); ?></td>
              <td><?php echo e($m[3]); ?></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </table>

        </div>

      </div>
    </div>

  </div>
</main>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
  function activateTab(el, sec) {
    document.querySelectorAll('.settings-section').forEach(s => s.style.display = 'none');
    document.getElementById(sec).style.display = 'block';
  }
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('Admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Aditya Pratap\Desktop\main_lms\resources\views\Admin\settings.blade.php ENDPATH**/ ?>