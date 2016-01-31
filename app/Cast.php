<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cast extends Model
{
    /**
     * return movies of the cast
     */
    public function movies()
    {
        return $this->belongsToMany('App\Movie', 'cast_movie');
    }
}
