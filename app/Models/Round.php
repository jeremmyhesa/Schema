<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Round1 extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function Tournament() {
        return $this->belongsTo(Tournament::class, 'tournament_id');
    }
}
