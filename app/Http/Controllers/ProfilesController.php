<?php

namespace App\Http\Controllers;

use App\Profile;
use Illuminate\Http\Request;

class ProfilesController extends Controller
{
	/**
	 * Show the public profile
	 * 	
	 * @param  string $slug_name 
	 * @return Response
	 */
    public function show($slug_name)
    {
    	$profile = Profile::with('user')->where('slug_name', $slug_name)->firstOrFail();

    	return $profile;

    	return view('profile.show', compact('profile'));
    }
}
