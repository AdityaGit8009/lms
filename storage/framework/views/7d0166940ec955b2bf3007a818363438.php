

<?php $__env->startSection('title', 'Overall Feedback Analytics'); ?>

<?php $__env->startSection('content'); ?>
<main class="main-content">
  <div class="page-body p-3">
    <div class="row g-3 mb-4">
      <div class="col-md-3">
        <div class="card border-0 shadow-sm rounded-4">
          <div class="card-body">
            <div class="text-muted">Total Responses</div>
            <h2 class="mb-0"><?php echo e($responses->count()); ?></h2>
          </div>
        </div>
      </div>
    </div>

    <div class="row g-3 mb-4">
      <div class="col-lg-6">
        <div class="card border-0 shadow-sm rounded-4 h-100">
          <div class="card-body">
            <h5>Session Wise</h5>
            <div style="height:320px;"><canvas id="sessionChart"></canvas></div>
          </div>
        </div>
      </div>

      <div class="col-lg-6">
        <div class="card border-0 shadow-sm rounded-4 h-100">
          <div class="card-body">
            <h5>Center Wise</h5>
            <div style="height:320px;"><canvas id="centerChart"></canvas></div>
          </div>
        </div>
      </div>

      <div class="col-lg-6">
        <div class="card border-0 shadow-sm rounded-4 h-100">
          <div class="card-body">
            <h5>Programme Wise</h5>
            <div style="height:320px;"><canvas id="programmeChart"></canvas></div>
          </div>
        </div>
      </div>

      <div class="col-lg-6">
        <div class="card border-0 shadow-sm rounded-4 h-100">
          <div class="card-body">
            <h5>Technology Wise</h5>
            <div style="height:320px;"><canvas id="technologyChart"></canvas></div>
          </div>
        </div>
      </div>

      <div class="col-lg-12">
        <div class="card border-0 shadow-sm rounded-4 h-100">
          <div class="card-body">
            <h5>Batch Wise</h5>
            <div style="height:320px;"><canvas id="batchChart"></canvas></div>
          </div>
        </div>
      </div>
    </div>

    <div class="card border-0 shadow-sm rounded-4">
      <div class="card-body">
        <h3 class="mb-3">All Student Responses</h3>

        <div class="row g-3">
          <?php $__empty_1 = true; $__currentLoopData = $responses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $response): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
          <div class="col-lg-6">
            <div class="border rounded-4 p-3 h-100">
              <div class="d-flex justify-content-between align-items-start flex-wrap gap-2 mb-3">
                <div>
                  <div class="fw-bold"><?php echo e($response->name ?: ($response->username ?: 'Student')); ?></div>
                  <div class="text-muted small">
                    <?php echo e($response->email ?: '-'); ?>

                    <?php if(!empty($response->mobile)): ?> | <?php echo e($response->mobile); ?> <?php endif; ?>
                  </div>
                </div>
                <span class="badge bg-dark">Form #<?php echo e($response->form_id); ?></span>
              </div>

              <?php $__currentLoopData = ($response->answers_json ?? []); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $answer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <div class="mb-2">
                <div class="fw-semibold"><?php echo e($answer['question'] ?? 'Question'); ?></div>
                <div>
                  <?php if(isset($answer['value']) && is_array($answer['value'])): ?>
                  <?php echo e(implode(', ', $answer['value'])); ?>

                  <?php else: ?>
                  <?php echo e($answer['value'] ?? '-'); ?>

                  <?php endif; ?>
                </div>
              </div>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
          </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
          <div class="col-12">
            <div class="alert alert-info mb-0">No responses found.</div>
          </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</main>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  function makeBarChart(id, labels, values, label) {
    const ctx = document.getElementById(id);
    if (!ctx) return;

    new Chart(ctx, {
      type: 'bar',
      data: {
        labels: labels,
        datasets: [{
          label: label,
          data: values,
          backgroundColor: 'rgba(239,108,47,0.75)',
          borderColor: 'rgba(239,108,47,1)',
          borderWidth: 1,
          borderRadius: 10
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            display: true
          }
        },
        scales: {
          y: {
            beginAtZero: true,
            ticks: {
              precision: 0
            }
          }
        }
      }
    });
  }

  makeBarChart('sessionChart', <?php echo json_encode($sessionChart['labels'], 15, 512) ?>, <?php echo json_encode($sessionChart['values'], 15, 512) ?>, 'Responses');
  makeBarChart('centerChart', <?php echo json_encode($centerChart['labels'], 15, 512) ?>, <?php echo json_encode($centerChart['values'], 15, 512) ?>, 'Responses');
  makeBarChart('programmeChart', <?php echo json_encode($programmeChart['labels'], 15, 512) ?>, <?php echo json_encode($programmeChart['values'], 15, 512) ?>, 'Responses');
  makeBarChart('technologyChart', <?php echo json_encode($technologyChart['labels'], 15, 512) ?>, <?php echo json_encode($technologyChart['values'], 15, 512) ?>, 'Responses');
  makeBarChart('batchChart', <?php echo json_encode($batchChart['labels'], 15, 512) ?>, <?php echo json_encode($batchChart['values'], 15, 512) ?>, 'Responses');
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('Admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Aditya Pratap\Desktop\main_lms\resources\views\Admin\Feedback\overall_analytics.blade.php ENDPATH**/ ?>