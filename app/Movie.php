<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    /**
     * return casts of the movie
     */
    public function casts()
    {
        return $this->belongsToMany('App\Cast', 'cast_movie');
    }
}
