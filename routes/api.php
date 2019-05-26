<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('users', 'UserController');
	Route::post('register', 'UserController@register');
	Route::post('login', 'UserController@login');
	Route::post('recover', 'UserController@recover');

Route::apiResource('foods', 'FoodController');
	Route::post('addfood', 'FoodController@add');
	Route::get('getfood', 'FoodController@get_food');

Route::apiResource('orders', 'OrderController');
	Route::post('neworder', 'OrderController@neworder');

