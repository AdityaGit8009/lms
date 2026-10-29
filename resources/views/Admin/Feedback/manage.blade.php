@extends('Admin.layouts.app')

@section('title', 'Manage Feedback Forms')

@section('content')
<main class="main-content">
  <div class="page-body p-3">
    <div class="card border-0 shadow-sm rounded-4">
      <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-4">
          <div>
            <h1 class="mb-1 h4">View & Manage Feedback Forms</h1>
            <p class="text-muted mb-0">Create, copy, update, delete and review analytics.</p>
          </div>
          <a href="{{ route('admin.feedback.create') }}" class="btn btn-orange">Create New</a>
        </div>

        <div class="table-responsive">
          <table class="table table-bordered align-middle" id="feedbackTable">
            <thead>
              <tr>
                <th>Sr. No.</th>
                <th>Title</th>
                <th>Session</th>
                <th>Center</th>
                <th>Programme / Technology / Batch</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($forms as $index => $form)
              <tr>
                <td>{{ $index + 1 }}</td>

                <td style="min-width:220px;">
                  {{ $form->title }}
                </td>

                <td style="min-width:160px;">
                  <div class="scope-single">
                    {{ $form->session_names }}
                  </div>
                </td>

                <td style="min-width:180px;">
                  <div class="scope-single">
                    {{ $form->center_names }}
                  </div>
                </td>

                <td style="min-width:300px;">
                  <div class="scope-box">
                    <div class="scope-row">
                      <span class="scope-label">Programme:</span>
                      <span class="scope-value">{{ $form->programme_names }}</span>
                    </div>
                    <div class="scope-row">
                      <span class="scope-label">Technology:</span>
                      <span class="scope-value">{{ $form->technology_names }}</span>
                    </div>
                    <div class="scope-row">
                      <span class="scope-label">Batch:</span>
                      <span class="scope-value">{{ $form->batch_names }}</span>
                    </div>
                  </div>
                </td>

                <td>
                  <span class="badge {{ $form->form_status === 'open' ? 'bg-success' : 'bg-danger' }}">
                    {{ ucfirst($form->form_status) }}
                  </span>
                </td>

                <td style="min-width:260px;">
                  <div class="d-flex flex-wrap gap-2">
                    <a href="{{ route('admin.feedback.response.page', $form->form_id) }}" class="btn btn-sm btn-outline-primary">
                      View & Edit
                    </a>

                    <form action="{{ route('admin.feedback.copy', $form->form_id) }}" method="POST" class="d-inline">
                      @csrf
                      <button type="submit" class="btn btn-sm btn-outline-info">Copy</button>
                    </form>

                    <form action="{{ route('admin.feedback.delete', $form->form_id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this form?')">
                      @csrf
                      <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                    </form>
                  </div>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>

      </div>
    </div>
  </div>
</main>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css">
<style>
  .btn-orange {
    background: #ef6c2f;
    border-color: #ef6c2f;
    color: #fff;
  }

  .btn-orange:hover {
    background: #d95b1f;
    border-color: #d95b1f;
    color: #fff;
  }

  .scope-single {
    background: #f8f9fb;
    border: 1px solid #e9ecef;
    border-radius: 10px;
    padding: 10px 12px;
    color: #495057;
    font-weight: 500;
    line-height: 1.5;
  }

  .scope-box {
    background: #f8f9fb;
    border: 1px solid #e9ecef;
    border-radius: 10px;
    padding: 10px 12px;
  }

  .scope-row {
    display: flex;
    align-items: flex-start;
    gap: 8px;
    line-height: 1.5;
    margin-bottom: 4px;
  }

  .scope-row:last-child {
    margin-bottom: 0;
  }

  .scope-label {
    min-width: 90px;
    font-weight: 700;
    color: #212529;
  }

  .scope-value {
    color: #495057;
    word-break: break-word;
  }
</style>
@endpush

@push('scripts')
<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>
<script>
  $(function() {
    $('#feedbackTable').DataTable({
      pageLength: 10,
      order: [
        [0, 'asc']
      ]
    });
  });
</script>
@endpush