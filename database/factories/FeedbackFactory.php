<?php

use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(App\Feedback::class, function (Faker $faker) {
    return [
    	'uuid' => Str::uuid(),
    	'feedback_date' => $faker->dateTimeBetween('now', '30 days'),
        'rating' => mt_rand(1, 5),
        'message' => $faker->paragraph,
        'reply' => $faker->paragraph,
        'from_user_id' => factory(App\User::class)->create(),
        'to_user_id' => factory(App\User::class)->create(),
        'project_id' => factory(App\Project::class),
    ];
});

/**
 * I will want to lookup all the feedbacks received by a user, I will look them up through the to_user_id
 */
