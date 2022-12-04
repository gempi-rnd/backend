<?php

namespace Database\Seeders;

use App\Models\AdminTenant;
use App\Models\Role;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminTenantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $user = User::create([
            'name' => 'Admin Tenant',
            'role_id' => Role::where('code', 'admintenant')->first()->id,
            'email' => 'admintenant@gmail.com',
            'password' => Hash::make('12345678'),
        ]);

        AdminTenant::create([
            'user_id' => $user->id,
            'tenant_id' => Tenant::where('slug', 'gempi')->first()->id,
            'full_name' => 'Admin Tenant',
            'email' => 'admintenant@gmail.com',
            'whatsapp' => '082370382007',
        ]);
    }
}
