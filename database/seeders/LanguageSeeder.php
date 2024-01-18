<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $languages = [
            ['name' => 'English', 'code' => "en"],
            ['name' => 'Hindi', 'code' => "hi"],
            ['name' => 'Marathi', 'code' => "ma"],
            ['name' => 'Telugu', 'code' => "te"],
            ['name' => 'Tamil', 'code' => "ta"],
            ['name' => 'Kannada', 'code' => "ka"],
            ['name' => 'Malayalam', 'code' => "ml"],
            ['name' => 'Gujarati', 'code' => "gu"],
            ['name' => 'Punjabi', 'code' => "pu"],
            ['name' => 'Bengali', 'code' => "be"],
            ['name' => 'Assamese', 'code' => "as"],
            ['name' => 'Odia', 'code' => "od"],
        ];

        Language::insert($languages);
    }
}
