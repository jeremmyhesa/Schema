<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    public function tournaments() {
        return $this->belongsTo(Tournament::class, 'tournament_id');
    }

    public function rounds() {
        return $this->belongsTo(Round::class, 'round_id');
    }

    public function teams() {
        return $this->hasMany(Team::class);
    }
}
