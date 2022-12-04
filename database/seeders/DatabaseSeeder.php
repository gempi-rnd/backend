<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleSeeder::class);
        $this->call(TenantSeeder::class);
        $this->call(StudentSeeder::class);
        $this->call(AdminTenantSeeder::class);
        $this->call(AdminSystemSeeder::class);
        $this->call(QuestionBaseSeeder::class);
    }
}
