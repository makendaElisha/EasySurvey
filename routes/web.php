<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
   
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Routes to Surveys
Route::get('survey/{category}/send', 'SurveysController@send')->name('survey.send');
Route::post('survey/link/{category}', 'SurveysController@sendlink')->name('survey.sendlink'); 
Route::get('survey/take/{category}/{token}', 'SurveysController@take')->name('survey.take');
Route::post('survey/{category}/{token}', 'SurveysController@store')->name('survey.store');

//Routes to Categories
Route::resource('categories', 'CategoriesController');

//Routes to Questions
Route::get('questions/create/{category}', 'QuestionsController@create')->name('questions.create');
Route::post('questions/store', 'QuestionsController@store')->name('questions.store');
Route::patch('questions/{question}', 'QuestionsController@update')->name('questions.update');
Route::delete('questions/{question}', 'QuestionsController@destroy')->name('questions.destroy');
Route::get('questions/{question}/edit', 'QuestionsController@edit')->name('questions.edit');

//Routes to Results
Route::get('results/', 'ResultsController@index')->name('results.index');
Route::get('results/{category}', 'ResultsController@show')->name('results.show');
