<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Round;
use App\Models\Team;
use App\Models\Category;
use App\Models\Game;
use App\Models\Tournament;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Livewire\Component;

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
            'active' => 'tournaments',
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

    //Add Participants
    public function participants(Tournament $tournament, Team $team)
    {
        return view('dashboard.tournaments.participants', [
            "title" => 'Add Participants',
            "active" => 'tournaments',
            "tournament" => $tournament,
            "teams" => Team::where('tournament_id', $tournament->id)->get(),
            "team" => $team
        ]);
    }

//     public function add(Request $request, Tournament $tournament)
// {
//     $participantName = $request->input('name');

//     if ($tournament->addParticipant($participantName)) {
//         return redirect()->route('participants', ['tournament' => $tournament->slug]);
//     } else {
//         return redirect()->back()->with('error', 'Turnamen sudah mencapai batas peserta maksimal.');
//     }
// }
    public function add(Request $request, Tournament $tournament, Team $team)
    {
        $values = Team::where('tournament_id', $tournament->id)->get();
        $currentTeams = $values->count();

        $maxTeams = $tournament->participants;

    if ($currentTeams < $maxTeams) {
        $validatedData = $request->validate([
            'name' => 'max:255|required',
        ]);

        $validatedData['tournament_id'] = $tournament->id;

        Team::create($validatedData);
        return redirect()->route('participants', ['tournament' => $tournament->slug]);
    } else {
        return redirect()->route('participants', ['tournament' => $tournament->slug])->with('error', "Teams Full");
    }
    }

    public function manage(Tournament $tournament, Team $team)
    {

        return view('dashboard.tournaments.manage', [
            "title" => 'Manage Participants',
            "active" => 'tournaments',
            "tournament" => $tournament,
            "teams" => Team::where('tournament_id', $tournament->id)->get(),
            "team" => $team
            
        ]);
    }

    public function shuffle(Tournament $tournament, Team $team)
    {
        // Check Existing Game
        $games = Game::where('tournament_id', $tournament->id)->get();

        for ($i = 0; $i < $games->count(); $i ++) {
            $existing_game = Game::find($games[$i]);
            if ($existing_game) {
                return redirect()->route('manage', ['tournament' => $tournament->slug])->with('error', "The tournament is underway");
            } 
        }
        // #

        $values = Team::where('tournament_id', $tournament->id)->get();
        $shuffled = $values->shuffle();
        
        for ($i = 0; $i < $shuffled->count(); $i ++ ) {
            $team_name = $shuffled[$i]->name;
            $tournament_id = $shuffled[$i]->tournament_id;
            $team_id = $values[$i]->id;

        $teams = Team::find($team_id);
        $teams->tournament_id = $tournament_id;
        $teams->name = $team_name;
        $teams->save(); 


}
        return redirect()->route('manage', ['tournament' => $tournament->slug]);

    }

    public function save(Tournament $tournament, Team $team, Game $game)
    {   
        $values = Team::where('tournament_id', $tournament->id)->get();
        $currentTeams = $values->count();
        $maxTeams = $tournament->participants;
        $games = Game::where('tournament_id', $tournament->id)->get();
        
        // Check Team
        if ($currentTeams < $maxTeams ) {
            return redirect()->route('participants', ['tournament' => $tournament->slug])->with('error', "Must Complete the participants first");
        }
        // #
        // Check Existing Game
        for ($i = 0; $i < $games->count(); $i ++) {
            $existing_game = Game::find($games[$i]);
            if ($existing_game) {
                // return redirect()->route('participants', ['tournament' => $tournament->slug])->with('error', "The tournament is underway");
                return redirect()->route('tournament', ['tournament' => $tournament->slug])->with('error', "The tournament is underway");
            } 
        }
        // #

                for ($i = 0; $i < $values->count(); $i += 2) {
                    $teamHome = $values[$i];
                    $teamAway = $values[$i + 1] ?? null; // If the number of teams is odd, the last team gets a bye

                    // Create a new game
                    $game = new Game();
                    $game->tournament_id = $tournament->id;
                    if ($tournament->participants == 32) {
                        $game->round_id = 1;
                    }
                    if ($tournament->participants == 16) {
                        $game->round_id = 2;
                    }
                    if ($tournament->participants == 8) {
                        $game->round_id = 3;
                    }
                    $game->date = null;
                    $game->home_team_id = $teamHome->id;
                
                    if ($teamAway) {
                        $game->away_team_id = $teamAway->id;
                    } else {
                    
                        // If the number of teams is odd, set tim_tamu to null
                $game->away_team_id = null;
            }
        
            $game->home_team_score = null;
            $game->away_team_score = null;
            $game->save();
            
        }
        return redirect('/dashboard/tournaments/{{ $tournament->slug }}');
            // return redirect()->route('participants', ['tournament' => $tournament->slug]);
}

    
    
    public function upgrade(Request $request, Tournament $tournament, Team $team)
    {
        // Check Existing Game
        $games = Game::where('tournament_id', $tournament->id)->get();

        for ($i = 0; $i < $games->count(); $i ++) {
            $existing_game = Game::find($games[$i]);
            if ($existing_game) {
                return redirect()->route('manage', ['tournament' => $tournament->slug])->with('error', "The tournament is underway");
            } 
        // #
        }
        $rules = [
            'name' => 'required|max:255',
            
        ];
        $validatedData = $request->validate($rules);

        $validatedData['tournament_id'] = $tournament->id;

        Team::where('id', $team->id)
                ->update($validatedData);

                return redirect()->route('manage', ['tournament' => $tournament->slug]);
    }

    public function delete(Tournament $tournament, Team $team)
    {   
        $games = Game::where('tournament_id', $tournament->id)->get();

        // Check Existing Game
        for ($i = 0; $i < $games->count(); $i ++) {
            $existing_game = Game::find($games[$i]);
            if ($existing_game) {
                return redirect()->route('participants', ['tournament' => $tournament->slug])->with('error', "The tournament is underway");
            } 
        // #
        }
        Team::destroy($team->id);
        
        return redirect()->route('participants', ['tournament' => $tournament->slug]);
    }




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


    public function store(Request $request, Tournament $tournament)
    {

        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'slug' => 'required|unique:tournaments',
            'category_id' => 'required',
            'image' => 'image|file|max:2048',
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
    public function show(Tournament $tournament, Category $category, Team $team, Game $game)
    {
        // $games = Game::with('homeTeam', 'awayTeam')->find($game);
        // $homeTeamName = $games->homeTeam->name;
        // $awayTeamName = $games->awayTeam->name;
        // dump($games);

        return view('dashboard.tournaments.show', [
                "title" => "Schema|Tournament",
                "active" => 'tournaments',
                "tournament" => $tournament,
                "category" => $category,
                "teams" => Team::where('tournament_id', $tournament->id)->get(),
                "games" => Game::where('tournament_id', $tournament->id)->with('homeTeam', 'awayteam')->get(),
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
