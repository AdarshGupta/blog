<?php

namespace App\Http\Controllers;


use App\Post;
use App\Comment;


class CommentsController extends Controller
{
    //
    public function store(Post $post)
    {
    	$this->validate(request(), ['body' => 'required|min:2']);

    	$post->addComment(request('body'), \Auth::user()->id);
    	// Comment::create([				Added in Post,php in addComment()
    	// 	'body' => request('body'),
    	// 	'post_id' => $post->id
    	// ]);

    	return back();
    }
}
