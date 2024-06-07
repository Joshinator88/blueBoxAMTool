<?php

namespace Database\Seeders;

use App\Models\Action;
use App\Models\Master;
use App\Models\Strategy;
use App\Models\User;
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
            $numberOfActions = mt_rand(1, 10);
            $startegy = Strategy::factory(mt_rand(0, 8))->create([
                "master_id" => $master->id
            ]);
            for ($i = 0; $i < $numberOfActions; $i++) {
                $userOne = mt_rand(1, User::count());
                $userTwo = mt_rand(1, User::count());
                while ($userOne == $userTwo) {
                    	$userTwo = mt_rand(1, User::count());
                }
                Action::factory()->create([
                    'who' => $userOne,
                    'support' => $userTwo
                ]);
            }
        });
    }
}
