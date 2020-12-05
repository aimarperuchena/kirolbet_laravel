<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game_Bet extends Model
{
    use HasFactory;
    protected $table = 'game_bet';
    protected $fillable = ['id', 'game_id', 'market_id'];
    public function market()
    {
        return $this->belongsTo(Market::class, 'market_id');
    }
    public function game()
    {
        return $this->belongsTo(Game::class, 'game_id');
    }
    public function odds()
    {
        return $this->hasMany(Odds::class);
    }
    public function surebets()
    {
        return $this->hasMany(Surebet::class);
    }
}
