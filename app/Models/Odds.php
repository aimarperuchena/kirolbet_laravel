<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Odds extends Model
{
    use HasFactory;
    protected $table = 'odds';
    protected $fillable = ['id', 'game_bet_id', 'odd', 'des','created_at'];
}
