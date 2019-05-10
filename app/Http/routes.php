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

// auth action
Route::auth();

// RESTful API
Route::resource('user', 'UserController', ['only' => [
    'index', 'edit', 'update', 'store', 'destroy'
]]);
