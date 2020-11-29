<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\League;
use App\Models\Game;
use Illuminate\Support\Facades\DB;

class League_controller extends Controller
{
    public function getLeagues($sport_id)
    {
       
        $leagues = League::where('sport_id', $sport_id)->simplePaginate(15);
        return view('main.leagues')->with('leagues', $leagues);
    }
    public function getLeague($league_id)
    {
        $id = (int)$league_id;
       $games=DB::select('select id, game, Concat(DATE_FORMAT(date, "%Y/%m/%d")," ", time+ INTERVAL 1 HOUR) as date_time from game where league_id=' . $league_id . ';');
        return view('main.league')->with('games', $games);
    }
}
