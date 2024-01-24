<?php

namespace Database\Seeders;

use App\Models\Paper;
use Illuminate\Database\Seeder;

class PaperSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $papers = [
            ['name' => 'GS-1'],
            ['name' => 'GS-2'],
            ['name' => 'GS-3'],
            ['name' => 'GS-4'],
            ['name' => 'GS-5'],
            ['name' => 'Others'],
        ];

        Paper::insert($papers);
    }
}
