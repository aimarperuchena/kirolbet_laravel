<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Surebet extends Model
{
    use HasFactory;
    protected $table = 'surebet';
    protected $fillable = ['id', 'game_id', 'league_id', 'sport_id', 'benefit', 'market_id', 'game_bet_id', 'created_at'];

    public function sport()
    {
        return $this->belongsTo(Sport::class, 'sport_id');
    }
    public function league()
    {
        return $this->belongsTo(League::class, 'league_id');
    }
    public function game()
    {
        return $this->belongsTo(Game::class, 'game_id');
    }
    public function game_bet()
    {
        return $this->belongsTo(Game_Bet::class, 'game_bet_id');
    }
    public function market()
    {
        return $this->belongsTo(Market::class, 'market_id');
    }
    public function surebet_odds()
    {
        return $this->hasMany(Surebet_Odd::class);
    }
}
