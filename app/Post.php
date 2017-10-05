<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
Use Carbon\Carbon;

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

    // Query Scope
    public function scopeFilter($query, $filters)
    {
        if(isset($filters['month']))
        {
            $month = $filters['month'];
            $query->whereMonth('created_at', Carbon::parse($month)->month);
        }

        if(isset($filters['year']))
        {
            $year = $filters['year'];
            $query->whereYear('created_at', $year);
        }
    }

    public static function archives()
    {
        return static::selectRaw('year(created_at) year, monthname(created_at) month, count(*) published')->groupBy('year', 'month')->orderByRaw('min(created_at) desc')->get()->toArray();
    }

    public function tags()
    {
        // Posts and tags have many-to-many relationship
        return $this->belongsToMany(Tag::class);
    }

}
