<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;
use App\Models\Game_Team;
use App\Models\Game_Bet;
use Illuminate\Support\Facades\DB;



class Game_Controller extends Controller
{
    public function getGame($id)
    {
        $game = DB::select('select game.id, game, Concat(DATE_FORMAT(date, "%Y/%m/%d")," ", time+ INTERVAL 1 HOUR) as date_time, sport.des as sport, league.des as league from game, sport, league where game.id=' . $id . ' and sport.id=game.sport_id and league.id=game.league_id limit 1;');
        $teams = DB::select('select team.id as id, team.des as des from game_team, team where game_id=' . $id . ' and team.id=game_team.team_id;');
        $game_bets = DB::select('select game_bet.id, market.des from game_bet, market where game_id=' . $id . ' and market.id=game_bet.market_id;');
        return view('main.game')->with('game', $game[0])->with('teams', $teams)->with('game_bets', $game_bets);
    }
}
