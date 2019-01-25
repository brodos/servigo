<?php

namespace App\Http\Controllers;

use App\County;
use App\Project;
use App\Proposal;
use App\Category;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function show($param1 = null, $param2 = null)
    {
    	if (isset($param1, $param2)) {
    		// 1 - categpry
    		$category = Category::whereSlug($param1)->firstOrFail();

    		// 2 - county
    		$param2 = explode('-', $param2);
    		$param2 = $param2[1];

    		$county = County::whereSlug($param2)->firstOrFail();
    	}
    	elseif (isset($param1) && ! isset($param2)) {
    		// we need to find it
    		$category = Category::whereSlug($param1)->first();

    		if (! $category) {
    			$param1 = explode('-', $param1);
    			$param1 = $param1[1];
    			$county = County::whereSlug($param1)->firstOrFail();
    		}
    	}

    	$q = request()->q ?? '';
    	$c = request()->c ?? '';
    	$z = request()->z ?? '';

    	$query = $q != '' ? $q : '*';

    	$projects = Project::with('category','proposals');

    	if (isset($category) && !empty($category)) {
    		$projects = $category->projects()->where('published', 1)->whereNull('completed_at')->orderBy('published_at', 'desc');
    	}

    	if (!empty($q)) {
    		$projects->where('title', 'like', '%' . $q . '%');
    	}

    	$counties = County::orderBy('name')->get();

    	$projects = $projects->paginate(25);
    	
    	$meta = (object) [
    		'pageTitle' => $query == '*' ? 'Anunturi' : 'Cauta anunturi',
    	];


    	return view('search.show', compact('projects','meta','counties','q','c','z'));
    }
}
