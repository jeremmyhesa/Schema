<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tournament;
use App\Models\Category;
use App\Models\User;

class AdminTournamentsController extends Controller
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


        return view('dashboard.tours.index',[
            "title" => "All Tournaments" . $title,
            "active" => 'tournaments',
            "tournaments" => Tournament::latest()->filter(request(['search', 'category', 'organizer']))->paginate(4)->withQueryString()
            // "tournaments" => Tournament::latest()->firstWhere(request(['search', 'category', 'organizer']))
            // ->paginate(7)->withQueryString()

        ]);

    // $title ='';
    // return view('dashboard.tours.index', [
    //     "title" => "All Tournaments" . $title,
    //         "active" => 'tournaments',
    //         "user" => User::all(),
    //         "tournaments" => Tournament::latest()->firstWhere(request(['search', 'category', 'organizer']))
    //         ->paginate(7)->withQueryString()
    // ]);
}
}
