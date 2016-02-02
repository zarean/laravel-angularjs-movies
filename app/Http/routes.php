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
    return view('layouts.app');
});


Route::group(['middleware' => 'cors'], function(){
    /**
     * Query
     */
    Route::get('/query', 'QueryController@query');

    Route::get('/fastquery', 'FastQueryController@query');
});


