<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Message;
use Faker\Generator as Faker;

$factory->define(Message::class, function (Faker $faker) {
    static $seed = 0;

    $faker->seed($seed++);

    return [
        'user_id' => factory(App\User::class),
        'title' => $faker->realText(10),
        'content' => $faker->realText(250),
    ];
});
