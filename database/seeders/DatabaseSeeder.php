<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        foreach (['admin', 'employee', 'student'] as $name) {
            if (!Role::whereRaw('LOWER(role_name) = ?', [$name])->exists()) {
                Role::create(['role_name' => $name]);
            }
        }
    }
}
