<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    protected $fillable = ['title', 'body', 'user_id'];
    // This allows mass assignment using Post::createt(..) in PostController.php... method store()
    // OR
    // protected $guarded = []; <-- It's opposite of $fillable...fields which are not allowed
    public function comments()
    {
    	return $this->hasMany(Comment::class);
    }

    public function addComment($body, $user_id)
    {
    	// Comment::create([
    	// 	'body' => $body,
    	// 	'post_id' => $this->id
    	// ]);

    	//OR
    	$this->comments()->create([
            'body' => $body,
            'user_id' => $user_id
        ]);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
