<?php

namespace Database\Seeders;

use App\Models\InitiativeTopic;
use Illuminate\Database\Seeder;

class SyllabusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // Polity and Governance
        $polityAndGovernance = InitiativeTopic::create(['name' => 'Polity and Governance']);

        $sections = [
            'Political systems: concepts, forms and types' => [
                'Democratic and other types of polity',
                'Republic and Monarchy',
                'Parliamentary & Presidential',
                'Constitutionalism, constitutional government etc',
                'Miscellaneous',
            ],
            'Historical Underpinnings' => [
                'Acts (Charter Acts, Councils Act, GOI Act, etc)',
                'Miscellaneous',
            ],
            'Evolution & Making of the Constitution' => [
                'Constituent Assembly- Composition, Working and Committees, etc',
                'Enactment and Enforcement of the Constitution',
                'Miscellaneous',
            ],
            'Salient Features of the Constitution' => [
                'Salient Features of the Constitution, Unitary and federal features, etc',
                'Schedules of the Constitution',
                'Miscellaneous',
            ],
            'The Union & Its Territory' => [
                'Expressions Union of States and Federation of States',
                "Parliament's Power to reorganize states",
                'Evolution of States and UT\'s',
                'Related Amendments - Article 368 etc',
                'Miscellaneous',
            ],
            'The Preamble' => [
                'Key words in the Preamble',
                'Amendability, Significance of Preamble, etc',
                'Miscellaneous',
            ],
            'Fundamental Rights' => [
                'Features, Significance and Definition of State, etc',
                'Fundamental Rights: Provisions and Articles',
                'Writs - Types and scope',
                'Effect of Emergency and Martial law on FR',
                'Exceptions to Fundamental Rights, Reasonable Restrictions, etc',
                'Rights outside Part III',
                'Related Amendments - 42nd, 44th , etc',
                'Miscellaneous',
            ],
            'Directive Principles of State Policy (DPSP)' => [
                'Features, Significance and utility of DPSP etc',
                'Classification of DPSP - Socialistic, Gandhian, Liberal-Intellectual, etc',
                'Conflict between FRs and DPSP',
                'Directives Outside Part IV',
                'Related Amendments - 42nd, 44th and others',
                'Miscellaneous',
            ],
            'Fundamental Duties' => [
                'Constitutional Articles/Provisions',
                'Nature and features',
                'Criticism and Significance',
                'Committees- Swaran Singh, JS Verma, etc',
                'Miscellaneous',
            ],
            'FRs, DPSP, Preamble, Fundamental Duties (Mixed questions)' => [
                'Comparision between FR and DPSP',
                'Comparison between FD and FR',
                'Comparison between FD and DPSP',
                'Any other comparison',
                'Miscellaneous',
            ],
            'Emergency Provisions' => [
                'Related to National Emergency',
                'Related to President\'s Rule',
                'Related to Financial Emergency',
                'Comparison between emergencies',
                'Martial law',
                'Miscellaneous',
            ],
            'Basic Structure' => [
                'Emergence and Elements of Basic Structure',
                'Amendability of the Basic Structure - simple majority, special majority, etc',
                'Miscellaneous',
            ],
            'Amendment to the Constitution' => [
                'Procedure for Amendment and its criticism',
                'Types of Amendment',
                'Miscellaneous',
            ],
            'Citizenship' => [
                'Constitutional Articles/Provisions',
                'Citizenship Amendment Act, 1955',
                'NRI/PIO, etc',
                'Recent amendments in Citizenship Acts',
                'Miscellaneous',
            ],
            'Parliament' => [
                'Organisation, Composition, Duration and Membership',
                'Leaders in Parliament',
                'Sessions in Parliament, Budget, etc',
                'Parliamentary Proceedings - Question hour, Motions etc, Passage of Bills',
                'Parliamentary Committee',
                'Position of Rajya Sabha and Lok Sabha, significance etc',
                'Miscellaneous',
            ],
            'Constitutional Bodies' => [
                'Election Commission of India',
                'State Election Commission',
                'UPSC',
                'SPSC',
                'JPSC',
                'Finance Commission',
                'State Finance Commission',
                'CAG',
                'National Commission for SCs',
                'National Commission for STs',
                'National Commission for Backward Classes',
                'Special Officer for Linguistic Minorities',
                'Attorney General of India and solicitor general',
                'Advocate General of State',
                'Miscellaneous',
            ],
            'Non-Constitutional Bodies' => [
                'NITI Aayog',
                'NHRC',
                'SHRC',
                'CIC',
                'SIC',
                'CVC',
                'SVC',
                'CBI',
                'Lokpal',
                'Lokayukta',
                'Other National Commissions',
                'Other bodies/Miscellaneous',
            ],
            'Other Constitutional Dimensions' => [
                'Co-operative Societies',
                'Official Language provisions',
                'Public Services',
                'Tribunals',
                'Rights and Liabilities of the Govt.',
                'Authoritative Text of the Constitution in Hindi Language',
                'Special Provisions Relating to certain classes-SCs, STs, EWS, Women, etc',
                'Miscellaneous',
            ],
            'Union Executive' => [
                'The President',
                'The Vice-President',
                'Prime minister,',
                'Council of Ministers',
                'Cabinet Secretariat and Cabinet Secretary',
                'PMO',
                'Attorney General',
                'Miscellaneous',
            ],
            'State Executive' => [
                'Governor',
                'Chief Minister',
                'State council of ministers',
                'Related to State secretariat',
                'Advocate General',
                'Miscellaneous',
            ],
            'Parliament' => [
                'Presiding officers of the Lok Sabha',
                'Presiding officers of the Rajya Sabha',
                'Related to functioning of both LS and RS',
                'Related to Functioning of LS',
                'Related to Functioning of RS',
                'Related to MPs (LS and RS)',
                'Procedure related to Bills/Acts',
                'Parliamentary Committees',
                'Miscellaneous',
            ],
            'State Legislature' => [
                'Presiding officers of Legislative Assembly (LA)',
                'Presiding officers of Legislative Council (LC)',
                'Related to functioning LA and LC',
                'Related to Functioning LA',
                'Related to Functioning of LC',
                'Related to MLAs',
                'Procedure related to Bills/Acts',
                'Miscellaneous',
            ],
            'Judiciary' => [
                'Related to Supreme Court',
                'Related to High Courts',
                'Subordinate courts',
                'Lok Adalat, NALSA, etc',
                'Alternate Dispute Resolution Mechanisms',
                'Miscellaneous',
            ],
            'Centre-State Relations' => [
                'Administrative and executive relations',
                'Legislative relations',
                'Financial relations',
                'Miscellaneous',
            ],
            'InterState Relations' => [
                'Constitutional Provisions',
                'Bodies/Departments for interstate relations',
                'Miscellaneous',
            ],
            'Local Government' => [
                'History of local governance since 1947',
                'Related to the Panchayati Raj',
                'Related to the Urban local govt.',
                'Panchayat Extension to Scheduled Areas',
                'Miscellaneous',
            ],
            'Elections' => [
                'Political parties',
                'Delimitation Act',
                'Representation of People\'s Act 1950',
                'Representation of People\'s Act 1951',
                'Anti-Defection law',
                'Model Code of Conduct',
                'Other laws',
                'Electoral Reforms',
                'Related Electoral Funding',
                'Miscellaneous',
            ],
            'Special Provisions for some states' => [
                'J&K, Maharashtra, Gujarat, Nagaland, etc',
                'Miscellaneous',
            ],
            'Miscellaneous (Governance)' => [
                'Related to Good Governance',
                'Related to Citizen Charter',
                'Related to Sevottam Model',
                'Relayed to E-Governance',
                'Related to Social Accountability',
                'Related to Social Audit',
                'Related to Right to Information',
                'Related to Pressure Groups',
                'Related to Self-Help Groups',
                'Other aspects of civil society',
                'Schemes/Policies/Initiatives',
                'Others/Miscellaneous',
            ],
            'Current Affairs (Polity)' => [
                'New Constitutional provisions',
                'New amendments to acts',
                'New developments in Polity',
                'Miscellaneous',
            ],
            'MISCELLANEOUS' => [
                'Other Current Affairs/Developments',
                'Miscellaneous',
            ],
        ];

        foreach ($sections as $sectionName => $subsectionTopics) {
            $section = $polityAndGovernance->sections()->create(['name' => $sectionName]);

            foreach ($subsectionTopics as $topic) {
                $section->subSection()->create(['name' => $topic]);
            }
        }


        // Economics (Microeconomics)
        $microeconomics = InitiativeTopic::create(['name' => 'Economics (Microeconomics)']);

        $microSections = [
            'Introduction' => [
                "1 A Simple Economy",
                "Central Problems of an Economy",
                "Organisation of Economic Activities",
                "The Centrally Planned Economy",
                "The Market Economy",
                "Positive and Normative Economics",
                "Miscellaneous"
            ],
            'Theory of Consumer Behaviour' => [
                "Utility (Cardinal and Ordinal)",
                "The Consumer's Budget",
                "The Optimal Choice of the Consumer",
                "Demand",
                "Market Demand",
                "Elasticity of Demand",
                "Miscellaneous"
            ],
            'Production and Costs' => [
                "Production Function",
                "The Short Run and the Long Run",
                "Total Product, Average Product and Marginal Product",
                "The Law of Diminishing Marginal Product and the Law of 40 Variable Proportions",
                "Shapes of Total Product, Marginal Product and Average Product Curves",
                "Returns to Scale",
                "Short-run and Long-run Costs",
                "Miscellaneous"
            ],
            'The Theory of the Firm Under Perfect Competition' => [
                "Perfect Competition: Defining Features",
                "Revenue",
                "Profit Maximisation",
                "Supply Curve of a Firm",
                "Determinants of a Firm’s Supply Curve",
                "Market Supply Curve",
                "Price Elasticity of Supply",
                "Miscellaneous"
            ],
            'Market Equilibrium' => [
                "Equilibrium, Excess Demand, Excess Supply",
                "Price Ceiling and Price Floor",
                "Miscellaneous"
            ],
            'Miscellaneous' => [
                "Other miscellaneous concepts, etc.",
                "Financial Accountancy (Accounting)",
                "Miscellaneous"
            ]
        ];

        foreach ($microSections as $sectionName => $subsectionTopics) {
            $section = $microeconomics->sections()->create(['name' => $sectionName]);

            foreach ($subsectionTopics as $topic) {
                $section->subSection()->create(['name' => $topic]);
            }
        }


        // Economics (Macroeconomics)
        $macroeconomics = InitiativeTopic::create(['name' => 'Economics (Macroeconomics)']);

        $macroSections = [
            'National Income Accounting' => [
                "Some Basic Concepts of Macroeconomics",
                "Circular Flow of Income and Methods of Calculating National Income",
                "Factor Cost, Basic Prices and Market Prices",
                "Some Macroeconomic Identities like GDP Deflator",
                "Nominal and Real GDP",
                "GDP and Welfare",
                "Miscellaneous"
            ],
            'Money and Banking' => [
                "Functions of Money",
                "Demand for Money and Supply of Money",
                "Money Creation by Banking System",
                "Policy Tools to Control Money Supply",
                "The Reserve Bank of India",
                "Monetary policy (SLR, CRR, repo, reverse repo, etc)",
                "Terms used in Money Supply and Banking",
                "About banks in India",
                "Banking Sector Reforms",
                "Inflation and terms related to inflation",
                "Miscellaneous"
            ],
            'Determination of Income and Employment' => [
                "Aggregate Demand and its Components",
                "Consumption",
                "Investment",
                "Determination of Income in Two-sector Model",
                "Determination of Equilibrium Income in the Short Run",
                "Macroeconomic equilibrium with price level fixed",
                "Effect of an autonomous change in aggregate Demand on income and output",
                "Miscellaneous"
            ],
            'Government Budget and the Economy' => [
                "Government Budget – Meaning and its Components",
                "Objectives of Government Budget",
                "Classification of Receipts",
                "Classification of Expenditure",
                "Balanced, Surplus and Deficit Budget",
                "Measures of Government Deficit",
                "Different types of taxes",
                "Public Debt and Deficit",
                "Other fiscal policies",
                "Miscellaneous"
            ],
            'External Sector' => [
                "The Balance of Payments",
                "Current Account and Capital Account",
                "Balance of Payments Surplus and Deficit",
                "Foreign Exchange Market",
                "Exchange Rate Systems",
                "WTO and related concepts and issues",
                "IMF",
                "The World Bank",
                "Other important bodies and conventions/agreements",
                "Reports related to economics/finance",
                "Miscellaneous"
            ],
            'Capital Market and Money Market' => [
                "Debt instruments",
                "Equity instruments",
                "Other concepts",
                "Primary and secondary market",
                "Bond markets",
                "SEBI and its functions",
                "Miscellaneous"
            ],
            'Current Affairs (Macroeconomics)' => [
                "New developments related to Bond Market",
                "New developments related to capital market",
                "New rules related to Monetary Policy",
                "New developments related to Digital Finance",
                "Related to Payment Ecosystem",
                "Other new directives of the RBI related to banking",
                "New directives of the SEBI",
                "New directives of the Union Ministry of Finance",
                "New directives of other ministries",
                "Initiatives by other bodies/organisations",
                "New reports related to finance/economics",
                "New terms in the news",
                "Other Recent Development related to economics",
                "Miscellaneous"
            ],
            'Miscellaneous' => [
                "Other miscellaneous topics/concepts"
            ]
        ];

        foreach ($macroSections as $sectionName => $subsectionTopics) {
            $section = $macroeconomics->sections()->create(['name' => $sectionName]);

            foreach ($subsectionTopics as $topic) {
                $section->subSection()->create(['name' => $topic]);
            }
        }


        // Economics (Indian Economy)
        $indianEconomy = InitiativeTopic::create(['name' => 'Economics (Indian Economy)']);

        $sections = [
            'Indian Economy on the Eve of Independence' => [
                "LOW LEVEL OF ECONOMIC DEVELOPMENT UNDER THE COLONIAL RULE",
                "AGRICULTURAL SECTOR",
                "INDUSTRIAL SECTOR",
                "FOREIGN TRADE",
                "DEMOGRAPHIC CONDITION",
                "OCCUPATIONAL STRUCTURE",
                "INFRASTRUCTURE",
                "MISCELLANEOUS"
            ],
            'Indian Economy 1950-1990' => [
                "THE GOALS OF FIVE YEAR PLANS",
                "AGRICULTURE",
                "INDUSTRY AND TRADE",
                "IMPORT SUBSTITUTION",
                "MISCELLANEOUS"
            ],
            'Liberalisation, Privatisation and Globalisation: An Appraisal' => [
                "BACKGROUND",
                "LIBERALISATION",
                "PRIVATISATION",
                "GLOBALISATION",
                "INDIAN ECONOMY DURING REFORMS: AN ASSESSMENT",
                "MISCELLANEOUS"
            ],
            'Indian Economy at Present' => [
                "AGRICULTURE and ALLIED",
                "INDUSTRY (labour, msme, organised and unorganised etc)",
                "INFRASTRUCTURE (PPP etc)",
                "SERVICE SECTOR (Insurance, Tourism, etc.)",
                "TRADE",
                "PDS",
                "POLICIES RELATED TO AGRICULTURE AND FARMERS",
                "UNEMPLOYMENT",
                "INFLATION",
                "MISCELLANEOUS"
            ],
            'Human Capital Formation in India' => [
                "HUMAN CAPITAL AND HUMAN DEVELOPMENT",
                "STATE OF HUMAN CAPITAL FORMATION IN INDIA",
                "EDUCATION SECTOR IN INDIA",
                "FUTURE PROSPECTS",
                "MISCELLANEOUS"
            ],
            'Rural Development' => [
                "WHAT IS RURAL DEVELOPMENT",
                "CREDIT AND MARKETING IN RURAL AREAS",
                "AGRICULTURAL MARKET SYSTEM",
                "DIVERSIFICATION INTO PRODUCTIVE ACTIVITIES",
                "MISCELLANEOUS"
            ],
            'Employment: Growth, Informalisation and Other Issues' => [
                "WORKERS AND EMPLOYMENT",
                "PARTICIPATION OF PEOPLE IN EMPLOYMENT",
                "SELF-EMPLOYED AND HIRED WORKERS",
                "EMPLOYMENT IN FIRMS, FACTORIES AND OFFICES",
                "GROWTH AND CHANGING STRUCTURE OF EMPLOYMENT",
                "INFORMALISATION OF INDIAN WORKFORCE",
                "UNEMPLOYMENT",
                "GOVERNMENT AND EMPLOYMENT GENERATION",
                "MISCELLANEOUS"
            ],
            'Important Documents' => [
                "Annual Budget",
                "Economic Survey",
                "NITI Aayog publications",
                "Other reports/documents",
                "Miscellaneous"
            ],
            'Current Affairs (Indian Economy)' => [
                "Related to Employment and Labour",
                "Related to energy and power sector",
                "Related to agriculture",
                "Related to poverty",
                "Related to food security",
                "Related to Industrial Sector",
                "Related to service sector",
                "Miscellaneous"
            ]
        ];

        foreach ($sections as $sectionName => $subsectionTopics) {
            $section = $indianEconomy->sections()->create(['name' => $sectionName]);

            foreach ($subsectionTopics as $topic) {
                $section->subSection()->create(['name' => $topic]);
            }
        }

        // Science and Technology
        $scienceAndTech = InitiativeTopic::create(['name' => 'Science and Technology']);

        $sections = [
            'Biotechnology' => [
                "Principles of biotechnology (related to basic DNA/RNA)",
                "Related to genetic engineering",
                "Cloning",
                "Polymerase Chain Reaction",
                "Tissue Culture",
                "Bioreactors",
                "Genetically Modified Organisms and GM Crops",
                "RNA interference",
                "Application of biotechnology in medicine",
                "Gene therapy",
                "Transgenic Organisms",
                "Stem Cells",
                "Miscellaneous"
            ],
            'Electronics and Communication' => [
                "Semiconductor and types",
                "Solar cells",
                "Basics of bandwiths and signals",
                "Satellite Communication",
                "Cellular Communication",
                "TV and FM Broadcast",
                "Electromagnetic Waves and spectrum",
                "Robotics",
                "Miscellaneous"
            ],
            'Information Technology' => [
                "Important terms in IT",
                "Developments in cyberspace (Darknet, etc.)",
                "Cybersecurity and risks",
                "Artificial Intelligence",
                "Related to the Internet",
                "Internet of Things",
                "Non-fungible tokens",
                "Blockchain",
                "Related to other Softwares",
                "Hardwares",
                "Advance computing",
                "Supercomputers",
                "Miscellaneous"
            ],
            'Nanotechnology' => [
                "Concepts and applications of nanotechnology",
                "Developments related to nanotechnology",
                "Miscellaneous"
            ],
            'Defense System' => [
                "Defense system of India",
                "Related to missiles",
                "Other warfare technologies",
                "Miscellaneous"
            ],
            'Basic Astronomy and Space Technology' => [
                "Basic concepts of cosmology",
                "Origin of Universe",
                "Solar System",
                "Stars and star systems",
                "Celestial Bodies",
                "Discoveries in space",
                "Space Debris",
                "Indian Satellite System and Satellite Launch Vehicles",
                "Aerial Vehicles",
                "Related to space missions and developments in India",
                "Space missions abroad (global)",
                "Miscellaneous"
            ],
            'Intellectual Property Rights' => [
                "Basic terms in IPR",
                "Issues related to IPR",
                "Laws and regulations in IPR",
                "Miscellaneous"
            ],
            'Health and drugs-related issues/technology' => [
                "Vaccines",
                "Adulterants",
                "Health-assisting technologies (except biotech)",
                "Drugs/medicines related developments",
                "Miscellaneous"
            ],
            'Prizes/Recognitions related to S&T' => [
                "Nobel Prize",
                "Other recognitions",
                "Miscellaneous"
            ],
            'Energy-harnessing technologies' => [
                "Related to Nuclear Power",
                "Electric Vehicles (in general)",
                "Types of Cells/Batteries",
                "Miscellaneous"
            ],
            'Current Affairs (Science and Technology)' => [
                "New technological development",
                "New terms in the news",
                "New space-related phenomena",
                "Other new phenomena",
                "Miscellaneous"
            ],
            'Science and Technology (Misc)' => [
                "Miscellaneous Concepts",
                "Miscellaneous Technologies"
            ]
        ];

        foreach ($sections as $sectionName => $subsectionTopics) {
            $section = $scienceAndTech->sections()->create(['name' => $sectionName]);

            foreach ($subsectionTopics as $topic) {
                $section->subSection()->create(['name' => $topic]);
            }
        }

        // Basic Science (Chemistry)
        $basicScienceChemistry = InitiativeTopic::create(['name' => 'Basic Science (Chemistry)']);

        $sections = [
            'Matter Around Us' => [
                "States of matter and inter-convertibility",
                "Elements, compound and mixtures",
                "Separation of substances",
                "Miscellaneous"
            ],
            'Structure of the Atom' => [
                "Atomic models",
                "Atomic nucleus: protons & neutrons",
                "Electrons",
                "Isotopes, isobars and isotones",
                "Miscellaneous"
            ],
            'Atoms and Molecules' => [
                "Atomic number, atomic mass, molecular mass",
                "Law of conservation of mass and law of definite proportions",
                "Molecules, ions",
                "Moles, Avogadro's Number",
                "Molarity and molality",
                "Miscellaneous"
            ],
            'Classification of Elements' => [
                "Periodic Table",
                "Metals and non-metals",
                "Carbon and its compounds",
                "Miscellaneous"
            ],
            'Physical and Chemical Change' => [
                "Chemical Bonding",
                "Chemical reactions and equations",
                "Combustion, flame, ignition temperature",
                "Redox reactions",
                "Miscellaneous"
            ],
            'Acid, Bases and Salts' => [
                "Properties of acids, bases and salts",
                "Miscellaneous"
            ],
            'Chemistry in Everyday Life' => [
                "Vitamins and minerals",
                "Drugs and medicines",
                "Soaps and detergents",
                "Artificial sweeteners and preservatives",
                "Antioxidants and colouring agents",
                "Fibres: Natural and Synthetic; Fabrics",
                "Polymers and Plastics",
                "Agrochemistry",
                "Biochemistry",
                "Miscellaneous"
            ]
        ];

        foreach ($sections as $sectionName => $subsectionTopics) {
            $section = $basicScienceChemistry->sections()->create(['name' => $sectionName]);

            foreach ($subsectionTopics as $topic) {
                $section->subSection()->create(['name' => $topic]);
            }
        }


        // Basic Science (Biology)
        $basicScienceBiology = InitiativeTopic::create(['name' => 'Basic Science (Biology)']);

        $sections = [
            'Cells' => [
                "Definition, discovery and history",
                "Examples of cell types",
                "Plant cells",
                "Animal cells",
                "Prokaryotic cells and eukaryotic cells",
                "Cell organelles or components",
                "Miscellaneous"
            ],
            'Tissues' => [
                "Definition and types of tissues",
                "Plant tissues",
                "Animal tissues",
                "Miscellaneous"
            ],
            'Life Processes of Animals and Plants' => [
                "Nutrition and respiration in plants",
                "Nutrition and respiration in animals (humans)",
                "Transportation in plants",
                "Reproduction in plants",
                "Reproduction in animals (humans)",
                "Locomotion",
                "Control and Coordination (general)",
                "Nervous System (Humans)",
                "Coordination in plants",
                "Endocrine System (Humans)",
                "Digestive System (Humans)",
                "Circulatory System",
                "Excretery System",
                "Miscellaneous"
            ],
            'Diversity in Living Organisms' => [
                "Taxonomy",
                "Animal Kingdom",
                "Plant Kingdom",
                "Miscellaneous"
            ],
            'Heredity and Evolution' => [
                "Acquired and inherited traits",
                "Mendelian experiment",
                "Theories of evolution",
                "Speciation",
                "Evolution and Classification",
                "Sex Determination",
                "Miscellaneous"
            ],
            'Health and Diseases' => [
                "Communicable Diseases",
                "Non-Communicable Diseases",
                "Genetic Disorders",
                "Deficiency Diseases",
                "Vaccines",
                "Different types of pathogens and vectors",
                "Immune System",
                "Miscellaneous"
            ],
            'Biomolecules' => [
                "Proteins",
                "Amino Acids",
                "Carbohydrates",
                "Polysaccharides",
                "Nucleic Acid",
                "Enzymes",
                "Miscellaneous"
            ]
        ];

        foreach ($sections as $sectionName => $subsectionTopics) {
            $section = $basicScienceBiology->sections()->create(['name' => $sectionName]);

            foreach ($subsectionTopics as $topic) {
                $section->subSection()->create(['name' => $topic]);
            }
        }


        // Basic Science (Physics)
        $basicSciencePhysics = InitiativeTopic::create(['name' => 'Basic Science (Physics)']);

        $sections = [
            'Motion' => [
                "Distance",
                "Displacement",
                "Speed",
                "Velocity",
                "Uniform and non-uniform motion",
                "Miscellaneous"
            ],
            'Force and Laws of Motion' => [
                "Force and acceleration",
                "Friction",
                "Newton's Laws of Motion",
                "Equations of motion",
                "Momentum",
                "Conservation of momentum",
                "Inertia",
                "Miscellaneous"
            ],
            'Gravitation' => [
                "Law of Gravitation",
                "Difference between weight and mass",
                "Escape Velocity",
                "Applications",
                "Miscellaneous"
            ],
            'Work and Energy' => [
                "Work done",
                "Energy",
                "Types of energy",
                "Conservation of energy",
                "Heat",
                "Miscellaneous"
            ],
            'Sound' => [
                "Sound wave",
                "Mechanical waves",
                "Amplitude",
                "Frequency",
                "Wavelength",
                "Pitch",
                "Loudness of Sound",
                "Intensity of Sound",
                "Miscellaneous"
            ],
            'Light: Reflection and Refraction' => [
                "Properties of Light",
                "Types of Mirror",
                "Types of Length",
                "Power of lens",
                "Human Eye and the Colourful World",
                "Miscellaneous"
            ],
            'Electrostatics and Electric Current' => [
                "Electric Charge",
                "Potential difference",
                "Ohm's Law",
                "Resistance and resistivity",
                "Parallel and series combination",
                "Electric Power",
                "Fuse",
                "Heating effect of Current",
                "Miscellaneous"
            ],
            'Magnetism' => [
                "Magnetic Field and Field Lines",
                "Magnetic Field due to a Current-Carrying Conductor",
                "Current Carrying Conductor in a Magnetic Field",
                "Electric Motor",
                "Electromagnetic Induction",
                "Electric Generator",
                "Miscellaneous"
            ],
            'Thermodynamics' => [
                "Zeroth law of Thermodynamics",
                "Heat, internal energy and work",
                "First law of thermodynamics",
                "Specific heat capacity",
                "Thermodynamic processes",
                "Heat engines",
                "Refrigerators and heat pumps",
                "Second law of thermodynamics",
                "Reversible and irreversible processes",
                "Miscellaneous"
            ]
        ];

        foreach ($sections as $sectionName => $subsectionTopics) {
            $section = $basicSciencePhysics->sections()->create(['name' => $sectionName]);

            foreach ($subsectionTopics as $topic) {
                $section->subSection()->create(['name' => $topic]);
            }
        }


        // International Relations
        $internationalRelations = InitiativeTopic::create(['name' => 'International Relations']);

        $sections = [
            'India\'s Foreign Policy' => [
                "Before Independence",
                "During Nehruvian Era",
                "During Shastri",
                "During Indira Gandhi",
                "During Janata rule",
                "During Rajiv Gandhi",
                "After 1991",
                "Gujaral Doctrine",
                "Between late 90s to 2014",
                "After 2014",
                "Miscellaneous"
            ],
            'India and neighbourhood' => [
                "India and Pakistan",
                "India and China",
                "India and Bangladesh",
                "India and Nepal",
                "India and Sri Lanka",
                "India and Bhutan",
                "India and Myanmar",
                "India and Afghanistan",
                "India and Maldives",
                "Miscellaneous"
            ],
            'India and others' => [
                "India and Island countries",
                "India and West Asia",
                "India and Central Asia/Russia",
                "India and Europe",
                "India and South East Asia",
                "India and East Asia",
                "India and Australia/Pacific",
                "India and Africa",
                "India and Latin America",
                "India and North America/the US",
                "Miscellaneous"
            ],
            'Organisations/Groups' => [
                "United Nations-related",
                "SAARC",
                "ASEAN",
                "RCEP",
                "East Asia Summit",
                "G20",
                "G7",
                "UNESCO",
                "UNICEF",
                "ILO",
                "Other UN agencies",
                "NATO",
                "EU",
                "Other regional blocs",
                "Other global organisations",
                "Miscellaneous"
            ],
            'Summits/ Conferences' => [
                "Bilateral",
                "Multilateral",
                "Miscellaneous"
            ],
            'Treaties/Convention' => [
                "Bilateral",
                "Multilateral",
                "Miscellaneous"
            ],
            'Issues/Conflicts' => [
                "Related to Central Asia",
                "Related to West Asia",
                "Related to Far East",
                "Related to South Asia",
                "Related to South East Asia",
                "Related to Africa",
                "Related to Europe",
                "Related to North America",
                "Related to South America",
                "Antarctica",
                "Australia",
                "Miscellaneous"
            ],
            'Occurrences of International Importance (Regions)' => [
                "Asia",
                "Africa",
                "Europe",
                "North America",
                "South America",
                "Antarctica",
                "Australia",
                "Miscellaneous"
            ],
            'Reports' => [
                "United Nations or its organs/agencies",
                "Other global bodies",
                "Other reports",
                "Miscellaneous"
            ],
            'Current Affairs (IR-related)' => [
                "New theories",
                "New terms",
                "New groupings",
                "New issues",
                "Miscellaneous"
            ],
            'Miscellaneous' => [
                "Terms",
                "Phrases used in IR",
                "Miscellaneous"
            ]
        ];

        foreach ($sections as $sectionName => $subsectionTopics) {
            $section = $internationalRelations->sections()->create(['name' => $sectionName]);

            foreach ($subsectionTopics as $topic) {
                $section->subSection()->create(['name' => $topic]);
            }
        }


        // Environment
        $environment = InitiativeTopic::create(['name' => 'Environment']);

        $sections = [
            'Ecology' => [
                'Basic Concepts in Ecology',
                'Ecosystems - Types, Functions and Structure',
                'Species - Population, Interactions, Community Organization',
                'Challenges to ecology',
                'Miscellaneous'
            ],
            'Biodiversity' => [
                'Biodiversity - Concepts, Types',
                'United Nations Convention on Biological Diversity (CBD)',
                'International Union for the Conservation of Nature (IUCN)',
                'Biological Diversity (Amendment) Act, 2021',
                'Wildlife (Protection) Act, 1972',
                'Possibly Extinct species',
                'Terrestrial species',
                'Aquatic species',
                'Avian Species',
                'Insects, rodents etc',
                'Plant Species',
                'Other Species',
                'Biosphere Reserves',
                'Wildlife Sanctuary',
                'National Parks',
                'Other Protected Areas',
                'Lakes',
                'Wetlands',
                'Ramsar Sites',
                'Coral Reefs',
                'Coastlands',
                'Forests',
                'Other Reports',
                'Miscellaneous'
            ],
            'Climate Change' => [
                'Global Warming - Extent, Causes, Impact',
                'Ocean Acidification and Impact on Marine Life',
                'Related to Ozone Depletion',
                'Related to Ocean Acidification',
                'Related to Sea-level rise',
                'Related to Coral-bleaching',
                'Climate Change in India - Impact, Organizations, Initiatives',
                'UNFCCC-related developments',
                'International Climate Change Conventions and Initiatives',
                'Climate Change Mitigation Strategies',
                'Miscellaneous'
            ],
            'Environmental Pollution' => [
                'Air - Causes, Types,  tackling policies',
                'Water - Causes, Types,  tackling policies',
                'Land/Soil - Causes, Types,  tackling policies',
                'Noise - Causes, Types,  tackling policies',
                'Nuclear - Causes, Types,  tackling policies',
                'e-Waste - Causes, Types,  tackling policies',
                'Harmful effects of plastics/policies to curb',
                'Solid Waste management',
                'Related to remediation techniques',
                'Coal Gasification',
                'Other clean technologies',
                'Environment Impact Assessment',
                'Miscellaneous'
            ],
            'Renewable Energy' => [
                'Hydrogen Based Energy',
                'Methanol Economy',
                'Geothermal Energy',
                'Ethanol Blending in India',
                'Electric Vehicles',
                'Renewable Energy Certificate (REC)',
                'Solar Energy',
                'Wind Energy',
                'Hybrid Renewable Energy',
                'Other Non Renewable Energy',
                'Other Renewable Energy',
                'International Solar Alliance',
                'Other organisations for renewable energy',
                'Miscellaneous'
            ],
            'Important Environmental ConventionsAgreements' => [
                'Key domestic policies/conventions',
                'Key international policies/conventions',
                'Miscellaneous'
            ],
            'Important Organisations/bodies' => [
                'Bodies/organisations in India',
                'Bodies/organisations of global importance',
                'Miscellaneous'
            ],
            'Sustainable Development' => [
                'Brundtland Report',
                'Concept and definition of Sustainable Development',
                'Natural Environmental Capital Accounting',
                'Gross Environment Product (GEP)',
                'Organic farming',
                'Miscellaneous'
            ],
            'Disaster/Disaster Management' => [
                'Flash Floods',
                'Landslides',
                'Floods',
                'Earthquake',
                'Volcano-related disaster',
                'Tsunamis',
                'Glacial Lake Outburst Floods (GLOF)',
                'Cyclones-related disaster',
                'Forest Fires',
                'Urban Fiires',
                'Droughts',
                'Cloudbursts',
                'Chemical Disaster',
                'Miscellaneous'
            ],
            'Current Affairs (Environment)' => [
                'New themes related to environment/ecology/biodiversity, etc',
                'Miscellaneous'
            ],
            'Miscellaneous Environmental Issues' => [
                'Miscellaneous Topics'
            ]
        ];

        foreach ($sections as $sectionName => $subsectionTopics) {
            $section = $environment->sections()->create(['name' => $sectionName]);

            foreach ($subsectionTopics as $topic) {
                $section->subSection()->create(['name' => $topic]);
            }
        }


        // Ancient India History
        $ancientIndiaHistory = InitiativeTopic::create(['name' => 'Ancient India History']);

        $sections = [
            'Prehistory' => [
                'Paleolithic Age: Society and other features',
                'Mesolithic Age: Society and other features',
                'Neolithic Age: Society and other features',
                'Chalcolithic Age',
                'Miscellaneous'
            ],
            'Protohistory' => [
                'Indus Valley Civilization (IVC)',
                'Miscellaneous'
            ],
            'Vedic Age' => [
                'Rig Vedic Age-Society/economy/polity,etc',
                'Later Vedic Age-Society/economy/polity, etc',
                'Terms/meanings',
                'Miscellaneous'
            ],
            'Mahajanapadas' => [
                '16 Mahajanapadas - society/economy/polity, etc',
                'Important personalities of the period',
                'Terms/meanings',
                'Miscellaneous'
            ],
            'Religious Reforms' => [
                'Buddhism',
                'Jainism',
                'Ajivikas',
                'Terms/meanings',
                'Miscellaneous'
            ],
            'Mauryan period' => [
                'Political set up and administration',
                'Economy',
                'Society',
                'Chandragupta Maurya and other rulers',
                'Ashoka and his policy',
                'Causes of decline of Mauryan empire',
                'Arthashastra',
                'Kautilya/Chanakya',
                'The Rise of Magadhas',
                'Terms/meanings',
                'Miscellaneous'
            ],
            'Post-Mauryan period' => [
                'Central Asian Contacts-Indo-Greeks',
                'Sakas',
                'Parthians',
                'Kushans',
                'Shunga dynasty',
                'Kanva dynasty',
                'Satvahanas',
                'Miscellaneous'
            ],
            'Sangam Age' => [
                'Polity and administration',
                'Society',
                'Economy',
                'Terms/meanings',
                'Miscellaneous'
            ],
            'Gupta Age' => [
                'The rise and growth of the Gupta empire',
                'Society and life in the Gupta age',
                'System of Administration Social developments',
                'Gupta age rulers/personalities',
                'Terms/meanings',
                'Miscellaneous'
            ],
            'Post-Gupta period' => [
                'Related to Harsha and Pushyabhuti dynasty',
                'Other kingdoms/dynasties',
                'Terms/meanings',
                'Miscellaneous'
            ],
            'Late Ancient (South India)' => [
                'About Cholas:',
                'About Cheras',
                'About Pandyas',
                'About Pallavas',
                'About other dynasties and kingdoms',
                'Terms/meanings',
                'Miscellaneous'
            ],
            'Ancient india: Miscellaneous' => [
                'Personalities/Travellers, etc',
                'Miscellaneous'
            ]
        ];

        foreach ($sections as $sectionName => $subsectionTopics) {
            $section = $ancientIndiaHistory->sections()->create(['name' => $sectionName]);

            foreach ($subsectionTopics as $topic) {
                $section->subSection()->create(['name' => $topic]);
            }
        }


        // Medieval India History
        $medievalIndiaHistory = InitiativeTopic::create(['name' => 'Medieval India History']);

        $sections = [
            'Early Medieval (North India)' => [
                'About Palas/Pratiharas/Rashtrakutas',
                'Other dynasties/kingdoms',
                'Society/Polity/Economy etc in general',
                'Terms/meanings',
                'Miscellaneous'
            ],
            'Early Medieval (South India)' => [
                'About medieval Pallavas',
                'About medieval Cholas (Imperial Cholas)',
                'About Chalukyas',
                'Society/Polity/Economy etc in general',
                'Terms/meanings',
                'Miscellaneous'
            ],
            'Rise of Islam: 10th-12th centuries AD' => [
                'Muhammed Ghori',
                'Mahmud Ghazni',
                'Other personalities',
                'Other political developments',
                'Terms/meanings',
                'Miscellaneous'
            ],
            'Delhi Sultanate' => [
                'About Slave Dynasty (Aibak, Iltutmish, Balban, etc)',
                'About Khilji Dynasty',
                'About Tughlaq Dynasty',
                'About Sayyid Dynasty',
                'About Lodi Dynasty',
                'About contemporary regional kingdoms',
                'Society/Polity/Economy etc in general',
                'Other important developments',
                'Terms/meanings',
                'Miscellaneous'
            ],
            'Vijaynagar Empire' => [
                'Polity, policies and administration',
                'Society',
                'Economy',
                'Personalities-based (traits, values, actions, etc.)',
                'Other developments',
                'Terms/meanings',
                'Miscellaneous'
            ],
            'Bahamani Kingdom' => [
                'Polity, policies and administration',
                'Society',
                'Economy',
                'Personalities-based (traits, values, actions, etc.)',
                'Other developments',
                'Terms/meanings',
                'Miscellaneous'
            ],
            'Other Dynasties' => [
                'Hoysalas',
                'Kakatiyas',
                'Medieval Chalukyas',
                'Kashmir',
                'Gujarat',
                'Jaunpur',
                'Other dynasties',
                'Terms/meanings',
                'Miscellaneous'
            ],
            'Mughal Period' => [
                'Polity, policies and administration',
                'Society',
                'Economy',
                'Personalities-based (traits, values, actions, etc.)',
                'Other developments',
                'Terms/meanings',
                'Miscellaneous'
            ],
            'Maratha Period' => [
                'Polity, policies and administration',
                'Society',
                'Economy',
                'Personalities-based (traits, values, actions, etc.)',
                'Other developments',
                'Terms/meanings',
                'Miscellaneous'
            ],
            'Sur Dyansty' => [
                'Polity, policies and administration',
                'Society',
                'Economy',
                'Personalities-based (traits, values, actions, etc.)',
                'Other developments',
                'Terms/meanings',
                'Miscellaneous'
            ],
            'Important Battles/Wars' => [
                'Battles of Panipat',
                'Other battles',
                'Miscellaneous'
            ],
            'Bhakti and Sufi movement' => [
                'Sufi personalities/practices',
                'Bhakti personalities/practices',
                'Other developments',
                'Terms/meanings',
                'Miscellaneous'
            ]
        ];

        foreach ($sections as $sectionName => $subsectionTopics) {
            $section = $medievalIndiaHistory->sections()->create(['name' => $sectionName]);

            foreach ($subsectionTopics as $topic) {
                $section->subSection()->create(['name' => $topic]);
            }
        }


        // Modern India History
        $modernIndiaHistory = InitiativeTopic::create(['name' => 'Modern India History']);

        $sections = [
            'After Aurangzeb: Later Mughals and Independent Kingdoms' => [
                'Causes of decline of the Mughal Empire',
                'About Rise of Bengal',
                'About Rise of Awadh',
                'About Rise of Hyderabad',
                'About Rise of Mysore',
                'About other regional powers',
                'Miscellaneous'
            ],
            'The Advent of Europeans in India' => [
                'The Portuguese in India',
                'The Dutch in India',
                'The English/British',
                'The Danes in India',
                'The French',
                'Anglo-French Rivalry and Carnatic Wars',
                'Other battles/rivalries/wars between Europeans',
                'Miscellaneous'
            ],
            'British Expansion in India' => [
                'Battle of Plassey and related developments',
                'Battle of Buxar and related developments',
                'Anglo Maratha Wars',
                'Anglo Sikh Wars',
                'Anglo Afghan Wars',
                'Anglo-Burmese Wars',
                'Anglo-Nepalese War',
                'The Conquest of Sindh',
                'The Subsidiary Alliance System',
                'The Doctrine of Lapse',
                'Policy of paramountcy',
                'Annexation of other regions',
                'Miscellaneous'
            ],
            'Economics Policies of  the British' => [
                'Economic Policies and impact',
                'Permanent Settlement-related',
                'Ryotwari, Mahalwar systems, etc.-related',
                'Drain of Wealth Theory-related',
                'Miscellaneous'
            ],
            'The Revolt of 1857' => [
                'Causes of the Revolt',
                'Centres and spread of the Revolt',
                'Leaders of the Revolt',
                'Causes of Failure of the Revolt',
                'Nature and Impact of the Revolt',
                'Suppression of the Revolt',
                'Consequences',
                'Miscellaneous'
            ],
            'Administrative changes after 1857' => [
                'Related to the Government of India Act, 1858',
                'Changes in the Army',
                'Changes in Foreign Policy',
                'Other changes',
                'Miscellaneous'
            ],
            'Policies (miscellaneous)' => [
                'Policies related to Education (Committees, etc.)',
                'Policies related to Civil Services (Committees, etc.)',
                'Policies related to Police system (Committees, etc.)',
                'Policies related to Judicial system (Committees, etc.)',
                'Policies related to Press/Journalism',
                'Famine-related measures (Commissions, etc)',
                'Miscellaneous'
            ],
            'Personalities (miscellaneous)' => [
                'Governor-Generals',
                'Viceroys',
                'Other important officials',
                'Miscellaneous'
            ],
            'Regulating Act and Charter Acts' => [
                'Regulating Act, 1773',
                'Pitt\'s India Act, 1784',
                'Charter Act, 1793',
                'Charter Act, 1813',
                'Charter Act, 1833',
                'Charter Act, 1853',
                'Miscellaneous'
            ],
            'Socio-religious reforms' => [
                'Factors leading to reforms',
                'Personalities and Important Hindu Reform/Revivalist Movements',
                'Personalities and Important Muslims Reform/Revivalist Movements',
                'Personalities and Important Sikh Reform/Revivalist Movements',
                'Personalities and Important Parsi Reform/Revivalist Movements',
                'Personalities related to Miscellaneous Reform/Revivalist Movements',
                'Other related developments',
                'Miscellaneous'
            ],
            'Peasants, Tribal and other movements' => [
                'Peasant movements',
                'Tribal movements/uprisings',
                'Other rebellions',
                'Personalities-based',
                'Miscellaneous'
            ],
            'Pre-INC organisations' => [
                'About organisations preceding INC',
                'About personalities associated',
                'Miscellaneous'
            ],
            'Early Nationalism (1885 - 1905)' => [
                'Formation of INC',
                'Initial working of the INC',
                'Moderate phase and related events',
                'Personalities associated',
                'Miscellaneous'
            ],
            'National Movement (1905 - 1917)' => [
                'Partition of Bengal (1905)',
                'Swadeshi Movement',
                'Muslim League, 1906',
                'Surat Session of INC, 1907',
                'Ghadar Party, 1913',
                'Komagata Maru Incident 1914',
                'The Lucknow Pact (1916)',
                'Home Rule Movement (1915–1916)',
                'August Declaration, 1917',
                'Contributions of important personalities',
                'Other important events/developments',
                'Miscellaneous'
            ],
            'Council Acts/Government of India Acts' => [
                'Indian Councils Act, 1861',
                'Indian Councils Act, 1892',
                'Indian Councils Act, 1909',
                'Government of India Act, 1919',
                'Government of India Act, 1935',
                'Miscellaneous'
            ],
            'National Movement (1918 -1947)' => [
                'World War I-Reforms and Agitation',
                'Champaran Satyagraha (1917)',
                'Ahmadabad Mill Strike (1918)',
                'Kheda Satyagraha (1918)',
                'The Government of India Act, 1919',
                'Rowlatt Act and Jallianwala Bagh Massacre (1919)',
                'Khilafat Movement',
                'The Non-Cooperation Movement (1920-22)',
                'Bardoli Resolution',
                'Nagpur Session of Congress',
                'Swaraj Party and its Evaluation',
                'Muddiman Committee (1924)',
                'Simon Commission (1927)',
                'Bardoli Satyagraha (1928)',
                'Nehru Report (1928)',
                'Jinnah’s Fourteen Points',
                'Lahore Session, 1929',
                'Civil Disobedience Movement (1930-1931)',
                'First Round Table Conference, 1930',
                'Gandhi-Irwin Pact, 1931',
                'Karachi session of 1931',
                'Second Round Table Conference, 1931',
                'Civil Disobedience Movement (Second-Phase)',
                'Third Round Table Conference (17 November 1932)',
                'Communal Award',
                'Poona Pact, 1932',
                'World War II and Indian Nationalism',
                'Resignation of Congress Ministers (1939)',
                'Poona Resolution and Conditional Support to Britain (1941)',
                'August Offer of 1940',
                'The Individual Civil Disobedience',
                'Two-Nation Theory',
                'Demand for Pakistan (1942)',
                'Cripps Mission (1942)',
                'Quit India Movement',
                'Azad Hind Fauj',
                'Indian National Army',
                'I.N.A. Trials',
                'RIN MUTINY',
                'Rajagopalachari Formula, 1945',
                'Desai - Liaqat Pact',
                'Cabinet Mission (1946)',
                'Wavell Plan',
                'Jinnah’s Direct Action Resolution',
                'Mountbatten Plan of June 1947',
                'Indian Independence Act 1947',
                'Contributions of different personalities',
                'Miscellaneous'
            ],
            'Modern India (Miscellaneous)' => [
                'Important INC sessions',
                'Miscellaneous'
            ]
        ];

        foreach ($sections as $sectionName => $subsectionTopics) {
            $section = $modernIndiaHistory->sections()->create(['name' => $sectionName]);

            foreach ($subsectionTopics as $topic) {
                $section->subSection()->create(['name' => $topic]);
            }
        }


        // Art & Culture
        $artAndCulture = InitiativeTopic::create(['name' => 'Art & Culture']);

        $sections = [
            'Paintings' => [
                'Prehistoric paintings',
                'Protohistoric paintings',
                'Paintings from Ancient period (Ajanta, Ellora, etc)',
                'Paintings from Medieval period',
                'Paintings from regional schools',
                'Contemporary and Modern Art',
                'Tribal and folk paintings',
                'Terms/meanings',
                'Miscellaneous'
            ],
            'Architecture' => [
                'Temple Architecture',
                'Buddhist, Jain architecture',
                'Delhi Sultanate Architecture',
                'Mughal Architecture',
                'Regional Architecture',
                'Modern Indian Architecture',
                'Terms/meanings',
                'Miscellaneous'
            ],
            'Sculptures/Pottery' => [
                'Protohistory (IVC or Harappan)',
                'Chalcolithic period',
                'Vedic period',
                'Mahajanapadas',
                'Mauryan Period and contemporary',
                'Post-Mauryan and contemporary',
                'Gupta Age and contemporary',
                'Post Gupta period',
                'Medieval period',
                'Terms/meanings',
                'Miscellaneous'
            ],
            'Literature' => [
                'Ancient Period (Hindu, Buddhist, Jain etc.)',
                'Medieval Period (all languages and religions)',
                'Modern Period (Books/Pamphlets, etc)',
                'Terms/meanings',
                'Miscellaneous'
            ],
            'Music' => [
                'North Indian (Hindustani)',
                'South Indian (Carnatic)',
                'Folk music',
                'Terms/meanings',
                'Miscellaneous'
            ],
            'Dance' => [
                'Classical dances',
                'Folk dances',
                'Terms/meanings',
                'Miscellaneous'
            ],
            'Puppetry/Drama' => [
                'Drama',
                'Puppetry',
                'Terms/meanings',
                'Miscellaneous'
            ],
            'Garments/Attire/Apparel' => [
                'Garments',
                'Embroidery',
                'Traditional clothings',
                'Terms/meanings',
                'Miscellaneous'
            ],
            'GI Tag' => [
                'About GI-Tag',
                'GI Tagged products',
                'Miscellaneous'
            ],
            'Initiatives of UNESCO' => [
                'Related to World Heritage Sites',
                'Related to Intangible Cultural Heritage',
                'Related to World Heritage Cities',
                'Others'
            ],
            'Current Affairs (Art and Culture)' => [
                'Current themes',
                'Current rules/regulations',
                'Miscellaneous'
            ],
            'Art and Culture (Miscellaneous)' => [
                'Miscellaneous'
            ]
        ];

        foreach ($sections as $sectionName => $subsectionTopics) {
            $section = $artAndCulture->sections()->create(['name' => $sectionName]);

            foreach ($subsectionTopics as $topic) {
                $section->subSection()->create(['name' => $topic]);
            }
        }


        // Geography
        $geography = InitiativeTopic::create(['name' => 'Geography']);

        $sections = [
            'Physical Geography' => [
                'Universe, Solar System, Earth - Basic Concepts, Rotation, Revolution, Latitude, Longitude, Time Zones',
                'Geomorphology',
                'Climatology',
                'Oceanography',
                'Biogeography',
                'Miscellaneous'
            ],
            'Physical Geography of India' => [
                'India: Location, Area and Boundaries, Standard Time',
                'Structure and Relief: Physiographic Divisons',
                'Drainage System',
                'Climate: Monsoons, Cyclones and other phenomenon in India',
                'Soils of India',
                'Biomes, Vegetation, Plant and Animal Life of India',
                'Map based questions from India',
                'Miscellaneous'
            ],
            'World - Human and Economic Geography' => [
                'World Agriculture',
                'Industries and Trade - Primary, secondary, tertiary, quaternary and quinary activities',
                'World Water Resources',
                'World Land Resources',
                'World Mineral and Energy Resources',
                'World Transport and communication',
                'World Population - Distribution, Density, Races & Tribes',
                'Settlement, Migration and Regional Planning World',
                'Major Features of the Continents',
                'Other Economic Infrastructure',
                'Map Based Questions from the World',
                'Miscellaneous'
            ],
            'India - Economic and Human Geography' => [
                'Agriculture of India',
                'Land Resources of India',
                'Water Resources of India',
                'Mineral and Energy Resources of India',
                'Industries of India',
                'Transport and Communication - India',
                "India's Foreign Trade",
                'India - Population',
                'India - Migration and Settlements',
                'Other Economic Infrastructure in India',
                'Miscellaneous'
            ],
            'Current Affairs (related Geography)' => [
                'Current Affairs related to Indian geography',
                'Current Affairs related to World geography',
                'Miscellaneous'
            ]
        ];

        foreach ($sections as $sectionName => $subsectionTopics) {
            $section = $geography->sections()->create(['name' => $sectionName]);

            foreach ($subsectionTopics as $topic) {
                $section->subSection()->create(['name' => $topic]);
            }
        }


        // Security
        $security = InitiativeTopic::create(['name' => 'Security']);

        $sections = [
            'Aspects of Internal Security' => [
                'Left Wing Extremism (LWE)',
                'North-East Insurgency',
                'Technology and Extremism',
                'Terrorism',
                'Cybersecurity',
                'Media and Social Networking Sites',
                'External State and Non-State Actors',
                'Inter-State Disputes',
                'Peace Accords with North-Eastern States',
                'Internet Shutdowns',
                'Miscellaneous',
            ],
            'Money Laundering & Smuggling' => [
                'Black Money',
                'Miscellaneous',
            ],
            'Management of Border Areas' => [
                'Various Technologies for Border Management',
                'Maritime/Coastal Security',
                'Border Infrastructure',
                'Border issues/conflicts',
                'Miscellaneous',
            ],
            'Security Forces and Agencies' => [
                'Paramilitary forces',
                'Military',
                'Miscellaneous',
            ],
            'Defence Modernisation' => [
                'National Security Architecture',
                'Defence Production',
                'Defence Acquisition',
                'Theatre Command',
                'Women in Combat Role',
                'Miscellaneous',
            ],
            'Emerging Dimensions of Warfare' => [
                'Space Warfare',
                'Biowarfare',
                'Chemical warfare',
                'Hybrid Warfare',
                'Miscellaneous',
            ],
            'Current Affairs (Security)' => [
                'New developments',
                'New measures/steps',
                'Miscellaneous',
            ],
            'Miscellaneous (Security)' => [
                'Police Reforms',
                "India's Nuclear Doctrine",
                'Intelligence Reforms',
                'Miscellaneous',
            ],
        ];

        foreach ($sections as $sectionName => $subsectionTopics) {
            $section = $security->sections()->create(['name' => $sectionName]);

            foreach ($subsectionTopics as $topic) {
                $section->subSection()->create(['name' => $topic]);
            }
        }

        // Ethics
        $ethics = InitiativeTopic::create(['name' => 'Ethics']);

        $sections = [
            'Ethics and Human Interface' => [
                'Ethics and Science',
                'Determinants of Ethics',
                'Dimensions of Ethics',
                'Ethics in Public Private Relationships',
                'Miscellaneous',
            ],
            'Attitude' => [
                'Thought and Behavior',
                'Moral and Political Attitudes',
                'Social Influence',
                'Persuasion',
                'Miscellaneous',
            ],
            'Aptitude and foundational values of Civil Services' => [
                'Civil Service Values',
                'Weaker Sections',
                'Miscellaneous',
            ],
            'Emotional Intelligence' => [
                'Concept and utility',
                'Application in civil services',
                'Application in other areas',
                'Miscellaneous',
            ],
            'Moral thinkers and Philosophers' => [
                'Indian thinkers- Ancient',
                'Indian thinkers- Medieval',
                'Indian thinkers- Modern',
                'Indian thinkers- contemporary',
                'Foreign thinkers',
                'Miscellaneous',
            ],
            'Public/Civil Service values and Ethics in Public Administration' => [
                'Government Institutions',
                'Rules and laws and their ethics',
                'Ethical Governance',
                'International Ethics',
                'Corporate Governance',
                'Miscellaneous',
            ],
            'Probity in Governance' => [
                'Information sharing and transparency',
                'Work Culture in Government',
                'Service Delivery',
                'Public Funds',
                'Corruption',
                'Miscellaneous',
            ],
            'Other areas' => [
                'Environmental Ethics',
                'Miscellaneous',
            ],
        ];

        foreach ($sections as $sectionName => $subsectionTopics) {
            $section = $ethics->sections()->create(['name' => $sectionName]);

            foreach ($subsectionTopics as $topic) {
                $section->subSection()->create(['name' => $topic]);
            }
        }


        // Social Issues
        $socialIssues = InitiativeTopic::create(['name' => 'Social Issues']);

        $sections = [
            'Women' => [
                'Laws/Acts',
                'Key bodies/organisation',
                'Key initiatives/Scheme',
                'Key data',
                'Others',
                'Miscellaneous',
            ],
            'Child' => [
                'Laws/Acts',
                'Key bodies/organisation',
                'Key initiatives/Scheme',
                'Key data',
                'Others',
                'Miscellaneous',
            ],
            'Persons with Disability' => [
                'Laws/Acts',
                'Key bodies/organisation',
                'Key initiatives/Scheme',
                'Key data',
                'Others',
                'Miscellaneous',
            ],
            'Elderly People' => [
                'Laws/Acts',
                'Key bodies/organisation',
                'Key initiatives/Scheme',
                'Key data',
                'Others',
                'Miscellaneous',
            ],
            'SC/ST/OBC' => [
                'Laws/Acts',
                'Key bodies/organisation',
                'Key initiatives/Scheme',
                'Key data',
                'Others',
                'Miscellaneous',
            ],
            'Other Vulnerable Groups' => [
                'Transgender',
                'Indigenous People',
                'Manual Scavenger',
                'Others',
                'Miscellaneous',
            ],
            'Developmental issues' => [
                'Poverty',
                'Migration',
                'Nutrition',
                'Globalisation',
                'Urbanisation',
                'Social Security and Informal Workers',
                'Others',
                'Miscellaneous',
            ],
            'Education' => [
                'Laws/Acts/Policies',
                'Key bodies/organisation',
                'Key initiatives/Scheme',
                'Key data',
                'Others',
                'Miscellaneous',
            ],
        ];

        foreach ($sections as $sectionName => $subsectionTopics) {
            $section = $socialIssues->sections()->create(['name' => $sectionName]);

            foreach ($subsectionTopics as $topic) {
                $section->subSection()->create(['name' => $topic]);
            }
        }


        // World History
        $worldHistory = InitiativeTopic::create(['name' => 'World History']);

        $sections = [
            'Beginning of the Modern World' => [
                'Renaissance, Discovery of Sea Routes, Reformation, Counter-Reformation',
                'Miscellaneous',
            ],
            'Industrial Revolution' => [
                'Factors Responsible for the Industrial Revolution',
                'Reasons for IR in England',
                'IR in other parts of Europe – France, Germany, Italy and Sweden',
                'IR outside Europe – Russia, USA, Japan',
                'Effects of Industrial Revolution – Economic, Political and Social',
                'Miscellaneous',
            ],
            'American Revolution' => [
                'Background and Reasons for AR',
                'Events during the Course of the Revolution',
                'Impact of the American Revolution',
                'Miscellaneous',
            ],
            'American Civil War' => [
                'Reasons for the War',
                'Debates on Slavery',
                'Events during the Course of the War',
                'Miscellaneous',
            ],
            'French Revolution' => [
                'Nature and Character of the Revolution',
                'Causes – Social, Political',
                'France under Napoleon',
                'Role of Philosophers',
                'Role of Constituent Assembly and its critical analysis',
                'Impact and Significance of Revolution',
                'Miscellaneous',
            ],
            'Nationalism in Europe' => [
                'Rise of the Nation-state system',
                'Unification of Italy',
                'Unification of Germany',
                'Miscellaneous',
            ],
            'World War I' => [
                'Causes and Course of the War',
                'Why World War I is Total War?',
                'Impact of World War- I',
                'End of the War and Peace Treaties',
                'Consequences of the War – Rise of Hitler',
                'League of Nations',
                'Miscellaneous',
            ],
            'The period between two World Wars' => [
                'Europe After the War – Fascism & Nazism',
                'The Great Depression',
                'Emergence of the Soviet Union',
                'Nationalist Movements in Asia & Africa',
                'US as a Strong Power',
                'Miscellaneous',
            ],
            'World War II' => [
                'Fascist Aggression & Response of Western Democracies',
                'Outbreak of the War',
                'Theatres of the War',
                'US Entry into the War',
                'Global Nature of the War',
                'The Holocaust',
                'Resistance Movements',
                'After-effects of the War',
                'Miscellaneous',
            ],
            'Rise of Colonialism, Capitalism and Imperialism' => [
                'Colonialism',
                'Evolution of Colonialism',
                'Stages of Colonialism',
                'African Colonisation',
                'Colonization in Asia',
                'Miscellaneous',
            ],
            'Decolonization' => [
                'Europe after World War II',
                'Decolonization of Colonies',
                'Decolonization in Latin America',
                'Decolonization in South-East Asia',
                'Decolonization in Indo-China',
                'Decolonization in Africa',
                'Korean War',
                'Vietnam War',
                'Miscellaneous',
            ],
            'Redrawal of National Boundaries' => [
                'How World War I changed the map (Sykes-Picot Agreement, Treaty of Versailles, Sevres)',
                'World War II (Splitting of Germany)',
                'Rise of Asia & Africa - The emergence of New Nations',
                'Developments in West Asia & North Africa',
                'Miscellaneous',
            ],
            'Cold War' => [
                'Reasons for the Cold War',
                'Important events of the Cold War',
                'Marshall plan v/s Cominform',
                'NATO v/s Warsaw Pact',
                'Cuban Crisis',
                'The collapse of the Soviet Union',
                'Post-Cold War Period',
                'Miscellaneous',
            ],
            'Socialism' => [
                'Types of Socialism',
                'Russian Revolution',
                'Russia under Stalin',
                'Miscellaneous',
            ],
            'Communism' => [
                'Difference between Socialism and Communism',
                'Spread of Communism',
                'War Communism',
                'Miscellaneous',
            ],
            'Capitalism' => [
                'Different forms of Capitalism',
                'Relevance of Capitalism in present times',
                'Miscellaneous',
            ],
            'Development in the Middle East' => [
                'Democratic Reforms in the Middle East',
                'Arab Nationalism',
                'Israel and Palestine Conflict',
                'Miscellaneous',
            ],
            'China' => [
                'Colonization in China (Opium Wars)',
                'Role of Sun Yat Sen',
                'Chinese Civil War',
                'Miscellaneous',
            ],
            'Japan' => [
                'Meiji Restoration',
                'Miscellaneous',
            ],
        ];

        foreach ($sections as $sectionName => $subsectionTopics) {
            $section = $worldHistory->sections()->create(['name' => $sectionName]);

            foreach ($subsectionTopics as $topic) {
                $section->subSection()->create(['name' => $topic]);
            }
        }

        // Post Independence
        $postIndependence = InitiativeTopic::create(['name' => 'Post Independence']);

        $sections = [
            'Challenges to Nation Building (Nehruvian Era)' => [
                'Consolidation of provinces',
                'Kashmir issue',
                'Integration of the princely states',
                'Issue of the official language (this recurs in most eras)',
                'Reorganisation of states',
                'Tribal consolidation and issues',
                'The foreign policy of Pandit Nehru',
                'Indo-China war 1962',
                'Miscellaneous',
            ],
            'Shastri Era' => [
                'Official language issue',
                'Food shortage',
                'Economic crisis',
                'Indo-Pak war',
                'Miscellaneous',
            ],
            'Indira Gandhi Era' => [
                'Official language',
                'Split in congress (diminishing of Congress hegemony in regions)',
                'Issue of inflation',
                'Green revolution',
                'Punjab crisis – Operation Blue Star',
                'Land reforms',
                'Bank nationalisation',
                'Emergency',
                'Naxal movement',
                '1971 war with Pakistan',
                'Janta movement',
                'Miscellaneous',
            ],
            'Rajiv Gandhi Era' => [
                'Environment (focus on this topic for the first time by the government)',
                'Anti-defection law',
                'Women movements – Dowry Prohibition Act, Shah Bano case',
                'Modernisation of army',
                'Miscellaneous',
            ],
            'After 1991' => [
                'Political developments',
                'Economics reforms',
                'Panchayati Raj refroms',
                'Miscellaneous',
            ],
        ];

        foreach ($sections as $sectionName => $subsectionTopics) {
            $section = $postIndependence->sections()->create(['name' => $sectionName]);

            foreach ($subsectionTopics as $topic) {
                $section->subSection()->create(['name' => $topic]);
            }
        }

        // Ministries
        $ministriesSub = InitiativeTopic::create(['name' => 'MINISTRY-WISE SCHEMES']);
        $ministries = [
            'MINISTRY OF AGRICULTURE AND FARMERS WELFARE',
            'MINISTRY OF FISHERIES, ANIMAL HUSBANDRY & DAIRYING',
            'MINISTRY OF AYUSH',
            'MINISTRY OF CHEMICALS AND FERTILIZERS',
            'MINISTRY OF CIVIL AVIATION',
            'MINISTRY OF COAL',
            'MINISTRY OF COMMERCE',
            'MINISTRY OF COMMUNICATION',
            'MINISTRY OF CO-OPERATION',
            'MINISTRY OF CORPORATE AFFAIRS',
            'MINISTRY OF CULTURE',
            'MINISTRY OF DEFENCE',
            'MINISTRY OF DEVELOPMENT OF NORTH EASTERN REGION',
            'MINISTRY OF JAL SHAKTI',
            'MINISTRY OF EARTH SCIENCES',
            'MINISTRY OF ELECTRONICS & IT',
            'MINISTRY OF ENVIRONMENT, FOREST AND CLIMATE CHANGE',
            'MINISTRY OF EXTERNAL AFFAIRS',
            'MINISTRY OF FINANCE',
            'MINISTRY OF FOOD PROCESSING INDUSTRIES',
            'MINISTRY OF HEALTH AND FAMILY WELFARE',
            'MINISTRY OF HEAVY INDUSTRIES & PUBLIC ENTERPRISES',
            'MINISTRY OF HOME AFFAIRS',
            'MINISTRY OF HOUSING AND URBAN AFFAIRS',
            'MINISTRY OF HUMAN RESOURCE AND DEVELOPMENT',
            'MINISTRY OF LABOUR AND EMPLOYMENT',
            'MINISTRY OF LAW AND JUSTICE',
            'MINISTRY OF MINES',
            'MINISTRY OF MINORITY AFFAIRS',
            'MINISTRY OF MICRO, SMALL AND MEDIUM ENTERPRISES (MSME)',
            'MINISTRY OF NEW AND RENEWABLE ENERGY',
            'MINISTRY OF PANCHAYATI RAJ',
            'MINISTRY OF PERSONNEL, PUBLIC GRIEVANCES AND PENSIONS',
            'MINISTRY OF PETROLEUM AND NATURAL GAS',
            'MINISTRY OF POWER',
            'MINISTRY OF RAILWAYS',
            'MINISTRY OF ROAD TRANSPORT & HIGHWAYS',
            'MINISTRY OF RURAL DEVELOPMENT',
            'MINISTRY OF SCIENCE AND TECHNOLOGY',
            'MINISTRY OF SHIPPING',
            'MINISTRY OF SKILL DEVELOPMENT AND ENTREPRENEURSHIP',
            'MINISTRY OF SOCIAL JUSTICE AND EMPOWERMENT',
            'MINISTRY OF STATISTICS AND PROGRAMME IMPLEMENTATION',
            'MINISTRY OF STEEL',
            'MINISTRY OF TEXTILE',
            'MINISTRY OF TOURISM',
            'MINISTRY OF TRIBAL AFFAIRS',
            'MINISTRY OF WOMEN AND CHILD DEVELOPMENT',
            'Miscellaneous',
        ];

        foreach ($ministries as $ministryName) {
            $section = $ministriesSub->sections()->create(['name' => $ministryName]);

            $section->subSection()->create(['name' => 'Schemes']);
            $section->subSection()->create(['name' => 'Policies']);
            $section->subSection()->create(['name' => 'Other initiatives']);
        }

        // Indian Society
        $indianSociety = InitiativeTopic::create(['name' => 'Indian Society']);

        $sections = [
            'Modernization and Westernization' => [
                'Various Dimensions of Modernization in Indian Society',
                'Forces Responsible for Modernization and Westernization',
                'Impact on Indian Society and Its Various Segments',
                'Reaction to Modernization and Westernization',
                'Miscellaneous',
            ],
            'Family' => [
                'Role of Family (Socialization)',
                'Joint Family in India',
                'Features of Joint Family',
                'Rise of Nuclear Family in India and Associated Impact and Challenges',
                'Factors Affecting Family System in India',
                'Emerging Forms of Families in India',
                'Miscellaneous',
            ],
            'Caste System' => [
                'Features of the Caste System',
                'Transformation of the Caste System',
                'Forces of Change in the Caste System',
                'Role of Caste in Politics',
                'Contemporary Reality of Caste',
                'Evolving Caste Identities',
                'Sanskritisation',
                'Reservation',
                'Dalit Capitalism',
                'Caste Violence and Conflict',
                'Miscellaneous',
            ],
            'Tribes' => [
                'Definitional Problem',
                'Modernization’s Impact on Tribals',
                'Distribution of Tribes All Over India',
                'Integration and Assimilation',
                'Land Alienation and Conflict',
                'Miscellaneous',
            ],
            'Diversity' => [
                'Extent of Diversity (Linguistic, Religious, etc.)',
                'Unity in Diversity',
                'Diversity in Unity',
                'Role of Diversity in Politics',
                'Problems Associated with Diversity',
                'Reasons for the Growth of Sects and Cults in India',
                'Miscellaneous',
            ],
            'Concept of Gender' => [
                'Transgenders and Related Issues',
                'Miscellaneous',
            ],
            'Women-related Issues' => [
                'Patriarchy',
                'Women and Religion',
                'Women and Caste',
                'Women and Family Roles',
                'Double and Triple Burden on Women',
                'Feminization of Agriculture',
                'Women in Industry and Service Sector',
                'Women in Informal Sector',
                'Gender Issues at the Workplace',
                'Gender Wage Gap',
                'Concept of Unpaid Work',
                'Maternity and Paternity Leave',
                'Violence Against Women',
                'Waves of Feminism in India',
                'Women\'s Organizations and Their Roles in India',
                'Miscellaneous',
            ],
            'Population and Associated Issues' => [
                'Debate with Respect to High Population Growth',
                'Prospects of Human Capital Formation',
                'Demography',
                'Demographic Dividend',
                'Fertility and Variation in India',
                'Two-Child Policy Debate',
                'Population Policy',
                'National Population Policy',
                'Sex Ratio and Related Challenges',
                'Female Infanticide and Feticide',
                'Old Age and Related Issues',
                'Child Issues in India',
                'Miscellaneous',
            ],
            'Migration' => [
                'Type of migration in and outside India',
                'Causes of Migration in and outside India.',
                'Consequences of Migration for source and destination region.',
                'Cultural impact of migration',
                'Miscellaneous',
            ],
            'Urbanization' => [
                'Pattern of urbanization in India',
                'Drivers of Urbanization in India',
                'Slums and Related Issues',
                'Urbanization-related policies and schemes in India',
                'Socio-Cultural problems associated with Urbanization',
                'New Model of Urbanization',
                'Miscellaneous',
            ],
            'Poverty and Developmental Issues' => [
                'Concept of Poverty and Development, Government efforts towards sustainable urbanization.',
                'Social Exclusion and Inequality',
                'Socio-political Dimension of Poverty and Development',
                'Poverty and Development in Post-liberal Economy',
                'Poverty Alleviation Initiatives, Impact, Challenges',
                'Regional Variation of Development and Associated Impact and Challenges',
                'Miscellaneous',
            ],
            'Salient Feature of Globalization in India' => [
                'Forces of Globalization',
                'Impact of Globalization on Culture',
                'Impact of Globalization on Religion',
                'Impact of Globalization on Urban and Rural Areas',
                'Impact of Globalization on Marriage and Family',
                'Impact of Globalization on Women',
                'Impact of Globalization on Workers',
                'Impact of Globalization on Tribal Areas and Tribes',
                'Impact of Globalization on the Economy (Agriculture, Industry, and Services)',
                'Miscellaneous',
            ],
            'Social Empowerment' => [
                'Need for Social Empowerment of Various Disadvantageous Sections',
                'Means of Social Empowerment for Various Sections (Women, Dalits, Tribal, Poor)',
                'Tools and Initiatives Deployed by State to Ensure Social Empowerment',
                'Various Dimensions of Social Empowerment',
                'Miscellaneous',
            ],
            'Communalism' => [
                'Various Aspects of Communalism in India',
                'Determinants/Causes of Communalism in India',
                'Religious Fundamentalism',
                'Communalism and Politics',
                'Consequences of Communalism in India',
                'Various Threats Arising Out of Communalism',
                'Measures Needed to Tackle Communalism',
                'Miscellaneous',
            ],
            'Secularism' => [
                'Models of Secularism',
                'Indian Model of Secularism',
                'Evolution of Secularism in India',
                'Forces and Factors Responsible for Secularism',
                'Challenges to and from Secularism in the Indian Context',
                'Miscellaneous',
            ],
            'Regionalism' => [
                'Positive and Negative Aspects of Regionalism',
                'Regionalism in Post-Independent India',
                'Factors Responsible for Regionalism in India',
                'Son of the Soil Theory',
                'Basis of Regionalism',
                'Types of Regionalism',
                'Impacts of Regionalism',
                'Regionalism: A Threat to National Integration?',
                'Regionalism in Various Parts of India',
                'Various Methods to Tackle Regionalism in India',
                'Miscellaneous',
            ],
        ];

        foreach ($sections as $sectionName => $subsectionTopics) {
            $section = $indianSociety->sections()->create(['name' => $sectionName]);

            foreach ($subsectionTopics as $topic) {
                $section->subSection()->create(['name' => $topic]);
            }
        }
    }
}
