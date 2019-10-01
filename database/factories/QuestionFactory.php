<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Category;
use App\Question;
use Faker\Generator as Faker;

$factory->define(Question::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'category_id' => function(){
            return (Category::all()->pluck('id'))->random();
        },
    ];
});
