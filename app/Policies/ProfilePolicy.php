<?php

namespace App\Policies;

use App\User;
use App\Profile;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProfilePolicy
{
    use HandlesAuthorization;

    public function update_profile(User $user, Profile $profile)
    {
        return $user->id === $profile->user_id;
    }
}
