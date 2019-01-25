<?php

namespace App\Http\Controllers\User;

use App\User;
use App\County;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
	/**
	 * [show description]
	 * @return Response
	 */
    public function show()
    {
    	$user = auth()->user();
    	$user->load('profile','profile.media');
    	
    	return view('account.profile.show', compact('user'));
    }

    /**
     * [edit description]
     * @return Response
     */
    public function edit()
    {
    	$user = auth()->user();
    	$user->load('profile');

    	$this->authorize('update_profile', $user->profile);

    	$counties = County::orderBy('name')->get();
    	
    	return view('account.profile.edit', compact('user','counties'));
    }

    /**
     * [update description]
     * @return Response
     */
    public function update()
    {
    	$user = auth()->user();
    	$user->load('profile');

    	$this->authorize('update_profile', $user->profile);

    	$this->validate(request(), [
    		'avatar' => 'nullable|image|dimensions:min_width=100,min_height=50|max:10240',
    		'display_name' => 'required|min:1|max:50|regex:/^[A-Za-z]+[\w\s\-\.]+$/',
    		'county_id' => 'required|exists:counties,id',
    		'city_id' => 'required|exists:cities,id',
    		'tagline' => 'nullable|min:1|max:100',
    		'bio' => 'nullable|min:1|max:1000',
    		'slug_name' => [
    			'nullable',
    			'min:3',
    			'max:50',
    			'alpha_dash',
    			Rule::unique('profiles')->ignore($user->id, 'user_id'),
    		],
    		'personal_url' => 'nullable|url|max:255',
    	]);

    	$user->profile->update([
    		'display_name' => request()->display_name,
    		'slug_name' => request()->slug_name,
    		'tagline' => request()->tagline,
    		'bio' => request()->bio,
    		'personal_url' => request()->personal_url,
    		'county_id' => request()->county_id,
    		'city_id' => request()->city_id,
    	]);

    	// check for newly uploaded avatar
    	if (request()->hasFile('avatar') && request()->file('avatar')->isValid() && ! request()->has('remove_avatar')) {

    		$path = request()->file('avatar')->store('avatar/' . $user->uuid, 'public');

    		$user->profile->avatar = $path;
    		$user->profile->save();

    	}

    	// remove the avatar
    	if (request()->has('remove_avatar')) {
    		$user->profile->avatar = null;
    		$user->profile->save();
    	}

    	return redirect()->route('user-profile.show')->with('flash-message', 'Profilul a fost modificat cu succes!');
    }
}
