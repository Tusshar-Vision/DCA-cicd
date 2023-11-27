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
            ['name' => 'News Today', 'name_hindi' => "न्यूज टुडे", 'description' => null, 'path' => '/news-today'],
            ['name' => 'Monthly Magazine', 'name_hindi' => "मासिक पत्रिका", 'description' => null, 'path' => '/monthly-magazine'],
            ['name' => 'Weekly Focus', 'name_hindi' => "साप्ताहिक फोकस", 'description' => null, 'path' => '/weekly-focus'],
            ['name' => 'Mains 365', 'name_hindi' => "मेन्स 365", 'description' => null, 'path' => '/mains-365'],
            ['name' => 'PT 365', 'name_hindi' => "पीटी 365", 'description' => null, 'path' => '/pt-365'],
            ['name' => 'Downloads', 'name_hindi' => "डाउनलोड", 'description' => null, 'path' => '/downloads']
        ];

        DB::table('initiatives')->insert($initiatives);
    }
}
