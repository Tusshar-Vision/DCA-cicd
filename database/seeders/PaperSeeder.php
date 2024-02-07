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
            ['id' => 1, 'name' => 'GS-1'],
            ['id' => 2, 'name' => 'GS-2'],
            ['id' => 3, 'name' => 'GS-3'],
            ['id' => 4, 'name' => 'GS-4'],
            ['id' => 5, 'name' => 'GS-5'],
            ['id' => 6, 'name' => 'Others'],
        ];

        Paper::insert($papers);
    }
}
