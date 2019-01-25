<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
	use RefreshDatabase;

    /** @test */
    public function a_user_can_be_assigned_a_role()
    {
        $user = create('App\User');

        $role = create('App\Role', [
        	'name' => 'client',
        	'label' => 'client',
        ]);

        $user->assignRole($role);

        $this->assertDatabaseHas('role_user', ['role_id' => $role->id, 'user_id' => $user->id]);
    }

    /** @test */
    public function a_user_has_a_profile ()
    {
        $user = create('App\User');

        $profile = create('App\Profile', ['user_id' => $user->id]);

        $this->assertInstanceOf('App\Profile', $user->profile);        
    }
}