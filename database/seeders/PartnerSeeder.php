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
        //a loop to create all the partners
        
        $partners = [
            "Hinojosa",
            "Klingele",
            "VPK",
            "Cart-One FEPA",
            "Cart-One SADA"
        ];
        foreach ($partners as $partner) {
            Partner::factory()->create([
                'name' => $partner
            ]);
        }
    }
}
