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

Route::get('/posts/create', 'PostsController@create');
// Route::get('/posts/{post}', 'PostsController@show');

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

