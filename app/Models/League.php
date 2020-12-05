<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class League extends Model
{
    use HasFactory;
    protected $table = 'league';
    protected $fillable = ['id', 'des', 'sport_id'];
    public function sport()
    {
        return $this->belongsTo(Sport::class, 'sport_id');
    }

    public function games()
    {
        return $this->hasMany(Game::class);
    }
    public function surebets()
    {
        return $this->hasMany(Surebet::class);
    }
    public function game_team()
    {
        return $this->hasMany(Game_Team::class);
    }
}
