<?php

use App\Filters;

class ProjectFilters extends Filters
{
	/**
     * Registered filters to operate upon.
     *
     * @var array
     */
    protected $filters = [
    	'cid', // category id
    	'zid', // zone ide
    	'q', // search query
    ];
}