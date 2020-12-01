<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game_Team extends Model
{
    use HasFactory;
    protected $table = 'game_team';
    protected $fillable = ['id', 'game_id', 'team_id', 'league_id'];

}
