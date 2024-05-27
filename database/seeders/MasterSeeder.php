<?php

namespace Database\Seeders;

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
        Master::factory()->create([
            "name" => "Nestle",
            "category_id" => 1,
            "partner_id" => 1
        ]);
    }
}
