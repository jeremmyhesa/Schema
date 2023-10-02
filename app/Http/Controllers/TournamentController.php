<?php

namespace App\Http\Controllers;

use App\Models\Tournament;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class TournamentController extends Controller
{
    public function index() {
        
        $title = '';
        if(request('category')) {
            $category = Category::firstWhere('slug', request('category'));
            $title = ' in ' . $category->name;
        }

        if(request('organizer')) {
            $organizer = User::firstWhere('username', request('organizer'));
            $title = ' by ' . $organizer->name;
        }

        return view('tournaments',[
            "title" => "All Tournaments" . $title,
            "active" => 'tournaments',
            "tournaments" => Tournament::latest()->filter(request(['search', 'category', 'organizer']))
            ->paginate(7)->withQueryString()

        ]);
    }

    public function show(Tournament $tournament) {
        return view('dashboard.tournaments.show', [
            "title" => "Schema|Tournament",
            "active" => 'tournaments',
            "tournament" => $tournament
        ]);
    }
}