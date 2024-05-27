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

        User::factory(20)->create([
        "gender_id" => random_int(1, Gender::count()), 
        "role_id" => random_int(1, Role::count())
        ]);

        $users = User::all();
        
        Master::All()->each(function ($master) use ($users) {
            $master->users()->saveMany($users);
        });
    }
}
