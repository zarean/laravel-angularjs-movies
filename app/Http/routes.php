<?php

use App\Movie;
use App\Cast;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/**
 * Display
 */
Route::get('/', function () {
    return view('app');
});

/**
 * Display
 */
Route::get('/gendata', function () {
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
});

/**
 * Query
 */
Route::get('/query', function (Request $request) {
    $string = $request->string;
    echo $string;
});

