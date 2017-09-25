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


Route::get('/tasks', 'TasksController@index');

Route::get('/tasks/{task}', 'TasksController@show');



Route::get('/', 'PostsController@index');
//create PostsController - php artisan make:controller PostsController
//create Post Model - php artisan make:model Post
//create posts migration - php artisan make:migration create_posts_table --create=posts
//OR php artisan make:model Post -mc  <---- create all three together



// Problem(Soln. below): if I put Route::get('/posts/{post}','PostController@show'); before Route::get('/posts/create','PostController@create'); I will get error .
Route::get('/posts/create', 'PostsController@create');

// ***** NOTE *****
// Solution: Because Laravel will try to match the route according to the ORDER of routes registered. If you list it first, it will take priority over the other one. If you try to access "/posts/create", Laravel will match it to 'posts/{post}' and will use 'PostController@show' because '{post}' acts as a wild card. So, 'create' will be accepted as the value of the wild card '{post}'. Since there is no post with an id of 'create', you get your error.
// This will not happen if you list it at the bottom because the right controller will be triggered for the route '/posts/create'.


// Route::get('/posts/{post}', 'PostsController@show');
Route::get('/posts/{post}', 'PostsController@show')->name('home');
// posts

//****NOTE -  Use php artisan make:Controller PostsController -r  <--- to create the below methods in controller automatically 
// GET /posts

// GET /posts/create


// POST /posts  -- to submit post
Route::post('/posts', 'PostsController@store');

// GET /posts/{id}/edit  -- to edit a post

// GET /posts/{id} -- to view a post

// PATCH /posts/{id} -- to submit edit to a post

// DELETE /posts/{id} -- to delete a post



// Comments
Route::post('/posts/{post}/comments', 'CommentsController@store');


// User Authentication
Route::get('/register', 'RegistrationController@create');
Route::post('/register', 'RegistrationController@store');

Route::get('/login', 'SessionController@create');
Route::post('/login', 'SessionController@store');
Route::get('/logout', 'SessionController@destroy');