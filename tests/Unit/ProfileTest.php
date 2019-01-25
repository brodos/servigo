<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class profileTest extends TestCase
{
	use RefreshDatabase;

    /** @test */
    public function a_user_has_a_profile()
    {
        $user = create('App\User');

        $role = create('App\Role', [
        	'name' => 'client',
        	'label' => 'client',
        ]);

        $user->assignRole($role);

        $this->assertDatabaseHas('role_user', ['role_id' => $role->id, 'user_id' => $user->id]);
    }
}
