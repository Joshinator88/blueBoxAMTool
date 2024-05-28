<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\Models\Gender;
use App\Models\Master;
use Faker\Guesser\Name;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        User::Factory()->create([
        'name' => "admin",
        'last_name' => 'admin',
        'gender_id' => 1,
        'role_id' => 1,
        'email' => 'admin@mail.com',
        'password' => Hash::make('123')
        ]);
        User::Factory()->create([
        'name' => "sales",
        'last_name' => 'sales',
        'gender_id' => 1,
        'role_id' => 2,
        'email' => 'sales@mail.com',
        'password' => Hash::make('123')
        ]);
        User::Factory()->create([
        'name' => "management",
        'last_name' => 'management',
        'gender_id' => 1,
        'role_id' => 3,
        'email' => 'management@mail.com',
        'password' => Hash::make('123')
        ]);
        User::Factory()->create([
        'name' => "user",
        'last_name' => 'user',
        'gender_id' => 1,
        'role_id' => 4,
        'email' => 'user@mail.com',
        'password' => Hash::make('123')
        ]);

        User::factory(10)->create([
        "gender_id" => random_int(1, Gender::count()), 
        "role_id" => 2
        ]);
        User::factory(10)->create([
            "gender_id" => random_int(1, Gender::count()), 
            "role_id" => 1
        ]);
        User::factory(10)->create([
            "gender_id" => random_int(1, Gender::count()), 
            "role_id" => 3
        ]);
        User::factory(10)->create([
            "gender_id" => random_int(1, Gender::count()), 
            "role_id" => 4
        ]);

        
        Master::All()->each(function ($master) {
            $sales1 = 0;
            $sales2 = 0;
            while ($sales1 == $sales2) {
                $sales1 = mt_rand(5, 14);
                $sales2 = mt_rand(5, 14);
            }
            $master->users()->save(User::where("role_id", 2)->find($sales1));
            $master->users()->save(User::where("role_id", 2)->find($sales2));
        });
    }
}
