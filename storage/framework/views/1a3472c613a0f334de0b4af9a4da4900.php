

<?php $__env->startSection('title', 'Feedback Form'); ?>

<?php $__env->startSection('content'); ?>
<div class="container py-4">
  <div class="card border-0 shadow-sm rounded-4 mb-4">
    <div class="card-body">
      <h2><?php echo e($form->title); ?></h2>
      <p class="text-muted mb-0"><?php echo e($form->description); ?></p>
    </div>
  </div>

  <form action="<?php echo e(route('student.feedback.store', $form->form_id)); ?>" method="POST">
    <?php echo csrf_field(); ?>

    <?php $__currentLoopData = ($form->questions_json ?? []); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $question): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="card border-0 shadow-sm rounded-4 mb-3">
      <div class="card-body">
        <label class="fw-bold d-block mb-3">
          <?php echo e($index + 1); ?>. <?php echo e($question['text'] ?? ''); ?>

        </label>

        <?php $name = "answers[{$question['uid']}]"; ?>

        <input type="hidden" name="<?php echo e($name); ?>[question]" value="<?php echo e($question['text'] ?? ''); ?>">
        <input type="hidden" name="<?php echo e($name); ?>[type]" value="<?php echo e($question['type'] ?? ''); ?>">

        <?php if(($question['type'] ?? '') === 'short_answer'): ?>
        <input type="text" name="<?php echo e($name); ?>[value]" class="form-control">
        <?php elseif(($question['type'] ?? '') === 'paragraph'): ?>
        <textarea name="<?php echo e($name); ?>[value]" class="form-control" rows="4"></textarea>
        <?php elseif(($question['type'] ?? '') === 'dropdown'): ?>
        <select name="<?php echo e($name); ?>[value]" class="form-select">
          <option value="">Select option</option>
          <?php $__currentLoopData = ($question['options'] ?? []); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <option value="<?php echo e($option); ?>"><?php echo e($option); ?></option>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
        <?php elseif(($question['type'] ?? '') === 'radio'): ?>
        <?php $__currentLoopData = ($question['options'] ?? []); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="form-check mb-2">
          <input class="form-check-input" type="radio" name="<?php echo e($name); ?>[value]" value="<?php echo e($option); ?>">
          <label class="form-check-label"><?php echo e($option); ?></label>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php elseif(($question['type'] ?? '') === 'checkbox'): ?>
        <?php $__currentLoopData = ($question['options'] ?? []); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="form-check mb-2">
          <input class="form-check-input" type="checkbox" name="<?php echo e($name); ?>[value][]" value="<?php echo e($option); ?>">
          <label class="form-check-label"><?php echo e($option); ?></label>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php elseif(($question['type'] ?? '') === 'rating'): ?>
        <select name="<?php echo e($name); ?>[value]" class="form-select">
          <option value="">Select rating</option>
          <option value="1">1 Star</option>
          <option value="2">2 Star</option>
          <option value="3">3 Star</option>
          <option value="4">4 Star</option>
          <option value="5">5 Star</option>
        </select>
        <?php endif; ?>
      </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <button type="submit" class="btn btn-primary">Submit Feedback</button>
  </form>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('student.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Aditya Pratap\Desktop\main_lms\resources\views\Student\feedback\show.blade.php ENDPATH**/ ?>