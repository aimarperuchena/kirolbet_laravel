<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;
    protected $table = 'game';
    protected $fillable = ['id', 'league_id', 'sport_id', 'game','date','time'];

    public function league(){
        return $this->belongsTo(League::class, 'league_id');
    }
    public function sport(){
        return $this->belongsTo(Sport::class, 'sport_id');
    }

    public function game_bets(){
        return $this->hasMany(Game_Bet::class);

    }
    public function surebets(){
        return $this->hasMany(Surebet::class);
    }
    public function team(){
        return $this->hasMany(Game_Team::class);
    }
}
