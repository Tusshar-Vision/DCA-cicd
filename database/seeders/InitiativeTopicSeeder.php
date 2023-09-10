<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InitiativeTopicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $initiativeTopics = [
            ['name' => 'Polity'],
            ['name' => 'International Relations'],
            ['name' => 'Economy'],
            ['name' => 'Security'],
            ['name' => 'Environment'],
            ['name' => 'Social'],
            ['name' => 'Science & Tech'],
            ['name' => 'Culture'],
            ['name' => 'Ethics']
        ]; 

        DB::table('initiative_topics')->insert($initiativeTopics);
    }
}
