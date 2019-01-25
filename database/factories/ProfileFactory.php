<?php

use Faker\Generator as Faker;

$factory->define(App\Profile::class, function (Faker $faker) {
    return [
        'user_id' => function() {
            return factory(App\User::class)->create()->id;  
        },
        'tagline' => $faker->sentence,
        'bio' => $faker->paragraph,
        'display_name' => $faker->name
    ];
});

$factory->state(App\Profile::class, 'for_existing_users', [
    'user_id'       => function() {
        return \App\User::all()->random()->id;
    }
]);
$factory->state(App\Profile::class, 'from_existing_counties', [
    'county_id'       => function() {
        return \App\County::all()->random()->id;
    }
]);