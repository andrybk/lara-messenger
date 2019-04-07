<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Claim::class, function (Faker $faker) {

    $theme = $faker->sentence(rand(3, 8), true);
    $message = $faker->realText(rand(100, 400));

    $createdAt = $faker->dateTimeBetween('-2 week', '-1 day');


    return [
        'user_id' => rand(2, 20),
        'theme' => $theme,
        'message' => $message,
        'answered' => rand(1, 5) == 5 ? true : false,
        'created_at' => $createdAt,
        'updated_at' => $createdAt,
    ];

});
