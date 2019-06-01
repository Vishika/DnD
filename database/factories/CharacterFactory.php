<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Character;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(Character::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'gold' => 0,
        'experience' => 0,
        'level' => rand(1,20),
        'race' => Str::random(10),
        'class' => Str::random(10),
    ];
});