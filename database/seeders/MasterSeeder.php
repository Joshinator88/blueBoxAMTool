<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Master;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Master::factory(10)->create([
            "category_id" => random_int(1, Category::count())
        ]);
    }
}
