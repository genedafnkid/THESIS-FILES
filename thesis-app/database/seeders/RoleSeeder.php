<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    public function run()
    {
        // Create roles with the 'web' guard
        Role::create(['name' => 'admin', 'guard_name' => 'web']);
        Role::create(['name' => 'instructor', 'guard_name' => 'web']);
        Role::create(['name' => 'student', 'guard_name' => 'web']);
    }
}
