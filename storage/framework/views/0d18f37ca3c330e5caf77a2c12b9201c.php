

<?php $__env->startSection('title', 'Edit Subject Mock Test'); ?>

<?php $__env->startPush('styles'); ?>
<style>
  .mock-card {
    border: 0;
    border-radius: 18px;
    box-shadow: 0 10px 30px rgba(15, 23, 42, .08)
  }

  .mock-card .card-body {
    padding: 24px
  }

  .form-control,
  .form-select {
    min-height: 46px;
    border-radius: 12px
  }

  .ck-editor__editable_inline {
    min-height: 320px
  }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<main class="main-content">
  <div class="page-body">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <div>
        <h1 class="mb-1 h4">Edit Subject Mock Test</h1>
        <p class="mb-0 text-muted">Update stored HTML in same single DB row.</p>
      </div>
      <a href="<?php echo e(route('admin.subject-mocktest.index')); ?>" class="btn btn-outline-secondary">Back</a>
    </div>

    <?php if(session('success')): ?>
    <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <div class="card mock-card">
      <div class="card-body">
        <form action="<?php echo e(route('admin.subject-mocktest.update', $mockTest->subject_mock_test_id)); ?>" method="POST" enctype="multipart/form-data" id="mockTestEditForm">
          <?php echo csrf_field(); ?>
          <?php echo method_field('PUT'); ?>

          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label">Subject Name <span class="text-danger">*</span></label>
              <select name="subject_id" class="form-select" required>
                <option value="">-- Select Subject --</option>
                <?php $__currentLoopData = $subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($subject->subject_id); ?>" <?php echo e(old('subject_id', $mockTest->subject_id) == $subject->subject_id ? 'selected' : ''); ?>>
                  <?php echo e($subject->subject_name); ?>

                </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </select>
              <?php $__errorArgs = ['subject_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="text-danger small mt-1"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="col-md-6">
              <label class="form-label">Mocktest Title <span class="text-danger">*</span></label>
              <input type="text" name="title" class="form-control" value="<?php echo e(old('title', $mockTest->title)); ?>" required>
              <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="text-danger small mt-1"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="col-md-6">
              <label class="form-label">Upload File (optional)</label>
              <input type="file" name="upload_file" class="form-control">
              <?php $__errorArgs = ['upload_file'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="text-danger small mt-1"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

              <?php if($mockTest->upload_file): ?>
              <div class="mt-2">
                Current File:
                <a href="<?php echo e(asset('uploads/mock-tests/' . $mockTest->upload_file)); ?>" target="_blank"><?php echo e($mockTest->upload_file); ?></a>
              </div>
              <?php endif; ?>
            </div>

            <div class="col-md-6">
              <label class="form-label">Enter Max Mark <span class="text-danger">*</span></label>
              <input type="number" name="max_marks" class="form-control" min="0" value="<?php echo e(old('max_marks', $mockTest->max_marks)); ?>" required>
              <?php $__errorArgs = ['max_marks'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="text-danger small mt-1"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="col-12">
              <label class="form-label">Questions / Content <span class="text-danger">*</span></label>
              <textarea name="mock_test" id="mock_test" class="form-control"><?php echo e(old('mock_test', $mockTest->mock_test)); ?></textarea>
              <?php $__errorArgs = ['mock_test'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="text-danger small mt-1"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
          </div>

          <div class="mt-4">
            <button type="submit" class="btn btn-primary">Update Mock Test</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</main>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<script>
  let mockEditor;
  ClassicEditor.create(document.querySelector('#mock_test'), {
    toolbar: [
      'heading', '|',
      'bold', 'italic', 'link', '|',
      'bulletedList', 'numberedList', '|',
      'blockQuote', 'insertTable', 'undo', 'redo'
    ]
  }).then(editor => {
    mockEditor = editor;
  }).catch(error => console.error(error));

  document.getElementById('mockTestEditForm').addEventListener('submit', function() {
    if (mockEditor) {
      document.getElementById('mock_test').value = mockEditor.getData();
    }
  });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('Admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Aditya Pratap\Desktop\main_lms\resources\views\Admin\Content\edit_subject_mock.blade.php ENDPATH**/ ?>