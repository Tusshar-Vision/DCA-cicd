<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TopicSubSectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $topicSubSections = [
            // Sub Sections for Indian Constitution - Provisions and Basic Structure
            ['name' => 'Evolution of Constitution', 'section_id' => 1],
            ['name' => 'Major amendments', 'section_id' => 1],
            ['name' => 'Comparison with Other Constitutions', 'section_id' => 1],
            ['name' => 'Basic Structure', 'section_id' => 1],
            ['name' => 'Rule of Law', 'section_id' => 1],
            ['name' => 'Sedition', 'section_id' => 1],
            ['name' => 'Uniform Civil Code', 'section_id' => 1],
            ['name' => 'Reservation', 'section_id' => 1],
            ['name' => 'Censorship', 'section_id' => 1],
            ['name' => 'Fundamental Rights', 'section_id' => 1],
            ['name' => 'Directive Principles of State Policy', 'section_id' => 1],
            ['name' => 'Fundamental Duties', 'section_id' => 1],
            ['name' => 'Citizenship', 'section_id' => 1],
            ['name' => 'Others', 'section_id' => 1],

            // Sub Sections for Federal Structure
            ['name' => 'Federation', 'section_id' => 2],
            ['name' => 'Inter-State Water Disputes', 'section_id' => 2],
            ['name' => '6th Schedule', 'section_id' => 2],
            ['name' => 'UTs', 'section_id' => 2],
            ['name' => 'Reorganisation of States', 'section_id' => 2],
            ['name' => 'Emergency Provisions', 'section_id' => 2],
            ['name' => 'Others', 'section_id' => 2],

            // Sub Sections for Union and State Executive
            ['name' => 'President', 'section_id' => 3],
            ['name' => 'Vice-President', 'section_id' => 3],
            ['name' => 'Prime Minister', 'section_id' => 3],
            ['name' => 'Council of Ministers', 'section_id' => 3],
            ['name' => 'Cabinet', 'section_id' => 3],
            ['name' => 'Attorney General', 'section_id' => 3],
            ['name' => 'Governor', 'section_id' => 3],
            ['name' => 'Chief Minister', 'section_id' => 3],
            ['name' => 'State Council of Ministers', 'section_id' => 3],
            ['name' => 'Advocate General', 'section_id' => 3],
            ['name' => 'Others', 'section_id' => 3],

            // Sub Sections for Parliament and State Legislature
            ['name' => 'Speaker and Deputy Speaker of Lok Sabha', 'section_id' => 4],
            ['name' => 'Chairman of Rajya Sabha', 'section_id' => 4],
            ['name' => 'Conduct of Business', 'section_id' => 4],
            ['name' => 'Anti-Defection Law', 'section_id' => 4],
            ['name' => 'Parliamentary committees', 'section_id' => 4],
            ['name' => 'Parliamentary privileges', 'section_id' => 4],
            ['name' => 'State Legislative council', 'section_id' => 4],
            ['name' => 'Others', 'section_id' => 4],

            // Sub Sections for Government Acts/Bills, Policies and Interventions
            ['name' => 'Co-operatives', 'section_id' => 5],
            ['name' => 'Pressure groups', 'section_id' => 5],
            ['name' => 'Others', 'section_id' => 5],

            // Sub Sections for Separation of Powers
            ['name' => 'Judicial Review, Activism and overreach', 'section_id' => 6],
            ['name' => 'Checks and Balances', 'section_id' => 6],
            ['name' => 'Others', 'section_id' => 6],

            // Sub Sections for Judiciary
            ['name' => 'Judicial Reforms', 'section_id' => 7],
            ['name' => 'Contempt of Court', 'section_id' => 7],
            ['name' => 'Judicial Independence', 'section_id' => 7],
            ['name' => 'Tribunals', 'section_id' => 7],
            ['name' => 'Alternate Dispute Resolution', 'section_id' => 7],
            ['name' => 'Others', 'section_id' => 7],

            // Sub Sections for Elections
            ['name' => 'Electoral Reforms', 'section_id' => 8],
            ['name' => 'Election Commission of India', 'section_id' => 8],
            ['name' => 'Others', 'section_id' => 8],

            // Sub Sections for Governance
            ['name' => 'E-Governance', 'section_id' => 9],
            ['name' => 'Citizen Charter', 'section_id' => 9],
            ['name' => 'Social Accountability', 'section_id' => 9],
            ['name' => 'Social Audit', 'section_id' => 9],
            ['name' => 'Sevottam Model', 'section_id' => 9],
            ['name' => 'Role of Civil Services in India', 'section_id' => 9],
            ['name' => 'Others', 'section_id' => 9],

            // Sub Sections for Local Governance
            ['name' => 'Urban Local Bodies', 'section_id' => 10],
            ['name' => 'Panchayats', 'section_id' => 10],
            ['name' => 'Aspirational Districts', 'section_id' => 10],
            ['name' => 'Panchayat Extension to Scheduled Areas', 'section_id' => 10],
            ['name' => 'Others', 'section_id' => 10],

            // Sub Sections for Transparency and Accountability
            ['name' => 'Right to information', 'section_id' => 11],
            ['name' => 'Whistle Blowing', 'section_id' => 11],
            ['name' => 'Others', 'section_id' => 11],

            // Sub Sections for Others
            ['name' => 'Constitutional Bodies', 'section_id' => 12],
            ['name' => 'Non-Constitutional Bodies', 'section_id' => 12],

            // Sub Sections for India - Neighbourhood Relations
            ['name' => 'Pakistan', 'section_id' => 13],
            ['name' => 'Bangladesh', 'section_id' => 13],
            ['name' => 'Bhutan', 'section_id' => 13],
            ['name' => 'Nepal', 'section_id' => 13],
            ['name' => 'Sri Lanka', 'section_id' => 13],
            ['name' => 'Maldives', 'section_id' => 13],
            ['name' => 'China', 'section_id' => 13],
            ['name' => 'Afghanistan', 'section_id' => 13],
            ['name' => 'Myanmar', 'section_id' => 13],
            ['name' => 'Others', 'section_id' => 13],

            // Sub Sections for India and West Asia
            ['name' => 'Iraq', 'section_id' => 14],
            ['name' => 'Iran', 'section_id' => 14],
            ['name' => 'Saudi Arabia', 'section_id' => 14],
            ['name' => 'Israel and Palestine', 'section_id' => 14],
            ['name' => 'UAE', 'section_id' => 14],
            ['name' => 'Qatar', 'section_id' => 14],
            ['name' => 'Others', 'section_id' => 14],

            // Sub Sections for India and Central Asia/Russia
            ['name' => 'Russia', 'section_id' => 15],
            ['name' => 'Mongolia', 'section_id' => 15],
            ['name' => 'Kazakhstan', 'section_id' => 15],
            ['name' => 'Turkmenistan', 'section_id' => 15],
            ['name' => 'Tajikistan', 'section_id' => 15],
            ['name' => 'Kyrgyzstan', 'section_id' => 15],
            ['name' => 'Uzbekistan', 'section_id' => 15],
            ['name' => 'Others', 'section_id' => 15],

            // Sub Sections for India and Europe
            ['name' => 'European Union (EU)', 'section_id' => 16],
            ['name' => 'United Kingdom', 'section_id' => 16],
            ['name' => 'France', 'section_id' => 16],
            ['name' => 'Germany', 'section_id' => 16],
            ['name' => 'Scandinavian Countries', 'section_id' => 16],
            ['name' => 'Others', 'section_id' => 16],

            // Sub Sections for India and South East Asia
            ['name' => 'Indonesia', 'section_id' => 17],
            ['name' => 'Vietnam', 'section_id' => 17],
            ['name' => 'Singapore', 'section_id' => 17],
            ['name' => 'Philippines', 'section_id' => 17],
            ['name' => 'Malaysia', 'section_id' => 17],
            ['name' => 'Others', 'section_id' => 17],

            // Sub Sections for India and East Asia
            ['name' => 'Japan', 'section_id' => 18],
            ['name' => 'North Korea', 'section_id' => 18],
            ['name' => 'South Korea', 'section_id' => 18],
            ['name' => 'Taiwan', 'section_id' => 18],
            ['name' => 'Others', 'section_id' => 18],

            // Sub Sections for India and Australia/Pacific
            ['name' => 'Australia', 'section_id' => 19],
            ['name' => 'New Zealand', 'section_id' => 19],
            ['name' => 'Fiji', 'section_id' => 19],
            ['name' => 'Others', 'section_id' => 19],

            // Sub Sections for India and Africa
            ['name' => 'South Africa', 'section_id' => 20],
            ['name' => 'Kenya', 'section_id' => 20],
            ['name' => 'Egypt', 'section_id' => 20],
            ['name' => 'African Union', 'section_id' => 20],
            ['name' => 'Others', 'section_id' => 20],

            // Sub Sections for India and Latin America
            ['name' => 'Brazil', 'section_id' => 22],
            ['name' => 'Argentina', 'section_id' => 22],
            ['name' => 'Cuba', 'section_id' => 22],
            ['name' => 'Others', 'section_id' => 22],

            // Sub Sections for Key International Organisations/Institutions
            ['name' => 'UN', 'section_id' => 23],
            ['name' => 'UNHRC', 'section_id' => 23],
            ['name' => 'WTO', 'section_id' => 23],
            ['name' => 'WHO', 'section_id' => 23],
            ['name' => 'G20', 'section_id' => 23],
            ['name' => 'G7', 'section_id' => 23],
            ['name' => 'SCO', 'section_id' => 23],
            ['name' => 'OPEC', 'section_id' => 23],
            ['name' => 'IOR', 'section_id' => 23],
            ['name' => 'RCEP', 'section_id' => 23],
            ['name' => 'ASEAN', 'section_id' => 23],
            ['name' => 'BRICS', 'section_id' => 23],
            ['name' => 'IBSA', 'section_id' => 23],
            ['name' => 'BIMSTEC', 'section_id' => 23],
            ['name' => 'SAARC', 'section_id' => 23],
            ['name' => 'IAEA', 'section_id' => 23],
            ['name' => 'ADB', 'section_id' => 23],
            ['name' => 'Mekong Ganga', 'section_id' => 23],
            ['name' => 'NATO', 'section_id' => 23],
            ['name' => 'OIC', 'section_id' => 23],
            ['name' => 'Eurasian Economic Union', 'section_id' => 23],
            ['name' => 'GCC', 'section_id' => 23],
            ['name' => 'Arab League', 'section_id' => 23],
            ['name' => 'Quad/AUKUS', 'section_id' => 23],
            ['name' => 'UNFCCC', 'section_id' => 23],
            ['name' => 'Others', 'section_id' => 23],

            // Sub Sections for Key Treaties/Convention
            ['name' => 'Nuclear Disarmament', 'section_id' => 24],
            ['name' => 'Environment', 'section_id' => 24],
            ['name' => 'Space', 'section_id' => 24],
            ['name' => 'Sea', 'section_id' => 24],
            ['name' => 'Terrorism', 'section_id' => 24],
            ['name' => 'Arctic/Antarctic', 'section_id' => 24],
            ['name' => 'Others', 'section_id' => 24],

            // Sub Sections for Labour, Employment and Skill Development
            ['name' => 'Employment', 'section_id' => 26],
            ['name' => 'Skill Development', 'section_id' => 26],
            ['name' => 'Labour', 'section_id' => 26],
            ['name' => 'Others', 'section_id' => 26],

            // Sub Sections for Inclusive Development
            ['name' => 'Housing and Poverty Alleviation', 'section_id' => 27],
            ['name' => 'Financial Inclusion', 'section_id' => 27],
            ['name' => 'Land Reforms in India', 'section_id' => 27],
            ['name' => 'Urban Growth and Development', 'section_id' => 27],
            ['name' => 'Others', 'section_id' => 27],

            // Sub Sections for Government Budgeting and Financial Intermediation
            ['name' => 'Fiscal Policy', 'section_id' => 28],
            ['name' => 'Taxation', 'section_id' => 28],
            ['name' => 'Monetary Policy', 'section_id' => 28],
            ['name' => 'Others', 'section_id' => 28],

            // Sub Sections for Banking and Finance
            ['name' => 'Financial Markets', 'section_id' => 29],
            ['name' => 'Banking', 'section_id' => 29],
            ['name' => 'Payment Systems', 'section_id' => 29],
            ['name' => 'Others', 'section_id' => 29],

            // Sub Sections for External Sector
            ['name' => 'Trade', 'section_id' => 30],
            ['name' => 'Investment', 'section_id' => 30],
            ['name' => 'Others', 'section_id' => 30],

            // Sub Sections for Agriculture and Food Management
            ['name' => 'Agricultural Input', 'section_id' => 31],
            ['name' => 'Sustainable Agriculture', 'section_id' => 31],
            ['name' => 'Agricultural Technology and Research', 'section_id' => 31],
            ['name' => 'Allied Sector', 'section_id' => 31],
            ['name' => 'Food Processing Sector', 'section_id' => 31],
            ['name' => 'Food Management', 'section_id' => 31],
            ['name' => 'Agriculture Miscellaneous', 'section_id' => 31],

            // Sub Sections for Infrastructure
            ['name' => 'Ports, shipping and waterways', 'section_id' => 32],
            ['name' => 'Roads', 'section_id' => 32],
            ['name' => 'Railways', 'section_id' => 32],
            ['name' => 'Aviation', 'section_id' => 32],
            ['name' => 'Power sector', 'section_id' => 32],
            ['name' => 'Social Infrastructure', 'section_id' => 32],

            // Sub Sections for Business and Industry
            ['name' => 'Business', 'section_id' => 33],
            ['name' => 'Innovation and Entrepreneurship', 'section_id' => 33],
            ['name' => 'Industrial Sector as a whole', 'section_id' => 33],
            ['name' => 'Micro, Small and Medium Enterprises (MSME)', 'section_id' => 33],
            ['name' => 'Steel Industry', 'section_id' => 33],
            ['name' => 'Textile Industry', 'section_id' => 33],
            ['name' => 'Electronics Industry', 'section_id' => 33],
            ['name' => 'Pharmaceutical Industry', 'section_id' => 33],
            ['name' => 'Other Industries', 'section_id' => 33],

            // Sub Sections for Services
            ['name' => 'Services Sector as a whole', 'section_id' => 34],
            ['name' => 'IT-BPM Sector', 'section_id' => 34],
            ['name' => 'Tourism Sector', 'section_id' => 34],
            ['name' => 'Space Sector', 'section_id' => 34],

            // Sub Sections for Extremism
            ['name' => 'Left Wing Extremism (LWE)', 'section_id' => 36],
            ['name' => 'North-East Insurgency', 'section_id' => 36],
            ['name' => 'Technology and Extremism', 'section_id' => 36],
            ['name' => 'Others', 'section_id' => 36],

            // Sub Sections for Internal Security
            ['name' => 'Terrorism', 'section_id' => 37],
            ['name' => 'Cyber-security', 'section_id' => 37],
            ['name' => 'Media and Social Networking Sites', 'section_id' => 37],
            ['name' => 'External State and Non-State Actors', 'section_id' => 37],
            ['name' => 'Inter-State Disputes', 'section_id' => 37],
            ['name' => 'Peace Accords with North- Eastern States', 'section_id' => 37],
            ['name' => 'Internet Shutdowns', 'section_id' => 37],
            ['name' => 'Others', 'section_id' => 37],

            // Sub Sections for Money Laundering
            ['name' => 'Black Money', 'section_id' => 38],
            ['name' => 'Others', 'section_id' => 38],

            // Sub Sections for Management of Border Areas
            ['name' => 'Various Technologies for Border Management', 'section_id' => 39],
            ['name' => 'Maritime/Coastal Security', 'section_id' => 39],
            ['name' => 'Border Infrastructure', 'section_id' => 39],
            ['name' => 'Others', 'section_id' => 39],

            // Sub Sections for Security Forces and Agencies
            ['name' => 'Central Armed Police Forces (CAPF)', 'section_id' => 40],
            ['name' => 'National Security Architecture', 'section_id' => 40],
            ['name' => 'Others', 'section_id' => 40],

            // Sub Sections for Defence Modernisation
            ['name' => 'Defence Production', 'section_id' => 41],
            ['name' => 'Defence Acquisition', 'section_id' => 41],
            ['name' => 'Theatre Command', 'section_id' => 41],
            ['name' => 'Women in Combat Role', 'section_id' => 41],
            ['name' => 'Others', 'section_id' => 41],

            // Sub Sections for Emerging Dimensions of Warfare
            ['name' => 'Space Warfare', 'section_id' => 42],
            ['name' => 'Hybrid Warfare', 'section_id' => 42],
            ['name' => 'Others', 'section_id' => 42],

            // Sub Sections for Miscellaneous
            ['name' => 'Police Reforms', 'section_id' => 43],
            ['name' => "India's Nuclear Doctrine", 'section_id' => 43],
            ['name' => 'Intelligence Reforms', 'section_id' => 43],
            ['name' => 'Others', 'section_id' => 43],

            // Sub Sections for Climate Change
            ['name' => 'Intergovernmental Panel on Climate Change (IPCC)', 'section_id' => 44],
            ['name' => 'Climate and Clean Air Coalition', 'section_id' => 44],
            ['name' => 'Conference of the Parties (COP)', 'section_id' => 44],
            ['name' => 'UN Environment Programme (UNEP)', 'section_id' => 44],
            ['name' => 'World Meteorological Organization (WMO)', 'section_id' => 44],
            ['name' => 'United Nations Framework Convention on Climate Change (UNFCCC)', 'section_id' => 44],
            ['name' => 'International Solar Alliance (ISA)', 'section_id' => 44],
            ['name' => 'World Meteorological Organization (WMO)', 'section_id' => 44],
            ['name' => 'Coalition for Disaster Resilient Infrastructure', 'section_id' => 44],
            ['name' => 'Kigali Amendment', 'section_id' => 44],
            ['name' => 'Montreal Protocol', 'section_id' => 44],
            ['name' => 'Panchamrita', 'section_id' => 44],
            ['name' => 'Ozone Depletion', 'section_id' => 44],
            ['name' => 'Global Warming', 'section_id' => 44],
            ['name' => 'Climate Finance', 'section_id' => 44],
            ['name' => 'Green Finance Mechanisms', 'section_id' => 44],
            ['name' => 'Carbon Border Tax', 'section_id' => 44],
            ['name' => '‘Net zero’ carbon targets', 'section_id' => 44],
            ['name' => 'Carbon capture, utilisation and storage (CCUS)', 'section_id' => 44],
            ['name' => 'Carbon Pricing', 'section_id' => 44],
            ['name' => 'Carbon trading', 'section_id' => 44],
            ['name' => 'Adaptation Gap Report', 'section_id' => 44],
            ['name' => 'Emissions Gap Report', 'section_id' => 44],
            ['name' => 'Adaptation Gap Report', 'section_id' => 44],
            ['name' => 'Climate Change Performance Index (CCPI)', 'section_id' => 44],
            ['name' => 'State Energy & Climate Index (SECI)', 'section_id' => 44],
            ['name' => 'Environmental Performance Index (EPI)', 'section_id' => 44],
            ['name' => 'Sea Level Rise', 'section_id' => 44],
            ['name' => 'Sea Ice Cover', 'section_id' => 44],
            ['name' => 'Global Water Stress Hotspots', 'section_id' => 44],
            ['name' => 'Thermohaline circulation (THC)', 'section_id' => 44],
            ['name' => 'Permafrost Thawing', 'section_id' => 44],
            ['name' => 'Arctic Region', 'section_id' => 44],
            ['name' => 'Antarctic region', 'section_id' => 44],
            ['name' => 'Global Methane Budget', 'section_id' => 44],
            ['name' => 'Global Nitrous Oxide Budget', 'section_id' => 44],
            ['name' => 'Land Degradation', 'section_id' => 44],
            ['name' => 'Other Reports', 'section_id' => 44],
            ['name' => 'Miscellaneous', 'section_id' => 44],

            // Sub Sections for Pollution
            ['name' => 'Air Pollution', 'section_id' => 45],
            ['name' => 'World Health Organisation (WHO) Air Pollution Standards', 'section_id' => 45],
            ['name' => 'National Clean Air Programme (NCAP)', 'section_id' => 45],
            ['name' => 'Indoor Air Pollution', 'section_id' => 45],
            ['name' => 'Flue Gas Desulphurisation (FGD)', 'section_id' => 45],
            ['name' => 'Fly Ash', 'section_id' => 45],
            ['name' => 'Decarbonising transport', 'section_id' => 45],
            ['name' => 'Agricultural Emissions', 'section_id' => 45],
            ['name' => 'Stubble burning', 'section_id' => 45],
            ['name' => 'Water Pollution and Conservation', 'section_id' => 45],
            ['name' => 'Groundwater', 'section_id' => 45],
            ['name' => 'Single Use Plastic', 'section_id' => 45],
            ['name' => 'Marine Plastic Pollution', 'section_id' => 45],
            ['name' => 'Great Pacific Garbage Patch', 'section_id' => 45],
            ['name' => 'Solid Waste', 'section_id' => 45],
            ['name' => 'Biomedical waste', 'section_id' => 45],
            ['name' => 'e-waste', 'section_id' => 45],
            ['name' => 'Ammonia Pollution', 'section_id' => 45],
            ['name' => 'Stockholm Convention', 'section_id' => 45],
            ['name' => 'Minamata Convention', 'section_id' => 45],
            ['name' => 'Clean coal technology', 'section_id' => 45],
            ['name' => 'Other Reports', 'section_id' => 45],
            ['name' => 'Miscellaneous', 'section_id' => 45],

            // Sub Sections for Conservation
            ['name' => 'National Green Tribunal (NGT)', 'section_id' => 46],
            ['name' => 'Other Environment Laws', 'section_id' => 46],
            ['name' => 'Other Environment Policies', 'section_id' => 46],
            ['name' => 'Coral Restoration', 'section_id' => 46],
            ['name' => 'Coastal Regulation Zones', 'section_id' => 46],
            ['name' => 'Watershed Development', 'section_id' => 46],
            ['name' => 'Compensatory Afforestation', 'section_id' => 46],
            ['name' => 'Urban Forestry', 'section_id' => 46],
            ['name' => 'Other Conservation Efforts', 'section_id' => 46],

            // Sub Sections for Biodiversity
            ['name' => 'United Nations Convention on Biological Diversity (CBD)', 'section_id' => 47],
            ['name' => 'International Union for the Conservation of Nature (IUCN)', 'section_id' => 47],
            ['name' => 'Biological Diversity (Amendment) Act, 2021', 'section_id' => 47],
            ['name' => 'Wildlife (Protection) Act, 1972', 'section_id' => 47],
            ['name' => 'Possibly Extinct species', 'section_id' => 47],
            ['name' => 'Terrestrial species', 'section_id' => 47],
            ['name' => 'Aquatic species', 'section_id' => 47],
            ['name' => 'Avian Species', 'section_id' => 47],
            ['name' => 'Insects, rodents etc', 'section_id' => 47],
            ['name' => 'Plant Species', 'section_id' => 47],
            ['name' => 'Other Species', 'section_id' => 47],
            ['name' => 'Biosphere Reserves', 'section_id' => 47],
            ['name' => 'Wildlife Sanctuary', 'section_id' => 47],
            ['name' => 'National Parks', 'section_id' => 47],
            ['name' => 'Other Protected Areas', 'section_id' => 47],
            ['name' => 'Lakes', 'section_id' => 47],
            ['name' => 'Wetlands', 'section_id' => 47],
            ['name' => 'Ramsar Sites', 'section_id' => 47],
            ['name' => 'Coral Reefs', 'section_id' => 47],
            ['name' => 'Coastlands', 'section_id' => 47],
            ['name' => 'Forests', 'section_id' => 47],
            ['name' => 'Other Reports', 'section_id' => 47],
            ['name' => 'Miscellaneous', 'section_id' => 47],

            // Sub Sections for Renewable Energy And Alternative Energy Resources
            ['name' => 'Hydrogen Based Energy', 'section_id' => 48],
            ['name' => 'Methanol Economy', 'section_id' => 48],
            ['name' => 'Geothermal Energy', 'section_id' => 48],
            ['name' => 'Ethanol Blending in India', 'section_id' => 48],
            ['name' => 'Electric Vehicles', 'section_id' => 48],
            ['name' => 'Renewable Energy Certificate (REC)', 'section_id' => 48],
            ['name' => 'Solar Energy', 'section_id' => 48],
            ['name' => 'Wind Energy', 'section_id' => 48],
            ['name' => 'Hybrid Renewable Energy', 'section_id' => 48],
            ['name' => 'Other Non Renewable Energy', 'section_id' => 48],
            ['name' => 'Other Renewable Energy', 'section_id' => 48],
            ['name' => 'Other Reports', 'section_id' => 48],
            ['name' => 'Miscellaneous', 'section_id' => 48],

            // Sub Sections for Sustainable Development
            ['name' => 'Natural Capital Accounting', 'section_id' => 49],
            ['name' => 'Gross Environment Product (GEP)', 'section_id' => 49],
            ['name' => 'Organic farming', 'section_id' => 49],
            ['name' => 'Millets', 'section_id' => 49],
            ['name' => 'Environment Impact Assessment (EIA)', 'section_id' => 49],
            ['name' => 'Sand Mining', 'section_id' => 49],
            ['name' => 'Solid Waste Management', 'section_id' => 49],
            ['name' => 'Coal Gasification', 'section_id' => 49],
            ['name' => 'Other Clean Coal Technologies', 'section_id' => 49],

            // Sub Sections for Disaster Management
            ['name' => 'Flash Floods', 'section_id' => 50],
            ['name' => 'Landslides', 'section_id' => 50],
            ['name' => 'Floods', 'section_id' => 50],
            ['name' => 'Earthquake', 'section_id' => 50],
            ['name' => 'Volcano', 'section_id' => 50],
            ['name' => 'Tsunamis', 'section_id' => 50],
            ['name' => 'Glacial Lake Outburst Floods (GLOF)', 'section_id' => 50],
            ['name' => 'Cyclones', 'section_id' => 50],
            ['name' => 'Forest Fires', 'section_id' => 50],
            ['name' => 'Urban Fiires', 'section_id' => 50],
            ['name' => 'Droughts', 'section_id' => 50],
            ['name' => 'Cloudbursts', 'section_id' => 50],
            ['name' => 'Other Reports', 'section_id' => 50],
            ['name' => 'Miscellaneous', 'section_id' => 50],

            // Sub Sections for Geography
            ['name' => 'Glacial Lake', 'section_id' => 51],
            ['name' => 'Atlantic Meridional Overturning Circulation (AMOC)', 'section_id' => 51],
            ['name' => 'La-Nina', 'section_id' => 51],
            ['name' => 'El-Nino', 'section_id' => 51],
            ['name' => 'Earth', 'section_id' => 51],

            // Sub Sections for Maps
            ['name' => 'Rivers maps', 'section_id' => 53],
            ['name' => 'Mountain maps', 'section_id' => 53],
            ['name' => 'Country maps', 'section_id' => 53],

            // Sub Sections for Women
            ['name' => 'Laws/Acts', 'section_id' => 54],
            ['name' => 'Key bodies/organisation', 'section_id' => 54],
            ['name' => 'key initiatives/Scheme', 'section_id' => 54],
            ['name' => 'Key data', 'section_id' => 54],
            ['name' => 'Others', 'section_id' => 54],

            // Sub Sections for Child
            ['name' => 'Laws/Acts', 'section_id' => 55],
            ['name' => 'Key bodies/organisation', 'section_id' => 55],
            ['name' => 'key initiatives/Scheme', 'section_id' => 55],
            ['name' => 'Key data', 'section_id' => 55],
            ['name' => 'Others', 'section_id' => 55],

            // Sub Sections for Persons with Disability
            ['name' => 'Laws/Acts', 'section_id' => 56],
            ['name' => 'Key bodies/organisation', 'section_id' => 56],
            ['name' => 'key initiatives/Scheme', 'section_id' => 56],
            ['name' => 'Key data', 'section_id' => 56],
            ['name' => 'Others', 'section_id' => 56],

            // Sub Sections for Elderly People
            ['name' => 'Laws/Acts', 'section_id' => 57],
            ['name' => 'Key bodies/organisation', 'section_id' => 57],
            ['name' => 'key initiatives/Scheme', 'section_id' => 57],
            ['name' => 'Key data', 'section_id' => 57],
            ['name' => 'Others', 'section_id' => 57],

            // Sub Sections for SC/ST/OBC
            ['name' => 'Laws/Acts', 'section_id' => 58],
            ['name' => 'Key bodies/organisation', 'section_id' => 58],
            ['name' => 'key initiatives/Scheme', 'section_id' => 58],
            ['name' => 'Key data', 'section_id' => 58],
            ['name' => 'Others', 'section_id' => 58],

            // Sub Sections for Other Vulnerable Groups
            ['name' => 'Transgender', 'section_id' => 59],
            ['name' => 'Indigenous People', 'section_id' => 59],
            ['name' => 'Manual Scavenger', 'section_id' => 59],
            ['name' => 'Others', 'section_id' => 59],

            // Sub Sections for Developmental issues
            ['name' => 'Poverty', 'section_id' => 60],
            ['name' => 'Migration', 'section_id' => 60],
            ['name' => 'Nutrition', 'section_id' => 60],
            ['name' => 'Globalisation', 'section_id' => 60],
            ['name' => 'Urbanisation', 'section_id' => 60],
            ['name' => 'Social Security and Informal Workers', 'section_id' => 60],
            ['name' => 'Others', 'section_id' => 60],

            // Sub Sections for Education
            ['name' => 'Laws/Acts/Policies', 'section_id' => 61],
            ['name' => 'Key bodies/organisation', 'section_id' => 61],
            ['name' => 'key initiatives/Scheme', 'section_id' => 61],
            ['name' => 'Key data', 'section_id' => 61],
            ['name' => 'Others', 'section_id' => 61],

            // Sub Sections for Bio Technology
            ['name' => 'Genome Sequencing', 'section_id' => 63],
            ['name' => 'Genome Editing', 'section_id' => 63],
            ['name' => 'GM Crops', 'section_id' => 63],
            ['name' => 'Stem Cells', 'section_id' => 63],
            ['name' => 'DNA', 'section_id' => 63],
            ['name' => 'RNA', 'section_id' => 63],
            ['name' => 'Others', 'section_id' => 63],

            // Sub Sections for Nano Technology
            ['name' => 'Applications of Nano Technology', 'section_id' => 64],
            ['name' => 'Developments in Nano Technology', 'section_id' => 64],
            ['name' => 'Others', 'section_id' => 64],

            // Sub Sections for Information Technology, Computers, Robotics
            ['name' => '3G/4G/5G/6G', 'section_id' => 65],
            ['name' => 'Wi-Fi Technology', 'section_id' => 65],
            ['name' => 'Li-Fi Technology', 'section_id' => 65],
            ['name' => 'Near Field Communication (NFC) Technology', 'section_id' => 65],
            ['name' => 'Satellite Internet Services', 'section_id' => 65],
            ['name' => '3D Printing/Additive Manufacturing', 'section_id' => 65],
            ['name' => 'Artificial Intelligence', 'section_id' => 65],
            ['name' => 'Non-Fungible tokens (NFTs)', 'section_id' => 65],
            ['name' => 'BlockChain', 'section_id' => 65],
            ['name' => 'Biometrics', 'section_id' => 65],
            ['name' => 'IoT (Internet of Things)', 'section_id' => 65],
            ['name' => 'Metaverse', 'section_id' => 65],
            ['name' => 'Optical Fiber Technology', 'section_id' => 65],
            ['name' => 'Web 3.0', 'section_id' => 65],
            ['name' => 'DarkNet', 'section_id' => 65],
            ['name' => 'Net Neutrality', 'section_id' => 65],
            ['name' => 'Internet Protocol Version (IPV)', 'section_id' => 65],
            ['name' => 'Electromagnetic Spectrum', 'section_id' => 65],
            ['name' => 'Geospatial Technology', 'section_id' => 65],
            ['name' => 'Bills/Policies/Initiatives', 'section_id' => 65],
            ['name' => 'Quantum Technology', 'section_id' => 65],
            ['name' => 'Super Computers', 'section_id' => 65],
            ['name' => 'Bills/Policies/Initiatives', 'section_id' => 65],
            ['name' => 'Others', 'section_id' => 65],

            // Sub Sections for Space Related Developments
            ['name' => 'NASA Missions', 'section_id' => 66],
            ['name' => 'ISRO Missions', 'section_id' => 66],
            ['name' => 'Launch Vehicles', 'section_id' => 66],
            ['name' => 'Other Space Organisations', 'section_id' => 66],
            ['name' => 'Space Phenomenon and Experiments', 'section_id' => 66],
            ['name' => 'Various orbits', 'section_id' => 66],
            ['name' => "India's Satellites", 'section_id' => 66],

            // Sub Sections for Nuclear Technology
            ['name' => 'Nuclear Fusion', 'section_id' => 67],
            ['name' => 'Nuclear Fission', 'section_id' => 67],
            ['name' => 'Nuclear Technology In Space', 'section_id' => 67],
            ['name' => "India's Nuclear Program", 'section_id' => 67],
            ['name' => 'Others', 'section_id' => 67],

            // Sub Sections for Defence Related Developments
            ['name' => 'Drones', 'section_id' => 68],
            ['name' => 'Missiles', 'section_id' => 68],
            ['name' => 'Submarines', 'section_id' => 68],
            ['name' => 'Ships', 'section_id' => 68],
            ['name' => 'Aircraft Carrier', 'section_id' => 68],
            ['name' => 'Aircrafts', 'section_id' => 68],
            ['name' => 'Helicopters', 'section_id' => 68],
            ['name' => 'Defence Systems', 'section_id' => 68],
            ['name' => 'Bombs and Weapons', 'section_id' => 68],

            // Sub Sections for Prize/Awards
            ['name' => 'Nobel Prize', 'section_id' => 69],
            ['name' => 'Shanti Swarup Bhatnagar Prize', 'section_id' => 69],
            ['name' => 'Ramanujan Prize for Young Mathematician', 'section_id' => 69],
            ['name' => 'Others', 'section_id' => 69],

            // Sub Sections for Health
            ['name' => 'Vaccines', 'section_id' => 70],
            ['name' => 'Diseases', 'section_id' => 70],
            ['name' => 'Food and Health', 'section_id' => 70],
            ['name' => 'Bills/Policies/Initiatives', 'section_id' => 70],
            ['name' => 'Others', 'section_id' => 70],

            // Sub Sections for Alternative Energy
            ['name' => 'Batteries', 'section_id' => 71],
            ['name' => 'Hydrogen', 'section_id' => 71],
            ['name' => 'Others', 'section_id' => 71],

            // Sub Sections for Intellectual Property Rights (IPRs)
            ['name' => 'Types of IPRs', 'section_id' => 72],
            ['name' => 'Patent Pools', 'section_id' => 72],
            ['name' => 'Others', 'section_id' => 72],

            // Sub Sections for Miscellaneous
            ['name' => 'International Research/Experiments', 'section_id' => 73],
            ['name' => 'Organisations', 'section_id' => 73],
            ['name' => 'Personalities', 'section_id' => 73],

            // Sub Sections for Sculpture and Architecture
            ['name' => 'Temples', 'section_id' => 74],
            ['name' => 'Sculptures', 'section_id' => 74],
            ['name' => 'Others', 'section_id' => 74],

            // Sub Sections for Paintings and Other Art forms
            ['name' => 'Folk Art', 'section_id' => 75],
            ['name' => 'Court Art', 'section_id' => 75],
            ['name' => 'Tribal Art', 'section_id' => 75],
            ['name' => 'Others', 'section_id' => 75],

            // Sub Sections for Initiatives of UNESCO
            ['name' => 'World Heritage Sites', 'section_id' => 76],
            ['name' => 'Others', 'section_id' => 76],

            // Sub Sections for Ancient India
            ['name' => 'Pre-Historic Age', 'section_id' => 78],
            ['name' => 'Indus Valley Civilisation', 'section_id' => 78],
            ['name' => 'Rig Vedic Times', 'section_id' => 78],
            ['name' => 'Later Vedic Times', 'section_id' => 78],
            ['name' => 'Mauryas', 'section_id' => 78],
            ['name' => 'Guptas', 'section_id' => 78],
            ['name' => 'Sangam Age', 'section_id' => 78],
            ['name' => 'Harshvardhan', 'section_id' => 78],
            ['name' => 'Chalukyas', 'section_id' => 78],
            ['name' => 'Rashtrakutas', 'section_id' => 78],
            ['name' => 'Others', 'section_id' => 78],

            // Sub Sections for Medieval India
            ['name' => 'Bhakti and Sufi Movement', 'section_id' => 79],
            ['name' => 'Delhi Sultanate', 'section_id' => 79],
            ['name' => 'Vijayanagar empire', 'section_id' => 79],
            ['name' => 'Mughals', 'section_id' => 79],
            ['name' => 'Others', 'section_id' => 79],

            // Sub Sections for Modern India
            ['name' => 'Coming of Europeans', 'section_id' => 80],
            ['name' => 'Establishment of British Empire', 'section_id' => 80],
            ['name' => 'Socio-Religious Reform Movements', 'section_id' => 80],
            ['name' => 'Revolt of 1857', 'section_id' => 80],
            ['name' => 'Moderate Phase', 'section_id' => 80],
            ['name' => 'Extremist Phase', 'section_id' => 80],
            ['name' => 'Gandhian Phase', 'section_id' => 80],
            ['name' => 'Others', 'section_id' => 80],

            // Sub Sections for Ethics and Human Interface
            ['name' => 'Ethics and Science', 'section_id' => 81],
            ['name' => 'Determinants of Ethics', 'section_id' => 81],
            ['name' => 'Dimensions of Ethics', 'section_id' => 81],
            ['name' => 'Ethics in Public Private Relationships', 'section_id' => 81],

            // Sub Sections for Attitude
            ['name' => 'Thought and Behavior', 'section_id' => 82],
            ['name' => 'Moral and Political Attitudes', 'section_id' => 82],
            ['name' => 'Social Influence', 'section_id' => 82],
            ['name' => 'Persuasion', 'section_id' => 82],

            // Sub Sections for Aptitude and foundational values of Civil Services
            ['name' => 'Civil Service Values', 'section_id' => 83],
            ['name' => 'Weaker Sections', 'section_id' => 83],

            // Sub Sections for Emotional Intelligence
            ['name' => 'Concept and utility', 'section_id' => 84],
            ['name' => 'Application in civil services', 'section_id' => 84],
            ['name' => 'Application in other areas', 'section_id' => 84],

            // Sub Sections for Moral thinkers and Philosophers
            ['name' => 'Indian thinkers - Ancient', 'section_id' => 85],
            ['name' => 'Indian thinkers - Medieval', 'section_id' => 85],
            ['name' => 'Indian thinkers - Modern', 'section_id' => 85],
            ['name' => 'Indian thinkers - contemporary', 'section_id' => 85],
            ['name' => 'Foreign thinkers', 'section_id' => 85],

            // Sub Sections for Public/Civil Service values and Ethics in Public Administration
            ['name' => 'Government Institutions', 'section_id' => 86],
            ['name' => 'Rules and laws and their ethics', 'section_id' => 86],
            ['name' => 'Ethical Governance', 'section_id' => 86],
            ['name' => 'International Ethics', 'section_id' => 86],
            ['name' => 'Corporate Governance', 'section_id' => 86],

            // Sub Sections for Probity in Governance
            ['name' => 'Information sharing and transparency', 'section_id' => 87],
            ['name' => 'Work Culture in Government', 'section_id' => 87],
            ['name' => 'Service Delivery', 'section_id' => 87],
            ['name' => 'Public Funds', 'section_id' => 87],
            ['name' => 'Corruption', 'section_id' => 87],

            // Sub Sections for Other areas
            ['name' => 'Environmental Ethics', 'section_id' => 88],

            // Sub Sections for Ministry Of Agriculture And Farmers Welfare
            ['name' => 'Pradhan Mantri Kisan Samman Nidhi (PM- KISAN)', 'section_id' => 89],
            ['name' => 'PM Fasal Bima Yojana', 'section_id' => 89],
            ['name' => 'Pradhan Mantri Annadata Aay Sanrakshan Abhiyan (PM-AASHA)', 'section_id' => 89],
            ['name' => 'Pradhan Mantri Krishi Sinchayee Yojana', 'section_id' => 89],
            ['name' => 'Soil Health Card Scheme', 'section_id' => 89],
            ['name' => 'National Agricultural Market (NAM)', 'section_id' => 89],
            ['name' => 'Kisan Credit Card (KCC)', 'section_id' => 89],
            ['name' => 'Other Schemes', 'section_id' => 89],

            // Sub Sections for Ministry Of Fisheries, Animal Husbandry & Dairying
            ['name' => 'Dairy Processing and Infrastructure Development Fund (DIDF) Scheme', 'section_id' => 90],
            ['name' => 'Blue Revolution: Integrated Development and Management of Fisheries', 'section_id' => 90],
            ['name' => 'National Animal Disease Control Programme (NADCP)', 'section_id' => 90],
            ['name' => 'Other Schemes', 'section_id' => 90],

            // Sub Sections for Ministry Of Ayush
            ['name' => 'National Ayush Mission', 'section_id' => 91],
            ['name' => 'Other Schemes', 'section_id' => 91],

            // Sub Sections for Ministry Of Chemicals And Fertilizers
            ['name' => 'Nutrient Based Subsidy Scheme', 'section_id' => 92],
            ['name' => 'Production Linked Incentive (PLI) Scheme (for promoting domestic manufacturing of medical devices)', 'section_id' => 92],
            ['name' => 'Production Linked Incentive Scheme (for promotion of domestic manufacturing of critical KSMs/Drug Intermediates and APIs)', 'section_id' => 92],
            ['name' => 'Pradhan Mantri Bhartiya Janaushadi Pariyojana (PMBJP)', 'section_id' => 92],
            ['name' => 'Other Schemes', 'section_id' => 92],

            // Sub Sections for Ministry Of Civil Aviation
            ['name' => 'Ude Desh Ka Aam Naagrik (Udan)/Regional Connectivity Scheme (RCS)', 'section_id' => 93],
            ['name' => 'Other Schemes', 'section_id' => 93],

            // Sub Sections for Ministry Of Coal
            ['name' => 'Shakti (Scheme for Harnessing and Allocating Koyala Transparently in India)', 'section_id' => 94],
            ['name' => 'Other Schemes', 'section_id' => 94],

            // Sub Sections for Ministry Of Commerce
            ['name' => 'Start Up India', 'section_id' => 95],
            ['name' => 'Make in India', 'section_id' => 95],
            ['name' => 'Other Schemes', 'section_id' => 95],

            // Sub Sections for Ministry Of Communication
            ['name' => 'National Broadband Mission', 'section_id' => 96],
            ['name' => 'Bharat Net Project', 'section_id' => 96],
            ['name' => 'Other Schemes', 'section_id' => 96],

            // Sub Sections for Ministry Of Consumer Affairs, Food & Public Distribution
            ['name' => 'Antyodaya Anna Yojana (AAY)', 'section_id' => 97],
            ['name' => 'Targeted Public Distribution System (TPDS)', 'section_id' => 97],
            ['name' => 'Other Schemes', 'section_id' => 97],

            // Sub Sections for Ministry Of Culture
            ['name' => 'Project Mausam', 'section_id' => 100],
            ['name' => 'Safeguarding the Intangible Cultural Heritage and Diverse Cultural Traditions of India', 'section_id' => 100],
            ['name' => 'Other Schemes', 'section_id' => 100],

            // Sub Sections for Ministry Of Jal Shakti
            ['name' => 'Swachha Bharat Mission (Gramin) [SBM (G)]', 'section_id' => 103],
            ['name' => 'Atal Bhujal Yojna', 'section_id' => 103],
            ['name' => 'Namami Gange Yojana', 'section_id' => 103],
            ['name' => 'Jal Jeevan Mission (JJM)', 'section_id' => 103],
            ['name' => 'Other Schemes', 'section_id' => 103],

            // Sub Sections for Ministry Of Electronics & IT
            ['name' => 'Digital India', 'section_id' => 105],
            ['name' => 'Pradhan Mantri Gramin Digital Saksharta Abhiyan (PMGDISHA)', 'section_id' => 105],
            ['name' => 'National Supercomputing Mission', 'section_id' => 105],
            ['name' => 'Production linked incentive scheme (PLI)', 'section_id' => 105],
            ['name' => 'Other Schemes', 'section_id' => 105],

            // Sub Sections for Ministry Of Environment, Forest And Climate Change
            ['name' => 'National Action Plan on Climate Change (NAPCC)', 'section_id' => 106],
            ['name' => 'National Clean Air Programme (NCAP)', 'section_id' => 106],
            ['name' => 'Other Schemes', 'section_id' => 106],

            // Sub Sections for Ministry Of External Affairs
            ['name' => 'Know India Programme', 'section_id' => 107],
            ['name' => 'Other Schemes', 'section_id' => 107],

            // Sub Sections for Ministry Of Finance
            ['name' => 'Pradhan Mantri Garib Kalyan Yojana', 'section_id' => 108],
            ['name' => 'National Pension System', 'section_id' => 108],
            ['name' => 'Pradhan Mantri Mudra Yojana', 'section_id' => 108],
            ['name' => 'Atal Pension Yojana', 'section_id' => 108],
            ['name' => 'Pradhan Mantri Suraksha Bima Yojana', 'section_id' => 108],
            ['name' => 'Pradhan Mantri Jeevan Jyoti Bima Yojana', 'section_id' => 108],
            ['name' => 'Pradhan Mantri Vaya Vandana Yojana (PMVVY)', 'section_id' => 108],
            ['name' => 'Pradhan Mantri Jan-Dhan Yojana (PMJDY)', 'section_id' => 108],
            ['name' => 'Stand Up India Scheme', 'section_id' => 108],
            ['name' => 'Other Schemes', 'section_id' => 108],

            // Sub Sections for Ministry of Food Processing Industries
            ["name" => "Pradhan Mantri Kisan Sampada Yojana (PMKSY)", "section_id" => 109],
            ["name" => "Mega Food Park", "section_id" => 109],
            ["name" => "Operation Greens", "section_id" => 109],
            ["name" => "Other Schemes", "section_id" => 109],

            // Sub Sections for Ministry of Health and Family Welfare
            ["name" => "National Health Mission (NHM)", "section_id" => 110],
            ["name" => "National Rural Health Mission", "section_id" => 110],
            ["name" => "National Urban Health Mission", "section_id" => 110],
            ["name" => "Universal Immunization Programme", "section_id" => 110],
            ["name" => "Mission Indradhanush", "section_id" => 110],
            ["name" => "Ayushman Bharat - National Health Protection Mission", "section_id" => 110],

            // Sub Sections for Ministry of Heavy Industries & Public Enterprises
            ["name" => "Faster Adoption and Manufacturing of Hybrid and Electric Vehicles (FAME II) Scheme", "section_id" => 111],
            ["name" => "Other Schemes", "section_id" => 111],

            // Sub Sections for Ministry of Housing and Urban Affairs
            ["name" => "Pradhan Mantri Awas Yojana (PMAY)- Urban", "section_id" => 113],
            ["name" => "Deen Dayal Antyodaya Yojana- Urban (National Urban Livelihoods Mission): DAY-NULM", "section_id" => 113],
            ["name" => "Atal Mission For Rejuvenation And Urban Transformation (AMRUT)", "section_id" => 113],
            ["name" => "National Heritage City Development And Augmentation Yojana (HRIDAY)", "section_id" => 113],
            ["name" => "Swachh Bharat Mission (Urban)", "section_id" => 113],
            ["name" => "Other Schemes", "section_id" => 113],

            // Sub Sections for Ministry of Human Resource and Development
            ["name" => "Mid-Day Meal Scheme", "section_id" => 114],
            ["name" => "Study In India", "section_id" => 114],
            ["name" => "Other Schemes", "section_id" => 114],

            // Sub Sections for Ministry of Labour and Employment
            ["name" => "PM Shram-Yogi Maandhan Yojana", "section_id" => 115],
            ["name" => "National Child Labour Project Scheme", "section_id" => 115],
            ["name" => "Other Schemes", "section_id" => 115],

            // Sub Sections for Ministry of Mines
            ["name" => "Pradhan Mantri Khanij Kshetra Kalyan Yojana (PMKKKY)", "section_id" => 117],
            ["name" => "Other Schemes", "section_id" => 117],

            // Sub Sections for Ministry of Minority Affairs
            ["name" => "Jiyo Parsi", "section_id" => 118],
            ["name" => "Other Schemes", "section_id" => 118],

            // Sub Sections for Ministry of Petroleum and Natural Gas
            ["name" => "Pradhan Mantri Ujjwala Yojana (PMUY)", "section_id" => 123],
            ["name" => "National Gas Grid", "section_id" => 123],
            ["name" => "City Gas Distribution (CGD) Network", "section_id" => 123],
            ["name" => "Other Schemes", "section_id" => 123],

            //Sub Sections for Ministry of Power
            ["name" => "Ujwal Discom Assurance Yojana (UDAY)", "section_id" => 124],
            ["name" => "Deendayal Upadhyaya Gram Jyoti Yojana (DDUGJY)", "section_id" => 124],
            ["name" => "National LED Programme", "section_id" => 124],
            ["name" => "Other Schemes", "section_id" => 124],

            // Sub Sections for Ministry of Road Transport & Highways
            ["name" => "Bharatmala Pariyojana", "section_id" => 126],
            ["name" => "Other Schemes", "section_id" => 126],

            // Sub Sections for Ministry of Rural Development
            ["name" => "Pradhan Mantri Gram Sadak Yojana", "section_id" => 127],
            ["name" => "Mahatma Gandhi National Rural Employment Guarantee Act (MGNREGA)", "section_id" => 127],
            ["name" => "Pradhan Mantri Awas Yojana (Grameen)", "section_id" => 127],
            ["name" => "Mission Antyodaya", "section_id" => 127],
            ["name" => "Deendayal Antyodaya Yojana- National Rural Livelihoods Mission (DAY-NRLM)", "section_id" => 127],
            ["name" => "Other Schemes", "section_id" => 127],

            // Sub Sections for Ministry of Shipping
            ["name" => "Sagarmala", "section_id" => 129],
            ["name" => "Other Schemes", "section_id" => 129],

            // Sub Sections for Ministry of Skill Development and Entrepreneurship
            ["name" => "Pradhan Mantri Kaushal Vikas Yojana (PMKVY)", "section_id" => 130],
            ["name" => "Other Schemes", "section_id" => 130],

            // Sub Sections for Ministry of Statistics and Programme Implementation
            ["name" => "Members of Parliament Local Area Development Scheme (MPLADS)", "section_id" => 132],
            ["name" => "Other Schemes", "section_id" => 132],

            // Sub Sections for Ministry of Textile
            ["name" => "National Technical Textiles Mission", "section_id" => 134],
            ["name" => "Other Schemes", "section_id" => 134],

            // Sub Sections for Ministry of Tourism
            ["name" => "Swadesh Darshan", "section_id" => 135],
            ["name" => "National Mission On Pilgrimage Rejuvenation And Spiritual Augmentation Drive (PRASAD) Scheme", "section_id" => 135],
            ["name" => "Adopt A Heritage/Apni Dharohar Apni Pehchan Project", "section_id" => 135],
            ["name" => "Other Schemes", "section_id" => 135],

            // Sub Sections for Ministry of Women and Child Development
            ["name" => "National Nutrition Mission (Poshan Abhiyaan)", "section_id" => 137],
            ["name" => "Beti Bachao Beti Padhao (BBBP)", "section_id" => 137],
            ["name" => "Other Schemes", "section_id" => 137],

        ];

        DB::table('topic_sub_sections')->insert($topicSubSections);
    }
}
