<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;
    protected $table = 'team';
    protected $fillable = ['id', 'sport_id', 'des'];
    public function game_team()
    {
        return $this->hasMany(Game_Team::class);
    }
    public function sport()
    {
        return $this->belongsTo(Sport::class, 'sport_id');
    }
}
