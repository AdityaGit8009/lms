@extends('Admin.layouts.app')

@section('title', 'Overall Feedback Analytics')

@section('content')
<main class="main-content">
  <div class="page-body p-3">
    <div class="row g-3 mb-4">
      <div class="col-md-3">
        <div class="card border-0 shadow-sm rounded-4">
          <div class="card-body">
            <div class="text-muted">Total Responses</div>
            <h2 class="mb-0">{{ $responses->count() }}</h2>
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
          @forelse($responses as $response)
          <div class="col-lg-6">
            <div class="border rounded-4 p-3 h-100">
              <div class="d-flex justify-content-between align-items-start flex-wrap gap-2 mb-3">
                <div>
                  <div class="fw-bold">{{ $response->name ?: ($response->username ?: 'Student') }}</div>
                  <div class="text-muted small">
                    {{ $response->email ?: '-' }}
                    @if(!empty($response->mobile)) | {{ $response->mobile }} @endif
                  </div>
                </div>
                <span class="badge bg-dark">Form #{{ $response->form_id }}</span>
              </div>

              @foreach(($response->answers_json ?? []) as $answer)
              <div class="mb-2">
                <div class="fw-semibold">{{ $answer['question'] ?? 'Question' }}</div>
                <div>
                  @if(isset($answer['value']) && is_array($answer['value']))
                  {{ implode(', ', $answer['value']) }}
                  @else
                  {{ $answer['value'] ?? '-' }}
                  @endif
                </div>
              </div>
              @endforeach
            </div>
          </div>
          @empty
          <div class="col-12">
            <div class="alert alert-info mb-0">No responses found.</div>
          </div>
          @endforelse
        </div>
      </div>
    </div>
  </div>
</main>
@endsection

@push('scripts')
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

  makeBarChart('sessionChart', @json($sessionChart['labels']), @json($sessionChart['values']), 'Responses');
  makeBarChart('centerChart', @json($centerChart['labels']), @json($centerChart['values']), 'Responses');
  makeBarChart('programmeChart', @json($programmeChart['labels']), @json($programmeChart['values']), 'Responses');
  makeBarChart('technologyChart', @json($technologyChart['labels']), @json($technologyChart['values']), 'Responses');
  makeBarChart('batchChart', @json($batchChart['labels']), @json($batchChart['values']), 'Responses');
</script>
@endpush