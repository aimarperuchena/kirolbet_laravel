<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Game_Bet;
use App\Models\Game_Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Sport;
use App\Models\League;
use App\Models\Odds;
use App\Models\Team;

class Main_Controller extends Controller
{
    public function indexSports()
    {
        $sports = Sport::simplePaginate(10);
        return view('main.sports')->with('sports', $sports);
    }

    public function indexLeagues($sport_id)
    {

        $leagues = League::where('sport_id', $sport_id)->get();
        return view('main.leagues')->with('leagues', $leagues);
    }

    public function indexLeague($league_id)
    {
        $league = League::where('id', $league_id)->first();
        $teams = DB::select('SELECT distinct team.des as des, team.id as id FROM game_team, team where game_team.league_id=' . $league_id . ' and team.id=game_team.team_id order by des asc ;');
        return view('main.league')->with('league', $league)->with('teams', $teams);
    }

    public function indexGame($id)
    {
        $game = Game::where('id', $id)->first();
        return view('main.game')->with('game', $game);
    }

    public function indexGameBet($game_bet_id)
    {

        $game_bet_des = DB::select('SELECT distinct des FROM odds where game_bet_id=' . $game_bet_id . '');
        $game_bet_info = DB::select('SELECT market.des as des FROM game_bet, market where game_bet.id=' . $game_bet_id . ' and market.id=game_bet.market_id;');
        $game_bet = Game_Bet::where('id', $game_bet_id)->first();
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


        return view('main.game_bet')->with('last_odds', $last_odds_array)->with('market_des', $game_bet_info[0])->with('game_bet', $game_bet)->with('surebet', $surebet_value);
    }

    public function indexTeam($team_id)
    {
        $team = Team::where('id', $team_id)->first();
        $leagues = DB::select('SELECT distinct league.id, league.des FROM game_team,league where game_team.team_id=' . $team_id . ' and league.id=game_team.league_id;');
        return view('main.team')->with('team', $team)->with('leagues',$leagues);
    }
}
