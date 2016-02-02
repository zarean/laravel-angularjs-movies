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
        $movieNames = ['Star Wars 1', 'Star Wars 2', 'Star Wars 3', 'Batman', 'Godfather', 'Avatar'];
        foreach($movieNames as $movieName){
            $movie = new \App\Movie();
            $movie->name = $movieName;
            $movie->save();
        }

    }
}
