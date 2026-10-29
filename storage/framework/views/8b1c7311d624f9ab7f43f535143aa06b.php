
<?php $__env->startSection('title', 'Feedback Analytics'); ?>

<?php $__env->startSection('content'); ?>
<main class="main-content">
  <div class="page-body p-3">
    <div class="row g-3 mb-4">
      <div class="col-md-6">
        <div class="card border-0 shadow-sm h-100">
          <div class="card-body">
            <h4 class="mb-3">Response Volume</h4>
            <canvas id="responseBarChart"></canvas>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card border-0 shadow-sm h-100">
          <div class="card-body">
            <h4 class="mb-3">Rating Distribution</h4>
            <canvas id="ratingPieChart"></canvas>
          </div>
        </div>
      </div>
    </div>

    <div class="card border-0 shadow-sm">
      <div class="card-body">
        <h4 class="mb-3">Student Responses</h4>
        <div class="row g-3">
          <?php $__currentLoopData = $form->responses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $response): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <div class="col-md-6">
            <div class="border rounded-4 p-3 h-100 bg-light-subtle">
              <div class="d-flex justify-content-between mb-2">
                <div>
                  <h6 class="mb-1"><?php echo e($response->student_name); ?></h6>
                  <div class="small text-muted"><?php echo e($response->email); ?> | <?php echo e($response->mobile); ?></div>
                </div>
                <span class="badge bg-primary">#<?php echo e($response->response_id); ?></span>
              </div>
              <hr>
              <?php $__currentLoopData = ($response->answers_json ?? []); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $answer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <div class="mb-2">
                <strong><?php echo e(is_array($answer['question'] ?? null) ? '' : ($answer['question'] ?? ('Q'.$loop->iteration))); ?></strong>
                <div class="text-muted"><?php echo e(is_array($answer['value'] ?? null) ? implode(', ', $answer['value']) : ($answer['value'] ?? '-')); ?></div>
              </div>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
          </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
      </div>
    </div>
  </div>
</main>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  const responses = <?php echo json_encode($form -> responses -> values(), 15, 512) ?>;
  const totalResponses = responses.length;
  const questionCount = <?php echo json_encode(count($form -> questions_json ?? []), 15, 512) ?>;

  new Chart(document.getElementById('responseBarChart'), {
    type: 'bar',
    data: {
      labels: ['Total Responses', 'Questions'],
      datasets: [{
        label: 'Count',
        data: [totalResponses, questionCount],
        backgroundColor: ['rgba(239,108,47,0.75)', 'rgba(93,92,222,0.75)'],
        borderRadius: 12
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false
    }
  });

  let ratingCounts = {
    '1': 0,
    '2': 0,
    '3': 0,
    '4': 0,
    '5': 0
  };
  responses.forEach(r => {
    Object.values(r.answers_json || {}).forEach(a => {
      const value = a?.value;
      if (ratingCounts[value] !== undefined) ratingCounts[value]++;
    });
  });

  new Chart(document.getElementById('ratingPieChart'), {
    type: 'pie',
    data: {
      labels: Object.keys(ratingCounts).map(k => `${k} Star`),
      datasets: [{
        data: Object.values(ratingCounts),
        backgroundColor: ['#ff6b6b', '#f59e0b', '#3b82f6', '#10b981', '#8b5cf6']
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false
    }
  });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('Admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Aditya Pratap\Desktop\main_lms\resources\views\Admin\Feedback\analytics.blade.php ENDPATH**/ ?>