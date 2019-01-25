<?php

use Faker\Generator as Faker;
use Illuminate\Support\Carbon;

$factory->define(App\Message::class, function (Faker $faker) {
    return [
        'body' => $faker->paragraph,
        'conversation_id' => factory(App\Conversation::class),
        'user_id' => factory(App\User::class),
    ];
});

$factory->state(App\Message::class, 'for_existing_conversations', function() {
	$chat = \App\Conversation::all()->random();

	return [
		'user_id' => $chat->project->owner->id,
		'conversation_id' => $chat->id
	];
});
