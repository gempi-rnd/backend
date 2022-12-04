<?php

namespace Database\Seeders;

use App\Models\DifficultyLevels;
use App\Models\GroupTopic;
use App\Models\QuestionType;
use App\Models\Tenant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuestionBaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DifficultyLevels::create([
            'name'                  => 'Mudah',
            'tenant_id' => Tenant::where('slug', 'gempi')->first()->id,
            'code'                  => 'easy',
            'short_description'     => 'Mudah',
        ]);

        QuestionType::create([
            'name'                  => 'Multiple Choice Single Answer',
            'tenant_id' => Tenant::where('slug', 'gempi')->first()->id,
            'code'                  => 'MCSA',
            'short_description'     => 'Multiple Choice Single Answer',
        ]);
    }
}
