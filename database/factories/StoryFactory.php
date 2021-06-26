<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Story;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Story::class, function (Faker $faker) {
    $type = $faker->randomElement(['short', 'long']);
    if($type == 'long'){
        $body = $faker->paragraph();
    }else{
        $body = $faker->text(200);
    }
    return [
        //
        'user_id' => $faker->numberBetween(1, 2),
        'title' => $faker->unique()->lexify('??????????'),
        'body' => $body,
        // 'body' => $faker->paragraph(),
        'type' => $type,
        // 'type' => $faker->randomElement(['short', 'long']),
        'status' => $faker->boolean()
    ];
});
