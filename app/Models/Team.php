<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    // protected $with = ['game'];

    public function games() {
        return $this->belongsTo(Game::class);
    }

}
