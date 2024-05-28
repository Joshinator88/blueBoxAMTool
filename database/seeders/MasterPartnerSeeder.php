<?php

namespace Database\Seeders;

use App\Models\Master;
use App\Models\Partner;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MasterPartnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Master::all()->each(function ($master) {
            $partnerAmount = mt_rand(1, Partner::count());
            $usedNumbers = [];
            for ($i = 1; $i <= $partnerAmount; $i++) {
                $partnerIndex = mt_rand(1, Partner::count());
                while (in_array($partnerIndex, $usedNumbers)) {
                    $partnerIndex = mt_rand(1, Partner::count());
                }
                array_push($usedNumbers, $partnerIndex);
                    $master->partners()->save(Partner::find($partnerIndex));
            }
        });
    }
}
