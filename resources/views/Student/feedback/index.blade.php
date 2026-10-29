@extends('student.layouts.app')

@section('title', 'Feedback Forms')

@section('content')
<div class="container py-4">
  <h2 class="mb-4">Feedback Forms</h2>

  <div class="row g-3">
    @forelse($forms as $form)
    <div class="col-md-6 col-lg-4">
      <div class="card border-0 shadow-sm h-100 rounded-4">
        <div class="card-body">
          <h5>{{ $form->title }}</h5>
          <p class="text-muted">{{ $form->description }}</p>
          <a href="{{ route('student.feedback.show', $form->form_id) }}" class="btn btn-primary">
            Open Form
          </a>
        </div>
      </div>
    </div>
    @empty
    <div class="col-12">
      <div class="alert alert-info">No feedback forms available.</div>
    </div>
    @endforelse
  </div>
</div>
@endsection