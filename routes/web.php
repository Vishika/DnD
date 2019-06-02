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

/*
 * GET /x (index)
 * GET /x/create (create)
 * GET /x/1 (show)
 * POST /x/(store)
 * GET /x/1/edit (edit)
 * PATCH /x/1 (update)
 * DELETE /x/1 (destroy)
 */
/* Route::get('/user', 'UserController@index');
 Route::get('/user/create', 'UserController@create');
 Route::get('/user/{user}', 'UserController@show');
 Route::post('/user', 'UserController@store');
 Route::get('/user/{user}/edit', 'UserController@edit');
 Route::patch('/user/{user}', 'UserController@update');
 Route::delete('/user/{user}', 'UserController@destroy'); */

Auth::routes();

Route::get('/', 'PagesController@index');
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/registrable/create', 'RegistrableController@create');
Route::post('/registrable', 'RegistrableController@store');

Route::get('/user', 'UserController@index');
Route::get('/user/{user}', 'UserController@show');
Route::get('/user/{user}/edit', 'UserController@edit');
Route::patch('/user/{user}', 'UserController@update');

Route::get('/character', 'CharacterController@index');
Route::get('/character/create', 'CharacterController@create');
Route::get('/character/{character}/edit', 'CharacterController@edit');
Route::get('/character/{character}', 'CharacterController@show');
Route::post('/character', 'CharacterController@store');
Route::patch('/character/{character}', 'CharacterController@update');

Route::get('/session', 'SessionsController@index');



