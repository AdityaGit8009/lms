@extends('Student.layouts.app')

@section('title', 'Feedback Form')

@section('content')
<div class="container py-4">
  <div class="card border-0 shadow-sm rounded-4 mb-4">
    <div class="card-body">
      <h2>{{ $form->title }}</h2>
      <p class="text-muted mb-0">{{ $form->description }}</p>
    </div>
  </div>

  <form action="{{ route('student.feedback.store', $form->form_id) }}" method="POST">
    @csrf

    @foreach(($form->questions_json ?? []) as $index => $question)
    <div class="card border-0 shadow-sm rounded-4 mb-3">
      <div class="card-body">
        <label class="fw-bold d-block mb-3">
          {{ $index + 1 }}. {{ $question['text'] ?? '' }}
        </label>

        @php $name = "answers[{$question['uid']}]"; @endphp

        <input type="hidden" name="{{ $name }}[question]" value="{{ $question['text'] ?? '' }}">
        <input type="hidden" name="{{ $name }}[type]" value="{{ $question['type'] ?? '' }}">

        @if(($question['type'] ?? '') === 'short_answer')
        <input type="text" name="{{ $name }}[value]" class="form-control">
        @elseif(($question['type'] ?? '') === 'paragraph')
        <textarea name="{{ $name }}[value]" class="form-control" rows="4"></textarea>
        @elseif(($question['type'] ?? '') === 'dropdown')
        <select name="{{ $name }}[value]" class="form-select">
          <option value="">Select option</option>
          @foreach(($question['options'] ?? []) as $option)
          <option value="{{ $option }}">{{ $option }}</option>
          @endforeach
        </select>
        @elseif(($question['type'] ?? '') === 'radio')
        @foreach(($question['options'] ?? []) as $option)
        <div class="form-check mb-2">
          <input class="form-check-input" type="radio" name="{{ $name }}[value]" value="{{ $option }}">
          <label class="form-check-label">{{ $option }}</label>
        </div>
        @endforeach
        @elseif(($question['type'] ?? '') === 'checkbox')
        @foreach(($question['options'] ?? []) as $option)
        <div class="form-check mb-2">
          <input class="form-check-input" type="checkbox" name="{{ $name }}[value][]" value="{{ $option }}">
          <label class="form-check-label">{{ $option }}</label>
        </div>
        @endforeach
        @elseif(($question['type'] ?? '') === 'rating')
        <select name="{{ $name }}[value]" class="form-select">
          <option value="">Select rating</option>
          <option value="1">1 Star</option>
          <option value="2">2 Star</option>
          <option value="3">3 Star</option>
          <option value="4">4 Star</option>
          <option value="5">5 Star</option>
        </select>
        @endif
      </div>
    </div>
    @endforeach

    <button type="submit" class="btn btn-primary">Submit Feedback</button>
  </form>
</div>
@endsection