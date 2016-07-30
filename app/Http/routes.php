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

Route::get('/', 'HomeController@index');
Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
Route::get('search', 'HomeController@search');
Route::get('new-carpool', 'CarpoolController@create');
Route::post('new-carpool', 'CarpoolController@postcreate');
Route::get('my-carpools', 'CarpoolController@mypools');
Route::get('from-{from}-to-{to}', 'HomeController@fromToLocation');
Route::get('carpool-from-{from}-to-{to}', 'HomeController@fromToLocation');
Route::get('carpool-from-{from}/to-{to}', 'HomeController@fromToLocation');
Route::get('carpool-from-{from}', 'HomeController@fromLocation');
Route::get('in-{locality}', 'HomeController@inLocation');
Route::get('carpool-in-{locality}', 'HomeController@inLocation');
Route::get('details-{carpoolId}-from-{from}-to-{to}', 'HomeController@details');
Route::get('regular-carpool-{carpoolId}-from-{from}-to-{to}', 'HomeController@details');
Route::get('odd-carpool-{carpoolId}-from-{from}-to-{to}', 'HomeController@details');
Route::get('even-carpool-{carpoolId}-from-{from}-to-{to}', 'HomeController@details');
Route::get('onetime-carpool-{carpoolId}-from-{from}-to-{to}', 'HomeController@details');
Route::get('home', 'CarpoolController@mypools');
Route::get('test', 'HomeController@test');
Route::get('contact-us', 'HomeController@contact');
Route::post('contact-us', 'HomeController@postContact');