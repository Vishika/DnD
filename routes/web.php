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

Auth::routes();

Route::get('/', 'HomeController@index');

Route::get('/registrable/create', 'RegistrableController@create');
Route::post('/registrable', 'RegistrableController@store');

Route::get('/user', 'UserController@index');
Route::get('/user/{user}', 'UserController@show');
Route::get('/user/{user}/edit', 'UserController@edit');
Route::patch('/user/{user}/password', 'UserController@updatePassword');
Route::patch('/user/{user}', 'UserController@update');

Route::get('/user/{user}/character', 'CharacterController@index');
Route::get('/user/{user}/character/create', 'CharacterController@create');
Route::get('/user/{user}/character/{character}/edit', 'CharacterController@edit');
Route::get('/user/{user}/character/{character}', 'CharacterController@show');
Route::post('/user/{user}/character', 'CharacterController@store');
Route::patch('/user/{user}/character/{character}', 'CharacterController@update');

Route::get('/user/{user}/character/{character}/contribute', 'ContributionsController@create');
Route::post('/user/{user}/character/{character}/contribute', 'ContributionsController@store');

Route::get('/session', 'SessionController@index');
Route::get('/session/create', 'SessionController@create');
Route::post('/session', 'SessionController@store');
