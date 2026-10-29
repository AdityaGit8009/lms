<?php echo $__env->make('Admin.includes.head', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>;
<?php echo $__env->make('Admin.includes.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>;
<?php echo $__env->make('Admin.includes.topbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>;
<?php echo $__env->yieldContent('content'); ?>

<?php echo $__env->yieldPushContent('scripts'); ?>
<?php echo $__env->make('Admin.includes.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>;<?php /**PATH C:\Users\Aditya Pratap\Desktop\main_lms\resources\views/Admin/layouts/app.blade.php ENDPATH**/ ?>