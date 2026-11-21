<?php

namespace Tests\Feature;

use App\Models\Student;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class QrAttendanceTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_scan_updates_the_attendance_register_and_enforces_daily_claims(): void
    {
        $password = Hash::make(bin2hex(random_bytes(12)));
        $admin = User::create(['name' => 'Staff', 'email' => 'scan@example.test', 'role' => 'admin', 'password' => $password]);
        $this->actingAs($admin)->get(route('qr.attendance.form'))->assertOk();
        $day = now()->toDateString();

        foreach ([1, 2] as $number) {
            $student = Student::create(['stu_name' => 'Test Student', 'stu_regid' => "TEST$number",
                'stu_mobile' => "987650010$number", 'stu_email' => "student$number@example.test",
                'stu_password' => $password, 'stu_course' => 1, 'stu_branch' => 1,
                'stu_college' => 'Example College', 'stu_course_year' => '1', 'stu_gender' => 'Other',
                'stu_pro' => 1, 'stu_session' => 1]);
            DB::table('tbl_attendance')->insert(['attend_date' => $day, 'attend_student' => $student->stu_id,
                'attend_technology' => '1', 'attend_batch' => '1', 'attendance' => 'A',
                'added_date' => $day, 'added_time' => '09:00:00']);
        }

        $url = route('attendance.qr.attendance.submit');
        $this->post($url, ['mobile' => '9876500101'])->assertSessionHas('success');
        $this->post($url, ['mobile' => '9876500101'])->assertSessionHas('error');
        $this->post($url, ['mobile' => '9876500102'])->assertSessionHas('error');
        $this->assertDatabaseHas('tbl_attendance', ['attend_student' => '1', 'attendance' => 'P', 'qr_student_id' => 1]);
        $this->assertDatabaseHas('tbl_attendance', ['attend_student' => '2', 'attendance' => 'A', 'qr_student_id' => null]);
        $this->assertDatabaseCount('tbl_attendance', 2);
    }
}
