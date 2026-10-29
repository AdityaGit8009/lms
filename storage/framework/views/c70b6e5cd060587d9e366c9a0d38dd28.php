

<?php $__env->startSection('title', 'Upload Content'); ?>

<?php $__env->startPush('styles'); ?>
<style>
  .upload-card {
    border: 0;
    border-radius: 18px;
    box-shadow: 0 10px 30px rgba(15, 23, 42, 0.08);
    overflow: hidden;
    background: #fff;
  }

  .upload-card .card-body {
    padding: 1.5rem;
  }

  .wizard-header {
    display: grid;
    grid-template-columns: repeat(7, 1fr);
    gap: 12px;
    margin-bottom: 24px;
  }

  .wizard-tab {
    border: 1px solid #e5e7eb;
    background: #fff;
    border-radius: 14px;
    padding: 12px 10px;
    display: flex;
    align-items: center;
    gap: 10px;
    cursor: pointer;
    transition: 0.25s ease;
    min-height: 64px;
  }

  .wizard-tab.active {
    border-color: #1677ff;
    background: #eef5ff;
    box-shadow: 0 8px 20px rgba(22, 119, 255, 0.10);
  }

  .wizard-tab.completed {
    border-color: #16a34a;
    background: #effdf4;
  }

  .wizard-step-no {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    background: #f3f4f6;
    color: #111827;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 13px;
    font-weight: 700;
    flex-shrink: 0;
  }

  .wizard-tab.active .wizard-step-no {
    background: #1677ff;
    color: #fff;
  }

  .wizard-tab.completed .wizard-step-no {
    background: #16a34a;
    color: #fff;
  }

  .wizard-tab-text {
    display: flex;
    flex-direction: column;
    line-height: 1.2;
  }

  .wizard-tab-text strong {
    font-size: 13px;
    color: #111827;
  }

  .wizard-tab-text span {
    font-size: 11px;
    color: #6b7280;
  }

  .wizard-pane {
    display: none;
    border: 1px solid #e5e7eb;
    border-radius: 16px;
    padding: 20px;
    background: #fff;
  }

  .wizard-pane.active {
    display: block;
  }

  .pane-title {
    font-size: 18px;
    font-weight: 700;
    color: #1677ff;
    margin-bottom: 18px;
  }

  .form-label {
    font-size: 13px;
    font-weight: 600;
    color: #667085;
    margin-bottom: 8px;
  }

  .form-control,
  .form-select {
    min-height: 46px;
    border-radius: 12px;
    border: 1px solid #d0d5dd;
    box-shadow: none !important;
  }

  .form-control:focus,
  .form-select:focus {
    border-color: #0ea5e9;
    box-shadow: 0 0 0 4px rgba(14, 165, 233, 0.10) !important;
  }

  .add-topic-link {
    display: inline-block;
    margin-top: 8px;
    font-size: 13px;
    font-weight: 600;
    color: #0d6efd;
    text-decoration: none;
  }

  .add-topic-link:hover {
    text-decoration: underline;
    color: #0b5ed7;
  }

  .help-text {
    display: block;
    margin-top: 6px;
    font-size: 12px;
    color: #6b7280;
  }

  .error-text {
    color: #dc3545;
    font-size: 13px;
    margin-top: 5px;
  }

  .wizard-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 24px;
    gap: 12px;
    flex-wrap: wrap;
  }

  .wizard-footer .btn {
    min-width: 130px;
    border-radius: 10px;
    font-weight: 600;
  }

  .wizard-actions-right {
    display: flex;
    gap: 12px;
    flex-wrap: wrap;
  }

  .modal-content {
    border: 0;
    border-radius: 16px;
    overflow: hidden;
  }

  .modal-header,
  .modal-footer {
    border-color: #eef2f7;
  }

  .ck-editor__editable_inline {
    min-height: 220px;
  }

  .test-box {
    border: 1px dashed #d0d5dd;
    border-radius: 14px;
    padding: 16px;
    margin-bottom: 18px;
    background: #fafcff;
  }

  .question-card {
    border: 1px solid #e5e7eb;
    border-radius: 14px;
    padding: 16px;
    margin-bottom: 16px;
    background: #fff;
  }

  .question-card h6 {
    margin-bottom: 14px;
    font-weight: 700;
  }

  .hidden-block {
    display: none;
  }

  @media (max-width: 1399px) {
    .wizard-header {
      grid-template-columns: repeat(4, 1fr);
    }
  }

  @media (max-width: 991px) {
    .wizard-header {
      grid-template-columns: repeat(2, 1fr);
    }
  }

  @media (max-width: 767px) {
    .wizard-header {
      grid-template-columns: repeat(1, 1fr);
    }

    .wizard-footer {
      flex-direction: column;
      align-items: stretch;
    }

    .wizard-actions-right {
      width: 100%;
    }

    .wizard-actions-right .btn,
    .wizard-footer .btn {
      width: 100%;
    }
  }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<main class="main-content">
  <div class="page-body">
    <div class="page-hdr mb-4">
      <div>
        <h1>Upload Content</h1>
        <p class="mb-0">Create learning content, assignments, recording and tests.</p>
      </div>
    </div>

    <div class="card upload-card">
      <div class="card-body">

        <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
        <?php endif; ?>

        <?php if(session('error')): ?>
        <div class="alert alert-danger"><?php echo e(session('error')); ?></div>
        <?php endif; ?>

        <div class="wizard-header" id="wizardTabs">
          <button type="button" class="wizard-tab active" data-step="1">
            <span class="wizard-step-no">1</span>
            <span class="wizard-tab-text">
              <strong>Basic</strong>
              <span>Subject, topic, title</span>
            </span>
          </button>

          <button type="button" class="wizard-tab" data-step="2">
            <span class="wizard-step-no">2</span>
            <span class="wizard-tab-text">
              <strong>Objective</strong>
              <span>Learning objective</span>
            </span>
          </button>

          <button type="button" class="wizard-tab" data-step="3">
            <span class="wizard-step-no">3</span>
            <span class="wizard-tab-text">
              <strong>Content</strong>
              <span>Resources</span>
            </span>
          </button>

          <button type="button" class="wizard-tab" data-step="4">
            <span class="wizard-step-no">4</span>
            <span class="wizard-tab-text">
              <strong>Assignments</strong>
              <span>Question wise split</span>
            </span>
          </button>

          <button type="button" class="wizard-tab" data-step="5">
            <span class="wizard-step-no">5</span>
            <span class="wizard-tab-text">
              <strong>Recording</strong>
              <span>Recording task</span>
            </span>
          </button>



          <button type="button" class="wizard-tab" data-step="6">
            <span class="wizard-step-no">6</span>
            <span class="wizard-tab-text">
              <strong>Outcomes</strong>
              <span>Learning outcomes</span>
            </span>
          </button>


          <button type="button" class="wizard-tab" data-step="7">
            <span class="wizard-step-no">7</span>
            <span class="wizard-tab-text">
              <strong>Test</strong>
              <span>Mock & online</span>
            </span>
          </button>

        </div>

        <form action="<?php echo e(route('admin.upload-content.store')); ?>" method="POST" enctype="multipart/form-data" id="uploadContentForm">
          <?php echo csrf_field(); ?>

          <div class="wizard-pane active" data-step="1">
            <div class="pane-title">Step 1: Basic Details</div>

            <div class="row g-3">
              <div class="col-lg-6 col-md-6">
                <label class="form-label">Subject Name</label>
                <select name="subject_id" id="subject_id" class="form-select" required>
                  <option value="">Select Subject</option>
                  <?php $__currentLoopData = $subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <option value="<?php echo e($subject->subject_id); ?>" <?php echo e(old('subject_id') == $subject->subject_id ? 'selected' : ''); ?>>
                    <?php echo e($subject->subject_name); ?>

                  </option>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php $__errorArgs = ['subject_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="error-text"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
              </div>

              <div class="col-lg-6 col-md-6">
                <label class="form-label">Topic</label>
                <select name="topic_id" id="topic_id" class="form-select" data-old-topic="<?php echo e(old('topic_id')); ?>" required>
                  <option value="">Select Topic</option>
                  <?php if(isset($oldTopics) && $oldTopics->count()): ?>
                  <?php $__currentLoopData = $oldTopics; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $topic): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <option value="<?php echo e($topic->topic_id); ?>" <?php echo e(old('topic_id') == $topic->topic_id ? 'selected' : ''); ?>>
                    <?php echo e($topic->topic_name); ?>

                  </option>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  <?php endif; ?>
                </select>

                <a href="javascript:void(0)" class="add-topic-link" id="openTopicModal">+ Add Topic</a>

                <?php $__errorArgs = ['topic_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="error-text"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
              </div>

              <div class="col-12">
                <label class="form-label">Title</label>
                <input type="text" name="title" id="title" class="form-control" placeholder="Enter Title" value="<?php echo e(old('title')); ?>" required>
                <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="error-text"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
              </div>
            </div>
          </div>

          <div class="wizard-pane" data-step="2">
            <div class="pane-title">Step 2: Learning Objective</div>
            <div class="row g-3">
              <div class="col-12">
                <label class="form-label">Learning Objective</label>
                <textarea name="learning_objective" id="learning_objective" class="form-control ckeditor-field"><?php echo e(old('learning_objective')); ?></textarea>
                <?php $__errorArgs = ['learning_objective'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="error-text"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
              </div>
            </div>
          </div>

          <div class="wizard-pane" data-step="3">
            <div class="pane-title">Step 3: Content & Resources</div>
            <div class="row g-3">
              <div class="col-12">
                <label class="form-label">Content</label>
                <textarea name="content_body" id="content_body" class="form-control ckeditor-field"><?php echo e(old('content_body')); ?></textarea>
                <?php $__errorArgs = ['content_body'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="error-text"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
              </div>

              <div class="col-12">
                <label class="form-label">Upload File</label>
                <input type="file" name="resource_file" class="form-control">
                <?php $__errorArgs = ['resource_file'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="error-text"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
              </div>

              <div class="col-12">
                <label class="form-label">Video Link</label>
                <input type="text" name="video_link" class="form-control" placeholder="Paste Video Link (e.g., YouTube)" value="<?php echo e(old('video_link')); ?>">
                <?php $__errorArgs = ['video_link'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="error-text"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
              </div>
            </div>
          </div>

          <div class="wizard-pane" data-step="4">
            <div class="pane-title">Step 4: Assignments</div>
            <div class="row g-3">
              <div class="col-12">
                <label class="form-label">Trainer Task</label>
                <textarea name="trainer_task" id="trainer_task" class="form-control ckeditor-field"><?php echo e(old('trainer_task')); ?></textarea>
                <?php $__errorArgs = ['trainer_task'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="error-text"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
              </div>

              <div class="col-12">
                <label class="form-label">Assignment Questions</label>
                <textarea name="assignment_questions" id="assignment_questions" class="form-control ckeditor-field"><?php echo e(old('assignment_questions')); ?></textarea>
                <small class="help-text">Numbered list ya bullet list me likho. Har item alag row me save hoga.</small>
                <?php $__errorArgs = ['assignment_questions'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="error-text"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
              </div>

              <div class="col-md-6">
                <label class="form-label">Assignment File</label>
                <input type="file" name="assignment_file" class="form-control">
                <?php $__errorArgs = ['assignment_file'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="error-text"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
              </div>

              <div class="col-md-3">
                <label class="form-label">Max Marks</label>
                <input type="number" name="max_marks" class="form-control" min="0" value="<?php echo e(old('max_marks')); ?>">
                <?php $__errorArgs = ['max_marks'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="error-text"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
              </div>

              <div class="col-md-3">
                <label class="form-label">Due Date</label>
                <input type="date" name="due_date" class="form-control" value="<?php echo e(old('due_date')); ?>">
                <?php $__errorArgs = ['due_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="error-text"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
              </div>
            </div>
          </div>

          <div class="wizard-pane" data-step="5">
            <div class="pane-title">Step 5: Recording</div>
            <div class="row g-3">
              <div class="col-12">
                <label class="form-label">Video Recording</label>
                <textarea name="video_recording" id="video_recording" class="form-control ckeditor-field"><?php echo e(old('video_recording')); ?></textarea>
                <small class="help-text">Numbered list ya bullet list me likho. Har item alag row me save hoga.</small>
                <?php $__errorArgs = ['video_recording'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="error-text"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
              </div>

              <div class="col-md-6">
                <label class="form-label">Recording Max Marks</label>
                <input type="number" name="recording_max_marks" class="form-control" min="0" value="<?php echo e(old('recording_max_marks')); ?>">
                <?php $__errorArgs = ['recording_max_marks'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="error-text"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
              </div>

              <div class="col-md-6">
                <label class="form-label">Recording Due Date</label>
                <input type="date" name="recording_due_date" class="form-control" value="<?php echo e(old('recording_due_date')); ?>">
                <?php $__errorArgs = ['recording_due_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="error-text"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
              </div>
            </div>
          </div>

          <div class="wizard-pane" data-step="6">
            <div class="pane-title">Step 6: Learning Outcomes</div>
            <div class="row g-3">
              <div class="col-12">
                <label class="form-label">Learning Outcomes</label>
                <textarea name="learning_outcomes" id="learning_outcomes" class="form-control ckeditor-field"><?php echo e(old('learning_outcomes')); ?></textarea>
                <?php $__errorArgs = ['learning_outcomes'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="error-text"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
              </div>
            </div>
          </div>

          <div class="wizard-pane" data-step="7">
            <div class="pane-title">Step 7: Test</div>

            <div class="test-box">
              <div class="row g-3">
                <div class="col-md-4">
                  <label class="form-label">Mock Test</label>
                  <select name="mock_test_enabled" id="mock_test_enabled" class="form-select">
                    <option value="no" <?php echo e(old('mock_test_enabled') == 'no' ? 'selected' : ''); ?>>No</option>
                    <option value="yes" <?php echo e(old('mock_test_enabled') == 'yes' ? 'selected' : ''); ?>>Yes</option>
                  </select>
                </div>
              </div>

              <div id="mockTestWrapper" class="hidden-block mt-3">
                <div class="row g-3">
                  <div class="col-md-3">
                    <label class="form-label">Mock Test Marks</label>
                    <input type="number" name="mock_test_marks" class="form-control" min="0" value="<?php echo e(old('mock_test_marks')); ?>">
                    <?php $__errorArgs = ['mock_test_marks'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="error-text"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                  </div>
                  <div class="col-12">
                    <label class="form-label">Mock Test Content</label>
                    <textarea name="mock_test" id="mock_test" class="form-control ckeditor-field"><?php echo e(old('mock_test')); ?></textarea>
                    <?php $__errorArgs = ['mock_test'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="error-text"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                  </div>
                </div>
              </div>
            </div>

            <div class="test-box">
              <div class="row g-3 align-items-end">
                <div class="col-md-4">
                  <label class="form-label">Online Test</label>
                  <select name="online_test_enabled" id="online_test_enabled" class="form-select">
                    <option value="no" <?php echo e(old('online_test_enabled') == 'no' ? 'selected' : ''); ?>>No</option>
                    <option value="yes" <?php echo e(old('online_test_enabled') == 'yes' ? 'selected' : ''); ?>>Yes</option>
                  </select>
                </div>
              </div>

              <div id="onlineTestWrapper" class="hidden-block mt-3">
                <div class="row g-3 align-items-end">
                  <div class="col-md-4">
                    <label class="form-label">No. of Questions</label>
                    <input type="number" name="online_question_count" id="online_question_count" class="form-control" min="1" value="<?php echo e(old('online_question_count')); ?>">
                  </div>
                  <div class="col-md-4">
                    <button type="button" class="btn btn-primary w-100" id="generateOnlineQuestionsBtn">Generate Questions</button>
                  </div>
                  <div class="col-md-4">
                    <button type="button" class="btn btn-outline-dark w-100" data-bs-toggle="modal" data-bs-target="#bulkUploadModal">
                      Bulk Upload CSV
                    </button>
                  </div>
                </div>

                <?php $__errorArgs = ['online_questions'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="error-text mt-2"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                <div id="onlineQuestionsContainer" class="mt-4"></div>
              </div>
            </div>
          </div>



          <div class="wizard-footer">
            <button type="button" class="btn btn-outline-secondary" id="prevStepBtn">Previous</button>
            <div class="wizard-actions-right">
              <button type="button" class="btn btn-primary" id="nextStepBtn">Next</button>
              <button type="submit" class="btn btn-success d-none" id="submitBtn">
                <i class="bi bi-check-circle me-1"></i> Submit
              </button>
            </div>
          </div>
        </form>

      </div>
    </div>
  </div>
</main>

<div class="modal fade" id="topicModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="topicForm">
        <div class="modal-header">
          <h5 class="modal-title">Add Topic</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">Topic Name</label>
            <input type="text" id="topic_name" class="form-control" placeholder="Enter topic name">
            <div class="error-text" id="topic_error"></div>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-light border" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save Topic</button>
        </div>
      </form>
    </div>
  </div>
</div>
<div class="modal fade" id="bulkUploadModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="bulkUploadForm">
        <div class="modal-header">
          <h5 class="modal-title">Bulk Upload Online Test CSV</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body">
          <div class="mb-3 d-flex justify-content-end">
            <a href="<?php echo e(route('upload-content.online-test-template.download')); ?>" class="btn btn-outline-success">
              <i class="bi bi-download me-1"></i> Download Template
            </a>
          </div>

          <div class="mb-3">
            <label class="form-label">Marks for All Questions</label>
            <input type="number" id="bulk_marks" class="form-control" min="0" placeholder="Enter marks">
          </div>

          <div class="mb-3">
            <label class="form-label">CSV File</label>
            <input type="file" id="bulk_csv_file" class="form-control" accept=".csv">
            <small class="help-text">
              CSV columns: question, option_a, option_b, option_c, option_d, correct_option
            </small>
          </div>

          <div class="error-text" id="bulk_upload_error"></div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-light border" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Import CSV</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<script src="https://cdn.jsdelivr.net/npm/papaparse@5.4.1/papaparse.min.js"></script>

<script>
  $(function() {
    const topicModal = new bootstrap.Modal(document.getElementById('topicModal'));
    const bulkUploadModal = new bootstrap.Modal(document.getElementById('bulkUploadModal'));
    const addTopicUrl = <?php echo json_encode(route('admin.upload-content.topic.store'), 15, 512) ?>;
    const topicsUrlTemplate = <?php echo json_encode(route('upload-content.topics', ['subjectId' => '__SUBJECT_ID__']), 512) ?>;
    const editors = {};
    let currentStep = 1;
    const totalSteps = 7;

    const oldOnlineQuestions = <?php echo json_encode(old('online_questions', []), 512) ?>;
    const oldMockEnabled = <?php echo json_encode(old('mock_test_enabled', 'no'), 512) ?>;
    const oldOnlineEnabled = <?php echo json_encode(old('online_test_enabled', 'no'), 512) ?>;

    function buildTopicsUrl(subjectId) {
      return topicsUrlTemplate.replace('__SUBJECT_ID__', subjectId);
    }

    function initEditorByElement(element) {
      if (!element || !element.id || editors[element.id]) {
        return;
      }

      ClassicEditor.create(element, {
        toolbar: [
          'heading', '|',
          'bold', 'italic', 'link', '|',
          'bulletedList', 'numberedList', '|',
          'blockQuote', 'insertTable', '|',
          'undo', 'redo'
        ]
      }).then(editor => {
        editors[element.id] = editor;
      }).catch(error => {
        console.error(error);
      });
    }

    document.querySelectorAll('.ckeditor-field').forEach((element) => {
      initEditorByElement(element);
    });

    let isSubmitting = false;

    $('#uploadContentForm').on('submit', function(e) {
      if (isSubmitting) {
        e.preventDefault();
        return false;
      }

      Object.keys(editors).forEach(function(key) {
        const textarea = document.getElementById(key);
        if (textarea) {
          textarea.value = editors[key].getData();
        }
      });

      isSubmitting = true;
      $('#submitBtn')
        .prop('disabled', true)
        .html('<i class="bi bi-hourglass-split me-1"></i> Saving...');
    });

    function renderTopics(topics, selectedId = '') {
      let html = '<option value="">Select Topic</option>';

      if (Array.isArray(topics) && topics.length > 0) {
        topics.forEach(function(topic) {
          const selected = String(topic.topic_id) === String(selectedId) ? 'selected' : '';
          html += `<option value="${topic.topic_id}" ${selected}>${topic.topic_name}</option>`;
        });
      }

      $('#topic_id').html(html);
    }

    function loadTopics(subjectId, selectedId = '') {
      if (!subjectId) {
        renderTopics([], '');
        return;
      }

      $('#topic_id').html('<option value="">Loading topics...</option>');

      $.ajax({
        url: buildTopicsUrl(subjectId),
        type: 'GET',
        success: function(response) {
          if (response.status) {
            renderTopics(response.topics, selectedId);
          } else {
            renderTopics([], '');
          }
        },
        error: function(xhr) {
          console.log(xhr.responseText);
          renderTopics([], '');
        }
      });
    }

    function showStep(step) {
      currentStep = step;

      $('.wizard-pane').removeClass('active');
      $('.wizard-pane[data-step="' + step + '"]').addClass('active');

      $('.wizard-tab').each(function() {
        const tabStep = parseInt($(this).attr('data-step'));
        $(this).removeClass('active completed');

        if (tabStep < step) {
          $(this).addClass('completed');
        } else if (tabStep === step) {
          $(this).addClass('active');
        }
      });

      $('#prevStepBtn').prop('disabled', step === 1);

      if (step === totalSteps) {
        $('#nextStepBtn').addClass('d-none');
        $('#submitBtn').removeClass('d-none');
      } else {
        $('#nextStepBtn').removeClass('d-none');
        $('#submitBtn').addClass('d-none');
      }
    }

    function validateStep1() {
      const subjectId = $('#subject_id').val();
      const topicId = $('#topic_id').val();
      const title = $('#title').val().trim();

      if (!subjectId) {
        alert('Please select subject.');
        return false;
      }

      if (!topicId) {
        alert('Please select topic.');
        return false;
      }

      if (!title) {
        alert('Please enter title.');
        return false;
      }

      return true;
    }

    function toggleMockBlock() {
      if ($('#mock_test_enabled').val() === 'yes') {
        $('#mockTestWrapper').slideDown(150);
      } else {
        $('#mockTestWrapper').slideUp(150);
      }
    }

    function toggleOnlineBlock() {
      if ($('#online_test_enabled').val() === 'yes') {
        $('#onlineTestWrapper').slideDown(150);
      } else {
        $('#onlineTestWrapper').slideUp(150);
      }
    }

    function normalizeCorrectOption(value) {
      const val = String(value || '').trim().toUpperCase();
      if (['A', 'B', 'C', 'D'].includes(val)) {
        return val;
      }
      if (val === '1') return 'A';
      if (val === '2') return 'B';
      if (val === '3') return 'C';
      if (val === '4') return 'D';
      return '';
    }

    function buildQuestionCard(index, data = {}) {
      return `
            <div class="question-card">
                <h6>Question ${index + 1}</h6>
                <div class="row g-3">
                    <div class="col-md-2">
                        <label class="form-label">Marks</label>
                        <input type="number" name="online_questions[${index}][marks]" class="form-control" min="0" value="${data.marks ?? ''}">
                    </div>

                    <div class="col-12">
                        <label class="form-label">Question</label>
                        <textarea name="online_questions[${index}][question]" id="online_question_${index}" class="form-control dynamic-online-editor">${data.question ?? ''}</textarea>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Option A</label>
                        <input type="text" name="online_questions[${index}][option_a]" class="form-control" value="${data.option_a ?? ''}">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Option B</label>
                        <input type="text" name="online_questions[${index}][option_b]" class="form-control" value="${data.option_b ?? ''}">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Option C</label>
                        <input type="text" name="online_questions[${index}][option_c]" class="form-control" value="${data.option_c ?? ''}">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Option D</label>
                        <input type="text" name="online_questions[${index}][option_d]" class="form-control" value="${data.option_d ?? ''}">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Correct Option</label>
                        <select name="online_questions[${index}][correct_option]" class="form-select">
                            <option value="">Select Correct Option</option>
                            <option value="A" ${data.correct_option === 'A' ? 'selected' : ''}>A</option>
                            <option value="B" ${data.correct_option === 'B' ? 'selected' : ''}>B</option>
                            <option value="C" ${data.correct_option === 'C' ? 'selected' : ''}>C</option>
                            <option value="D" ${data.correct_option === 'D' ? 'selected' : ''}>D</option>
                        </select>
                    </div>
                </div>
            </div>
        `;
    }

    function destroyDynamicEditors() {
      Object.keys(editors).forEach(function(key) {
        if (key.startsWith('online_question_')) {
          editors[key].destroy().catch(() => {});
          delete editors[key];
        }
      });
    }

    function renderOnlineQuestions(questions) {
      destroyDynamicEditors();
      $('#onlineQuestionsContainer').html('');

      questions.forEach((question, index) => {
        $('#onlineQuestionsContainer').append(buildQuestionCard(index, question));
      });

      document.querySelectorAll('.dynamic-online-editor').forEach((element) => {
        initEditorByElement(element);
      });
    }

    $('#generateOnlineQuestionsBtn').on('click', function() {
      const count = parseInt($('#online_question_count').val(), 10);

      if (!count || count < 1) {
        alert('Please enter valid number of questions.');
        return;
      }

      const questions = [];
      for (let i = 0; i < count; i++) {
        questions.push({
          marks: '',
          question: '',
          option_a: '',
          option_b: '',
          option_c: '',
          option_d: '',
          correct_option: ''
        });
      }

      renderOnlineQuestions(questions);
    });

    $('#bulkUploadForm').on('submit', function(e) {
      e.preventDefault();

      const marks = $('#bulk_marks').val();
      const fileInput = document.getElementById('bulk_csv_file');
      const file = fileInput.files[0];
      $('#bulk_upload_error').text('');

      if (marks === '' || marks === null) {
        $('#bulk_upload_error').text('Please enter marks.');
        return;
      }

      if (!file) {
        $('#bulk_upload_error').text('Please select CSV file.');
        return;
      }

      Papa.parse(file, {
        header: true,
        skipEmptyLines: true,
        complete: function(results) {
          if (!results.data || !results.data.length) {
            $('#bulk_upload_error').text('CSV is empty or invalid.');
            return;
          }

          const parsedQuestions = [];

          for (const row of results.data) {
            const question = row.question ?? row.Question ?? '';
            const optionA = row.option_a ?? row.OptionA ?? row.optionA ?? '';
            const optionB = row.option_b ?? row.OptionB ?? row.optionB ?? '';
            const optionC = row.option_c ?? row.OptionC ?? row.optionC ?? '';
            const optionD = row.option_d ?? row.OptionD ?? row.optionD ?? '';
            const correctOption = normalizeCorrectOption(row.correct_option ?? row.CorrectOption ?? row.correctOption ?? '');

            if (
              String(question).trim() === '' &&
              String(optionA).trim() === '' &&
              String(optionB).trim() === '' &&
              String(optionC).trim() === '' &&
              String(optionD).trim() === ''
            ) {
              continue;
            }

            parsedQuestions.push({
              marks: marks,
              question: question,
              option_a: optionA,
              option_b: optionB,
              option_c: optionC,
              option_d: optionD,
              correct_option: correctOption
            });
          }

          if (!parsedQuestions.length) {
            $('#bulk_upload_error').text('No valid questions found in CSV.');
            return;
          }

          $('#online_question_count').val(parsedQuestions.length);
          renderOnlineQuestions(parsedQuestions);
          bulkUploadModal.hide();
          $('#online_test_enabled').val('yes').trigger('change');
          $('#bulkUploadForm')[0].reset();
        },
        error: function() {
          $('#bulk_upload_error').text('Unable to parse CSV file.');
        }
      });
    });

    $('#nextStepBtn').on('click', function() {
      if (currentStep === 1 && !validateStep1()) {
        return;
      }

      if (currentStep < totalSteps) {
        showStep(currentStep + 1);
      }
    });

    $('#prevStepBtn').on('click', function() {
      if (currentStep > 1) {
        showStep(currentStep - 1);
      }
    });

    $('.wizard-tab').on('click', function() {
      const targetStep = parseInt($(this).attr('data-step'));

      if (targetStep > currentStep && currentStep === 1 && !validateStep1()) {
        return;
      }

      showStep(targetStep);
    });

    $('#subject_id').on('change', function() {
      loadTopics($(this).val(), '');
    });

    $('#openTopicModal').on('click', function() {
      const subjectId = $('#subject_id').val();

      if (!subjectId) {
        alert('Please select subject first.');
        return;
      }

      $('#topic_name').val('');
      $('#topic_error').text('');
      topicModal.show();
    });

    $('#topicForm').on('submit', function(e) {
      e.preventDefault();

      const subjectId = $('#subject_id').val();
      const topicName = $('#topic_name').val().trim();

      $('#topic_error').text('');

      if (!subjectId) {
        $('#topic_error').text('Please select subject first.');
        return;
      }

      if (!topicName) {
        $('#topic_error').text('Topic name is required.');
        return;
      }

      $.ajax({
        url: addTopicUrl,
        type: 'POST',
        data: {
          _token: $('input[name="_token"]').val(),
          subject_id: subjectId,
          topic_name: topicName
        },
        success: function(response) {
          if (response.status) {
            topicModal.hide();
            loadTopics(subjectId, response.topic.topic_id);
          } else {
            $('#topic_error').text(response.message || 'Unable to add topic.');
          }
        },
        error: function(xhr) {
          if (xhr.responseJSON && xhr.responseJSON.errors) {
            if (xhr.responseJSON.errors.topic_name) {
              $('#topic_error').text(xhr.responseJSON.errors.topic_name[0]);
            } else if (xhr.responseJSON.errors.subject_id) {
              $('#topic_error').text(xhr.responseJSON.errors.subject_id[0]);
            } else {
              $('#topic_error').text('Validation error.');
            }
          } else {
            $('#topic_error').text('Unable to add topic.');
          }
        }
      });
    });

    $('#mock_test_enabled').on('change', toggleMockBlock);
    $('#online_test_enabled').on('change', toggleOnlineBlock);

    const oldSubjectId = $('#subject_id').val();
    const oldTopicId = $('#topic_id').data('old-topic');

    if (oldSubjectId) {
      loadTopics(oldSubjectId, oldTopicId);
    }

    $('#mock_test_enabled').val(oldMockEnabled);
    $('#online_test_enabled').val(oldOnlineEnabled);

    toggleMockBlock();
    toggleOnlineBlock();

    if (oldOnlineQuestions.length) {
      $('#online_question_count').val(oldOnlineQuestions.length);
      const normalized = oldOnlineQuestions.map(q => ({
        marks: q.marks ?? '',
        question: q.question ?? '',
        option_a: q.option_a ?? '',
        option_b: q.option_b ?? '',
        option_c: q.option_c ?? '',
        option_d: q.option_d ?? '',
        correct_option: q.correct_option ?? ''
      }));
      renderOnlineQuestions(normalized);
    }

    showStep(1);
  });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('Admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Aditya Pratap\Desktop\main_lms\resources\views\Admin\Content\upload_content.blade.php ENDPATH**/ ?>