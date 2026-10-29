<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<?php
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

$adminName = $adminName ?? (auth()->user()->name ?? 'Admin');

$today = now()->toDateString();
$currentMonthStart = now()->startOfMonth()->toDateString();
$lastMonthStart = now()->copy()->subMonth()->startOfMonth()->toDateString();
$lastMonthEnd = now()->copy()->subMonth()->endOfMonth()->toDateString();

/*
|--------------------------------------------------------------------------
| Core Counts
|--------------------------------------------------------------------------
*/
$totalStudents = DB::table('tbl_student')->count();
$totalEmployees = DB::table('tbl_employee')->count();
$totalCenters = DB::table('tbl_centers')->count();
$totalProgrammes = DB::table('tbl_programme')->count();
$totalTechnologies = DB::table('tbl_technology')->count();
$totalBatches = DB::table('tbl_batch')->count();
$totalSubjects = DB::table('tbl_subject')->count();
$totalTopics = DB::table('tbl_topic')->count();
$totalAssignments = DB::table('tbl_assignments')->count();
$totalContents = DB::table('tbl_upload_content')->count();
$totalRecordings = DB::table('tbl_recordings')->count();
$totalNotifications = DB::table('tbl_notification')->count();
$totalFeedbackForms = DB::table('tbl_feedback_forms')->count();
$totalFeedbackResp = DB::table('tbl_feedback_responses')->count();

$activeEmployees = DB::table('tbl_employee')
->where(function ($q) {
$q->where('status', 1)
->orWhere('status', '1')
->orWhere('status', 'Active');
})
->count();

$blockedEmployees = DB::table('tbl_employee')
->where('is_block', 'Y')
->count();

$todayPresent = DB::table('tbl_attendance')->where('attend_date', $today)->where('attendance', 'P')->count();
$todayAbsent = DB::table('tbl_attendance')->where('attend_date', $today)->where('attendance', 'A')->count();
$todayAttendanceTotal = $todayPresent + $todayAbsent;
$todayAttendanceRate = $todayAttendanceTotal > 0 ? round(($todayPresent / $todayAttendanceTotal) * 100, 1) : 0;

$onlineStudents = DB::table('student_login_logs')->where('status', 'online')->distinct('stu_id')->count('stu_id');

/*
|--------------------------------------------------------------------------
| Monthly Trend - Students Created
|--------------------------------------------------------------------------
*/
$studentMonthRaw = DB::table('tbl_student')
->selectRaw("DATE_FORMAT(created_at, '%b') as month_label, DATE_FORMAT(created_at, '%Y-%m') as month_key, COUNT(*) as total")
->whereNotNull('created_at')
->where('created_at', '>=', now()->copy()->subMonths(5)->startOfMonth())
->groupBy('month_label', 'month_key')
->orderBy('month_key')
->get()
->keyBy('month_key');

$studentChartLabels = [];
$studentChartData = [];

for ($i = 5; $i >= 0; $i--) {
$date = now()->copy()->subMonths($i);
$key = $date->format('Y-m');
$studentChartLabels[] = $date->format('M');
$studentChartData[] = (int) optional($studentMonthRaw->get($key))->total;
}

