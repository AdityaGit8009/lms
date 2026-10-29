<?php
$nav = [
'MAIN' => [
['route' => 'admin.dashboard', 'icon' => 'bi-grid-1x2-fill', 'label' => 'Dashboard'],

[
'label' => 'Master Entry',
'icon' => 'bi-stack',
'submenu' => [
['route' => 'admin.roles', 'icon' => 'bi-person-badge-fill', 'label' => 'Roles'],
['route' => 'admin.sessions', 'icon' => 'bi-calendar-event', 'label' => 'Session'],
['route' => 'admin.programmes', 'icon' => 'bi-journal-text', 'label' => 'Programme'],
['route' => 'admin.technologies', 'icon' => 'bi-code-slash', 'label' => 'Technology'],
['route' => 'admin.batches', 'icon' => 'bi-box-seam', 'label' => 'Batch'],

['route' => 'admin.subjects', 'icon' => 'bi-book-half', 'label' => 'Subjects'],
['route' => 'admin.centers', 'icon' => 'bi-building', 'label' => 'Centers'],
['route' => 'admin.courses', 'icon' => 'bi-book', 'label' => 'Courses'],
['route' => 'admin.branches', 'icon' => 'bi-diagram-3-fill', 'label' => 'Branches']
]
],
[
'label' => 'Manage Users',
'icon' => 'bi-people-fill',
'submenu' => [
['route' => 'admin.students', 'icon' => 'bi-person-badge-fill', 'label' => 'Students'],
['route' => 'admin.employees', 'icon' => 'bi-person-badge-fill', 'label' => 'Employees']
]
],

['route' => 'admin.viewstudents', 'icon' => 'bi-person-badge-fill', 'label' => 'View Students'],


['route' => 'admin.addattandence', 'icon' => 'bi-person-badge-fill', 'label' => 'Add Attandence'],


['route' => 'admin.viewattandence', 'icon' => 'bi bi-calendar3', 'label' => 'View Attandence'],


[
'label' => 'Content Repository',
'icon' => 'bi bi-cloud-upload-fill',
'submenu' => [
['route' => 'upload-content.index', 'icon' => 'bi bi-upload', 'label' => 'Upload Content'],
['route' => 'admin.content-bundles.index', 'icon' => 'bi bi-eye', 'label' => 'Show Content'],
['route' => 'admin.subject-mocktest.index', 'icon' => 'bi bi-file-text', 'label' => 'Subject Mock Test'],

]
],
[
'label' => 'Manage Notification',
'icon' => 'bi bi-bell-fill',
'submenu' => [
['route' => 'admin.notification-heads.index', 'icon' => 'bi bi-upload', 'label' => 'Notification Head'],
['route' => 'admin.notifications.index', 'icon' => 'bi bi-plus', 'label' => 'Add Notification'],
['route' => 'admin.popup-notifications.index', 'icon' => 'bi bi-file-text', 'label' => 'Pop up Notification'],

]
],

[
'label' => 'Manage Feedbacks',
'icon' => 'bi bi-clipboard-data-fill',
'submenu' => [
['route' => 'admin.feedback.create', 'icon' => 'bi bi-plus-square-fill', 'label' => 'Create Feedback'],
['route' => 'admin.feedback.manage', 'icon' => 'bi bi-card-list', 'label' => 'All Feedback Forms'],
['route' => 'admin.feedback.overall.analytics', 'icon' => 'bi bi-bar-chart-fill', 'label' => 'Overall Analytics'],
],
],

[
'label' => 'Login Status',
'icon' => 'bi bi-clipboard-data-fill',
'submenu' => [
['route' => 'admin.student.login.status', 'icon' => 'bi bi-plus-square-fill', 'label' => 'Student Status'],

]
],











['route' => 'admin.instructors', 'icon' => 'bi-person-badge-fill', 'label' => 'Instructors'],
['route' => 'admin.schedule', 'icon' => 'bi-calendar3', 'label' => 'Schedule'],
['route' => 'admin.approvals', 'icon' => 'bi-person-check-fill', 'label' => 'Self Registration'],
],

'ANALYTICS' => [
['route' => 'admin.reports', 'icon' => 'bi-bar-chart-line-fill', 'label' => 'Reports'],
['route' => 'admin.revenue', 'icon' => 'bi-graph-up-arrow', 'label' => 'Revenue'],
['route' => 'admin.assessments', 'icon' => 'bi-clipboard-data-fill', 'label' => 'Assessments'],
],

'MANAGE' => [
['route' => 'admin.announcements', 'icon' => 'bi-megaphone-fill', 'label' => 'Announcements', 'badge' => '3'],
['route' => 'admin.add_course', 'icon' => 'bi-plus-circle-fill', 'label' => 'Add Course'],
['route' => 'admin.add_student', 'icon' => 'bi-person-plus-fill', 'label' => 'Add Student'],
['route' => 'admin.settings', 'icon' => 'bi-gear-fill', 'label' => 'Settings'],
],
];
?>

