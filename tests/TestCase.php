<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function signIn($user = null)
    {
        $user = $user ?: create(\App\User::class);
        $this->actingAs($user);
        return $this;
    }

    /**
     * Create a user and assign a role
     *
     * @param string		$role
     * @return \App\User	$user
     **/
    protected function getRoledUser($role)
    {
    	$user = create(\App\User::class);

    	$role = create(\App\Role::class, [
            'name' => $role,
            'label' => $role,
        ]);

		$user->assignRole($role);

		return $user;
    }
}
