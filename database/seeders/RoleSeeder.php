<?php

namespace Database\Seeders;

use Database\Factories\RoleFactory;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $roles = ['admin', 'sales', 'management', 'user'];

        foreach ($roles as $role) {
            Role::factory()->create([
            'role' => $role
            ]);
        }
    }
}
