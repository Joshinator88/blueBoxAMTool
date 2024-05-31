<?php

namespace Database\Seeders;

use App\Models\Master;
use App\Models\Strategy;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StrategySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Master::all()->each(function ($master) {
            Strategy::factory(mt_rand(0, 8))->create([
                "master_id" => $master->id
            ]);
        });
    }
}
