<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Upload::class, function (Faker $faker) {
    $claim = factory(\App\Models\Claim::class)->create();
    return [
        'file' => $faker->file('storage\framework\testing', 'storage\app\public\uploads'),
        'claim_id' => $claim,
    ];
});
