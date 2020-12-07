<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Sport;
use App\Models\League;
use App\Models\Game;
use App\Models\Game_Bet;
use App\Models\Odds;
use App\Models\Surebet;
use Illuminate\Http\Request;
use Carbon\Carbon;

class Admin_Controller extends Controller
{
    public function indexDashboard()
    {
        $sports_count = Sport::count();
        $odds_count = Odds::count();
        $games_count = Game::count();
        $leagues_count = League::count();

        $odds_today = DB::table('odds')
            ->whereDate('created_at', Carbon::today())->count();
        $games_today = DB::table('game')
            ->whereDate('date', Carbon::today())->count();

        $sports = Sport::simplePaginate(10);


        return view('admin.dashboard')->with('odds_today', number_format($odds_today))->with('sports', $sports)->with('odds_count', $odds_count)->with('sports_count', $sports_count)->with('leagues_count', $leagues_count)->with('games_count', $games_count);
    }

    public function indexLeagues($id)
    {

        $sport = Sport::where('id', $id)->first();
        $total_leagues = League::where('sport_id', $id)->count();
        $leagues = League::where('sport_id', $id)->get();
        $total_games = Game::where('sport_id', $id)->count();
        $games_today = Game::where('sport_id', $id)->whereDate('date', Carbon::today())->count();
        $totals_surebets = DB::select('SELECT count(*) as cont, round(avg(benefit),2) as average FROM surebet where sport_id=' . $id . ';');

        $surebets_today = DB::select('SELECT round(avg(surebet.benefit),2) as average, count(surebet.benefit) as cont FROM game, surebet where  game.sport_id=' . $id . '  and game.date=curdate()  and surebet.game_id=game.id;');
        $surebets_today_list = DB::select('SELECT game.game as game, market.des as market_des, round(surebet.benefit,2) as benefit FROM game, surebet, market where  game.sport_id=' . $id . '  and game.date=curdate()  and surebet.game_id=game.id and market.id=surebet.market_id order by benefit desc limit 10;');
        return view('admin.leagues')->with('leagues', $leagues)->with('total_leagues', $total_leagues)->with('total_games', $total_games)->with('games_today', $games_today)->with('sport', $sport)->with('surebets_today', $surebets_today[0])->with('totals_surebets', $totals_surebets[0])->with('surebets_today_list', $surebets_today_list);
    }

    public function indexLeague($league_id)
    {
        $surebets_today_list = DB::select('SELECT game.game as game, market.des as market_des, round(surebet.benefit,2) as benefit FROM game, surebet, market where  game.league_id=' . $league_id . '  and surebet.game_id=game.id and market.id=surebet.market_id order by surebet.benefit desc limit 10;');
        $total_games = DB::select('select count(*) as cont from game where league_id=' . $league_id . ';');

        $games_today = Game::where('league_id', $league_id)->whereDate('date', Carbon::today())->count();
        $surebets_today = DB::select('SELECT IFNULL(round(avg(surebet.benefit),2), 0) as average, count(surebet.benefit) as cont FROM game, surebet where  game.league_id=' . $league_id . '  and game.date=curdate()  and surebet.game_id=game.id;');

        $totals_surebets = DB::select('SELECT round(avg(surebet.benefit),2) as average, count(surebet.benefit) as cont FROM game, surebet where  game.league_id=' . $league_id . '  and surebet.game_id=game.id;');
        $sport = DB::select('SELECT sport.id, sport.des FROM league, sport where league.id=' . $league_id . ' and sport.id=league.sport_id;');
        $league = DB::select('SELECT league.des as league, sport.id as sport_id, sport.des as sport FROM league, sport where league.id=' . $league_id . ' and sport.id=league.sport_id;');
        $games = DB::select('select id, game, Concat(DATE_FORMAT(date, "%Y/%m/%d")," ", time+ INTERVAL 1 HOUR) as date_time from game where league_id=' . $league_id . ' order by  date_time desc;');
        $teams = DB::select('SELECT distinct team.des as des, team.id as id FROM game_team, team where game_team.league_id=' . $league_id . ' and team.id=game_team.team_id order by des asc ;');
        return view('admin.league')->with('games', $games)->with('teams', $teams)->with('league', $league[0])->with('sport', $sport[0])->with('surebets_today_list', $surebets_today_list)->with('total_games', $total_games[0])->with('games_today', $games_today)->with('totals_surebets', $totals_surebets[0])->with('surebets_today', $surebets_today[0]);
    }

    public function indexGame($id)
    {
        $surebets = Surebet::where('game_id', $id)->simplePaginate(3);
        $game = Game::where('id', $id)->first();
        return view('admin.game')->with('game', $game)->with('surebets', $surebets);
    }

    public function indexGameBet($game_bet_id){
        $game_bet_des = DB::select('SELECT distinct des FROM odds where game_bet_id=' . $game_bet_id . '');
        $game_bet_info = DB::select('SELECT market.des as des FROM game_bet, market where game_bet.id=' . $game_bet_id . ' and market.id=game_bet.market_id;');
        $game_bet = Game_Bet::where('id', $game_bet_id)->first();
        $max_odds = array();
        $last_odds_array = array();
        $surebet = 0;
        $cont = 0;
        $surebets=Surebet::where('game_bet_id',$game_bet_id)->get();
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


        return view('admin.game_bet')->with('last_odds', $last_odds_array)->with('market_des', $game_bet_info[0])->with('game_bet', $game_bet)->with('surebet', $surebet_value)->with('surebets',$surebets);

    }
}
