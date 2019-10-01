<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Category;
use App\User;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->text($maxNbChars = 200),
        'user_id' => function(){
            return (User::all()->pluck('id'))->random();
        },

    ];
});
