@extends('Admin.layouts.app')

@section('title', 'Student Login Status')

@section('content')
<main class="main-content">
  <div class="page-body p-3">

    <div class="d-flex justify-content-between align-items-center mb-4">
      <div>
        <h1 class="mb-1">Student Login Status</h1>
        <p class="text-muted mb-0">Student login monitoring panel</p>
      </div>
    </div>

    <div class="card shadow-sm border-0 mb-4">
      <div class="card-body">
        <form method="GET" action="{{ route('admin.student.login.status') }}">
          <div class="row g-3">
            <div class="col-md-3">
              <label class="form-label">Center</label>
              <select name="center_id" class="form-select">
                <option value="">All</option>
                @foreach($centers as $center)
                <option value="{{ $center->center_id }}" {{ request('center_id') == $center->center_id ? 'selected' : '' }}>
                  {{ $center->center_name }}
                </option>
                @endforeach
              </select>
            </div>

            <div class="col-md-3">
              <label class="form-label">Program</label>
              <select name="programme_id" class="form-select">
                <option value="">All</option>
                @foreach($programmes as $programme)
                <option value="{{ $programme->programme_id }}" {{ request('programme_id') == $programme->programme_id ? 'selected' : '' }}>
                  {{ $programme->programme_name }}
                </option>
                @endforeach
              </select>
            </div>

            <div class="col-md-3">
              <label class="form-label">Technology</label>
              <select name="technology_id" class="form-select">
                <option value="">All</option>
                @foreach($technologies as $technology)
                <option value="{{ $technology->technology_id }}" {{ request('technology_id') == $technology->technology_id ? 'selected' : '' }}>
                  {{ $technology->technology_name }}
                </option>
                @endforeach
              </select>
            </div>

            <div class="col-md-3">
              <label class="form-label">Batch</label>
              <select name="batch_id" class="form-select">
                <option value="">All</option>
                @foreach($batches as $batch)
                <option value="{{ $batch->batch_id }}" {{ request('batch_id') == $batch->batch_id ? 'selected' : '' }}>
                  {{ $batch->batch_name }}
                </option>
                @endforeach
              </select>
            </div>

            <div class="col-12">
              <button class="btn btn-primary">Filter</button>
              <a href="{{ route('admin.student.login.status') }}" class="btn btn-secondary">Reset</a>
            </div>
          </div>
        </form>
      </div>
    </div>

    <div class="card shadow-sm border-0">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered align-middle">
            <thead>
              <tr>
                <th>Sr. No.</th>
                <th>Student Name</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>Batch</th>
                <th>Last Login Date</th>
                <th>Last Login Time</th>
                <th>Status</th>
                <th>Logs</th>
              </tr>
            </thead>
            <tbody>
              @forelse($students as $key => $student)
              <tr>
                <td>{{ $students->firstItem() + $key }}</td>
                <td>{{ $student->stu_name }}</td>
                <td>{{ $student->stu_email }}</td>
                <td>{{ $student->stu_mobile }}</td>
                <td>{{ $student->batch_name ?? '-' }}</td>
                <td>{{ $student->last_login_at ? \Carbon\Carbon::parse($student->last_login_at)->format('d-m-Y') : '-' }}</td>
                <td>{{ $student->last_login_at ? \Carbon\Carbon::parse($student->last_login_at)->format('h:i A') : '-' }}</td>
                <td>
                  @if($student->status === 'online')
                  <span class="badge bg-success">Online</span>
                  @else
                  <span class="badge bg-secondary">Offline</span>
                  @endif
                </td>
                <td>
                  <button class="btn btn-sm btn-primary viewLogsBtn"
                    data-url="{{ route('admin.student.login.logs', $student->stu_id) }}">
                    Logs
                  </button>
                </td>
              </tr>
              @empty
              <tr>
                <td colspan="9" class="text-center">No records found</td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>

        {{ $students->withQueryString()->links() }}
      </div>
    </div>
  </div>
</main>

<div class="modal fade" id="logsModal" tabindex="-1">
  <div class="modal-dialog modal-xl modal-dialog-scrollable">
    <div class="modal-content" id="logsModalContent"></div>
  </div>
</div>
@endsection

@section('scripts')
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const modal = new bootstrap.Modal(document.getElementById('logsModal'));
    const content = document.getElementById('logsModalContent');

    document.querySelectorAll('.viewLogsBtn').forEach(btn => {
      btn.addEventListener('click', function() {
        const url = this.dataset.url;
        content.innerHTML = '<div class="modal-body text-center p-5">Loading...</div>';
        modal.show();

        fetch(url)
          .then(res => res.text())
          .then(html => {
            content.innerHTML = html;
            bindFilter();
          });
      });
    });

    function bindFilter() {
      const form = document.getElementById('studentLogFilterForm');
      if (!form) return;

      form.addEventListener('submit', function(e) {
        e.preventDefault();
        const url = form.action + '?' + new URLSearchParams(new FormData(form)).toString();

        fetch(url)
          .then(res => res.text())
          .then(html => {
            content.innerHTML = html;
            bindFilter();
          });
      });
    }
  });
</script>
@endsection