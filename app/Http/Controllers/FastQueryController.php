<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Movie;
use App\Cast;
use Illuminate\Http\Request;

class FastQueryController extends Controller
{

    public function query(Request $request)
    {
        $q = $request->input('q');
        $results["q"] = $q;
        $results["movies"] = [];
        $results["casts"] = [];
        if(!strcmp($q,""))
            return $results;
        $results["movies"] = Movie::where('name', 'like' ,'%'.$q.'%')->take(3)->get();
        $results["casts"] = Cast::where('name', 'like' ,'%'.$q.'%')->take(3)->get();
        return $results;
    }

}
