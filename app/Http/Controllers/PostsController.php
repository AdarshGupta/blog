<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    } 

    public function index()
    {
        $posts = Post::latest()->get();
    	return view('posts.index', compact('posts'));
    }

    public function show(Post $post)
    {
        //$post = Post::find($id); Replaced by Route Model Binding
    	return view('posts.show', compact('post'));
    }

    public function create()
    {
    	return view('posts.create');
    }

    public function store()
    {
        // Inputvalidation
        $this->validate(request(), [
            'title' => 'required',
            'body' => 'required'
        ]);

        // create  a new post using the request data
        // $post = new Post; // or new \App\Post;
        // $post->title = request('title');
        // $post->body = request('body');

        // // Save it to the database
        // $post->save();

        // OR
        // But it would give massassignment error for security reasons
        // Post::create([
        //     'title' => request('title'),
        //     'body' => request('body'),
        //     'user_id' => auth()->id()
        // ]);

        // can also be written as
        //Post::create(request(['title', 'body']));

        //OR

        auth()->user()->publish(
            new Post(request(['title', 'body'])) // uses User.php
        );

        // And then redirect to the home page.
        return redirect('/');
    }
}

