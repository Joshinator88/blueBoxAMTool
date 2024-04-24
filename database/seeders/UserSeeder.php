<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Guesser\Name;
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
            'password' => '123'
        ]);
    }
}
