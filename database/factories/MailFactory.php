<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Mail;
use Faker\Generator as Faker;

$factory->define(Mail::class, function (Faker $faker) {
    return [
        'subject' => $faker->sentence(3),
        'body' => $faker->paragraph(5),
        'user_id' => $faker->numberBetween(1, 3),
    ];
});
