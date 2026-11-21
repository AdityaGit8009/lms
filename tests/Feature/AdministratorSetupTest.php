<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AdministratorSetupTest extends TestCase
{
    use RefreshDatabase;

    public function test_local_setup_creates_a_login_once_and_preserves_existing_accounts(): void
    {
        $password = bin2hex(random_bytes(12));
        $this->artisan('lms:create-admin')
            ->expectsQuestion('Name', 'Test Admin')->expectsQuestion('Email', 'local@example.test')
            ->expectsQuestion('Password', $password)->expectsQuestion('Confirm password', $password)
            ->assertSuccessful();
        $user = User::where('email', 'local@example.test')->firstOrFail();
        $this->assertTrue(Hash::check($password, $user->password));
        $this->assertSame('admin', $user->role);
        $this->assertDatabaseHas('roles', ['role_name' => 'admin']);
        $this->artisan('lms:create-admin')
            ->expectsQuestion('Name', 'Different User')->expectsQuestion('Email', 'local@example.test')
            ->assertFailed();
        $this->assertSame('Test Admin', $user->fresh()->name);
    }
}
