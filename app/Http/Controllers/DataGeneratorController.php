<?php
/**
 * Created by PhpStorm.
 * User: ali
 * Date: 1/31/16
 * Time: 10:27 PM
 */

namespace App\Http\Controllers;

use App\Movie;
use App\Cast;
use App\Cast_Movie;
use App\Http\Controllers\Controller;

class DataGeneratorController extends Controller
{

    /**
     * generate data
     */
    public function generate()
    {
        $movienames = ['Martian','Avatar','Up','Star Wars','Jurassic World','Ant Man','Minions','Mad Max','Interstellar'];
        $castnames = ['Ali Zarean','Mahmod Karimian','Mohamad FrznPr','Nima'];

        Movie::truncate();
        foreach($movienames as $moviename){
            $movie = new Movie();
            $movie->title = $moviename;
            $movie->save();
        }

        Cast::truncate();
        foreach($castnames as $castname){
            $cast = new Cast();
            $cast->name = $castname;
            $cast->save();
        }

        echo "OK";
    }
}