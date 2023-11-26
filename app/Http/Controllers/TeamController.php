<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\Game;
use App\Models\Tournament;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateTeamRequest;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function participants(Tournament $tournament)
    {
        return view('dashboard.tournaments.participants', [
            "title" => 'Add Participants',
            "active" => 'tournaments',
            "tournament" => $tournament,
            "teams" => Team::where('tournament_id', $tournament->id)->get()
            // where('tournament_id', $tournament->id)
        ]);
    }

    // public function save(Request $request)
    // {
    //     $validatedData = $request->validate([
    //         'name' => 'required'|'max:255'
    //     ]);
        
    //     Team::create($validatedData);

    //     return redirect('/dashboard/participants');
    //     // ->with('add team succes');
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTeamRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Team $team)
    {
        $validatedData = $request->validate([
            'name' => 'max:255|required'
        ]);

        // $validatedData['tournament_id'] = $team->tournament->id;

        Team::create($validatedData);

        return redirect('/dashboard/tournaments/participants');


    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function show(Team $team)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function edit(Team $team)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTeamRequest  $request
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Team $team)
    {
        // $rules = [
        //     'name' => 'required|max:255'
        // ];

        // $validatedData = $request->validate($rules);

        // $validatedData['user_id'] = auth()->user()->id;

        // Team::where('id', $team->id)
        //     ->update($validatedData);

        // return redirect('/dashboard/participants');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function destroy(Team $team)
    {
        
    }
}
