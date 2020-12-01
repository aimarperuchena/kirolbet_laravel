<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Team_Controller extends Controller
{
    public function getTeam($team_id)
    {
        $team = DB::select('select team.des as team, sport.des as sport from team, sport where team.id=' . $team_id . ' and sport.id=team.sport_id;');
        $games = DB::select('SELECT game.id as id, game.game as game, league.des, Concat(DATE_FORMAT(game.date, "%Y/%m/%d")," ", game.time+ INTERVAL 1 HOUR) as date_time FROM game_team, game, league where game_team.team_id=' . $team_id . ' and game.id=game_team.game_id and league.id=game.league_id order by date_time desc;');
        $leagues = DB::select('SELECT distinct league.id, league.des FROM game_team,league where game_team.team_id=' . $team_id . ' and league.id=game_team.league_id;');
        return view('main.team')->with('games', $games)->with('leagues', $leagues)->with('team', $team);
    }
}