<aside class="sidebar" id="sidebar">
  <div class="sidebar-logo">
    <div class="logo-mark">EC</div>
    <div class="logo-name">Edu<span>Core</span></div>
  </div>

  <div class="sidebar-scroll">
    <?php $__currentLoopData = $nav; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section => $items): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="sidebar-section"><?php echo e($section); ?></div>

    <div class="nav-group">
      <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

      <?php if(isset($item['submenu'])): ?>
      <?php
      $isSubmenuActive = false;
      foreach ($item['submenu'] as $sub) {
      if (request()->routeIs($sub['route'])) {
      $isSubmenuActive = true;
      break;
      }
      }
      ?>

      <div class="nav-dropdown <?php echo e($isSubmenuActive ? 'open' : ''); ?>">
        <a href="javascript:void(0);" class="nav-link nav-toggle <?php echo e($isSubmenuActive ? 'active' : ''); ?>">
          <div class="d-flex align-items-center gap-2">
            <i class="bi <?php echo e($item['icon']); ?>"></i>
            <span class="nav-txt"><?php echo e($item['label']); ?></span>
          </div>
          <i class="bi bi-chevron-down dropdown-arrow"></i>
        </a>

        <div class="nav-submenu" style="<?php echo e($isSubmenuActive ? 'display:block;' : 'display:none;'); ?>">
          <?php $__currentLoopData = $item['submenu']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <a class="nav-sublink <?php echo e(request()->routeIs($subItem['route']) ? 'active' : ''); ?>"
            href="<?php echo e(route($subItem['route'])); ?>">
            <i class="bi <?php echo e($subItem['icon']); ?>"></i>
            <span><?php echo e($subItem['label']); ?></span>
          </a>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
      </div>
      <?php else: ?>
      <a class="nav-link <?php echo e(request()->routeIs($item['route']) ? 'active' : ''); ?>"
        href="<?php echo e(route($item['route'])); ?>">
        <i class="bi <?php echo e($item['icon']); ?>"></i>
        <span class="nav-txt"><?php echo e($item['label']); ?></span>

        <?php if(isset($item['badge'])): ?>
        <span class="nav-badge"><?php echo e($item['badge']); ?></span>
        <?php endif; ?>
      </a>
      <?php endif; ?>

      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <div class="nav-divider"></div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </div>

  <div class="sidebar-footer">
    <div class="profile-hover-box">
      <img
        src="<?php echo e(!empty(auth()->user()->image) && file_exists(public_path('uploads/' . auth()->user()->image))
                    ? asset('uploads/' . auth()->user()->image)
                    : asset('uploads/office-man.webp')); ?>"
        class="topbar-avatar ms-1"
        alt="Admin"
        id="profileAvatar"
        style="width:40px;height:40px;object-fit:center;border:4px solid rgb(0, 4, 255);" />
    </div>

    <div class="sf-meta">
      <div class="uname"><?php echo e($adminName ?? 'Admin'); ?></div>
      <div class="urole"><?php echo e(ucfirst($adminRole ?? 'admin')); ?></div>
    </div>
  </div>
</aside>
<?php $__env->startPush('scripts'); ?>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.nav-toggle').forEach(function(toggle) {
      toggle.addEventListener('click', function() {
        const parent = this.closest('.nav-dropdown');
        const submenu = parent.querySelector('.nav-submenu');

        if (parent.classList.contains('open')) {
          parent.classList.remove('open');
          submenu.style.display = 'none';
        } else {
          parent.classList.add('open');
          submenu.style.display = 'block';
        }
      });
    });
  });
</script>
<?php $__env->stopPush(); ?><?php /**PATH C:\Users\Aditya Pratap\Desktop\main_lms\resources\views\Admin\includes\sidebar.blade.php ENDPATH**/ ?>