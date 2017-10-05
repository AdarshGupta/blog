<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Carbon\Carbon;
use App\Repositories\Posts;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    } 


    public function index()
    {
        // Refactored - Put into a Query scope method filter in Post.php
        // $posts = Post::latest();

        // if($month = request('month'))
        // {
        //     $posts->whereMonth('created_at', Carbon::parse($month)->month);
        // }

        // if($year = request('year'))
        // {
        //     $posts->whereYear('created_at', $year);
        // }

        // $posts = $posts->get();

        //OR can be written as
        $posts = Post::latest()
                ->filter(request(['month', 'year']))
                ->get();
        // Above can be Replaced by Dependency Injection below
        //$posts = $posts->all();

        // Works only from index page since archive variable is defined here only
        // So refactored in archives() method in Post.php
        // $archives = Post::selectRaw('year(created_at) year, monthname(created_at) month, count(*) published')->groupBy('year', 'month')->orderByRaw('min(created_at) desc')->get()->toArray();

        // Removed from here to make it globally acccessible - Placed in Service providers
        //$archives = Post::archives();

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

        session()->flash(
            'message', 'Your post has now been published!'
        );

        // And then redirect to the home page.
        return redirect('/');
    }
}

