<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    //
    public function posts()
    {
        // Posts and tags have many-to-many relationship
        return $this->belongsToMany(Post::class);
    }
}
