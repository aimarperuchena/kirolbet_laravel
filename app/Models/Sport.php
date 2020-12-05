<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Sport extends Model
{
    use HasFactory;
    protected $table = 'sport';
    protected $fillable = ['id', 'des'];

    public function leagues()
    {
        return $this->hasMany(League::class);
    }
    public function markets()
    {
        return $this->hasMany(Market::class);
    }
    public function surebets()
    {
        return $this->hasMany(Surebet::class);
    }
}
