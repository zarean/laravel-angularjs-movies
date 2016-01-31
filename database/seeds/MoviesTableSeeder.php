<?php

use Illuminate\Database\Seeder;

class MoviesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $movieTitles = ['Star Wars 1', 'Star Wars 2', 'Star Wars 3', 'Batman', 'Godfather', 'Avatar'];
        foreach($movieTitles as $movieTitle){
            $movie = new \App\Movie();
            $movie->title = $movieTitle;
            $movie->save();
        }

    }
}
