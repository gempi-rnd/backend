<?php

namespace Database\Seeders;

use App\Models\Tenant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TenantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tenant::create([
            'slug' => 'gempi',
            'name'  => 'GEMPI',
            'logo'  => 'https://i.ibb.co/5vdvxxS/82458562-612781166141833-1711622854904119296-n.jpg',
            'locale'    => 'id',
            'timezone'  => 'Asia/Jakarta',
            'email' => 'tryout@try-out.my.id',
            'content'   => 'This is GEMPI Tryout',
        ]);
    }
}
