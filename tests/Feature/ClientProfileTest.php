<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Profile;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class ClientProfileTest extends TestCase
{
    use RefreshDatabase;

    public function test_if_user_has_a_profile()
    {
        // create a user role
        $role = Role::create(['title' => 'client', 'is_default_role' => 1]);

        // create a user
        $user = User::create([
            'firstname' => 'Imalka',
            'lastname' => 'Wijerathna',
            'email' => 'imalka@wijerathna.com',
            'password' => Hash::make('password'),
            'status' => 'active',
            'role_id' => $role->id,
        ]);

        // create a profile for the user
        $profile = Profile::create([
            'user_id' => $user->id
        ]);

        // check if role is created
        $this->assertDatabaseHas('roles', ['title' => 'client']);

        // assert if the created role is the default role
        $this->assertEquals(1, $role->is_default_role);

        // assert if created role is selected as the default role
        $this->assertEquals(Role::getDefault()->id, $role->id);

        // check if user is created
        $this->assertDatabaseHas('users', ['email' => 'imalka@wijerathna.com']);

        // check if the user has a profile
        $this->assertEquals($profile->user_id, $user->id);
    }
}
