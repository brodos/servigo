<?php

/** Application specific settings */

/**
 * Projects statuses
 *
 * 0 => draft,
 * 1 =>
 */

return [
	'hashids' => [
		'key' => 'this is a key',
		'pad' => 8
	],

	'profilePercentages' => [
		'url' => 5,
		'bio' => 20,
		'tagline' => 15,
		'location' => 15,
		'avatar' => 10,
		'name' => 25,
		'media' => 10
	],

	'roles' => [
		'client',
		'contractor',
	],

	'duration_type' => [
		1 => 'minute',
		2 => 'ore',
		3 => 'zile',
		4 => 'saptamani',
		5 => 'luni',
		6 => 'ani',
	],

	'project' => [
		'draft' 	=> 0,
		'published' => 1, // project was made visible on the site
		'selected' 	=> 2, // a proposal was selected and is awaiting for contractor confirmation
		'ongoing' 	=> 3, // contractor confirmed the project execution
		'completed' => 4, // the contractor submitted a review for the client

		// custom states
		'active' => [1, 2],

		// helper array to use in views
		'statuses' => [
			0 => 'draft',
			1 => 'published', // project was made visible on the site
			2 => 'selected', // a proposal was selected and is awaiting for contractor confirmation
			3 => 'ongoing', // contractor confirmed the project execution
			4 => 'completed', // the contractor submitted a review for the client
		],
	],

	'proposal' => [
		'draft' 	=> 0,
		'submitted' => 1, // proposal was submitted to the client
		'saved' 	=> 2, // the client has saved this proposal for later review
		'selected' 	=> 3, // client has selected proposal as the winning one
		'confirmed' => 4, // contractor confirmed the project execution
		'completed' => 5, // the client sutmitted a review for the contractor
		'dismissed' => 99, // client dismissed this proposal

		// states
		'ongoing' 	=> 4,
		'active' => [1,2],
		'ongoing' => [3,4],

		// helpers
		'winner' 	=> [3,4,5],
		'allow_save' 	=> [1,2],
		'allow_dismiss' => [1,2,3],
		'allow_select' 	=> [1,2],

		// helper array to use in views
		'statuses' => [
			0 	=> 'draft',
			1 	=> 'submitted', // proposal was submitted to the project
			2 	=> 'saved', // the client has saved this proposal for later review
			3 	=> 'selected', // client has selected proposal as the winning one
			4 	=> 'confirmed', // contractor confirmed the project execution
			5	=> 'completed', // the client sutmitted a review for the contractor
			99 	=> 'dismissed', // client dismissed this proposal
		],
	],

	'pagination' => [
        'perPage' => 10,
        'proposalsPerPage' => 25
    ]

];