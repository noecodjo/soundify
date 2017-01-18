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


///////////////
// HOME PAGE //
///////////////

Route::get('/', 'HomeController@index');


/////////////
// TRACKS  //
/////////////

Route::get('/tracks/create', 'TracksController@create');
Route::get('/tracks/{track}', 'TracksController@show');
Route::get('/tracks/{track}/likes', 'LikesController@showLikes');
Route::get('/tracks/{track}/delete', 'TracksController@delete');
Route::get('/tracks/{track}/edit', 'TracksController@edit');

Route::post('/tracks', 'TracksController@store');
Route::post('/tracks/{track}/likes', 'LikesController@toggle');
Route::post('/tracks/{track}/comments', 'CommentsController@store');

Route::delete('/tracks/{track}', 'TracksController@destroy');
Route::delete('/tracks/{track}/comments/{comment}', 'CommentsController@destroy');

Route::put('/tracks/{track}', 'TracksController@update');
Route::put('/tracks/{track}/avatar', 'TracksController@updateAvatar');


///////////
// USERS //
///////////

Route::get('users/edit', 'UsersController@edit');
Route::get('/users/you/tracks', 'UsersController@tracks');
Route::get('/users/{user}', 'UsersController@show');
Route::get('/users/{user}/likes', 'LikesController@userLikes');
Route::get('/users/{user}/followers', 'FollowersController@followers');
Route::get('/users/{user}/following', 'FollowersController@following');
Route::get('/users/{user}/comments', 'CommentsController@index');

Route::post('/users/{user}/followers', 'FollowersController@toggle');

Route::put('/users/{user}', 'UsersController@update');
Route::put('/users/{user}/password', 'UsersController@updatePassword');
Route::put('/users/{user}/avatar', 'UsersController@updateAvatar');


////////////
// SEARCH //
////////////

Route::get('/search', 'SearchController@index');

//////////
// TAGS //
//////////

Route::get('/tags/{tag}', 'TagsController@index');

Auth::routes();