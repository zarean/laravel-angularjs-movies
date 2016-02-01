<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cast extends Model
{
    protected $hidden = array('created_at', 'updated_at');

    /**
     * return movies of the cast
     */
    public function movies()
    {
        return $this->belongsToMany('App\Movie', 'cast_movie');
    }
}
