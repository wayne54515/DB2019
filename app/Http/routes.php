<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('authtest');
});

// view
Route::get('/home', 'HomeController@index');
Route::get('/food_menu', 'FoodController@food_menu');
Route::get('/rank_list', 'RankController@rank_list');
Route::get('/manage', 'ManageController@index');

// auth action
Route::auth();

// RESTful API
Route::resource('user', 'UserController', ['only' => [
    'index', 'edit', 'update', 'store', 'destroy'
]]);

Route::resource('food', 'FoodController', ['only' => [
    'index', 'edit', 'update', 'store', 'destroy'
]]);

Route::resource('employee', 'EmployeeController', ['only' => [
    'index', 'edit', 'update', 'store', 'destroy'
]]);

Route::resource('rank', 'RankController', ['only' => [
    'index', 'edit', 'update', 'store', 'destroy', 'show'
]]);

Route::resource('table', 'TableController', ['only' => [
    'index', 'edit', 'update', 'store', 'destroy'
]]);

Route::resource('trade', 'TradeController', ['only' => [
    'index', 'edit', 'update', 'store', 'destroy'
]]);

Route::resource('rmd', 'RmdController', ['only' => [
    'show', 'index'
]]);


