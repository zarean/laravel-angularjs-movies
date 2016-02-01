<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{

    protected $hidden = array('created_at', 'updated_at');

    /**
     * return casts of the movie
     */
    public function casts()
    {
        return $this->belongsToMany('App\Cast', 'cast_movie');
    }
}
