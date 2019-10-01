<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Answer;
use App\Question;
use App\Survey;
use App\User;
use Faker\Generator as Faker;

$factory->define(Survey::class, function (Faker $faker) {
    return [        
        'user_id' => function(){
            return (User::all()->pluck('id'))->random();
        },
        'category_id' => function(){
            return (Category::all()->pluck('id'))->random();
        },
        'question_id' => function(){
            return (Question::all()->pluck('id'))->random();
        },
        'answer_id' => function(){
            return (Answer::all()->pluck('id'))->random();
        },
    ];
});
