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

        $leagues = League::where('sport_id', $sport_id)->get();
        return view('main.leagues')->with('leagues', $leagues);
    }
    public function getLeague($league_id)
    {
        $sport=DB::select('SELECT sport.id, sport.des FROM league, sport where league.id=' . $league_id . ' and sport.id=league.sport_id;');
        $league=DB::select('SELECT league.des as league, sport.id as sport_id, sport.des as sport FROM league, sport where league.id=' . $league_id . ' and sport.id=league.sport_id;');
        $games = DB::select('select id, game, Concat(DATE_FORMAT(date, "%Y/%m/%d")," ", time+ INTERVAL 1 HOUR) as date_time from game where league_id=' . $league_id . ' order by  date_time desc;');
        $teams=DB::select('SELECT distinct team.des as des, team.id as id FROM game_team, team where game_team.league_id=' . $league_id . ' and team.id=game_team.team_id order by des asc ;');
        return view('main.league')->with('games', $games)->with('teams',$teams)->with('league',$league[0])->with('sport',$sport[0]);
    }
}
