<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Movie;
use App\Cast;
use Illuminate\Http\Request;

class QueryController extends Controller
{

    public function query(Request $request)
    {
        $q = $request->input('q');
        $results["movies"] = Movie::where('title', 'like' ,'%'.$q.'%')->with('casts')->get();
        $results["casts"] = Cast::where('name', 'like' ,'%'.$q.'%')->with('movies')->get();
        return view('results', ['results' => $results]);
        //return $result;
    }

}
