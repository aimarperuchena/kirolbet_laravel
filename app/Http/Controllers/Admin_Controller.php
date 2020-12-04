<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Sport;
use App\Models\League;
use App\Models\Game;
use App\Models\Surebet;
use Illuminate\Http\Request;
use Carbon\Carbon;

class Admin_Controller extends Controller
{
    public function indexDashboard()
    {
        $total_odds_query = DB::table('odds')->count();
        $total_games_query = DB::table('game')->count();
        $total_sports_query = DB::table('sport')->count();
        $total_leagues_query = DB::table('league')->count();
        $odds_today = DB::table('odds')
            ->whereDate('created_at', Carbon::today())->count();
        $games_today = DB::table('game')
            ->whereDate('date', Carbon::today())->count();
        $total_odds = number_format($total_odds_query);
        $game_totals = number_format($total_games_query);
        $total_sports = number_format($total_sports_query);
        $total_leagues = number_format($total_leagues_query);
        $sports = Sport::simplePaginate(10);


        return view('admin.dashboard')->with('game_totals', $game_totals)->with('total_odds', $total_odds)->with('total_games', $game_totals)->with('odds_today', number_format($odds_today))->with('total_sports', $total_sports)->with('total_leagues', $total_leagues)->with('sports', $sports);
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
        $surebets_date = DB::select('SELECT round(avg(surebet.benefit),2) as average,count(surebet.benefit) as cont,game.date as game_date FROM game, surebet where  game.sport_id=' . $id . '  and surebet.game_id=game.id group by game.date order by  game_date desc;');
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
        $game = DB::select('select game.id, game, Concat(DATE_FORMAT(date, "%Y/%m/%d")," ", time+ INTERVAL 1 HOUR) as date_time, sport.des as sport, league.des as league from game, sport, league where game.id=' . $id . ' and sport.id=game.sport_id and league.id=game.league_id limit 1;');
        $teams = DB::select('select team.id as id, team.des as des from game_team, team where game_id=' . $id . ' and team.id=game_team.team_id;');
        $game_bets = DB::select('select game_bet.id, market.des from game_bet, market where game_id=' . $id . ' and market.id=game_bet.market_id;');
        $surebets_list=DB::select('SELECT round(surebet.benefit,2) as benefit, market.des as market_des FROM Kirolbet_db.surebet, game, market where surebet.game_id= game.id and game.id=' . $id . ' and market.id=surebet.market_id order by benefit desc;');
        $surebets_totals=DB::select('SELECT IFNULL(round(avg(surebet.benefit),2),0) as average, count(surebet.id) as cont FROM surebet where surebet.game_id=' . $id . ';');
        return view('admin.game')->with('game', $game[0])->with('teams', $teams)->with('game_bets', $game_bets)->with('surebets_list',$surebets_list)->with('surebets_totals',$surebets_totals[0]);
    }
}
