<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\Gender;
use App\Models\Master;
use App\Models\Partner;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            CategorySeeder::class,
            GenderSeeder::class,
            RoleSeeder::class,
            MasterSeeder::class,
            PartnerSeeder::class,
            UserSeeder::class,
            MasterPartnerSeeder::class,
            StrategySeeder::class
        ]);
    }
}
