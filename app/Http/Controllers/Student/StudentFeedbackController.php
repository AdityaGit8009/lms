<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\FeedbackForm;
use App\Models\FeedbackResponse;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentFeedbackController extends Controller
{
  public function index()
  {
    $user = Auth::user();

    $student = Student::where('stu_email', $user->email)->first();

    if (!$student) {
      return redirect()->back()->with('error', 'Student profile not found.');
    }

    $forms = FeedbackForm::where('form_status', 'open')->latest('form_id')->get();

    return view('Student.feedback.index', compact('forms', 'student'));
  }

  public function show($formId)
  {
    $user = Auth::user();
    $student = Student::where('stu_email', $user->email)->firstOrFail();
    $form = FeedbackForm::findOrFail($formId);

    return view('Student.feedback.show', compact('form', 'student'));
  }

  public function store(Request $request, $formId)
  {
    $user = Auth::user();
    $student = Student::where('stu_email', $user->email)->firstOrFail();
    $form = FeedbackForm::findOrFail($formId);

    $answers = $request->input('answers', []);

    FeedbackResponse::create([
      'form_id' => $form->form_id,
      'student_id' => $student->stu_id ?? null,
      'user_id' => $user->id,
      'name' => $student->stu_name ?? $user->name,
      'email' => $student->stu_email ?? $user->email,
      'mobile' => $student->stu_mobile ?? null,
      'session_id' => $student->session_id ?? null,
      'center_id' => $student->center_id ?? null,
      'programme_id' => $student->programme_id ?? null,
      'technology_id' => $student->technology_id ?? null,
      'batch_id' => $student->batch_id ?? null,
      'answers_json' => $answers,
    ]);

    return redirect()->route('Student.feedback.index')->with('success', 'Feedback submitted successfully.');
  }
}
