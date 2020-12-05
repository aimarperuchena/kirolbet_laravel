<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Surebet_Odd extends Model
{
    use HasFactory;
    protected $table = 'game_bet';
    protected $fillable = ['id', 'surebet_id', 'odd_id'];
    public function surebet()
    {
        return $this->belongsTo(Surebet::class, 'surebet_id');
    }
    public function odd()
    {
        return $this->belongsTo(Odds::class, 'odd_id');
    }
}
