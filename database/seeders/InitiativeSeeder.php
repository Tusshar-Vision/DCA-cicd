<?php

namespace Database\Seeders;

use App\Models\Initiative;
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
            ['id' => 1, 'name' => 'News Today', 'name_hindi' => "न्यूज टुडे", 'description' => null, 'path' => '/news-today'],
            ['id' => 2, 'name' => 'Monthly Magazine', 'name_hindi' => "मासिक पत्रिका", 'description' => null, 'path' => '/monthly-magazine'],
            ['id' => 3, 'name' => 'Weekly Focus', 'name_hindi' => "साप्ताहिक फोकस", 'description' => null, 'path' => '/weekly-focus'],
            ['id' => 4, 'name' => 'Mains 365', 'name_hindi' => "मेन्स 365", 'description' => null, 'path' => '/mains-365'],
            ['id' => 5, 'name' => 'PT 365', 'name_hindi' => "पीटी 365", 'description' => null, 'path' => '/pt-365'],
            ['id' => 6, 'name' => 'Downloads', 'name_hindi' => "डाउनलोड", 'description' => null, 'path' => '/downloads'],
            ['id' => 7, 'name' => 'More', 'name_hindi' => 'अधिक', 'description' => null, 'path' => '/more'],
            ['id' => 9, 'name' => 'Economic Survey', 'name_hindi' => 'आर्थिक सर्वेक्षण', 'description' => null, 'path' => '/economic-survey', 'parent_id' => 7],
            ['id' => 10, 'name' => 'Weekly Round Table', 'name_hindi' => 'साप्ताहिक गोलमेज', 'description' => null, 'path' => '/weekly-round-table', 'parent_id' => 7],
            ['id' => 11, 'name' => 'Animated Shorts', 'name_hindi' => 'एनिमेटेड शॉर्ट्स', 'description' => null, 'path' => '/animated-shorts', 'parent_id' => 7],
            ['id' => 12, 'name' => 'PYQs', 'name_hindi' => 'पीवाईक्यू', 'description' => null, 'path' => '/pyq', 'parent_id' => 7],
            ['id' => 13, 'name' => 'Value Added Material', 'name_hindi' => 'मूल्य वर्धित सामग्री', 'description' => null, 'path' => '/value-added-material', 'parent_id' => 7],
            ['id' => 14, 'name' => 'Value Added Material (Optional)', 'name_hindi' => 'मूल्य वर्धित सामग्री (वैकल्पिक)', 'description' => null, 'path' => '/value-added-material-optional', 'parent_id' => 7],
            ['id' => 15, 'name' => 'Quarterly Revision Documents', 'name_hindi' => 'त्रैमासिक संशोधन दस्तावेज़', 'description' => null, 'path' => '/quarterly-revision-documents', 'parent_id' => 7],
            ['id' => 17, 'name' => 'Budget', 'name_hindi' => 'बजट', 'description' => null, 'path' => '/budget', 'parent_id' => 7],
        ];
        Initiative::insert($initiatives);
    }
}
