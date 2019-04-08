<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Upload::class, function (Faker $faker) {

    $claim = factory(\App\Models\Claim::class)->create();

    $path = storage_path().'\app\messenger\claims\\' . $claim->id;
    \Illuminate\Support\Facades\File::makeDirectory($path,0777,true);

    return [
        'file' => $faker->file('storage\framework\testing\messenger\claims\uploads', $path),
        'claim_id' => $claim->id,
    ];
});
