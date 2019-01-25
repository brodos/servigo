<?php

use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(App\Project::class, function (Faker $faker) {
    return [
    	'uuid' => Str::uuid(),
        'title' => $faker->realText(50),
        'slug' => str_slug($faker->realText(50)) . '-' . str_random(8),
        'description' => $faker->realText(500),
        'user_id' => function() {
        	return factory(App\User::class)->create()->id;	
        },
        'category_id' => function() {
            return factory(App\Category::class)->create()->id; 
        },
        'start_date' => $faker->dateTimeBetween('now', '15 days'),
        'end_date' => $faker->dateTimeBetween('15 days', '30 days'),
        'published_at' => $faker->dateTimeBetween('-30 days', 'now'),
        'approved_at' => $faker->dateTimeBetween('-30 days', 'now')
    ];
});
