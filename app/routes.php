<?php

// Event::listen('illuminate.query', function($sql) {
//     var_dump($sql);
// });
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
Route::get('login', 'SessionsController@create');
Route::get('logout', 'SessionsController@destroy');
Route::resource('sessions', 'SessionsController');

Route::resource('posts', 'PostsController');
Route::resource('categories', 'CategoriesController');

Route::resource('comments', 'CommentsController');

Route::get('register', 'UsersController@create');
Route::resource('users', 'UsersController');

Route::get('/', 'PagesController@home');

Route::get('createuser', function()
{
    $user = User::create([
                'name' => 'jk',
                'email' => 'jk@example.com',
                'password' => Hash::make('pwd')
            ]);
    echo 'done';
});
