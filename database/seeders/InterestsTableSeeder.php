<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InterestsTableSeeder extends Seeder
{
    public function run()
    {
        $interests = [
            ['field' => 'Genie Civil', 'interest' => 'Structural Engineering'],
            ['field' => 'Genie Civil', 'interest' => 'Construction Management'],
            ['field' => 'Genie Informatique', 'interest' => 'AI Development'],
            ['field' => 'Genie Informatique', 'interest' => 'Web Development'],
            ['field' => 'Genie Industriel', 'interest' => 'Supply Chain Management'],
            ['field' => 'Genie Industriel', 'interest' => 'Process Optimization'],
        ];

        DB::table('interests')->insert($interests);
    }
}

