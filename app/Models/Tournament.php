<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tournament extends Model
{
    use HasFactory, Sluggable;


    // protected $fillable = ['title', 'date', 'participants'];
    protected $guarded = ['id'];
    protected $with = ['category', 'organizer'];

    // public function scopeFilter($query, array $filters) {

    //     $query->when($filters['search'] ?? false, function($query, $search) {
    //         return $query->where('title', 'like', '%' . $search . '%')
    //                     ->orWhere('date', 'like', '%' . $search . '%');
    //     });

    //     $query->when($filters['category'] ?? false, function($query, $category) {
    //         return $query->whereHas('category', function($query) use($category) {
    //             $query->where('slug', $category);
    //         });
    //     });

    //     $query->when($filters['organizer'] ?? false, fn($query, $organizer) =>
    //         $query->whereHas('organizer', fn($query) =>
    //             $query->where('username', $organizer)
        //     )
        // );
    // }

    public function category() {

        return $this->belongsTo(Category::class);
    }

public function round1() {
    return $this-> hasMany(Round::class);
}

    public function organizer() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
 
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

}
