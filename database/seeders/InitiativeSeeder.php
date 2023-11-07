<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InitiativeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $initiatives = [
            ['name' => 'News Today','description' => null, 'path' => '/news-today'],
            ['name' => 'Monthly Magazine','description' => null, 'path' => '/monthly-magazine'],
            ['name' => 'Weekly Focus','description' => null, 'path' => '/weekly-focus'],
            ['name' => 'Mains 365','description' => null, 'path' => '/mains-365'],
            ['name' => 'PT 365','description' => null, 'path' => '/pt-365'],
            ['name' => 'Downloads', 'description' => null, 'path' => '/downloads']
        ];

        DB::table('initiatives')->insert($initiatives);
    }
}
