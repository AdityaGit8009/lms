<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>QR Attendance</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: #f4f7fb;
    }

    .attendance-card {
      max-width: 420px;
      margin: 60px auto;
      border: none;
      border-radius: 16px;
      box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
    }

    .attendance-card .card-body {
      padding: 28px;
    }

    .form-control {
      height: 48px;
      border-radius: 10px;
    }

    .btn-submit {
      height: 48px;
      border-radius: 10px;
      font-weight: 600;
    }
  </style>
</head>

<body>

  <div class="container">
    <div class="card attendance-card">
      <div class="card-body">
        <h3 class="text-center mb-2">Student Attendance</h3>
        <p class="text-center text-muted mb-4">Enter mobile number to mark attendance</p>

        <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
        <?php endif; ?>

        <?php if(session('error')): ?>
        <div class="alert alert-danger"><?php echo e(session('error')); ?></div>
        <?php endif; ?>

        <?php if($errors->any()): ?>
        <div class="alert alert-danger mb-3">
          <?php echo e($errors->first()); ?>

        </div>
        <?php endif; ?>

        <form method="POST" action="<?php echo e(route('qr.attendance.submit')); ?>">
          <?php echo csrf_field(); ?>

          <div class="mb-3">
            <label class="form-label fw-semibold">Mobile Number</label>
            <input
              type="text"
              name="mobile"
              class="form-control"
              maxlength="10"
              inputmode="numeric"
              pattern="[0-9]{10}"
              placeholder="Enter 10 digit mobile number"
              value="<?php echo e(old('mobile')); ?>"
              required>
          </div>
          <button type="submit" class="btn btn-primary w-100 btn-submit">
            Submit Attendance
          </button>
        </form>
      </div>
    </div>
  </div>

</body>

</html><?php /**PATH C:\Users\Aditya Pratap\Desktop\main_lms\resources\views\Admin\Attendance\qr-form.blade.php ENDPATH**/ ?>