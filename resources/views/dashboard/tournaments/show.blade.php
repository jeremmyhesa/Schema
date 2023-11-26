@extends('dashboard.layouts.main')
<link rel="stylesheet" href="/css/gaya.css">
@section('container')

<div class="container">
    <div class="row my-3">
      <div class="col-lg-8">
      <h1 class="mb-3">{{ $tournament->title }}</h1>
      
        <a href="/dashboard/tournaments" class="btn btn-success"><span data-feather="arrow-left"></span> Back to my tournaments</a>
        <a href="/dashboard/tournaments/{{ $tournament->slug }}/edit" class="btn btn-warning text-white">
          <span data-feather="edit"></span> Edit</a>
        <form action="/dashboard/tournaments/{{ $tournament->slug }}" method="post" class="d-inline">
          @method('delete')
          @csrf
          <button class="btn btn-danger" onclick="return confirm('Are you sure?')"><span data-feather="x-circle"></span> Delete</button>
          <a href="/dashboard/tournaments/{{ $tournament->slug }}/participants" class="btn btn-danger">Add Participants</a>
          </form>

        
      @if ($tournament->image)
      <div style="max-height: 350px; overflow:hidden;">
        <img src="{{ asset('storage/' . $tournament->image) }}" alt="{{ $tournament->category->name }}" 
        class="image-fluid mt-3">
      </div>
      @else  
      <img src="/img/turnamen.jpg" alt="Turnamen" 
      class="image-fluid mt-3">
      @endif
      <h5>{{ $tournament->date }}</h5>
      <h5>{{ $tournament->participants }}</h5>
    
    </div>
    </div>
    <div class="bg-dark">
      <main id='tournament' class="bracket mb-5">
        {{-- Check Round --}}
        <ul class='round round-1'>
          @foreach ($games as $game )
          @if ($game->round_id == 1)
          <li class='spacer'>&nbsp;</li>
          <li class='game game-top'>{{ $game->homeTeam->name ?? 'No Team'}}<span>{{ $game->home_team_score }}</span></li>
          <li class='game game-spacer'></li>
          <li class='game game-bottom'>{{ $game->awayTeam->name ?? 'No Team'}}<span>{{ $game->away_team_score }}</span></li>
          <li class='spacer'>&nbsp;</li>
          @endif
              @endforeach
            </ul>
            {{-- # --}}
            
            <ul class='round round-2'>
              @foreach ($games as $game )
              @if ($game->round_id == 2)
              <li class='spacer'>&nbsp;</li>
              <li class='game game-top'>{{ $game->homeTeam->name ?? 'No Team'}}<span>{{ $game->home_team_score }}</span></li>
              <li class='game game-spacer'></li>
              <li class='game game-bottom'>{{ $game->awayTeam->name ?? 'No Team'}}<span>{{ $game->away_team_score }}</span></li>
              <li class='spacer'>&nbsp;</li>
              @endif
                  @endforeach
                </ul>
                <ul class='round round-3'>
                  @foreach ($games as $game )
                  @if ($game->round_id == 3)
                  <li class='spacer'>&nbsp;</li>
                  <li class='game game-top'>{{ $game->homeTeam->name ?? 'No Team'}}<span>{{ $game->home_team_score }}</span></li>
                  <li class='game game-spacer'></li>
                  <li class='game game-bottom'>{{ $game->awayTeam->name ?? 'No Team'}}<span>{{ $game->away_team_score }}</span></li>
                  <li class='spacer'>&nbsp;</li>
                  @endif
                      @endforeach
                    </ul>
                    <ul class='round round-4'>
                      @foreach ($games as $game )
                      @if ($game->round_id == 4)
                      <li class='spacer'>&nbsp;</li>
                      <li class='game game-top'>{{ $game->homeTeam->name ?? 'No Team'}}<span>{{ $game->home_team_score }}</span></li>
                      <li class='game game-spacer'></li>
                      <li class='game game-bottom'>{{ $game->awayTeam->name ?? 'No Team'}}<span>{{ $game->away_team_score }}</span></li>
                      <li class='spacer'>&nbsp;</li>
                      @endif
                          @endforeach
                        </ul>
                        <ul class='round round-5'>
                          @foreach ($games as $game )
                          @if ($game->round_id == 5)
                          <li class='spacer'>&nbsp;</li>
                          <li class='game game-top'>{{ $game->homeTeam->name ?? 'No Team'}}<span>{{ $game->home_team_score }}</span></li>
                          <li class='game game-spacer'></li>
                          <li class='game game-bottom'>{{ $game->awayTeam->name ?? 'No Team'}}<span>{{ $game->away_team_score }}</span></li>
                          <li class='spacer'>&nbsp;</li>
                          @endif
                              @endforeach
                            </ul>
        <ul class='round round-3'>
          <li class='spacer'>&nbsp;</li>
          
              <li class='game game-bottom'>Jeremy Hesa (Winner)<span></span></li>
              <li class='spacer'>&nbsp;</li>
        </ul>
      </main>
      </div>
  </div>
  
  
  
@endsection