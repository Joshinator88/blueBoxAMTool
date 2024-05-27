<?php

namespace Database\Seeders;

use App\Models\Category;
use Database\Factories\RoleFactory;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $names = [
            "candy",
            "cookies",
            "fresh food",
            "junk food",
            'toys'
        ];

        foreach ($names as $name) {
            Category::factory()->create([
                "name" => $name,
            ]);
        }
    }
}
