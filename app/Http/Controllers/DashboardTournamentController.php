<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Round;
use App\Models\Team;
use App\Models\Category;
use App\Models\Tournament;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Cviebrock\EloquentSluggable\Services\SlugService;

class DashboardTournamentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.tournaments.index', [
            'title' => 'Tournaments',
            'tournaments' => Tournament::where('user_id', auth()->user()->id)->paginate(5)
        ]);

    }

    public function tournaments() {

        $tournaments = Tournament::latest();

        if(request('search')) {
            $tournaments->where('title', 'like', '%' . request('search', 'category', 'organizer') . '%');
        }

        return view('dashboard/index', [
            "title" => "All Tournaments",
            "active" => 'tournaments',
            // 'tournaments' => Tournament::where('user_id', auth()->user()->id)->get(),
            'tournaments' => $tournaments->where('user_id', auth()->user()->id)->paginate(4)

        ]);
    } 

    public function participants() {
        return view('dashboard.tournaments.participants', [
            "title" => 'Add Participants',
            "active" => 'tournaments',
            // 'tournament' => Tournament::where('user_id', auth()->user()->id)->get(),
            "teams" => Team::all()
        ]);
    }


    // public function tour(Tournament $tournament) {
    //     return view('dashboard.tournaments.show', [
    //         "title" => "Schema|Tournament",
    //         "active" => 'tournaments',
    //         "tournament" => $tournament
    //     ]);
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.tournaments.create', [
            "title" => "Create Tournament",
            'categories' => Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function save(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required'|'max:255'
        ]);
        
        Team::create($validatedData);

        return redirect('/dashboard/tournaments/participants');
        // ->with('add team succes');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'slug' => 'required|unique:tournaments',
            'category_id' => 'required',
            'image' => 'image|file|max:1024',
            'date' => 'required|date',
            'participants' => 'required|max:255',
            'team_name' => 'max:500'
        ]);

        if($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('tournament-images');
        }
        
        $validatedData['user_id'] = auth()->user()->id;

        Tournament::create($validatedData);

        return redirect('/dashboard/tournaments/')->with('success', 'New tournament has been added!');
    } 

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tournament  $tournament
     * @return \Illuminate\Http\Response
     */
    public function show(Tournament $tournament, Category $category)
    {
        return view('dashboard.tournaments.show', [
                "title" => "Schema|Tournament",
                "active" => 'tournaments',
                "tournament" => $tournament,
                "category" => $category
                    ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tournament  $tournament
     * @return \Illuminate\Http\Response
     */
    public function edit(Tournament $tournament)
    {
        return view('dashboard.tournaments.edit', [
            'title' => 'Tournament Edit',
            'tournament' => $tournament,
            'categories' => Category::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tournament  $tournament
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tournament $tournament)
    {
        $rules = [
            'title' => 'required|max:255',
            'category_id' => 'required',
            'participants' => 'required|max:255', 
            'date' => 'required|date',
            'image' => 'image|file|max:1024'
        ];

        if($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('tournament-images');
        }

        if($request->slug != $tournament->slug) {
            $rules['slug'] = 'required|unique:tournaments';
        }

        $validatedData = $request->validate($rules);

        if($request->file('image')) {
            if($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $validatedData['image'] = $request->file('image')->store('tournament-images');
        }

        $validatedData['user_id'] = auth()->user()->id;

        Tournament::where('id', $tournament->id)
                ->update($validatedData);

        return redirect('/dashboard/tournaments/')->with('success', 'Tournament has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tournament  $tournament
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tournament $tournament)
    {
        if($tournament->image) {
            Storage::delete($tournament->image);
        }
        Tournament::destroy($tournament->id);

        return redirect('/dashboard/tournaments/')->with('success', 'Tournament has been deleted');
    }

    public function checkSlug(Request $request) {
        $slug = SlugService::createSlug(Tournament::class, 'slug', $request->title);
        return response()->json(['slug' => $slug]);
    }
    
}
