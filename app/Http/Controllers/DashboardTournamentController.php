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
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
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
            "teams" => Team::where('tournament_id', $tournament->id)->paginate(8),
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
                'name' => 'max:11|required',
            ]);

            $validatedData['tournament_id'] = $tournament->id;

            Team::create($validatedData);

            $perPage = 8;
            $totalItems = Team::where('tournament_id', $tournament->id)->count();
            $lastPage = ceil($totalItems / $perPage);
            return redirect()->route('participants', ['tournament' => $tournament->slug, 'page' => $lastPage]);
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

        $values = Team::where('tournament_id', $tournament->id)->get();
        $firstTeam = $values->first();
        $lastTeam = $values->last();
        $midleTeams = $values->slice(1, -1);
        $midleTeams = $midleTeams->shuffle();
        $shuffled = $midleTeams->prepend($firstTeam)->push($lastTeam);
        
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

        for ($i = 0; $i < $games->count(); $i ++) {
            $existing_game = Game::find($games[$i]);
            if ($existing_game) {
                return redirect()->route('tournament', ['tournament' => $tournament->slug])->with('error', "The tournament is underway");
            } 
        }

        $startingRound = 1; //currentTeams = 32
        if ($currentTeams == 16) $startingRound = 2;
        if ($currentTeams == 8) $startingRound = 3;
        $maxMatch = $currentTeams / 2;
        $countTeam = 0;
        for ($round = $startingRound; $round <= 6; $round++) {
            for ($match = 1; $match <= $maxMatch; $match++) {
                $homeTeam = $values[$countTeam] ?? null;
                $awayTeam = $values[++$countTeam] ?? null;

                // Create a new game
                $game = new Game();
                $game->tournament_id = $tournament->id;
                $game->round_id = $round;
                $game->match_id = $match;
                $game->home_team_id = $homeTeam != null ? $homeTeam->id : null;
                $game->away_team_id = $awayTeam != null ? $awayTeam->id : null;
                $game->date = now();
                $game->save();

                $countTeam++;
            }
            $maxMatch = round($maxMatch / 2);
        }

        return redirect()->route('tournament', ['tournament' => $tournament->slug])->with('success', "Tournament is ready to run");
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
        return view('dashboard.tournaments.show', [
                    "title" => "Schema|Tournament",
                    "active" => 'tournaments',
                    "tournament" => $tournament,
                    "category" => $category,
                    "teams" => Team::where('tournament_id', $tournament->id)->get(),
                    "games_1" => Game::where('tournament_id', $tournament->id)
                                    ->where('round_id', 1 )
                                    ->with('homeTeam', 'awayTeam')->get(),
                    "games_2" => Game::where('tournament_id', $tournament->id)
                                    ->where('round_id', 2 )
                                    ->with('homeTeam', 'awayTeam')->get(),
                    "games_3" => Game::where('tournament_id', $tournament->id)
                                    ->where('round_id', 3 )
                                    ->with('homeTeam', 'awayTeam')->get(),
                    "games_4" => Game::where('tournament_id', $tournament->id)
                                    ->where('round_id', 4 )
                                    ->with('homeTeam', 'awayTeam')->get(),
                    "finals" => Game::where('tournament_id', $tournament->id)
                                    ->where('round_id', 5 )
                                    ->with('homeTeam', 'awayTeam')->get(),
                    "winner" => Game::where('tournament_id', $tournament->id)
                                    ->where('round_id', 6 )
                                    ->with('homeTeam', 'awayTeam')->first(),
                    "rounds" => Round::all(),
                        ]);
    }

    // Make Next Round
    public function nextRound(Request $request)
    {
        // Determine winner
        $tournamentId = $request['tournament_id'];
        $roundId = $request['round_id'];
        $homeTeamId = $request['home_team_id'];
        $awayTeamId = $request['away_team_id'];
        $gameId = $request['game_id'];
        $matchId = $request['match_id'];
        $homeTeamScore = $request['home_team_score'];
        $awayTeamScore = $request['away_team_score'];

        $winnerId = $homeTeamScore > $awayTeamScore ? $homeTeamId : $awayTeamId;
        Game::where('id', $gameId)
        ->update([
            'home_team_score' => $homeTeamScore,
            'away_team_score' => $awayTeamScore,
            'winner_id' => $winnerId,
            'updated_at' => now()
        ]);

        $nextMatchId = 0;
        $homeTeamId = null;
        $awayTeamId = null;
        if ($matchId % 2 != 0) {
            $nextMatchId = round($matchId / 2);
            $homeTeamId = $winnerId;
        } else {
            $nextMatchId = $matchId / 2;
            $awayTeamId = $winnerId;
        }
        $dataToUpdate = ['updated_at' => now()];
        if ($homeTeamId != null) $dataToUpdate['home_team_id'] = $homeTeamId;
        if ($awayTeamId != null) $dataToUpdate['away_team_id'] = $awayTeamId;
        Game::where([
            ['tournament_id', '=', $tournamentId],
            ['round_id', '=', ++$roundId],
            ['match_id', '=', $nextMatchId]
        ])
        ->update($dataToUpdate);

        return redirect()->route('tournament', $request['tournament_slug']);
    }

            
            
    //     return redirect()->route('tournament', ['tournament' => $tournament->slug])
    //             ->with('success', "Games for the next round has been created successlly");
        
    // }

//     protected function createNextRoundGames(Round $round, $winner_team_id, Tournament $tournament, Game $game)
//     {      
//     $currentRound = $game->round_id;
//     $nextRound = $currentRound + 1;

//     // Get all the winner
//     $winners = Game::where('round_id', $currentRound)
//         ->whereNotNull('home_team_score')
//         ->whereNotNull('away_team_score')
//         ->where(function ($query) use ($winner_team_id) {
//             $query->where('home_team_id', $winner_team_id)
//                   ->orWhere('away_team_id', $winner_team_id);
//         })
//         ->pluck('home_team_id', 'away_team_id')
//         ->toArray();

//     // Remove duplicates and ensure no team is paired with itself
//     $winners = array_filter(array_unique(array_merge(array_keys($winners), array_values($winners))));
//     $winners = array_diff($winners, [$winner_team_id]);

//         // Pair the winner
//         $pairedWinners = array_chunk($winners, 2);
    
//         foreach ($pairedWinners as $pair) {
//             if (count($pair) == 2) {
//                 Game::create([
//                     'tournament_id' => $tournament->id,
//                     'round_id' => $nextRound,
//                     'home_team_id' => $pair[0],
//                     'away_team_id' => $pair[1],
//                     'date' => null,
//                     'home_team_score' => null,
//                     'away_team_score' => null,
//                 ]);
//             } else {

//             }
            
//     }
// }

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
