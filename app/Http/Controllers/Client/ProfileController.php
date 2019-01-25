<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    public function show(User $user)
    {
    	# code...
    }

    public function edit(User $user)
    {
    	$this->authorize('update', $user->profile);
    }

    public function update(User $user)
    {
    	# code...
    }
}
