<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name' => 'Admin System',
            'code' => 'adminsystem',
        ]);

        Role::create([
            'name' => 'Admin Tenant',
            'code' => 'admintenant',
        ]);

        Role::create([
            'name' => 'Student',
            'code' => 'student',
        ]);
    }
}
