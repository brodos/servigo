<?php

use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(App\Proposal::class, function (Faker $faker) {
    return [
    	'uuid' 			=> Str::uuid(),
        'user_id' 		=> function() {
        	return factory(App\User::class)->create()->id;
        },
        'project_id' 	=> function() {
        	return factory(App\Project::class)->create()->id;
        },
        'price' 		=> mt_rand(1000, 1500),
        'description'	=> implode(PHP_EOL.PHP_EOL, $faker->paragraphs(5)),
        'duration' 		=> mt_rand(1, 30),
        'duration_type' => mt_rand(1, 6),
        'available_from' => $faker->dateTimeBetween('now', '30 days'),
        'submitted_at'  => $faker->dateTimeBetween('-30 days', 'now'),
    ];
});

$factory->state(App\Proposal::class, 'from_existing_users', function() {

    $user = \App\User::whereNotIn('id', [1])->get()->random();

    return [
        'user_id' => $user->id,
    ];
});