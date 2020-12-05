<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Market extends Model
{
    use HasFactory;
    protected $table = 'market';
    protected $fillable = ['id', 'des', 'sport_id'];
    public function sport(){
        return $this->belongsTo(Sport::class, 'sport_id');

    }
}
