<?php

namespace App\Console\Commands;

use App\Models\Role;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class CreateAdministrator extends Command
{
    protected $signature = 'lms:create-admin';
    protected $description = 'Create an administrator using a privately entered password';

    public function handle(): int
    {
        $name = trim((string) $this->ask('Name'));
        $email = strtolower(trim((string) $this->ask('Email')));
        $validator = Validator::make(compact('name', 'email'), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email', 'unique:tbl_register,email'],
        ]);
        if ($validator->fails()) {
            $this->error($validator->errors()->first());
            return self::FAILURE;
        }

        $password = $this->secret('Password', false);
        $confirmation = $this->secret('Confirm password', false);
        $validator = Validator::make(['password' => $password, 'password_confirmation' => $confirmation], [
            'password' => ['required', 'string', Password::defaults(), 'confirmed'],
        ]);
        if ($validator->fails()) {
            $this->error($validator->errors()->first());
            return self::FAILURE;
        }

        try {
            DB::transaction(function () use ($name, $email, $password) {
                if (!Role::whereRaw('LOWER(role_name) = ?', ['admin'])->exists()) {
                    Role::create(['role_name' => 'admin']);
                }
                User::create([
                    'name' => $name, 'email' => $email, 'role' => 'admin',
                    'password' => Hash::make($password), 'email_verified_at' => now(),
                ]);
            });
        } catch (UniqueConstraintViolationException $exception) {
            $this->error('That email already belongs to an account.');
            return self::FAILURE;
        }

        $this->info('Administrator created.');
        return self::SUCCESS;
    }
}
