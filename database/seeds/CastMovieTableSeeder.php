<?php

use Illuminate\Database\Seeder;

class CastMovieTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $movies = \App\Movie::all();
        $casts = \App\Cast::all();
        foreach($movies as $movie){
            foreach($casts as $cast){
                if(random_int(0,1)==1) {
                    $cm = new \App\Cast_Movie();
                    $cm->movie_id = $movie->id;
                    $cm->cast_id = $cast->id;
                    $cm->save();
                }
            }
        }
    }
}
