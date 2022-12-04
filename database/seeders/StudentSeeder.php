<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Student;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Fikih Firmansyah',
            'role_id' => Role::where('code', 'student')->first()->id,
            'email' => 'fikihfirmansyah43@gmail.com',
            'password' => Hash::make('12345678'),
        ]);

        Student::create([
            'user_id' => $user->id,
            'tenant_id' => Tenant::where('slug', 'gempi')->first()->id,
            'full_name' => 'Fikih Firmansyah',
            'email' => 'fikihfirmansyah43@gmail.com',
            'whatsapp' => '082370382008',
        ]);
    }
}
