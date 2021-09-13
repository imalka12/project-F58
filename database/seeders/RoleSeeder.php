<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create general user
        Role::create([
            'title' => 'General User',
            'is_default_role' => true,
        ]);

        // create seller
        Role::create([
            'title' => 'Seller',
            'is_default_role' => false,
        ]);

        // create administrator
        Role::create([
            'title' => 'Administrator',
            'is_default_role' => false,
        ]);
    }
}
