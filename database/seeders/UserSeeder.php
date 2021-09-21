<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // get admin role
        $role = Role::whereTitle('Administrator')->first();

        // create admin user
        $user = User::create([
            'firstname' => 'Admin',
            'lastname' => 'User',
            'email' => 'admin@quickads.local',
            'password' => Hash::make('123456789'),
            'status' => 'active',
            'role_id' => $role->id,
            'email_verified_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
