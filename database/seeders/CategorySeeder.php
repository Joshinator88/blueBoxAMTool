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
        $categories = [
            "CHAMPIONS",
            "UEFA",
            "MAINTAIN",
            "PROSPECT",
            "1-PARTNER"
        ];

        foreach ($categories as $category) {
            Category::factory()->create([
                "name" => $category,
            ]);
        }
    }
}
