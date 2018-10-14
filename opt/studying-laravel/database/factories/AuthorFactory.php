<?php

use Faker\Generator as Faker;

$factory->define(App\Eloquent\Author::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail
    ];
});

$factory->state(App\Eloquent\Author::class, 'yaizu', function (Faker $faker) {
    return [
        'name' => 'yaizu',
    ];
});

$factory->state(App\Eloquent\Author::class, 'yaizu_email', function (Faker $faker) {
    return [
        'email' => 'yaizu@yaizuuuu.com',
    ];
});
