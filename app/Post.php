<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    protected $fillable = ['title', 'body'];
    // This allows mass assignment using Post::createt(..) in PostController.php... method store()
    // OR
    // protected $guarded = []; <-- It's opposite of $fillable...fields which are not allowed

}
