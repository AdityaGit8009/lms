

<?php $__env->startSection('title', 'Edit Profile'); ?>

<?php $__env->startSection('content'); ?>
<main class="main-content">
  <div class="page-body">
    <div class="page-hdr d-flex justify-content-between align-items-center">
      <div>
        <h1>Edit Profile</h1>
        <p>Update your account and training details.</p>
      </div>
      <a href="<?php echo e(route('profile')); ?>" class="btn btn-ghost btn-sm">
        <i class="bi bi-arrow-left"></i> Back to Profile
      </a>
    </div>

    <div class="card">
      <div class="card-body">
        <form action="<?php echo e(route('profile.update')); ?>" method="POST" enctype="multipart/form-data">
          <?php echo csrf_field(); ?>

          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label">Full Name</label>
              <input type="text" name="name" class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                value="<?php echo e(old('name', $student->name)); ?>" required>
              <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="col-md-6">
              <label class="form-label">College</label>
              <input type="text" name="college" class="form-control <?php $__errorArgs = ['college'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                value="<?php echo e(old('college', $student->college)); ?>" required>
              <?php $__errorArgs = ['college'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="col-md-6">
              <label class="form-label">Course</label>
              <select name="course" id="course" class="form-select <?php $__errorArgs = ['course'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                <option value="">Select Course</option>
                <option value="1" <?php echo e(old('course', $student->course) == '1' ? 'selected' : ''); ?>>Diploma</option>
                <option value="2" <?php echo e(old('course', $student->course) == '2' ? 'selected' : ''); ?>>B.Tech</option>
                <option value="3" <?php echo e(old('course', $student->course) == '3' ? 'selected' : ''); ?>>BCA</option>
                <option value="4" <?php echo e(old('course', $student->course) == '4' ? 'selected' : ''); ?>>PGDCA</option>
                <option value="5" <?php echo e(old('course', $student->course) == '5' ? 'selected' : ''); ?>>MCA</option>
                <option value="6" <?php echo e(old('course', $student->course) == '6' ? 'selected' : ''); ?>>M.Sc</option>
                <option value="7" <?php echo e(old('course', $student->course) == '7' ? 'selected' : ''); ?>>B.A</option>
                <option value="8" <?php echo e(old('course', $student->course) == '8' ? 'selected' : ''); ?>>B.Sc</option>
                <option value="9" <?php echo e(old('course', $student->course) == '9' ? 'selected' : ''); ?>>M.Tech</option>
              </select>
              <?php $__errorArgs = ['course'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="col-md-6">
              <label class="form-label">Branch</label>
              <input type="text" name="branch" class="form-control <?php $__errorArgs = ['branch'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                value="<?php echo e(old('branch', $student->branch)); ?>" required>
              <?php $__errorArgs = ['branch'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="col-md-6">
              <label class="form-label">Year</label>
              <select name="year" class="form-select <?php $__errorArgs = ['year'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                <option value="">Select Year</option>
                <option value="1" <?php echo e(old('year', $student->year) == '1' ? 'selected' : ''); ?>>First Year</option>
                <option value="2" <?php echo e(old('year', $student->year) == '2' ? 'selected' : ''); ?>>Second Year</option>
                <option value="3" <?php echo e(old('year', $student->year) == '3' ? 'selected' : ''); ?>>Third Year</option>
                <option value="4" <?php echo e(old('year', $student->year) == '4' ? 'selected' : ''); ?>>Fourth Year</option>
                <option value="5" <?php echo e(old('year', $student->year) == '5' ? 'selected' : ''); ?>>Fifth Year</option>
              </select>
              <?php $__errorArgs = ['year'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="col-md-6">
              <label class="form-label">Mobile</label>
              <input type="text" name="mobile" class="form-control <?php $__errorArgs = ['mobile'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                value="<?php echo e(old('mobile', $student->mobile)); ?>" required>
              <?php $__errorArgs = ['mobile'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="col-md-6">
              <label class="form-label">Gender</label>
              <select name="gender" class="form-select <?php $__errorArgs = ['gender'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                <option value="">Select Gender</option>
                <option value="male" <?php echo e(old('gender', $student->gender) == 'male' ? 'selected' : ''); ?>>Male</option>
                <option value="female" <?php echo e(old('gender', $student->gender) == 'female' ? 'selected' : ''); ?>>Female</option>
              </select>
              <?php $__errorArgs = ['gender'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="col-md-6">
              <label class="form-label">Programme</label>
              <select name="pro" class="form-select <?php $__errorArgs = ['pro'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                <option value="">Select Programme</option>
                <option value="12" <?php echo e(old('pro', $student->program) == '12' ? 'selected' : ''); ?>>Summer Training 2025</option>
                <option value="13" <?php echo e(old('pro', $student->program) == '13' ? 'selected' : ''); ?>>In House Training</option>
                <option value="15" <?php echo e(old('pro', $student->program) == '15' ? 'selected' : ''); ?>>Certification Programme</option>
                <option value="16" <?php echo e(old('pro', $student->program) == '16' ? 'selected' : ''); ?>>Virtual Internship</option>
                <option value="8" <?php echo e(old('pro', $student->program) == '8' ? 'selected' : ''); ?>>Apprenticeship-2025</option>
                <option value="11" <?php echo e(old('pro', $student->program) == '11' ? 'selected' : ''); ?>>Full Stack Development</option>
              </select>
              <?php $__errorArgs = ['pro'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="col-12">
              <label class="form-label">Location</label>
              <select name="location" class="form-select <?php $__errorArgs = ['location'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                <option value="">Select Location</option>
                <option value="House" <?php echo e(old('location', $student->location) == 'House' ? 'selected' : ''); ?>>Softpro House, 3/213 Sector-J, Jankipuram, Lucknow - 226021</option>
                <option value="Academy" <?php echo e(old('location', $student->location) == 'Academy' ? 'selected' : ''); ?>>Softpro India Full Stack Academy, 1/6 Vastu Khand, Gomti Nagar, Lucknow - 226010</option>
                <option value="Noida" <?php echo e(old('location', $student->location) == 'Noida' ? 'selected' : ''); ?>>Softpro India Computer Technologies P Limited, Creatons Business Park, Ground Floor, H-35, Sector 63, Noida - 201301</option>
              </select>
              <?php $__errorArgs = ['location'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="col-12">
              <label class="form-label">Profile Photo</label>
              <input type="file" name="pic" class="form-control <?php $__errorArgs = ['pic'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
              <?php $__errorArgs = ['pic'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

              <?php if($student->photo): ?>
              <div class="mt-3">
                <img src="<?php echo e(asset('storage/' . $student->photo)); ?>" alt="Profile" style="width:100px;height:100px;border-radius:50%;object-fit:cover;">
              </div>
              <?php endif; ?>
            </div>
          </div>

          <div class="mt-4 d-flex gap-2">
            <button type="submit" class="btn btn-primary">
              <i class="bi bi-check-circle"></i> Update Profile
            </button>
            <a href="<?php echo e(route('profile')); ?>" class="btn btn-secondary">
              Cancel
            </a>
          </div>
        </form>
      </div>
    </div>
  </div>
</main>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Aditya Pratap\Desktop\main_lms\resources\views\Admin\edit_profile.blade.php ENDPATH**/ ?>