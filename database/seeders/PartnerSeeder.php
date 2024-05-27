<?php

namespace Database\Seeders;

use App\Models\Master;
use App\Models\Partner;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PartnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $masters = Master::all();
        foreach ($masters as $master) {
            Partner::factory(8)->create([
                "master_id" => $master->id
            ]);
        }
    }
}
