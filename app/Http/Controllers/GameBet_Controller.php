<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Odds;

class GameBet_Controller extends Controller
{
    public function getGamebet($game_bet_id)
    {

        $game_bet_des = DB::select('SELECT distinct des FROM odds where game_bet_id=' . $game_bet_id . '');
        $game_bet_info = DB::select('SELECT market.des as des FROM game_bet, market where game_bet.id=' . $game_bet_id . ' and market.id=game_bet.market_id;');
        $game = DB::select("SELECT game.id, game.game as game,concat(DATE_FORMAT(game.date, '%Y/%m/%d'),' ', game.time+ INTERVAL 1 HOUR) as date_time, sport.des as sport, league.des as league FROM game_bet, game, sport, league where game_bet.id=" . $game_bet_id . " and game.id=game_bet.game_id and sport.id=game.sport_id and league.id=game.league_id;");
        $teams = DB::select('select team.id as id, team.des as des from game_team, team where game_id=' . $game[0]->id . ' and team.id=game_team.team_id;');
        $max_odds = array();
        $last_odds_array = array();
        $surebet = 0;
        $cont = 0;
        foreach ($game_bet_des as $des) {
            $odd_des = $des->des;
            $last_odd = Odds::where([
                ['des', '=', $odd_des],
                ['game_bet_id', '=', $game_bet_id],
            ])->orderBy('created_at', 'desc')->first();
            $max_odd = Odds::where([
                ['des', '=', $odd_des],
                ['game_bet_id', '=', $game_bet_id],
            ])->max('odd');
            $min_odd = Odds::where([
                ['des', '=', $odd_des],
                ['game_bet_id', '=', $game_bet_id],
            ])->min('odd');
            $surebet = $surebet + (1 / $max_odd);
            $b = (1 - $surebet);
            $a = $b * 100;
            $surebet_value = round($a, 3);
            array_push($last_odds_array, ([$odd_des, $last_odd->odd, $max_odd, $min_odd]));
        }


        return view('main.game_bet')->with('last_odds', $last_odds_array)->with('market_des', $game_bet_info[0])->with('game', $game[0])->with('teams', $teams)->with('surebet', $surebet_value);
    }
}
