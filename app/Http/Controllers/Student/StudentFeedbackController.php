<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\FeedbackForm;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentFeedbackController extends Controller
{
  private function roster(Request $request): ?Student
  {
    $roster = Student::with([
      'assignedSessions', 'assignedProgrammes', 'assignedTechnologies',
      'assignedBatches' => fn ($query) => $query->where('is_active', 'Y'),
    ])->where('stu_email', $request->user()->email)->first();

    abort_if($roster && ($roster->is_block === 'Y' || $roster->del_status === 'Y'), 403);

    return $roster;
  }

  private function assignments(?Student $roster): array
  {
    return [
      'session' => [$roster?->stu_session, ...($roster?->assignedSessions->pluck('session_id')->all() ?? [])],
      'center' => [$roster?->center_id],
      'programme' => [$roster?->stu_pro, ...($roster?->assignedProgrammes->pluck('programme_id')->all() ?? [])],
      'technology' => $roster?->assignedTechnologies->pluck('technology_id')->all() ?? [],
      'batch' => $roster?->assignedBatches->pluck('batch_id')->all() ?? [],
    ];
  }

  public function index(Request $request)
  {
    $student = $request->attributes->get('studentRegistration');
    $assignments = $this->assignments($this->roster($request));
    $forms = FeedbackForm::where('form_status', 'open')->latest('form_id')->get()
      ->filter(fn ($form) => $form->responseDimensions($assignments) !== null);

    return view('Student.feedback.index', compact('forms', 'student'));
  }

  public function show(Request $request, $formId)
  {
    $student = $request->attributes->get('studentRegistration');
    $form = FeedbackForm::where('form_status', 'open')->findOrFail($formId);
    abort_if($form->responseDimensions($this->assignments($this->roster($request))) === null, 404);

    return view('Student.feedback.show', compact('form', 'student'));
  }

  public function store(Request $request, $formId)
  {
    $student = $request->attributes->get('studentRegistration');
    $roster = $this->roster($request);
    $form = FeedbackForm::where('form_status', 'open')->findOrFail($formId);
    $dimensions = $form->responseDimensions($this->assignments($roster));
    abort_if($dimensions === null, 404);

    $input = $request->validate(['answers' => 'nullable|array']);
    $answers = $form->validatedAnswers($input['answers'] ?? []);

    $form->responses()->create([
      ...$dimensions,
      'student_id' => $roster?->stu_id,
      'user_id' => $request->user()->id,
      'student_name' => $student->name,
      'email' => $student->email,
      'mobile' => $student->mobile,
      'answers_json' => $answers,
    ]);

    return redirect()->route('student.feedback.index')->with('success', 'Feedback submitted successfully.');
  }
}
