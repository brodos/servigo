<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AccountController extends Controller
{

	public function __contruct() 
	{
		$this->middleware('auth', 'verified');
	}
	
    /**
     * Show the user account page
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        // dd(route('user-account.show', [], false));

        return view('account.profile');
    }

    public function edit()
    {
        return view('account.settings');
    }
}
