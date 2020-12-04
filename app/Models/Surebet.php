<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Surebet extends Model
{
    use HasFactory;
    protected $table = 'surebet';
    protected $fillable = ['id', 'game_id','league_id','sport_id','benefit','market_id','game_bet_id','created_at'];
}