/*
|--------------------------------------------------------------------------
| Attendance Trend - Last 7 Days
|--------------------------------------------------------------------------
*/
$attendanceRaw = DB::table('tbl_attendance')
->selectRaw("
attend_date,
SUM(CASE WHEN attendance = 'P' THEN 1 ELSE 0 END) as present_count,
SUM(CASE WHEN attendance = 'A' THEN 1 ELSE 0 END) as absent_count
")
->whereBetween('attend_date', [
now()->copy()->subDays(6)->toDateString(),
now()->toDateString()
])
->groupBy('attend_date')
->orderBy('attend_date')
->get()
->keyBy('attend_date');

$attendanceLabels = [];
$attendancePresent = [];
$attendanceAbsent = [];

for ($i = 6; $i >= 0; $i--) {
$date = now()->copy()->subDays($i)->toDateString();
$attendanceLabels[] = Carbon::parse($date)->format('d M');
$attendancePresent[] = (int) optional($attendanceRaw->get($date))->present_count;
$attendanceAbsent[] = (int) optional($attendanceRaw->get($date))->absent_count;
}

/*
|--------------------------------------------------------------------------
| Top Technologies
|--------------------------------------------------------------------------
*/
$topTechnologies = DB::table('tbl_student_technology as st')
->join('tbl_technology as t', 't.technology_id', '=', 'st.technology_id')
->select('t.technology_name', DB::raw('COUNT(st.stu_id) as total_students'))
->groupBy('t.technology_id', 't.technology_name')
->orderByDesc('total_students')
->limit(5)
->get();

$techLabels = $topTechnologies->pluck('technology_name')->map(fn($v) => (string) $v)->values()->all();
$techData = $topTechnologies->pluck('total_students')->map(fn($v) => (int) $v)->values()->all();

/*
|--------------------------------------------------------------------------
| Batch Performance Table
|--------------------------------------------------------------------------
*/
$batchReports = DB::table('tbl_batch as b')
->leftJoin('tbl_technology as t', 't.technology_id', '=', 'b.technology_id')
->leftJoin('tbl_programme as p', 'p.programme_id', '=', 'b.programme_id')
->leftJoin('tbl_student_batch as sb', function ($join) {
$join->on('sb.batch_id', '=', 'b.batch_id')
->where('sb.is_active', '=', 'Y');
})
->leftJoin('tbl_student as s', 's.stu_id', '=', 'sb.stu_id')
->leftJoin('tbl_centers as c', 'c.center_id', '=', 's.center_id')
->leftJoin('tbl_attendance as a', function ($join) use ($today) {
$join->on('a.attend_batch', '=', 'b.batch_id')
->where('a.attend_date', '=', $today);
})
->select(
'b.batch_id',
'b.batch_name',
't.technology_name',
'p.programme_name',
DB::raw('MAX(c.center_name) as center_name'),
DB::raw('COUNT(DISTINCT sb.stu_id) as total_students'),
DB::raw("SUM(CASE WHEN a.attendance = 'P' THEN 1 ELSE 0 END) as present_count"),
DB::raw("SUM(CASE WHEN a.attendance = 'A' THEN 1 ELSE 0 END) as absent_count")
)
->groupBy('b.batch_id', 'b.batch_name', 't.technology_name', 'p.programme_name')
->orderByDesc('total_students')
->limit(6)
->get()
->map(function ($row) {
$totalToday = (int) $row->present_count + (int) $row->absent_count;
$row->attendance_rate = $totalToday > 0 ? round(((int) $row->present_count / $totalToday) * 100) : 0;
return $row;
});

/*
|--------------------------------------------------------------------------
| Recent Students
|--------------------------------------------------------------------------
*/
$recentStudents = DB::table('tbl_student as s')
->leftJoin('tbl_centers as c', 'c.center_id', '=', 's.center_id')
->leftJoin('tbl_courses as cr', 'cr.course_id', '=', 's.stu_course')
->leftJoin('tbl_branches as br', 'br.branch_id', '=', 's.stu_branch')
->select(
's.stu_id',
's.stu_name',
's.stu_email',
's.stu_mobile',
's.stu_regid',
's.created_at',
'c.center_name',
'cr.course_name',
'br.branch_name'
)
->latest('s.stu_id')
->limit(5)
->get();

/*
|--------------------------------------------------------------------------
| Recent Notifications
|--------------------------------------------------------------------------
*/
$recentNotifications = DB::table('tbl_notification as n')
->leftJoin('tbl_notification_heads as nh', 'nh.notification_head_id', '=', 'n.notification_head_id')
->leftJoin('tbl_batch as b', 'b.batch_id', '=', 'n.batch_id')
->leftJoin('tbl_technology as t', 't.technology_id', '=', 'n.technology_id')
->select(
'n.title',
'n.created_at',
'nh.notification_head',
'b.batch_name',
't.technology_name'
)
->latest('n.notification_id')
->limit(5)
->get();

/*
|--------------------------------------------------------------------------
| Quick Metrics
|--------------------------------------------------------------------------
*/
$thisMonthStudents = DB::table('tbl_student')
->whereDate('created_at', '>=', $currentMonthStart)
->count();

$lastMonthStudents = DB::table('tbl_student')
->whereBetween('created_at', [$lastMonthStart, $lastMonthEnd])
->count();

$studentGrowthPercent = $lastMonthStudents > 0
? round((($thisMonthStudents - $lastMonthStudents) / $lastMonthStudents) * 100, 1)
: ($thisMonthStudents > 0 ? 100 : 0);

$openFeedbackForms = DB::table('tbl_feedback_forms')->where('form_status', 'open')->count();
$closedFeedbackForms = DB::table('tbl_feedback_forms')->where('form_status', 'close')->count();

$quickMetrics = [
['icon' => '👨‍🎓', 'value' => number_format($onlineStudents), 'label' => 'Students Online'],
['icon' => '📣', 'value' => number_format($totalNotifications), 'label' => 'Total Notices'],
['icon' => '📝', 'value' => number_format($totalAssignments), 'label' => 'Assignments'],
['icon' => '🎥', 'value' => number_format($totalRecordings), 'label' => 'Recordings'],
];

$statCards = [
[
'iconClass' => 'ic-accent',
'icon' => 'bi-people-fill',
'value' => number_format($totalStudents),
'label' => 'Total Students',
'delta' => ($studentGrowthPercent >= 0 ? '+' : '') . $studentGrowthPercent . '%',
'up' => $studentGrowthPercent >= 0,
'corner' => '👨‍🎓',
],
[
'iconClass' => 'ic-amber',
'icon' => 'bi-person-badge-fill',
'value' => number_format($activeEmployees),
'label' => 'Active Employees',
'delta' => number_format($blockedEmployees) . ' blocked',
'up' => true,
'corner' => '👨‍🏫',
],
[
'iconClass' => 'ic-rose',
'icon' => 'bi-calendar2-check-fill',
'value' => $todayAttendanceRate . '%',
'label' => "Today's Attendance",
'delta' => number_format($todayPresent) . ' present',
'up' => $todayAttendanceRate >= 50,
'corner' => '📅',
],
[
'iconClass' => 'ic-sky',
'icon' => 'bi-chat-left-text-fill',
'value' => number_format($totalFeedbackResp),
'label' => 'Feedback Responses',
'delta' => number_format($openFeedbackForms) . ' forms open',
'up' => $openFeedbackForms > 0,
'corner' => '💬',
],
];
?>

<main class="main-content">
  <div class="page-body">
    <div class="page-hdr">
      <div>
        <h1>Good morning, <?php echo e($adminName); ?> 👋</h1>
        <p>LMS performance snapshot for <?php echo e(now()->format('l, d F Y')); ?>.</p>
      </div>

      <div class="page-hdr-right d-flex gap-2 align-items-center">
        <a href="<?php echo e(route('admin.students')); ?>" class="btn btn-primary btn-sm">
          <i class="bi bi-person-plus-fill"></i> Add Student
        </a>
        <a href="<?php echo e(route('admin.employees')); ?>" class="btn btn-ghost btn-sm">
          <i class="bi bi-people"></i> Employees
        </a>
      </div>
    </div>

    <div class="row g-3 mb-4">
      <?php $__currentLoopData = $statCards; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $card): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <div class="col-6 col-xl-3 d<?php echo e($i + 1); ?>">
        <div class="stat-card">
          <div class="icon-circle ic-44 <?php echo e($card['iconClass']); ?>" style="margin-bottom:12px">
            <i class="bi <?php echo e($card['icon']); ?>"></i>
          </div>
          <div class="stat-value"><?php echo e($card['value']); ?></div>
          <div class="stat-label"><?php echo e($card['label']); ?></div>
          <div class="stat-delta <?php echo e($card['up'] ? 'delta-up' : 'delta-down'); ?>">
            <i class="bi bi-arrow-<?php echo e($card['up'] ? 'up' : 'down'); ?>-short"></i><?php echo e($card['delta']); ?>

          </div>
          <div class="stat-corner"><?php echo e($card['corner']); ?></div>
        </div>
      </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <div class="row g-3 mb-4">
      <div class="col-12 col-xl-8 d1">
        <div class="card h-100">
          <div class="card-header">
            <div>
              <div class="card-title">Student Onboarding Trend</div>
              <div class="card-subtitle">Last 6 months student registrations</div>
            </div>
            <a href="<?php echo e(route('admin.students')); ?>" class="btn btn-ghost btn-sm">
              <i class="bi bi-arrow-right"></i> View Students
            </a>
          </div>
          <div class="card-body">
            <canvas id="studentTrendChart" height="230"></canvas>
          </div>
        </div>
      </div>

      <div class="col-12 col-xl-4 d2">
        <div class="card h-100">
          <div class="card-header">
            <div>
              <div class="card-title">Technology Distribution</div>
              <div class="card-subtitle">Student allocation by technology</div>
            </div>
          </div>
          <div class="card-body">
            <div style="max-width:165px;margin:0 auto 14px">
              <canvas id="techDonutChart"></canvas>
            </div>

            <ul class="donut-legend">
              <?php $__empty_1 = true; $__currentLoopData = $topTechnologies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $tech): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
              <li>
                <span class="dot" style="background:
                  <?php echo e(['#00d4aa','#f59e0b','#f43f5e','#0ea5e9','#8b5cf6'][$index % 5]); ?>">
                </span>
                <?php echo e($tech->technology_name); ?>

                <span class="pct"><?php echo e($tech->total_students); ?></span>
              </li>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
              <li>
                <span class="dot" style="background: var(--accent)"></span>
                No technology data
                <span class="pct">0</span>
              </li>
              <?php endif; ?>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <div class="row g-3 mb-4">
      <div class="col-12 d1">
        <div class="card">
          <div class="card-header mb-3">
            <div>
              <div class="card-title">Batch Performance Report</div>
              <div class="card-subtitle">Student strength and today attendance by batch</div>
            </div>
            <div class="d-flex gap-2">
              <a href="<?php echo e(route('admin.batches')); ?>" class="btn btn-ghost btn-sm">
                <i class="bi bi-grid-3x3-gap"></i> Batches
              </a>
              <a href="<?php echo e(route('admin.viewattandence')); ?>" class="btn btn-primary btn-sm">
                <i class="bi bi-calendar-check"></i> Attendance
              </a>
            </div>
          </div>

          <div class="card-body pt-0">
            <div class="tbl-wrap">
              <table id="dashboardBatchTable" class="tbl" style="width:100%">
                <thead>
                  <tr>
                    <th>Batch</th>
                    <th>Technology</th>
                    <th>Programme</th>
                    <th>Center</th>
                    <th>Students</th>
                    <th>Present</th>
                    <th>Absent</th>
                    <th>Attendance</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $__empty_1 = true; $__currentLoopData = $batchReports; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $batch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                  <tr>
                    <td>
                      <div class="d-flex align-items-center gap-2">
                        <div class="icon-circle ic-36" style="background: rgba(0,212,170,.12); color: var(--accent);">
                          <i class="bi bi-collection-fill"></i>
                        </div>
                        <span class="fw-600 text-sm"><?php echo e($batch->batch_name); ?></span>
                      </div>
                    </td>
                    <td><?php echo e($batch->technology_name ?? '—'); ?></td>
                    <td><?php echo e($batch->programme_name ?? '—'); ?></td>
                    <td><?php echo e($batch->center_name ?? '—'); ?></td>
                    <td class="fw-700"><?php echo e($batch->total_students); ?></td>
                    <td><span class="badge badge-green"><?php echo e($batch->present_count); ?></span></td>
                    <td><span class="badge badge-rose"><?php echo e($batch->absent_count); ?></span></td>
                    <td>
                      <div class="d-flex align-items-center gap-2" style="min-width:110px">
                        <div class="progress" style="flex:1">
                          <div class="progress-fill" style="width: <?php echo e($batch->attendance_rate); ?>%"></div>
                        </div>
                        <span class="text-xs text-muted"><?php echo e($batch->attendance_rate); ?>%</span>
                      </div>
                    </td>
                  </tr>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                  <tr>
                    <td colspan="8" class="text-center text-muted py-4">No batch report data found.</td>
                  </tr>
                  <?php endif; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row g-3 mb-4">
      <div class="col-12 col-lg-4 d1">
        <div class="card h-100">
          <div class="card-header">
            <div class="card-title">Recent Students</div>
            <a href="<?php echo e(route('admin.students')); ?>" class="text-accent text-xs">View all</a>
          </div>
          <div class="card-body">
            <?php $__empty_1 = true; $__currentLoopData = $recentStudents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="activity-item">
              <div class="avatar av-32 d-flex align-items-center justify-content-center fw-700"
                style="background: rgba(0,212,170,.14); color: var(--accent);">
                <?php echo e(strtoupper(substr($student->stu_name, 0, 1))); ?>

              </div>
              <div>
                <div class="activity-text">
                  <strong><?php echo e($student->stu_name); ?></strong>
                  <span class="text-muted">joined</span>
                  <?php echo e($student->course_name ?? 'Course N/A'); ?>

                </div>
                <div class="activity-time">
                  <i class="bi bi-building me-1"></i><?php echo e($student->center_name ?? 'No Center'); ?>

                  <span class="mx-1">•</span>
                  <i class="bi bi-clock me-1"></i><?php echo e(\Carbon\Carbon::parse($student->created_at)->diffForHumans()); ?>

                </div>
              </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="text-muted">No students found.</div>
            <?php endif; ?>
          </div>
        </div>
      </div>

      <div class="col-12 col-lg-4 d2">
        <div class="card h-100">
          <div class="card-header">
            <div class="card-title">LMS Module Summary</div>
            <a href="<?php echo e(route('admin.subjects')); ?>" class="text-accent text-xs">Modules</a>
          </div>
          <div class="card-body">
            <div class="student-row">
              <div class="rank-num">1</div>
              <div style="flex:1">
                <div class="sname">Subjects</div>
                <div class="scourse">Academic content buckets</div>
              </div>
              <div class="student-xp"><?php echo e($totalSubjects); ?></div>
            </div>

            <div class="student-row">
              <div class="rank-num">2</div>
              <div style="flex:1">
                <div class="sname">Topics</div>
                <div class="scourse">Structured learning topics</div>
              </div>
              <div class="student-xp"><?php echo e($totalTopics); ?></div>
            </div>

            <div class="student-row">
              <div class="rank-num">3</div>
              <div style="flex:1">
                <div class="sname">Content Uploads</div>
                <div class="scourse">Study material and files</div>
              </div>
              <div class="student-xp"><?php echo e($totalContents); ?></div>
            </div>

            <div class="student-row">
              <div class="rank-num">4</div>
              <div style="flex:1">
                <div class="sname">Assignments</div>
                <div class="scourse">Task and submission workflow</div>
              </div>
              <div class="student-xp"><?php echo e($totalAssignments); ?></div>
            </div>

            <div class="student-row">
              <div class="rank-num">5</div>
              <div style="flex:1">
                <div class="sname">Recordings</div>
                <div class="scourse">Recorded study sessions</div>
              </div>
              <div class="student-xp"><?php echo e($totalRecordings); ?></div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-12 col-lg-4 d3">
        <div class="card h-100">
          <div class="card-header">
            <div class="card-title">Recent Notifications</div>
            <a href="<?php echo e(route('admin.notifications.index')); ?>" class="btn btn-ghost btn-xs">
              <i class="bi bi-arrow-right"></i>
            </a>
          </div>
          <div class="card-body">
            <?php $__empty_1 = true; $__currentLoopData = $recentNotifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="announce-item">
              <span class="announce-tag atag-info"><?php echo e($notice->notification_head ?? 'Notice'); ?></span>
              <div class="announce-title"><?php echo e($notice->title); ?></div>
              <div class="announce-date">
                <i class="bi bi-mortarboard me-1"></i><?php echo e($notice->technology_name ?? 'General'); ?>

                <span class="mx-1">•</span>
                <i class="bi bi-collection me-1"></i><?php echo e($notice->batch_name ?? 'All Batches'); ?>

              </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="text-muted">No notifications found.</div>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>

    <div class="row g-3">
      <div class="col-12 col-lg-4 d1">
        <div class="card">
          <div class="card-header mb-3">
            <div class="card-title">Quick Metrics</div>
          </div>
          <div class="card-body pt-0">
            <div class="row g-2">
              <?php $__currentLoopData = $quickMetrics; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $metric): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <div class="col-6">
                <div class="mini-stat">
                  <span style="font-size:1.2rem"><?php echo e($metric['icon']); ?></span>
                  <div>
                    <div class="mini-stat-val"><?php echo e($metric['value']); ?></div>
                    <div class="mini-stat-lbl"><?php echo e($metric['label']); ?></div>
                  </div>
                </div>
              </div>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
          </div>
        </div>
      </div>

      <div class="col-12 col-lg-4 d2">
        <div class="card">
          <div class="card-header mb-3">
            <div>
              <div class="card-title">Weekly Attendance</div>
              <div class="card-subtitle">Present vs absent for last 7 days</div>
            </div>
          </div>
          <div class="card-body pt-0">
            <canvas id="attendanceBarChart" height="148"></canvas>
          </div>
        </div>
      </div>

      <div class="col-12 col-lg-4 d3">
        <div class="card">
          <div class="card-header mb-2">
            <div class="card-title">Feedback Summary</div>
          </div>
          <div class="card-body">
            <div class="deadline-item">
              <span style="font-size:1rem">🟢</span>
              <div style="flex:1;min-width:0;font-size:.8rem;font-weight:500;color:var(--text);">Open Forms</div>
              <span style="font-size:.75rem;padding:4px 10px;border-radius:99px;background:rgba(0,212,170,.12);color:var(--accent);font-weight:700;">
                <?php echo e($openFeedbackForms); ?>

              </span>
            </div>

            <div class="deadline-item">
              <span style="font-size:1rem">🔴</span>
              <div style="flex:1;min-width:0;font-size:.8rem;font-weight:500;color:var(--text);">Closed Forms</div>
              <span style="font-size:.75rem;padding:4px 10px;border-radius:99px;background:rgba(244,63,94,.12);color:#f43f5e;font-weight:700;">
                <?php echo e($closedFeedbackForms); ?>

              </span>
            </div>

            <div class="deadline-item">
              <span style="font-size:1rem">📝</span>
              <div style="flex:1;min-width:0;font-size:.8rem;font-weight:500;color:var(--text);">Total Feedback Forms</div>
              <span style="font-size:.75rem;padding:4px 10px;border-radius:99px;background:var(--surface2);color:var(--text);font-weight:700;">
                <?php echo e($totalFeedbackForms); ?>

              </span>
            </div>

            <div class="deadline-item">
              <span style="font-size:1rem">💬</span>
              <div style="flex:1;min-width:0;font-size:.8rem;font-weight:500;color:var(--text);">Total Responses</div>
              <span style="font-size:.75rem;padding:4px 10px;border-radius:99px;background:var(--surface2);color:var(--text);font-weight:700;">
                <?php echo e($totalFeedbackResp); ?>

              </span>
            </div>

            <div class="deadline-item">
              <span style="font-size:1rem">🏢</span>
              <div style="flex:1;min-width:0;font-size:.8rem;font-weight:500;color:var(--text);">Centers / Programmes / Batches</div>
              <span style="font-size:.75rem;padding:4px 10px;border-radius:99px;background:var(--surface2);color:var(--text);font-weight:700;">
                <?php echo e($totalCenters); ?>/<?php echo e($totalProgrammes); ?>/<?php echo e($totalBatches); ?>

              </span>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</main>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
  const studentTrendLabels = <?php echo json_encode($studentChartLabels, 15, 512) ?>;
  const studentTrendData = <?php echo json_encode($studentChartData, 15, 512) ?>;

  const attendanceLabels = <?php echo json_encode($attendanceLabels, 15, 512) ?>;
  const attendancePresent = <?php echo json_encode($attendancePresent, 15, 512) ?>;
  const attendanceAbsent = <?php echo json_encode($attendanceAbsent, 15, 512) ?>;

  const techLabels = <?php echo json_encode(count($techLabels) ? $techLabels : ['No Data'], 15, 512) ?>;
  const techData = <?php echo json_encode(count($techData) ? $techData : [1], 15, 512) ?>;

  let studentTrendChart, techDonutChart, attendanceBarChart;

  const TT = {
    backgroundColor: 'var(--surface2)',
    borderColor: 'var(--border)',
    borderWidth: 1,
    titleColor: 'var(--text)',
    bodyColor: 'var(--muted)',
    padding: 12,
    cornerRadius: 10
  };

  function acc() {
    return getComputedStyle(document.documentElement).getPropertyValue('--accent').trim() || '#00d4aa';
  }

  function buildStudentTrendChart() {
    if (studentTrendChart) studentTrendChart.destroy();

    const accent = acc();

    studentTrendChart = new Chart(document.getElementById('studentTrendChart'), {
      type: 'line',
      data: {
        labels: studentTrendLabels,
        datasets: [{
          label: 'Students',
          data: studentTrendData,
          borderColor: accent,
          backgroundColor: accent + '22',
          borderWidth: 2.5,
          tension: .4,
          fill: true,
          pointBackgroundColor: accent,
          pointRadius: 4
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        interaction: {
          intersect: false,
          mode: 'index'
        },
        plugins: {
          legend: {
            labels: {
              color: 'var(--muted)',
              font: {
                family: 'DM Sans',
                size: 12
              },
              boxWidth: 10,
              usePointStyle: true
            }
          },
          tooltip: TT
        },
        scales: {
          x: {
            grid: {
              color: 'rgba(128,128,128,.07)'
            },
            ticks: {
              color: 'var(--muted)',
              font: {
                family: 'DM Sans'
              }
            }
          },
          y: {
            beginAtZero: true,
            grid: {
              color: 'rgba(128,128,128,.07)'
            },
            ticks: {
              precision: 0,
              color: 'var(--muted)',
              font: {
                family: 'DM Sans'
              }
            }
          }
        }
      }
    });
  }

  function buildTechDonutChart() {
    if (techDonutChart) techDonutChart.destroy();

    techDonutChart = new Chart(document.getElementById('techDonutChart'), {
      type: 'doughnut',
      data: {
        labels: techLabels,
        datasets: [{
          data: techData,
          backgroundColor: ['#00d4aa', '#f59e0b', '#f43f5e', '#0ea5e9', '#8b5cf6'],
          borderWidth: 0,
          hoverOffset: 6
        }]
      },
      options: {
        cutout: '72%',
        plugins: {
          legend: {
            display: false
          },
          tooltip: TT
        }
      }
    });
  }

  function buildAttendanceBarChart() {
    if (attendanceBarChart) attendanceBarChart.destroy();

    const accent = acc();

    attendanceBarChart = new Chart(document.getElementById('attendanceBarChart'), {
      type: 'bar',
      data: {
        labels: attendanceLabels,
        datasets: [{
            label: 'Present',
            data: attendancePresent,
            backgroundColor: accent + 'cc',
            borderRadius: 5,
            borderSkipped: false
          },
          {
            label: 'Absent',
            data: attendanceAbsent,
            backgroundColor: 'rgba(244,63,94,.35)',
            borderRadius: 5,
            borderSkipped: false
          }
        ]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        interaction: {
          mode: 'index',
          intersect: false
        },
        plugins: {
          legend: {
            labels: {
              color: 'var(--muted)',
              font: {
                family: 'DM Sans',
                size: 11
              },
              boxWidth: 9,
              usePointStyle: true
            }
          },
          tooltip: TT
        },
        scales: {
          x: {
            grid: {
              display: false
            },
            ticks: {
              color: 'var(--muted)',
              font: {
                family: 'DM Sans',
                size: 11
              }
            }
          },
          y: {
            beginAtZero: true,
            grid: {
              color: 'rgba(128,128,128,.07)'
            },
            ticks: {
              precision: 0,
              color: 'var(--muted)',
              font: {
                family: 'DM Sans',
                size: 11
              }
            }
          }
        }
      }
    });
  }

  document.addEventListener('DOMContentLoaded', function() {
    buildStudentTrendChart();
    buildTechDonutChart();
    buildAttendanceBarChart();

    if (typeof initDataTable === 'function') {
      initDataTable('dashboardBatchTable', {
        searching: false,
        paging: false,
        info: false,
        ordering: true,
        order: [
          [4, 'desc']
        ]
      });
    }
  });
</script>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
  function logoutUser() {
    $.ajax({
      url: '<?php echo e(route("api.logout")); ?>',
      method: 'POST',
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        'Accept': 'application/json'
      },
      success: function(response) {
        localStorage.removeItem('auth_token');
        localStorage.removeItem('user_role');
        window.location.href = response.redirect || '<?php echo e(route("login")); ?>';
      },
      error: function() {
        localStorage.removeItem('auth_token');
        localStorage.removeItem('user_role');
        window.location.href = '<?php echo e(route("login")); ?>';
      }
    });
  }
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('Admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Aditya Pratap\Desktop\main_lms\resources\views/Admin/index.blade.php ENDPATH**/ ?>