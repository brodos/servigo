<?php

use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(App\Conversation::class, function (Faker $faker) {
    return [
        'uuid' => Str::uuid(),
        'project_id' => function() {
        	return factory(App\Project::class)->create()->id;	
        },
        'proposal_id' => function() {
        	return factory(App\Proposal::class)->create()->id;	
        }
    ];
});
$factory->state(App\Conversation::class, 'for_existing_projects', function() {
	$project = \App\Project::all()->random();
	$proposal = $project->proposals()->get()->random();

	return [
		'project_id' => $project->id,
		'proposal_id' => $proposal->id,
	];
});
