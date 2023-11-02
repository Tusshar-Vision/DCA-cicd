<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TopicSectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $topicSections = [

            // Sub Section for Polity Topic
            ['name' => 'Indian Constitution - Provisions and Basic Structure', 'topic_id' => 1],
            ['name' => 'Federal Structure', 'topic_id' => 1],
            ['name' => 'Union and State Executive', 'topic_id' => 1],
            ['name' => 'Parliament and State Legislature', 'topic_id' => 1],
            ['name' => 'Government Acts/Bills, Policies and Interventions', 'topic_id' => 1],
            ['name' => 'Separation of Powers', 'topic_id' => 1],
            ['name' => 'Judiciary', 'topic_id' => 1],
            ['name' => 'Elections', 'topic_id' => 1],
            ['name' => 'Governance', 'topic_id' => 1],
            ['name' => 'Local Governance', 'topic_id' => 1],
            ['name' => 'Transparency and Accountability', 'topic_id' => 1],
            ['name' => 'Others', 'topic_id' => 1],

            //Sub Section for International Relations Topic
            ['name' => 'India - Neighbourhood Relations', 'topic_id' => 2],
            ['name' => 'India and West Asia', 'topic_id' => 2],
            ['name' => 'India and Central Asia/Russia', 'topic_id' => 2],
            ['name' => 'India and Europe', 'topic_id' => 2],
            ['name' => 'India and South East Asia', 'topic_id' => 2],
            ['name' => 'India and East Asia', 'topic_id' => 2],
            ['name' => 'India and Australia/Pacific', 'topic_id' => 2],
            ['name' => 'India and Africa', 'topic_id' => 2],
            ['name' => 'India and USA', 'topic_id' => 2],
            ['name' => 'India and Latin America', 'topic_id' => 2],
            ['name' => 'Key International Organisations/Institutions', 'topic_id' => 2],
            ['name' => 'Key Treaties/Convention', 'topic_id' => 2],
            ['name' => 'Others', 'topic_id' => 2],

            // Sub Section For Economy Topic
            ['name' => 'Labour, Employment and Skill Development', 'topic_id' => 3],
            ['name' => 'Inclusive Development', 'topic_id' => 3],
            ['name' => 'Government Budgeting and Financial Intermediation', 'topic_id' => 3],
            ['name' => 'Banking and Finance', 'topic_id' => 3],
            ['name' => 'External Sector', 'topic_id' => 3],
            ['name' => 'Agriculture and Food Management', 'topic_id' => 3],
            ['name' => 'Infrastructure', 'topic_id' => 3],
            ['name' => 'Business and Industry', 'topic_id' => 3],
            ['name' => 'Services', 'topic_id' => 3],
            ['name' => 'Others', 'topic_id' => 3],

            // Sub Section for Security Topic
            ['name' => 'Extremism', 'topic_id' => 4],
            ['name' => 'Internal Security', 'topic_id' => 4],
            ['name' => 'Money Laundering', 'topic_id' => 4],
            ['name' => 'Management of Border Areas', 'topic_id' => 4],
            ['name' => 'Security Forces and Agencies', 'topic_id' => 4],
            ['name' => 'Defence Modernisation', 'topic_id' => 4],
            ['name' => 'Emerging Dimensions of Warfare', 'topic_id' => 4],
            ['name' => 'Miscellaneous', 'topic_id' => 4],

            // Sub Section for Environment Topic
            ['name' => 'Climate Change', 'topic_id' => 5],
            ['name' => 'Pollution', 'topic_id' => 5],
            ['name' => 'Conservation', 'topic_id' => 5],
            ['name' => 'Biodiversity', 'topic_id' => 5],
            ['name' => 'Renewable Energy And Alternative Energy Resources', 'topic_id' => 5],
            ['name' => 'Sustainable Development', 'topic_id' => 5],
            ['name' => 'Disaster Management', 'topic_id' => 5],
            ['name' => 'Geography', 'topic_id' => 5],
            ['name' => 'Miscellaneous', 'topic_id' => 5],
            ['name' => 'Maps', 'topic_id' => 5],

            // Sub Section for Social Topic
            ['name' => 'Women', 'topic_id' => 6],
            ['name' => 'Child', 'topic_id' => 6],
            ['name' => 'Persons with Disability', 'topic_id' => 6],
            ['name' => 'Elderly People', 'topic_id' => 6],
            ['name' => 'SC/ST/OBC', 'topic_id' => 6],
            ['name' => 'Other Vulnerable Groups', 'topic_id' => 6],
            ['name' => 'Developmental issues', 'topic_id' => 6],
            ['name' => 'Education', 'topic_id' => 6],
            ['name' => 'Others', 'topic_id' => 6],

            // Sub Section for Science and Technology Topic
            ['name' => 'Bio Technology', 'topic_id' => 7],
            ['name' => 'Nano Technology', 'topic_id' => 7],
            ['name' => 'Information Technology, Computers, Robotics', 'topic_id' => 7],
            ['name' => 'Space Related Developments', 'topic_id' => 7],
            ['name' => 'Nuclear Technology', 'topic_id' => 7],
            ['name' => 'Defence Related Developments', 'topic_id' => 7],
            ['name' => 'Prize/Awards', 'topic_id' => 7],
            ['name' => 'Health', 'topic_id' => 7],
            ['name' => 'Alternative Energy', 'topic_id' => 7],
            ['name' => 'Intellectual Property Rights (IPRs)', 'topic_id' => 7],
            ['name' => 'Miscellaneous', 'topic_id' => 7],

            // Sub Section for Culture Topic
            ['name' => 'Sculpture and Architecture', 'topic_id' => 8],
            ['name' => 'Paintings and Other Art forms', 'topic_id' => 8],
            ['name' => 'Initiatives of UNESCO', 'topic_id' => 8],
            ['name' => 'Personalities', 'topic_id' => 8],
            ['name' => 'Ancient India', 'topic_id' => 8],
            ['name' => 'Medieval India', 'topic_id' => 8],
            ['name' => 'Modern India', 'topic_id' => 8],

            // Sub Section for Ethics Topic
            ['name' => 'Ethics and Human Interface', 'topic_id' => 9],
            ['name' => 'Attitude', 'topic_id' => 9],
            ['name' => 'Aptitude and foundational values of Civil Services', 'topic_id' => 9],
            ['name' => 'Emotional Intelligence', 'topic_id' => 9],
            ['name' => 'Moral thinkers and Philosophers', 'topic_id' => 9],
            ['name' => 'Public/Civil Service values and Ethics in Public Administration', 'topic_id' => 9],
            ['name' => 'Probity in Governance', 'topic_id' => 9],
            ['name' => 'Other areas', 'topic_id' => 9],

            // Sub Section for Govt Schemes Topic
            ['name' => 'Ministry Of Agriculture And Farmers Welfare', 'topic_id' => 10],
            ['name' => 'Ministry Of Fisheries, Animal Husbandry & Dairying', 'topic_id' => 10],
            ['name' => 'Ministry Of Ayush', 'topic_id' => 10],
            ['name' => 'Ministry Of Chemicals And Fertilizers', 'topic_id' => 10],
            ['name' => 'Ministry Of Civil Aviation', 'topic_id' => 10],
            ['name' => 'Ministry Of Coal', 'topic_id' => 10],
            ['name' => 'Ministry Of Commerce', 'topic_id' => 10],
            ['name' => 'Ministry Of Communication', 'topic_id' => 10],
            ['name' => 'Ministry Of Consumer Affairs, Food & Public Distribution', 'topic_id' => 10],
            ['name' => 'Ministry Of Co-Operation', 'topic_id' => 10],
            ['name' => 'Ministry Of Corporate Affairs', 'topic_id' => 10],
            ['name' => 'Ministry Of Culture', 'topic_id' => 10],
            ['name' => 'Ministry Of Defence', 'topic_id' => 10],
            ['name' => 'Ministry Of Development Of North Eastern Region', 'topic_id' => 10],
            ['name' => 'Ministry Of Jal Shakti', 'topic_id' => 10],
            ['name' => 'Ministry Of Earth Sciences', 'topic_id' => 10],
            ['name' => 'Ministry Of Electronics & IT', 'topic_id' => 10],
            ['name' => 'Ministry Of Environment, Forest And Climate Change', 'topic_id' => 10],
            ['name' => 'Ministry Of External Affairs', 'topic_id' => 10],
            ['name' => 'Ministry Of Finance', 'topic_id' => 10],
            ["name" => "Ministry of Food Processing Industries", "topic_id" => 10],
            ["name" => "Ministry of Health and Family Welfare", "topic_id" => 10],
            ["name" => "Ministry of Heavy Industries & Public Enterprises", "topic_id" => 10],
            ["name" => "Ministry of Home Affairs", "topic_id" => 10],
            ["name" => "Ministry of Housing and Urban Affairs", "topic_id" => 10],
            ["name" => "Ministry of Human Resource and Development", "topic_id" => 10],
            ["name" => "Ministry of Labour and Employment", "topic_id" => 10],
            ["name" => "Ministry of Law and Justice", "topic_id" => 10],
            ["name" => "Ministry of Mines", "topic_id" => 10],
            ["name" => "Ministry of Minority Affairs", "topic_id" => 10],
            ["name" => "Ministry of Micro, Small and Medium Enterprises (Msme)", "topic_id" => 10],
            ["name" => "Ministry of New and Renewable Energy", "topic_id" => 10],
            ["name" => "Ministry of Panchayati Raj", "topic_id" => 10],
            ["name" => "Ministry of Personnel, Public Grievances and Pensions", "topic_id" => 10],
            ["name" => "Ministry of Petroleum and Natural Gas", "topic_id" => 10],
            ["name" => "Ministry of Power", "topic_id" => 10],
            ["name" => "Ministry of Railways", "topic_id" => 10],
            ["name" => "Ministry of Road Transport & Highways", "topic_id" => 10],
            ["name" => "Ministry of Rural Development", "topic_id" => 10],
            ["name" => "Ministry of Science and Technology", "topic_id" => 10],
            ["name" => "Ministry of Shipping", "topic_id" => 10],
            ["name" => "Ministry of Skill Development and Entrepreneurship", "topic_id" => 10],
            ["name" => "Ministry of Social Justice and Empowerment", "topic_id" => 10],
            ["name" => "Ministry of Statistics and Programme Implementation", "topic_id" => 10],
            ["name" => "Ministry of Steel", "topic_id" => 10],
            ["name" => "Ministry of Textile", "topic_id" => 10],
            ["name" => "Ministry of Tourism", "topic_id" => 10],
            ["name" => "Ministry of Tribal Affairs", "topic_id" => 10],
            ["name" => "Ministry of Women and Child Development", "topic_id" => 10],
            ["name" => "Ministry of Youth Affairs and Sports", "topic_id" => 10],
            ["name" => "Niti Aayog", "topic_id" => 10],
            ["name" => "Prime Minister’S Office", "topic_id" => 10],
            ["name" => "Department of Space/ Isro’S Initiatives", "topic_id" => 10],
            ["name" => "State Government Schemes", "topic_id" => 10]
        ];

        DB::table('topic_sections')->insert($topicSections);
    }
}
