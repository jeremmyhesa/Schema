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

    public function scopeFilter($query, array $filters) {

        $query->when($filters['search'] ?? false, function($query, $search) {
            return $query->where('title', 'like', '%' . $search . '%');
        });

        $query->when($filters['category'] ?? false, function($query, $category) {
            return $query->whereHas('category', function($query) use($category) {
                $query->where('slug', $category);
            });
        });
        
        $query->when($filters['organizer'] ?? false, function($query, $organizer) {
            return $query->whereHas('organizer', function($query) use($organizer) {
                $query->where('username', $organizer);
            });
        });
    }

    // Fungsi Max Participants
    public function add($name)
{
    // Ambil jumlah peserta saat ini
    $currentParticipants = $this->teams()->count();

    // Ambil batas maksimal peserta dari kolom max_participants
    $maxParticipants = $this->participants;

    // Periksa apakah masih ada slot kosong untuk peserta baru
    if ($currentParticipants < $maxParticipants) {
        // Tambahkan peserta baru
        Team::create([
            'tournament_id' => $this->id,
            'name' => $name,
        ]);

        return true; // Peserta berhasil ditambahkan
    }

    return false; // Peserta tidak dapat ditambahkan karena sudah mencapai batas maksimal
}

    public function category() {

        return $this->belongsTo(Category::class);
    }

    public function organizer() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function rounds() {
        return $this->hasMany(Round::class);
    }

    public function games() {
        return $this->hasMany(Game::class);
    }
    
    public function teams() {
        return $this->hasMany(Team::class);
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
