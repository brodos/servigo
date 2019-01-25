<?php

namespace App\Http\Controllers\Contractor;

use App\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
    	// $results = Project::(request('q'));
    	$results = Project::published()->get();

    	if (request()->expectsJson()) {
            return $results->paginate(25);
        }
    	
        return view('contractors.search.show', compact('results'));
    }
}
