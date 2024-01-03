<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            ['name' => 'admin', 'guard_name' => 'web'],
            ['name' => 'reviewer', 'guard_name' => 'web'],
            ['name' => 'expert', 'guard_name' => 'web'],
            ['name' => 'news_today_reviewer', 'guard_name' => 'web'],
            ['name' => 'news_today_expert', 'guard_name' => 'web'],
            ['name' => 'weekly_focus_reviewer', 'guard_name' => 'web'],
            ['name' => 'weekly_focus_expert', 'guard_name' => 'web'],
            ['name' => 'monthly_magazine_reviewer', 'guard_name' => 'web'],
            ['name' => 'monthly_magazine_expert', 'guard_name' => 'web']
        ];

        Role::insert($roles);
    }
}
