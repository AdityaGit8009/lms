<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class QrAttendanceController extends Controller
{
  public function showForm()
  {
    return view('Admin.Attendance.qr-form');
  }

  public function submitForm(Request $request)
  {
    $data = $request->validate(['mobile' => ['required', 'digits:10']]);
    $students = DB::table('tbl_student')
      ->where('del_status', 'N')->where('is_block', 'N')
      ->where('stu_mobile', 'like', '%' . $data['mobile'])
      ->limit(2)->get(['stu_id', 'stu_name', 'center_id']);

    if ($students->count() !== 1) {
      return back()->withInput()->with('error', 'Enter the mobile number of one active student.');
    }

    $student = $students->first();
    $now = now();
    $day = $now->toDateString();
    $ip = $request->ip();
    if (!$ip) {
      return back()->withInput()->with('error', 'The device address could not be determined.');
    }

    // Honor current-day scans from installations with the older device log.
    if (Schema::hasTable('tbl_qr_attendance_device_logs')
        && DB::table('tbl_qr_attendance_device_logs')->where('attendance_date', $day)->where('ip_address', $ip)->exists()) {
      return back()->withInput()->with('error', 'This device has already marked attendance today.');
    }

    $attendance = DB::table('tbl_attendance')
      ->where('attend_student', (string) $student->stu_id)->where('attend_date', $day)
      ->get(['attend_id', 'attendance']);

    if ($attendance->contains('attendance', 'P')) {
      return back()->withInput()->with('error', 'Attendance has already been marked for this student today.');
    }

    $mark = [
      'qr_ip' => $ip,
      'qr_student_id' => $student->stu_id,
      'attendance' => 'P',
      'attend_by' => (string) $request->user()->id,
      'added_date' => $day,
      'added_time' => $now->format('H:i:s'),
    ];
    try {
      if ($attendance->count() === 1) {
        $updated = DB::table('tbl_attendance')->where('attend_id', $attendance->first()->attend_id)
          ->where('attendance', '!=', 'P')->update($mark);
        if (!$updated) {
          return back()->withInput()->with('error', 'Attendance has already been marked for this student today.');
        }
      } else {
        $batches = DB::table('tbl_student_batch as sb')
          ->join('tbl_batch as b', 'b.batch_id', '=', 'sb.batch_id')
          ->where('sb.stu_id', $student->stu_id)->where('sb.is_active', 'Y')
          ->limit(2)->get(['b.batch_id', 'b.session_id', 'b.programme_id', 'b.technology_id']);

        if ($attendance->isNotEmpty() || $batches->count() !== 1) {
          return back()->withInput()->with('error', 'Use the attendance register to select the session and batch.');
        }

        $batch = $batches->first();
        DB::table('tbl_attendance')->insert($mark + [
          'attend_student' => (string) $student->stu_id,
          'attend_date' => $day,
          'attend_center' => (string) $student->center_id,
          'attend_session' => (string) $batch->session_id,
          'attend_programme' => (string) $batch->programme_id,
          'attend_technology' => (string) $batch->technology_id,
          'attend_batch' => (string) $batch->batch_id,
        ]);
      }
    } catch (UniqueConstraintViolationException $exception) {
      return back()->withInput()->with('error', 'This student or device has already marked attendance today.');
    }

    return back()->with('success', 'Attendance marked successfully for ' . $student->stu_name . '.');
  }
}
