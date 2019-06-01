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

Route::get('/', 'PagesController@index');
Route::get('/session', 'SessionsController@index');

Route::resource('user', 'UserController');
Route::resource('character', 'CharacterController');

/* Route::get('/user', 'UserController@index');
Route::get('/user/create', 'UserController@create');
Route::get('/user/{user}', 'UserController@show');
Route::post('/user', 'UserController@store');
Route::get('/user/{user}/edit', 'UserController@edit');
Route::patch('/user/{user}', 'UserController@update');
Route::delete('/user/{user}', 'UserController@destroy'); */