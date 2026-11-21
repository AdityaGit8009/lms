<?php

namespace Tests\Feature;

use App\Models\RegisterStudent;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class PortalAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_an_approved_registration_can_sign_in_and_loses_access_after_revocation(): void
    {
        $this->seed();
        $password = bin2hex(random_bytes(12));
        $registration = RegisterStudent::create([
            'name' => 'Test Learner', 'college' => 'Example College', 'regno' => 'TEST-101',
            'course' => '1', 'branch' => '1', 'year' => '1', 'mobile' => '9876500101',
            'email' => 'learner@example.test', 'gender' => 'male', 'program' => '1',
            'location' => 'House', 'password' => Hash::make($password), 'approval_status' => 'Approved',
        ]);

        $this->postJson(route('api.login'), ['email' => $registration->email, 'password' => $password])
            ->assertOk()->assertJsonPath('redirect', route('student.dashboard'));
        $this->assertAuthenticated();
        $this->get(route('student.dashboard'))->assertOk();
        $this->get(route('login'))->assertRedirect(route('student.dashboard'));
        $this->get(route('student.feedback.index'))->assertOk();
        $this->get(route('admin.students'))->assertForbidden();

        $registration->update(['approval_status' => 'Rejected']);
        $this->get(route('student.feedback.index'))->assertRedirect(route('login'));
        $this->assertGuest();
    }

    public function test_management_requests_require_an_administrator_and_employees_can_open_the_shared_dashboard(): void
    {
        $this->getJson(route('admin.notifications.list'))->assertUnauthorized();
        $this->postJson(route('attendance.students'))->assertUnauthorized();
        $this->get(route('admin.feedback.manage'))->assertRedirect(route('login'));

        $employee = User::create(['name' => 'Staff', 'email' => 'staff@example.test',
            'role' => 'employee', 'password' => Hash::make(bin2hex(random_bytes(12)))]);
        $this->actingAs($employee)->get(route('employee.dashboard'))->assertRedirect(route('admin.dashboard'));
        $this->get(route('admin.dashboard'))->assertOk();
        $this->postJson(route('api.admin.roles.store'), ['role_name' => 'Test'])->assertForbidden();

        $admin = User::create(['name' => 'Admin', 'email' => 'admin@example.test',
            'role' => 'admin', 'password' => Hash::make(bin2hex(random_bytes(12)))]);
        $this->actingAs($admin)->postJson(route('api.admin.roles.store'), ['role_name' => 'Test'])->assertCreated();
        $this->assertDatabaseHas('roles', ['role_name' => 'Test']);
    }
}
