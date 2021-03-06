<?php

// Event::listen('illuminate.query', function($sql) {
//     var_dump($sql);
// });

Route::get('login', 'SessionsController@create');
Route::get('logout', 'SessionsController@destroy');
Route::resource('sessions', 'SessionsController');

Route::resource('tags', 'TagsController');
Route::resource('posts', 'PostsController');
Route::resource('categories', 'CategoriesController');
Route::resource('series', 'SeriesController');
Route::resource('comments', 'CommentsController');

Route::get('register', 'UsersController@create');
Route::get('members', 'UsersController@index');
Route::resource('users', 'UsersController');

Route::get('/category/{category}/posts', 'PostsController@byCategory');
Route::get('/tag/{tag}/posts', 'PostsController@byTag');

Route::get('/{slug}', 'PostsController@show');
Route::get('/', 'PagesController@home');
