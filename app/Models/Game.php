<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function tournaments() {
        return $this->belongsTo(Tournament::class, 'tournament_id');
    }

    public function rounds() {
        return $this->belongsTo(Round::class, 'round_id');
    }

    
    public function homeTeam()
    {
        return $this->belongsTo(Team::class, 'home_team_id');
    }

    public function awayTeam()
    {
        return $this->belongsTo(Team::class, 'away_team_id');
    }
    public function winners()
    {
        return $this->belongsTo(Team::class, 'winner_id');
    }
}
