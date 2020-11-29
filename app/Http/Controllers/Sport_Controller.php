<?php

namespace App\Http\Controllers;
use App\Models\Sport;

use Illuminate\Http\Request;

class Sport_Controller extends Controller
{
    public function getSports()
    {

        $sports = Sport::simplePaginate(10);
        return view('main.sports')->with('sports', $sports);
    }
}
