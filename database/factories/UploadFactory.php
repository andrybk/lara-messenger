<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Upload::class, function (Faker $faker) {

    $claim = factory(\App\Models\Claim::class)->create();

    $path = storage_path().'/app/messenger/claims/uploads/' . $claim->id;
    if (!file_exists($path)) {
       \Illuminate\Support\Facades\File::makeDirectory($path, 0700, true);
    }

    return [
        'file' => $faker->file(storage_path().'/framework/testing/'),
        'claim_id' => $claim->id,
    ];
});
