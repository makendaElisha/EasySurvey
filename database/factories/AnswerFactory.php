<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Answer;
use App\Question;
use Faker\Generator as Faker;

$factory->define(Answer::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'question_id' => function(){
            return (Question::all()->pluck('id'))->random();
        },
        
    ];
});
