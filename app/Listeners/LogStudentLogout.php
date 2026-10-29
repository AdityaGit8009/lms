<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Logout;
use App\Models\StudentLoginLog;

class LogStudentLogout
{
  public function handle(Logout $event): void
  {
    if (!$event->user || ($event->user->role ?? null) !== 'student') {
      return;
    }

    $log = StudentLoginLog::where('user_id', $event->user->id)
      ->where('status', 'online')
      ->latest('log_id')
      ->first();

    if ($log) {
      $log->update([
        'logout_at' => now(),
        'last_seen_at' => now(),
        'status' => 'offline',
      ]);
    }
  }
}
