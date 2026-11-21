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
        @php
          $uid = $question['uid'];
          $name = "answers[{$uid}][value]";
          $oldValue = old("answers.{$uid}.value");
          $required = (bool) ($question['required'] ?? false);
        @endphp
        <div class="fw-bold d-block mb-3" id="question-{{ $uid }}">
          {{ $index + 1 }}. {{ $question['text'] ?? '' }}
          @if($required)<span class="text-danger"> (required)</span>@endif
        </div>

        @if(($question['type'] ?? '') === 'short_answer')
        <input type="text" name="{{ $name }}" aria-labelledby="question-{{ $uid }}" class="form-control" value="{{ is_scalar($oldValue) ? $oldValue : '' }}" @required($required)>
        @elseif(($question['type'] ?? '') === 'paragraph')
        <textarea name="{{ $name }}" aria-labelledby="question-{{ $uid }}" class="form-control" rows="4" @required($required)>{{ is_scalar($oldValue) ? $oldValue : '' }}</textarea>
        @elseif(($question['type'] ?? '') === 'dropdown')
        <select name="{{ $name }}" aria-labelledby="question-{{ $uid }}" class="form-select" @required($required)>
          <option value="">Select option</option>
          @foreach(($question['options'] ?? []) as $option)
          <option value="{{ $option }}" @selected($oldValue === $option)>{{ $option }}</option>
          @endforeach
        </select>
        @elseif(($question['type'] ?? '') === 'radio')
        @foreach(($question['options'] ?? []) as $option)
        <div class="form-check mb-2">
          <input class="form-check-input" type="radio" name="{{ $name }}" aria-labelledby="question-{{ $uid }}" value="{{ $option }}" id="{{ $uid }}-{{ $loop->index }}" @checked($oldValue === $option) @required($required)>
          <label class="form-check-label" for="{{ $uid }}-{{ $loop->index }}">{{ $option }}</label>
        </div>
        @endforeach
        @elseif(($question['type'] ?? '') === 'checkbox')
        @foreach(($question['options'] ?? []) as $option)
        <div class="form-check mb-2">
          <input class="form-check-input" type="checkbox" name="{{ $name }}[]" value="{{ $option }}" id="{{ $uid }}-{{ $loop->index }}" @checked(in_array($option, (array) $oldValue, true))>
          <label class="form-check-label" for="{{ $uid }}-{{ $loop->index }}">{{ $option }}</label>
        </div>
        @endforeach
        @elseif(($question['type'] ?? '') === 'rating')
        <select name="{{ $name }}" aria-labelledby="question-{{ $uid }}" class="form-select" @required($required)>
          <option value="">Select rating</option>
          @for($rating = 1; $rating <= 5; $rating++)
          <option value="{{ $rating }}" @selected(is_scalar($oldValue) && (string) $oldValue === (string) $rating)>{{ $rating }} {{ $rating === 1 ? 'star' : 'stars' }}</option>
          @endfor
        </select>
        @endif
      </div>
    </div>
    @endforeach

    <button type="submit" class="btn btn-primary">Submit Feedback</button>
  </form>
</div>
@endsection