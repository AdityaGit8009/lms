<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use App\Models\Student;
use App\Models\StudentLoginLog;

class LogStudentLogin
{
  public function handle(Login $event): void
  {
    $user = $event->user;

    if (($user->role ?? null) !== 'student') {
      return;
    }

    $student = Student::where('stu_email', $user->email)
      ->orWhere('stu_mobile', $user->phone ?? '')
      ->first();

    StudentLoginLog::create([
      'user_id'       => $user->id,
      'stu_id'        => $student->stu_id ?? null,
      'student_email' => $student->stu_email ?? $user->email,
      'student_mobile' => $student->stu_mobile ?? ($user->phone ?? null),
      'login_at'      => now(),
      'last_seen_at'  => now(),
      'status'        => 'online',
      'ip_address'    => request()->ip(),
      'user_agent'    => request()->userAgent(),
    ]);
  }
}
