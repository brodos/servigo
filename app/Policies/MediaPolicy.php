<?php

namespace App\Policies;

use App\User;
use App\Media;
use Illuminate\Auth\Access\HandlesAuthorization;

class MediaPolicy
{
    use HandlesAuthorization;

    public function delete_media(User $user, Media $media)
    {
        return $user->id === $media->user_id;
    }
}
