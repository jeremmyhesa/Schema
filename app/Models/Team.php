<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    // protected $with = ['tournament'];

    // public function games() {
    //     return $this->belongsTo(Game::class);
    // }

    // Probably
    public function tournaments() {
        return $this->belongsTo(Tournament::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getDataAttribute($team)
{
    return json_decode($team);
}
public function setDataAttribute($team)
{
    $this->attributes['data'] = json_encode($team);
}

}
