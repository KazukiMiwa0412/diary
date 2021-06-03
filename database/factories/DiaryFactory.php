<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Diary::class, function (Faker $faker) {
    return [
        "title"=>$faker->word,
        "text"=>$faker->sentence($nb = 3,$asText = false),
        "date"=>$faker->dateTime,
        "user_id"=>$faker->numberBetween($min = 0,$max = 10)
    ];
});
