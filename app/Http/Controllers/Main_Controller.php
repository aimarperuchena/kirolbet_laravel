<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Sport;
use App\Models\League;
use App\Models\Odds;

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
        $sport = DB::select('SELECT sport.id, sport.des FROM league, sport where league.id=' . $league_id . ' and sport.id=league.sport_id;');
        $league = DB::select('SELECT league.des as league, sport.id as sport_id, sport.des as sport FROM league, sport where league.id=' . $league_id . ' and sport.id=league.sport_id;');
        $games = DB::select('select id, game, Concat(DATE_FORMAT(date, "%Y/%m/%d")," ", time+ INTERVAL 1 HOUR) as date_time from game where league_id=' . $league_id . ' order by  date_time desc;');
        $teams = DB::select('SELECT distinct team.des as des, team.id as id FROM game_team, team where game_team.league_id=' . $league_id . ' and team.id=game_team.team_id order by des asc ;');
        return view('main.league')->with('games', $games)->with('teams', $teams)->with('league', $league[0])->with('sport', $sport[0]);
    }

    public function indexGame($id)
    {
        $game = DB::select('select game.id, game, Concat(DATE_FORMAT(date, "%Y/%m/%d")," ", time+ INTERVAL 1 HOUR) as date_time, sport.des as sport, league.des as league from game, sport, league where game.id=' . $id . ' and sport.id=game.sport_id and league.id=game.league_id limit 1;');
        $teams = DB::select('select team.id as id, team.des as des from game_team, team where game_id=' . $id . ' and team.id=game_team.team_id;');
        $game_bets = DB::select('select game_bet.id, market.des from game_bet, market where game_id=' . $id . ' and market.id=game_bet.market_id;');
        return view('main.game')->with('game', $game[0])->with('teams', $teams)->with('game_bets', $game_bets);
    }

    public function indexGameBet($game_bet_id)
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

    public function indexTeam($team_id)
    {
        $team = DB::select('select team.des as team, sport.des as sport from team, sport where team.id=' . $team_id . ' and sport.id=team.sport_id;');
        $games = DB::select('SELECT game.id as id, game.game as game, league.des, Concat(DATE_FORMAT(game.date, "%Y/%m/%d")," ", game.time+ INTERVAL 1 HOUR) as date_time FROM game_team, game, league where game_team.team_id=' . $team_id . ' and game.id=game_team.game_id and league.id=game.league_id order by date_time desc;');
        $leagues = DB::select('SELECT distinct league.id, league.des FROM game_team,league where game_team.team_id=' . $team_id . ' and league.id=game_team.league_id;');
        return view('main.team')->with('games', $games)->with('leagues', $leagues)->with('team', $team);
    }
}
