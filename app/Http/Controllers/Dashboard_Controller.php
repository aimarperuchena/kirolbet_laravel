<?php

namespace App\Http\Controllers;

use App\Charts\UserChart;
use Illuminate\Http\Request;
use App\Models\Sport;
use Illuminate\Support\Facades\DB;

class Dashboard_Controller extends Controller
{

    public function getSports()
    {

        $sports = Sport::simplePaginate(8);
        $odds_today = DB::select('select count(*) as odds from odds WHERE DATE(created_at) = CURDATE();');
        $total_games = DB::select('select count(*) as total from game;');
        $total_odds = DB::select('select count(*) as total from odds;');
        $game_totals = DB::select('select count(game.id) as tot, sport.des as sport, sport.id as sport_id from game,sport  where sport.id=game.sport_id group by game.sport_id order by sport.id asc;');
        $league_totals = DB::select('select count(league.id) as tot, sport.des as sport,sport.id as sport_id from league,sport  where sport.id=league.sport_id group by league.sport_id order by sport.id asc;');
        return view('dashboard')->with('league_totals', $league_totals)->with('game_totals', $game_totals)->with('total_odds', $total_odds)->with('total_games', $total_games)->with('sports', $sports)->with('odds_today',$odds_today);
    }
}
