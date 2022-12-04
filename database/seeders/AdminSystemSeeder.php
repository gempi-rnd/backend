<?php

namespace Database\Seeders;

use App\Models\AdminTenant;
use App\Models\Role;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSystemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $user = User::create([
            'name' => 'Admin System',
            'role_id' => Role::where('code', 'adminsystem')->first()->id,
            'email' => 'adminsystem@gmail.com',
            'password' => Hash::make('12345678'),
        ]);

        AdminTenant::create([
            'user_id' => $user->id,
            'tenant_id' => Tenant::where('slug', 'gempi')->first()->id,
            'full_name' => 'Admin System',
            'email' => 'adminsystem@gmail.com',
            'whatsapp' => '082370382009',
        ]);
    }
}
