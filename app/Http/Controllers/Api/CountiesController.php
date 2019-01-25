<?php

namespace App\Http\Controllers\Api;

use App\County;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CountiesController extends Controller
{
    public function index()
    {
    	return County::orderBy('name')->get();
    }

    public function show(County $county)
    {
    	$county->load('cities');
    	
    	return [
    		'success' => true,
    		'county' => $county
    	];
    }
}
