<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Movie;
use App\Cast;
use Illuminate\Http\Request;

class UpdateController extends Controller
{

    public function query(Request $request, $id)
    {
        $cast = Cast::find($id);
        $cast->movies()->sync($request->data);
        return;
    }

}
