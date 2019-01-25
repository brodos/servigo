<?php

namespace App\Http\Controllers\User;

use App\Media;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfileMediaController extends Controller
{
    public function store()
    {
    	$user = auth()->user();
    	$user->load('profile');

    	$this->authorize('update_profile', $user->profile);

    	// check for images
        if (request()->has('images')) {
            $media = Media::whereIn('uuid', request()->images)->pluck('id')->toArray();

            $user->profile->media()->syncWithoutDetaching($media);

            return redirect()->route('user-profile.show')->with('flash-message', 'Fotografiile au fost salvate cu succes!');
        }

        return redirect()->route('user-profile.show')->with('flash-message', 'Nu am primit nici-o fotografie...');
    }
}
