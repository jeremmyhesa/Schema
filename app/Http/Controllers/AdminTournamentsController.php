<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tournament;
use App\Models\Category;
use App\Models\User;

class AdminTournamentsController extends Controller
{
public function index() {
    $title ='';
    return view('dashboard.tours.index', [
        "title" => "All Tournaments" . $title,
            "active" => 'tournaments',
            "tournaments" => Tournament::latest()->firstWhere(request(['search', 'category', 'organizer']))
            ->paginate(7)->withQueryString()
    ]);
}
}
