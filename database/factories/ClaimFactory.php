<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Claim::class, function (Faker $faker) {

    $theme = $faker->realText(rand(50, 100), true);
    $message = $faker->realText(rand(100, 400));

    $createdAt = $faker->dateTimeBetween('-2 week', '-2 day');

    $user_id = rand(1, 6) == 1 ? 2 : rand(3, 20);
    $user = \App\Models\User::find($user_id);

    if($user->last_claim_created_at < $createdAt){
        $data = ['last_claim_created_at' => $createdAt];
        $result = $user
            ->update($data);
    }

    return [
        'user_id' => $user_id,
        'theme' => $theme,
        'message' => $message,
        'answered' => rand(1, 5) == 5 ? true : false,
        'created_at' => $createdAt,
        'updated_at' => $createdAt,
    ];

});
